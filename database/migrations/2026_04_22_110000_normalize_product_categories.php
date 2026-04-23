<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $legacyBo = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('slug', 'bo')
            ->first();

        $legacyThit = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('slug', 'thit')
            ->first();

        $breedCategory = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('slug', 'giong-bo-vacamaxi')
            ->first();

        if (! $breedCategory && $legacyBo) {
            $legacyBo->update([
                'name' => 'Giống bò Vaca Maxi',
                'slug' => 'giong-bo-vacamaxi',
                'sort_order' => 2,
                'is_active' => true,
            ]);

            $breedCategory = $legacyBo->fresh();
        }

        $meatCategory = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('slug', 'thit-bo')
            ->first();

        if (! $meatCategory && $legacyThit) {
            $legacyThit->update([
                'name' => 'Thịt bò',
                'slug' => 'thit-bo',
                'sort_order' => 3,
                'is_active' => true,
            ]);

            $meatCategory = $legacyThit->fresh();
        }

        if (! $breedCategory) {
            $breedCategory = Category::query()->create([
                'module' => Category::MODULE_PRODUCT,
                'name' => 'Giống bò Vaca Maxi',
                'slug' => 'giong-bo-vacamaxi',
                'description' => null,
                'sort_order' => 2,
                'is_active' => true,
            ]);
        }

        if (! $meatCategory) {
            $meatCategory = Category::query()->create([
                'module' => Category::MODULE_PRODUCT,
                'name' => 'Thịt bò',
                'slug' => 'thit-bo',
                'description' => null,
                'sort_order' => 3,
                'is_active' => true,
            ]);
        }

        $legacyCategoryIds = collect([$legacyBo?->id, $legacyThit?->id])
            ->filter()
            ->unique()
            ->values();

        if ($legacyCategoryIds->isNotEmpty()) {
            Product::query()
                ->whereIn('category_id', $legacyCategoryIds->all())
                ->where(function ($query): void {
                    $query->where('slug', 'like', 'thit-bo-%')
                        ->orWhere('slug', 'like', 'steak-%')
                        ->orWhere('name', 'like', 'Thịt%')
                        ->orWhere('name', 'like', 'Steak%');
                })
                ->update(['category_id' => $meatCategory->id]);
        }
    }

    public function down(): void
    {
        $breedCategory = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('slug', 'giong-bo-vacamaxi')
            ->first();

        $meatCategory = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('slug', 'thit-bo')
            ->first();

        if ($breedCategory) {
            $breedCategory->update([
                'name' => 'Bò',
                'slug' => 'bo',
                'sort_order' => 2,
            ]);
        }

        if ($meatCategory) {
            $meatCategory->update([
                'name' => 'Thịt',
                'slug' => 'thit',
                'sort_order' => 4,
            ]);
        }

        if ($breedCategory && $meatCategory) {
            Product::query()
                ->where('category_id', $meatCategory->id)
                ->where(function ($query): void {
                    $query->where('slug', 'like', 'thit-bo-%')
                        ->orWhere('slug', 'like', 'steak-%')
                        ->orWhere('name', 'like', 'Thịt%')
                        ->orWhere('name', 'like', 'Steak%');
                })
                ->update(['category_id' => $breedCategory->id]);
        }
    }
};
