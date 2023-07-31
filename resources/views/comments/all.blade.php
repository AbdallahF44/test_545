@extends('dashboard.layouts.master')

@section('content_title')
    All Comments
@endsection

@section('btn_toolbar')
    <a  data-bs-toggle="modal"
        data-bs-target="#create_comment"
       class="me-5 btn btn-sm btn-primary"
       id="create_form">Create</a>
@endsection

@push('css')
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <style>--}}
{{--        .create_model {--}}
{{--            transition: 1s;--}}
{{--        }--}}

{{--        .hide {--}}
{{--            display: none;--}}
{{--            transition: 1s;--}}
{{--        }--}}
{{--    </style>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

@endpush
@push('scripts')
    @livewireScripts
    <script src="{{ asset('livewire/livewire.js') }}" defer></script>
{{--    <script>--}}

{{--        // document.querySelectorAll('#close_form').forEach((e) => {--}}
{{--        //     e.addEventListener('closing', () => {--}}
{{--        //         e.parentElement.parentElement.parentElement.parentElement.classList.add('hide');--}}
{{--        //     })--}}
{{--        // });--}}
{{--        // document.querySelector('#create_form').addEventListener('click', () => {--}}
{{--        //         document.querySelector('.create_model').classList.remove('hide');--}}
{{--        // });--}}

{{--    </script>--}}

{{--     Bootstrap Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

@endpush

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            All Comments
        </li>
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <livewire:comments.index />
    @stack('scripts_livewire')
@endsection
