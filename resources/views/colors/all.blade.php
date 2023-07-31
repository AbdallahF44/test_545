@extends('dashboard.layouts.master')

@section('content_title')
    All Colors
@endsection

@section('btn_toolbar')
        <button href="#" data-bs-toggle="modal" type="submit"
           data-bs-target="#create_color"
           class="me-5 btn btn-sm btn-primary"
           id="kt_toolbar_primary_button">Create</button>

@endsection

@push('css')
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .color-box{
            width: 25px;
            height: 25px;
            border-radius: 5px;
            box-shadow: 0 0 1.5px 1.5px #ccc;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }
        label {
            font-family: "Poppins", sans-serif;
            font-size: 20px;
            cursor: pointer;
        }
        /*------ Style 1 ------*/
        #style1 {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 100px;
            height: 100px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        #style1::-webkit-color-swatch {
            border-radius: 15px;
            border: none;
        }
        #style1::-moz-color-swatch {
            border-radius: 15px;
            border: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

@endpush
@push('scripts')
    @livewireScripts
    <script src="{{ asset('livewire/livewire.js') }}" defer></script>
    <script>

        // document.querySelectorAll('#close_form').forEach((e) => {
        //     e.addEventListener('closing', () => {
        //         e.parentElement.parentElement.parentElement.parentElement.classList.add('hide');
        //     })
        // });
        // document.querySelector('#create_form').addEventListener('click', () => {
        //         document.querySelector('.create_model').classList.remove('hide');
        // });

    </script>

    {{-- Bootstrap Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

@endpush

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            All Colors
        </li>
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <livewire:colors.index />
    @stack('scripts_livewire')
@endsection
