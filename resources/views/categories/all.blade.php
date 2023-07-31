@extends('dashboard.layouts.master')


@section('content_title')
    All Categories
@endsection

@section('btn_toolbar')
    <a href="{{route('categories.create')}}" class="me-5 btn btn-sm btn-primary" >Create</a>
    <a href="{{route('categories_status.index')}}" class="btn btn-sm me-5 btn-primary" id="kt_toolbar_primary_button">Disabled
        Categories</a>
@endsection

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            All Categories
        </li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    @if ($errors->any())
        <br>
        <div class="mb-10" style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endif
    @if(count($categories)!=0)
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                <tr>
                    <th class="p-0 w-20px">#</th>
                    <th class="p-0 w-50px">Category Name</th>
                    <th class="p-0 w-70px">Actions</th>
                    {{--                    <th class="p-0 w-50px">Delete</th>--}}
                </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th style="text-align: center">
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$loop->iteration}}
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$category->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="display: flex;gap: 5px">
                                <div style="text-align: start" class="text-dark fw-bolder  mb-1 fs-6">
                                    <a href="{{route('categories.show',$category->id)}}" class="btn btn-sm btn-primary"
                                       id="kt_toolbar_primary_button"><i style="padding: 0" class="bi bi-eye-fill"></i></a>
                                </div>
                                <div style="text-align: start" class="text-dark fw-bolder mb-1 fs-6">
                                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-primary"
                                       id="kt_toolbar_primary_button"><i class="bi bi-pencil-square"
                                                                         style="padding: 0"></i></a>
                                </div>
                                <div style="text-align: start" class="text-dark fw-bolder mb-1 fs-6">
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                       data-bs-target="#kt_modal_delete{{$category->id}}" id="kt_toolbar_primary_button"><i
                                            style="padding: 0" class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>
                            <!--begin::Modal - Delete-->
                            <div class="modal fade" id="kt_modal_delete{{$category->id}}" tabindex="-1"
                                 aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_create_api_key_header">
                                            <!--begin::Modal title-->
                                            <h2>Are you sure you want to delete {{$category->name}} product?</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                 data-bs-dismiss="modal">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24" viewBox="0 0 24 24"
                                                            fill="none">
                                                            <rect opacity="0.5" x="6"
                                                                  y="17.3137" width="16"
                                                                  height="2" rx="1"
                                                                  transform="rotate(-45 6 17.3137)"
                                                                  fill="black"/>
                                                            <rect x="7.41422" y="6"
                                                                  width="16" height="2"
                                                                  rx="1"
                                                                  transform="rotate(45 7.41422 6)"
                                                                  fill="black"/>
                                                        </svg>
                                                    </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->
                                        <!--begin::Form-->
                                        <form id="kt_modal_create_api_key_form" class="form" method="post"
                                              action="{{route('categories.destroy',$category->id)}}">
                                            @csrf
                                            @method('delete')
                                            <!--begin::Modal footer-->

                                            <div class="modal-footer flex-center">
                                                <!--begin::Button-->
                                                <!--begin::Button-->
                                                <a href="" class="btn btn-light me-3" data-bs-dismiss="modal">No
                                                </a>
                                                <button type="submit" id="kt_modal_create_api_key_submit"
                                                        class="btn btn-danger">
                                                    <span class="indicator-label">Yes</span>
                                                    <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Modal footer-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                            <!--end::Modal - Delete-->

                        </td>

                        {{--                        <td style="text-align: center">--}}
                        {{--                            <div style="text-align: start" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">--}}
                        {{--
                        {{--                                --}}{{--                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Delete</a>--}}
                        {{--                            </div>--}}
                        {{--                        </td>--}}

                    </tr>

                @endforeach


                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    @else
        There is No Category Yet!
    @endif


{{--    <!--begin::Modal - Create Api Key-->--}}
{{--    <div class="modal fade" id="kt_modal_create_api_key" tabindex="-1" aria-hidden="true">--}}
{{--        <!--begin::Modal dialog-->--}}
{{--        <div class="modal-dialog modal-dialog-centered mw-650px">--}}
{{--            <!--begin::Modal content-->--}}
{{--            <div class="modal-content">--}}
{{--                <!--begin::Modal header-->--}}
{{--                <div class="modal-header" id="kt_modal_create_api_key_header">--}}
{{--                    <!--begin::Modal title-->--}}
{{--                    <h2>Create Category</h2>--}}
{{--                    <!--end::Modal title-->--}}
{{--                    <!--begin::Close-->--}}
{{--                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">--}}
{{--                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->--}}
{{--                        <span class="svg-icon svg-icon-1">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                                 fill="none">--}}
{{--                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"--}}
{{--                                      transform="rotate(-45 6 17.3137)" fill="black"/>--}}
{{--                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"--}}
{{--                                      fill="black"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        <!--end::Svg Icon-->--}}
{{--                    </div>--}}
{{--                    <!--end::Close-->--}}
{{--                </div>--}}
{{--                <!--end::Modal header-->--}}
{{--                <!--begin::Form-->--}}
{{--                <form class="form" action="{{route('categories.store')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    @method('POST')--}}
{{--                    <!--begin::Modal body-->--}}
{{--                    <div class="modal-body py-10 px-lg-17">--}}
{{--                        <!--begin::Scroll-->--}}
{{--                        <div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true"--}}
{{--                             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"--}}
{{--                             data-kt-scroll-dependencies="#kt_modal_create_api_key_header"--}}
{{--                             data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">--}}
{{--                            <!--begin::Input group-->--}}
{{--                            <div class="mb-5 fv-row">--}}
{{--                                <!--begin::Label-->--}}
{{--                                <label class="required fs-5 fw-bold mb-2">Category Name</label>--}}
{{--                                <!--end::Label-->--}}
{{--                                <!--begin::Input-->--}}
{{--                                <input type="text" required class="form-control form-control-solid"--}}
{{--                                       placeholder="Your Category Name" name="name"/>--}}
{{--                                <!--end::Input-->--}}
{{--                            </div>--}}
{{--                            <!--end::Input group-->--}}
{{--                            <!--begin::Input group-->--}}
{{--                            <div class="d-flex flex-column mb-5 fv-row">--}}
{{--                                <p class="fs-3 mb-2 mt-10">--}}
{{--                                    This category will be enabled.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <!--end::Input group-->--}}


{{--                        </div>--}}
{{--                        <!--end::Scroll-->--}}
{{--                    </div>--}}
{{--                    <!--end::Modal body-->--}}
{{--                    <!--begin::Modal footer-->--}}
{{--                    <div class="modal-footer flex-center">--}}
{{--                        <!--begin::Button-->--}}
{{--                        <button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard--}}
{{--                        </button>--}}
{{--                        <!--end::Button-->--}}
{{--                        <!--begin::Button-->--}}
{{--                        <button type="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">--}}
{{--                            <span class="indicator-label">Submit</span>--}}
{{--                            <span class="indicator-progress">Please wait...--}}
{{--                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
{{--                        </button>--}}
{{--                        <!--end::Button-->--}}
{{--                    </div>--}}
{{--                    <!--end::Modal footer-->--}}
{{--                </form>--}}
{{--                <!--end::Form-->--}}
{{--            </div>--}}
{{--            <!--end::Modal content-->--}}
{{--        </div>--}}
{{--        <!--end::Modal dialog-->--}}
{{--    </div>--}}
{{--    <!--end::Modal - Create Api Key-->--}}

@endsection

@push('css')

@endpush
@push('scripts')

@endpush
