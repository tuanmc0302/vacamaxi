@extends('backend.layouts.app')

@section('title', 'Thêm chuyên gia | Admin')
@section('eyebrow', 'Quản trị nội dung')
@section('page_heading', 'Thêm chuyên gia')

@section('content')
    @php
        $expert = new \App\Models\Expert(['is_active' => true, 'sort_order' => 0]);
    @endphp

    @include('backend.management.experts._form', [
        'expert' => $expert,
        'action' => route('admin.experts.store'),
        'method' => 'POST',
        'title' => 'Thông tin chuyên gia mới',
        'description' => 'Nhập thông tin chuyên gia để hiển thị trong các component đội ngũ.',
        'submitLabel' => 'Lưu chuyên gia',
    ])
@endsection
