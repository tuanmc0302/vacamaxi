@extends('backend.layouts.app')

@section('title', 'Cập nhật chuyên gia | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', 'Cập nhật chuyên gia')

@section('content')
    @include('backend.management.experts._form', [
        'expert' => $expert,
        'action' => route('admin.experts.update', $expert),
        'method' => 'PUT',
        'title' => 'Sửa thông tin: '.$expert->name,
        'description' => 'Cập nhật hồ sơ, ảnh đại diện và trạng thái hiển thị của chuyên gia.',
        'submitLabel' => 'Cập nhật thay đổi',
    ])
@endsection
