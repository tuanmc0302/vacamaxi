<?php

namespace Tests\Feature\Backend;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\Security\GoogleTwoFactorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackendLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_backend_login_page_is_accessible(): void
    {
        $this->get('/admin')
            ->assertOk()
            ->assertSee('Đăng nhập quản trị');
    }

    public function test_guest_is_redirected_to_admin_login_instead_of_missing_default_login_route(): void
    {
        $this->get('/admin/users')
            ->assertRedirect(route('admin.login'));
    }

    public function test_user_can_login_to_backend_dashboard(): void
    {
        $user = User::factory()->create([
            'username' => 'sondev03',
            'password' => 'password',
        ]);

        $role = $this->createRoleWithPermissions('super_admin', 'Quản trị hệ thống', [
            'admin.dashboard.view' => 'Xem bảng điều khiển',
        ]);

        $user->roles()->attach($role);

        $this->post('/admin/login', [
            'username' => $user->username,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_redirects_to_two_factor_challenge_when_enabled(): void
    {
        $service = app(GoogleTwoFactorService::class);
        $user = User::factory()->create([
            'username' => 'secureadmin',
            'password' => 'password',
            'google_two_factor_secret' => $service->generateSecret(),
            'google_two_factor_enabled' => true,
            'google_two_factor_confirmed_at' => now(),
        ]);

        $role = $this->createRoleWithPermissions('secure_role', 'Bảo mật', [
            'admin.dashboard.view' => 'Xem bảng điều khiển',
        ]);
        $user->roles()->attach($role);

        $this->post('/admin/login', [
            'username' => 'secureadmin',
            'password' => 'password',
        ])->assertRedirect(route('admin.two-factor.challenge'));
    }

    public function test_user_with_enabled_two_factor_cannot_access_dashboard_without_verification(): void
    {
        $service = app(GoogleTwoFactorService::class);
        $user = User::factory()->create([
            'google_two_factor_secret' => $service->generateSecret(),
            'google_two_factor_enabled' => true,
            'google_two_factor_confirmed_at' => now(),
        ]);

        $role = $this->createRoleWithPermissions('two_factor_role', 'Vai trò 2FA', [
            'admin.dashboard.view' => 'Xem bảng điều khiển',
        ]);
        $user->roles()->attach($role);

        $this->actingAs($user)
            ->withSession(['admin_two_factor_passed' => false])
            ->get('/admin/dashboard')
            ->assertRedirect(route('admin.two-factor.challenge'));
    }

    public function test_invalid_credentials_redirect_back_to_login(): void
    {
        User::factory()->create([
            'username' => 'adminroot',
            'password' => 'password',
        ]);

        $this->from('/admin')
            ->post('/admin/login', [
                'username' => 'adminroot',
                'password' => 'wrong-password',
            ])
            ->assertRedirect('/admin')
            ->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    public function test_user_without_permission_cannot_access_protected_admin_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['admin_two_factor_passed' => true])
            ->get('/admin/users')
            ->assertForbidden();
    }

    public function test_authorized_admin_can_create_new_user(): void
    {
        $admin = User::factory()->create(['username' => 'admincreator']);

        $role = $this->createRoleWithPermissions('user_manager', 'Quản lý người dùng', [
            'admin.users.view' => 'Xem danh sách người dùng',
            'admin.users.create' => 'Tạo mới người dùng',
            'admin.users.edit' => 'Cập nhật người dùng',
            'admin.users.delete' => 'Xóa người dùng',
        ]);

        $admin->roles()->attach($role);

        $this->actingAs($admin)
            ->withSession(['admin_two_factor_passed' => true])
            ->post('/admin/users', [
                'full_name' => 'Nguyễn Văn A',
                'username' => 'nguyenvana',
                'email' => 'nguyenvana@example.com',
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'role_ids' => [$role->id],
            ])
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'username' => 'nguyenvana',
            'full_name' => 'Nguyễn Văn A',
        ]);
    }

    public function test_authorized_admin_can_update_existing_user(): void
    {
        $admin = User::factory()->create(['username' => 'usereditor']);

        $managerRole = $this->createRoleWithPermissions('user_editor', 'Quản lý người dùng', [
            'admin.users.view' => 'Xem danh sách người dùng',
            'admin.users.edit' => 'Cập nhật người dùng',
        ]);

        $assignableRole = Role::query()->create([
            'name' => 'editor',
            'title' => 'Biên tập viên',
        ]);

        $user = User::factory()->create([
            'full_name' => 'Tên cũ',
            'username' => 'userold',
            'email' => 'userold@example.com',
        ]);

        $admin->roles()->attach($managerRole);

        $this->actingAs($admin)
            ->withSession(['admin_two_factor_passed' => true])
            ->put('/admin/users/'.$user->id, [
                'full_name' => 'Tên mới',
                'username' => 'usernew',
                'email' => 'usernew@example.com',
                'password' => '',
                'password_confirmation' => '',
                'role_ids' => [$assignableRole->id],
            ])
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'usernew',
        ]);
        $this->assertDatabaseHas('role_user', [
            'user_id' => $user->id,
            'role_id' => $assignableRole->id,
        ]);
    }

    public function test_authorized_admin_can_delete_user(): void
    {
        $admin = User::factory()->create(['username' => 'userdeleter']);

        $managerRole = $this->createRoleWithPermissions('user_deleter', 'Quản lý người dùng', [
            'admin.users.view' => 'Xem danh sách người dùng',
            'admin.users.delete' => 'Xóa người dùng',
        ]);

        $user = User::factory()->create(['username' => 'removeme']);
        $admin->roles()->attach($managerRole);

        $this->actingAs($admin)
            ->withSession(['admin_two_factor_passed' => true])
            ->delete('/admin/users/'.$user->id)
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_user_listing_supports_search_and_role_filter(): void
    {
        $admin = User::factory()->create(['username' => 'userfilter']);

        $managerRole = $this->createRoleWithPermissions('user_filter', 'Quản lý người dùng', [
            'admin.users.view' => 'Xem danh sách người dùng',
        ]);

        $seoRole = Role::query()->create([
            'name' => 'seo',
            'title' => 'SEO',
        ]);

        $matchedUser = User::factory()->create([
            'full_name' => 'Nguyễn SEO',
            'username' => 'seo_user',
            'email' => 'seo@example.com',
        ]);
        $matchedUser->roles()->attach($seoRole);

        User::factory()->create([
            'full_name' => 'Khác',
            'username' => 'other_user',
            'email' => 'other@example.com',
        ]);

        $admin->roles()->attach($managerRole);

        $this->actingAs($admin)
            ->withSession(['admin_two_factor_passed' => true])
            ->get('/admin/users?keyword=seo&role_id='.$seoRole->id)
            ->assertOk()
            ->assertSee('seo_user')
            ->assertDontSee('other_user');
    }

    public function test_authorized_admin_can_create_new_role_and_assign_permissions(): void
    {
        $admin = User::factory()->create(['username' => 'rolecreator']);

        $role = $this->createRoleWithPermissions('role_manager', 'Quản lý vai trò', [
            'admin.roles.view' => 'Xem vai trò và quyền',
            'admin.roles.create' => 'Tạo mới vai trò và gán quyền',
            'admin.roles.delete' => 'Xóa vai trò',
        ]);

        $permissionA = Permission::query()->create(['name' => 'custom.permission.a', 'title' => 'Quyền A']);
        $permissionB = Permission::query()->create(['name' => 'custom.permission.b', 'title' => 'Quyền B']);
        $admin->roles()->attach($role);

        $this->actingAs($admin)
            ->withSession(['admin_two_factor_passed' => true])
            ->post('/admin/roles', [
                'name' => 'content_editor',
                'title' => 'Biên tập nội dung',
                'permission_ids' => [$permissionA->id, $permissionB->id],
            ])
            ->assertRedirect(route('admin.roles.index'))
            ->assertSessionHas('status');

        $createdRole = Role::query()->where('name', 'content_editor')->first();
        $this->assertNotNull($createdRole);
    }

    public function test_authorized_admin_can_update_existing_role_permissions(): void
    {
        $admin = User::factory()->create(['username' => 'roleeditor']);

        $managerRole = $this->createRoleWithPermissions('role_manager', 'Quản lý vai trò', [
            'admin.roles.view' => 'Xem vai trò và quyền',
            'admin.roles.create' => 'Tạo mới vai trò và gán quyền',
            'admin.roles.delete' => 'Xóa vai trò',
        ]);

        $editableRole = Role::query()->create(['name' => 'seo_editor', 'title' => 'SEO Editor']);
        $permissionA = Permission::query()->create(['name' => 'custom.permission.c', 'title' => 'Quyền C']);
        $permissionB = Permission::query()->create(['name' => 'custom.permission.d', 'title' => 'Quyền D']);

        $editableRole->permissions()->attach($permissionA);
        $admin->roles()->attach($managerRole);

        $this->actingAs($admin)
            ->withSession(['admin_two_factor_passed' => true])
            ->put('/admin/roles/'.$editableRole->id, [
                'name' => 'seo_editor',
                'title' => 'SEO Editor Updated',
                'permission_ids' => [$permissionB->id],
            ])
            ->assertRedirect(route('admin.roles.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('roles', [
            'id' => $editableRole->id,
            'title' => 'SEO Editor Updated',
        ]);
    }

    public function test_authorized_admin_can_delete_role(): void
    {
        $admin = User::factory()->create(['username' => 'roledeleter']);

        $managerRole = $this->createRoleWithPermissions('role_deleter', 'Quản lý vai trò', [
            'admin.roles.view' => 'Xem vai trò và quyền',
            'admin.roles.delete' => 'Xóa vai trò',
        ]);

        $role = Role::query()->create([
            'name' => 'content_writer',
            'title' => 'Content Writer',
        ]);

        $admin->roles()->attach($managerRole);

        $this->actingAs($admin)
            ->withSession(['admin_two_factor_passed' => true])
            ->delete('/admin/roles/'.$role->id)
            ->assertRedirect(route('admin.roles.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);
    }

    private function createRoleWithPermissions(string $name, string $title, array $permissions): Role
    {
        $role = Role::query()->create([
            'name' => $name,
            'title' => $title,
        ]);

        foreach ($permissions as $permissionName => $permissionTitle) {
            $permission = Permission::query()->create([
                'name' => $permissionName,
                'title' => $permissionTitle,
            ]);

            $role->permissions()->attach($permission);
        }

        return $role;
    }
}
