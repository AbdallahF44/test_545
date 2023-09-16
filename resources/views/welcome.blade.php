@extends('dashboard.layouts.master')


@section('content_title')
    404 Page
@endsection

@section('btn_toolbar')
    <a href="{{ route('categories.index') }}" class="btn btn-sm me-5 btn-primary" id="kt_toolbar_primary_button">Categories</a>
@endsection

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="my-1 breadcrumb breadcrumb-separatorless fw-bold fs-7">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            404 Page
        </li>
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    404 ERROR
@endsection
