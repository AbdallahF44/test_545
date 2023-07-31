@extends('dashboard.layouts.master')


@section('content_title')
    @if(isset($user))
        Edit User
    @else
        Create User
    @endif
@endsection


@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('users.index')}}" class="text-muted text-hover-primary">All Users</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">  @if(isset($user))
                Edit User
            @else
                Create User
            @endif</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    @if(isset($user))
        <!--begin::Modal header-->
        <div class="modal-header" id="kt_modal_create_api_key_header">
            <!--begin::Modal title-->
            <h2>Edit User | {{$user->name}}</h2>
            <!--end::Modal title-->
        </div>
        <!--end::Modal header-->
        <!--begin::Form-->
        <form id="kt_modal_create_api_key_form" class="form" method="post"
              action="{{route('users.update',$user->id)}}">
            @csrf
            @method('PUT')
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">User Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Name" name="name" value="{{$user->name}}"/>
                    <!--end::Input-->
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">User Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Email" name="email" value="{{$user->email}}"/>
                    <!--end::Input-->
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">User Mobile</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Mobile" name="mobile" value="{{$user->mobile}}"/>
                    <!--end::Input-->
                    @error('mobile')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-10 mt-10">
                    <!--begin::Heading-->
                    <div class="mb-3">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-5 fw-bold">
                            <span class="required">Enable, Disable This User</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="If you disabled this category, it will remove from list, and it's products too."></i>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Row-->
                    <div class="fv-row">
                        <!--begin::Radio group-->
                        <div class="btn-group w-100" data-kt-buttons="true"
                             data-kt-buttons-target="[data-kt-button]">
                            <!--begin::Radio-->
                            <label
                                class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="status" value="0"/>
                                <!--end::Input-->
                                Disable</label>
                            <!--end::Radio-->
                            <!--begin::Radio-->
                            <label
                                class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="status" checked value="1"/>
                                <!--end::Input-->
                                Enable</label>
                            <!--end::Radio-->
                        </div>
                        <!--end::Radio group-->
                    </div>
                    <!--end::Row-->
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard
                </button>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
            <!--end::Modal footer-->
        </form>
        <!--end::Form-->
    @else
        <!--begin::Modal header-->
        <div class="modal-header" id="kt_modal_create_api_key_header">
            <!--begin::Modal title-->
            <h2>Create Product</h2>
            <!--end::Modal title-->
        </div>
        <!--end::Modal header-->
        <!--begin::Form-->
        <form id="kt_modal_create_api_key_form" class="form" method="post"
              action="{{route('users.store')}}">
            @csrf
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">User Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Name" name="name" value="{{old('name')}}"/>
                    <!--end::Input-->
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">User Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" class="form-control form-control-solid" required
                           placeholder="Your Email" name="email" value="{{old('email')}}"/>
                    <!--end::Input-->
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">User Password</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="password" class="form-control form-control-solid" required
                           placeholder="Your Password" name="password" value="{{old('password')}}"/>
                    <!--end::Input-->
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Confirm Password</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="password" class="form-control form-control-solid" required
                           placeholder="Confirm Password" name="password_confirmation"
                           value="{{old('password_confirmation')}}"/>
                    <!--end::Input-->
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">User Mobile</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Mobile" name="mobile" value="{{old('mobile')}}"/>
                    <!--end::Input-->
                    @error('mobile')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->

            </div>

            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard
                </button>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
            <!--end::Modal footer-->
        </form>
        <!--end::Form-->
    @endif

@endsection

@push('css')

@endpush
@push('scripts')

@endpush
