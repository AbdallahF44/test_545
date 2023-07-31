@extends('dashboard.layouts.master')


@section('content_title')
    {{$product->name}}
@endsection

@section('btn_toolbar')
    <a href="{{route('products.edit',$product)}}" class="btn btn-sm me-5 btn-primary"
       id="kt_toolbar_primary_button"><i class="bi bi-pencil-square" style="padding: 0"></i></a>
    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
       data-bs-target="#kt_modal_delete" id="kt_toolbar_primary_button"><i
            style="padding: 0" class="bi bi-trash-fill"></i></a>
@endsection

@push('css')
    <style>
        .color-box {
            width: 25px;
            height: 25px;
            border-radius: 5px;
            box-shadow: 0 0 1.5px 1.5px #ccc;
        }</style>
@endpush

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('products.index')}}" class="text-muted text-hover-primary">All Products</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{$product->name}}</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-5">
                    <!--begin::Table head-->
                    <thead>
                    <tr>
                        <th class="p-0 w-20px"></th>
                        <th class="p-0 w-70px"></th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    <tr>
                        <th>
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                Product Name:
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$product->name}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                Product Description:
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$product->description}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                Product price:
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                <sup>$</sup>{{$product->price}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                Product Category:
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="display: flex;gap: 20px;align-items: center">
                                <div style="text-align: start"
                                     class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    {{$product->category->name}}
                                </div>
                                <a href="{{route('categories.show',$product->category->id)}}"
                                   class="btn btn-sm btn-primary"
                                   style="height: fit-content"
                                   id="kt_toolbar_primary_button">Show This Category</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        @if(count($product->colors)!=0)
                            <th>
                                <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    Product Colors:
                                </div>
                            </th>
                            <td style="display: flex;gap:3px;">
                                @foreach($product->colors as $col)
                                    <div title="{{$col->name}}" class="color-box"
                                         style="background-color: {{$col->hex}}"></div>
                                @endforeach
                            </td>
                        @else
                        <th>
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                No Colors Yet!
                            </div>
                        </th>
                        <td style="display: flex;gap:3px;">
                        </td>
                        @endif
                    </tr>
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card-->

        </div>
        <!--end::Container-->
    </div>
    <!--begin::Modal - Delete-->
    <div class="modal fade" id="kt_modal_delete" tabindex="-1"
         aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_create_api_key_header">
                    <!--begin::Modal title-->
                    <h2>Are you sure you want to delete {{$product->name}} product?</h2>
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
                      action="{{route('products.destroy',$product->id)}}">
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
    {{--    <!--begin::Modal - Create Api Key-->--}}
    {{--    <div class="modal fade" id="kt_modal_create_api_key" tabindex="-1" aria-hidden="true">--}}
    {{--        <!--begin::Modal dialog-->--}}
    {{--        <div class="modal-dialog modal-dialog-centered mw-650px">--}}
    {{--            <!--begin::Modal content-->--}}
    {{--            <div class="modal-content">--}}
    {{--                <!--begin::Modal header-->--}}
    {{--                <div class="modal-header" id="kt_modal_create_api_key_header">--}}
    {{--                    <!--begin::Modal title-->--}}
    {{--                    <h2>Edit Product | {{$product->name}}</h2>--}}
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
    {{--                @if ($errors->any())--}}
    {{--                    <br>--}}
    {{--                    <div class="mb-10" style="color:red;">--}}
    {{--                        <ul>--}}
    {{--                            @foreach ($errors->all() as $error)--}}
    {{--                                <li>{{ $error }}</li>--}}
    {{--                            @endforeach--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                    <br>--}}
    {{--                @endif--}}
    {{--                <!--begin::Form-->--}}
    {{--                <form id="kt_modal_create_api_key_form" class="form" method="post"--}}
    {{--                      action="{{route('products.update',$product->id)}}">--}}
    {{--                    @csrf--}}
    {{--                    @method('PUT')--}}
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
    {{--                                <label class="required fs-5 fw-bold mb-2">Product Name</label>--}}
    {{--                                <!--end::Label-->--}}
    {{--                                <!--begin::Input-->--}}
    {{--                                <input type="text" class="form-control form-control-solid" required--}}
    {{--                                       placeholder="Your Product Name" name="name" value="{{$product->name}}"/>--}}
    {{--                                <!--end::Input-->--}}
    {{--                            </div>--}}
    {{--                            <!--end::Input group-->--}}
    {{--                            <!--begin::Input group-->--}}
    {{--                            <div class="mb-5 fv-row">--}}
    {{--                                <!--begin::Label-->--}}
    {{--                                <label class="required fs-5 fw-bold mb-2">Product Price</label>--}}
    {{--                                <!--end::Label-->--}}
    {{--                                <!--begin::Input-->--}}
    {{--                                <input type="text" class="form-control form-control-solid" required--}}
    {{--                                       placeholder="Your Product Price" name="price" value="{{$product->price}}"/>--}}
    {{--                                <!--end::Input-->--}}
    {{--                            </div>--}}
    {{--                            <!--end::Input group-->--}}
    {{--                            <!--begin::Input group-->--}}
    {{--                            <div class="mb-5 fv-row">--}}
    {{--                                <!--begin::Label-->--}}
    {{--                                <label class="required fs-5 fw-bold mb-2">Product Description</label>--}}
    {{--                                <!--end::Label-->--}}
    {{--                                <!--begin::Input-->--}}
    {{--                                <textarea class="form-control form-control-solid" required rows="5"--}}
    {{--                                          placeholder="Your Product Description"--}}
    {{--                                          name="description">{{$product->description}}</textarea>--}}
    {{--                                <!--end::Input-->--}}
    {{--                            </div>--}}
    {{--                            <!--end::Input group-->--}}
    {{--                            <!--begin::Input group-->--}}
    {{--                            <div class="mb-10 mt-10">--}}
    {{--                                <!--begin::Heading-->--}}
    {{--                                <div class="mb-3">--}}
    {{--                                    <!--begin::Label-->--}}
    {{--                                    <label class="d-flex align-items-center fs-5 fw-bold">--}}
    {{--                                        <span class="required">Enable, Disable This Product</span>--}}
    {{--                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"--}}
    {{--                                           title="If you disabled this category, it will remove from list, and it's products too."></i>--}}
    {{--                                    </label>--}}
    {{--                                    <!--end::Label-->--}}
    {{--                                </div>--}}
    {{--                                <!--end::Heading-->--}}
    {{--                                <!--begin::Row-->--}}
    {{--                                <div class="fv-row">--}}
    {{--                                    <!--begin::Radio group-->--}}
    {{--                                    <div class="btn-group w-100" data-kt-buttons="true"--}}
    {{--                                         data-kt-buttons-target="[data-kt-button]">--}}
    {{--                                        <!--begin::Radio-->--}}
    {{--                                        <label--}}
    {{--                                            class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"--}}
    {{--                                            data-kt-button="true">--}}
    {{--                                            <!--begin::Input-->--}}
    {{--                                            <input class="btn-check" type="radio" name="status" value="0"/>--}}
    {{--                                            <!--end::Input-->--}}
    {{--                                            Disable</label>--}}
    {{--                                        <!--end::Radio-->--}}
    {{--                                        <!--begin::Radio-->--}}
    {{--                                        <label--}}
    {{--                                            class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active"--}}
    {{--                                            data-kt-button="true">--}}
    {{--                                            <!--begin::Input-->--}}
    {{--                                            <input class="btn-check" type="radio" name="status" checked value="1"/>--}}
    {{--                                            <!--end::Input-->--}}
    {{--                                            Enable</label>--}}
    {{--                                        <!--end::Radio-->--}}
    {{--                                    </div>--}}
    {{--                                    <!--end::Radio group-->--}}
    {{--                                </div>--}}
    {{--                                <!--end::Row-->--}}
    {{--                            </div>--}}
    {{--                            <!--end::Input group-->--}}
    {{--                            <!--begin::Input group-->--}}
    {{--                            <div class="d-flex flex-column mb-10 fv-row">--}}
    {{--                                <!--begin::Label-->--}}
    {{--                                <label class="required fs-5 fw-bold mb-2">Category</label>--}}
    {{--                                <!--end::Label-->--}}
    {{--                                <!--begin::Select-->--}}
    {{--                                <select name="category_id" data-control="select2" data-hide-search="true"--}}
    {{--                                        data-placeholder="Select a Category..." class="form-select form-select-solid">--}}
    {{--                                    <option value="">Select a Category...</option>--}}
    {{--                                    @foreach($categories as $category)--}}
    {{--                                        @if($category->name==$product->category->name)--}}
    {{--                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>--}}
    {{--                                        @else--}}
    {{--                                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
    {{--                                        @endif--}}
    {{--                                    @endforeach--}}
    {{--                                </select>--}}
    {{--                                <!--end::Select-->--}}
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
    {{--    <!--begin::Modal - Delete-->--}}
    {{--    <div class="modal fade" id="kt_modal_delete" tabindex="-1" aria-hidden="true">--}}
    {{--        <!--begin::Modal dialog-->--}}
    {{--        <div class="modal-dialog modal-dialog-centered mw-650px">--}}
    {{--            <!--begin::Modal content-->--}}
    {{--            <div class="modal-content">--}}
    {{--                <!--begin::Modal header-->--}}
    {{--                <div class="modal-header" id="kt_modal_create_api_key_header">--}}
    {{--                    <!--begin::Modal title-->--}}
    {{--                    <h2>Are you sure you want to delete {{$product->name}} product?</h2>--}}
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
    {{--                <form id="kt_modal_create_api_key_form" class="form" method="post"--}}
    {{--                      action="{{route('products.destroy',$product->id)}}">--}}
    {{--                    @csrf--}}
    {{--                    @method('delete')--}}
    {{--                    <!--begin::Modal body-->--}}
    {{--                    --}}{{--                    <div class="modal-body py-10 px-lg-17">--}}
    {{--                    --}}{{--                        <!--begin::Scroll-->--}}
    {{--                    --}}{{--                        <div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true"--}}
    {{--                    --}}{{--                             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"--}}
    {{--                    --}}{{--                             data-kt-scroll-dependencies="#kt_modal_create_api_key_header"--}}
    {{--                    --}}{{--                             data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">--}}
    {{--                    --}}{{--                            <!--begin::Input group-->--}}
    {{--                    --}}{{--                            <div class="mb-5 fv-row">--}}
    {{--                    --}}{{--                                <!--begin::Label-->--}}
    {{--                    --}}{{--                                <label class="required fs-5 fw-bold mb-2">Product Name</label>--}}
    {{--                    --}}{{--                                <!--end::Label-->--}}
    {{--                    --}}{{--                                <!--begin::Input-->--}}
    {{--                    --}}{{--                                <input type="text" class="form-control form-control-solid" required--}}
    {{--                    --}}{{--                                       placeholder="Your Product Name" name="name" value="{{$product->name}}"/>--}}
    {{--                    --}}{{--                                <!--end::Input-->--}}
    {{--                    --}}{{--                            </div>--}}
    {{--                    --}}{{--                            <!--end::Input group-->--}}
    {{--                    --}}{{--                            <!--begin::Input group-->--}}
    {{--                    --}}{{--                            <div class="mb-5 fv-row">--}}
    {{--                    --}}{{--                                <!--begin::Label-->--}}
    {{--                    --}}{{--                                <label class="required fs-5 fw-bold mb-2">Product Price</label>--}}
    {{--                    --}}{{--                                <!--end::Label-->--}}
    {{--                    --}}{{--                                <!--begin::Input-->--}}
    {{--                    --}}{{--                                <input type="text" class="form-control form-control-solid" required--}}
    {{--                    --}}{{--                                       placeholder="Your Product Price" name="price" value="{{$product->price}}"/>--}}
    {{--                    --}}{{--                                <!--end::Input-->--}}
    {{--                    --}}{{--                            </div>--}}
    {{--                    --}}{{--                            <!--end::Input group-->--}}
    {{--                    --}}{{--                            <!--begin::Input group-->--}}
    {{--                    --}}{{--                            <div class="mb-5 fv-row">--}}
    {{--                    --}}{{--                                <!--begin::Label-->--}}
    {{--                    --}}{{--                                <label class="required fs-5 fw-bold mb-2">Product Description</label>--}}
    {{--                    --}}{{--                                <!--end::Label-->--}}
    {{--                    --}}{{--                                <!--begin::Input-->--}}
    {{--                    --}}{{--                                <textarea class="form-control form-control-solid" required rows="5"--}}
    {{--                    --}}{{--                                          placeholder="Your Product Description" name="description">{{$product->description}}</textarea>--}}
    {{--                    --}}{{--                                <!--end::Input-->--}}
    {{--                    --}}{{--                            </div>--}}
    {{--                    --}}{{--                            <!--end::Input group-->--}}
    {{--                    --}}{{--                            <!--begin::Input group-->--}}
    {{--                    --}}{{--                            <div class="mb-10 mt-10">--}}
    {{--                    --}}{{--                                <!--begin::Heading-->--}}
    {{--                    --}}{{--                                <div class="mb-3">--}}
    {{--                    --}}{{--                                    <!--begin::Label-->--}}
    {{--                    --}}{{--                                    <label class="d-flex align-items-center fs-5 fw-bold">--}}
    {{--                    --}}{{--                                        <span class="required">Enable, Disable This Product</span>--}}
    {{--                    --}}{{--                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"--}}
    {{--                    --}}{{--                                           title="If you disabled this category, it will remove from list, and it's products too."></i>--}}
    {{--                    --}}{{--                                    </label>--}}
    {{--                    --}}{{--                                    <!--end::Label-->--}}
    {{--                    --}}{{--                                </div>--}}
    {{--                    --}}{{--                                <!--end::Heading-->--}}
    {{--                    --}}{{--                                <!--begin::Row-->--}}
    {{--                    --}}{{--                                <div class="fv-row">--}}
    {{--                    --}}{{--                                    <!--begin::Radio group-->--}}
    {{--                    --}}{{--                                    <div class="btn-group w-100" data-kt-buttons="true"--}}
    {{--                    --}}{{--                                         data-kt-buttons-target="[data-kt-button]">--}}
    {{--                    --}}{{--                                        <!--begin::Radio-->--}}
    {{--                    --}}{{--                                        <label--}}
    {{--                    --}}{{--                                            class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"--}}
    {{--                    --}}{{--                                            data-kt-button="true">--}}
    {{--                    --}}{{--                                            <!--begin::Input-->--}}
    {{--                    --}}{{--                                            <input class="btn-check" type="radio" name="status" value="0"/>--}}
    {{--                    --}}{{--                                            <!--end::Input-->--}}
    {{--                    --}}{{--                                            Disable</label>--}}
    {{--                    --}}{{--                                        <!--end::Radio-->--}}
    {{--                    --}}{{--                                        <!--begin::Radio-->--}}
    {{--                    --}}{{--                                        <label--}}
    {{--                    --}}{{--                                            class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active"--}}
    {{--                    --}}{{--                                            data-kt-button="true">--}}
    {{--                    --}}{{--                                            <!--begin::Input-->--}}
    {{--                    --}}{{--                                            <input class="btn-check" type="radio" name="status" checked value="1"/>--}}
    {{--                    --}}{{--                                            <!--end::Input-->--}}
    {{--                    --}}{{--                                            Enable</label>--}}
    {{--                    --}}{{--                                        <!--end::Radio-->--}}
    {{--                    --}}{{--                                    </div>--}}
    {{--                    --}}{{--                                    <!--end::Radio group-->--}}
    {{--                    --}}{{--                                </div>--}}
    {{--                    --}}{{--                                <!--end::Row-->--}}
    {{--                    --}}{{--                            </div>--}}
    {{--                    --}}{{--                            <!--end::Input group-->--}}
    {{--                    --}}{{--                            <!--begin::Input group-->--}}
    {{--                    --}}{{--                            <div class="d-flex flex-column mb-10 fv-row">--}}
    {{--                    --}}{{--                                <!--begin::Label-->--}}
    {{--                    --}}{{--                                <label class="required fs-5 fw-bold mb-2">Category</label>--}}
    {{--                    --}}{{--                                <!--end::Label-->--}}
    {{--                    --}}{{--                                <!--begin::Select-->--}}
    {{--                    --}}{{--                                <select name="category_id" data-control="select2" data-hide-search="true" data-placeholder="Select a Category..." class="form-select form-select-solid">--}}
    {{--                    --}}{{--                                    <option value="">Select a Category...</option>--}}
    {{--                    --}}{{--                                    @foreach($categories as $category)--}}
    {{--                    --}}{{--                                        @if($category->name==$product->category->name)--}}
    {{--                    --}}{{--                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>--}}
    {{--                    --}}{{--                                        @else--}}
    {{--                    --}}{{--                                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
    {{--                    --}}{{--                                        @endif--}}
    {{--                    --}}{{--                                    @endforeach--}}
    {{--                    --}}{{--                                </select>--}}
    {{--                    --}}{{--                                <!--end::Select-->--}}
    {{--                    --}}{{--                            </div>--}}
    {{--                    --}}{{--                            <!--end::Input group-->--}}
    {{--                    --}}{{--                        </div>--}}
    {{--                    --}}{{--                        <!--end::Scroll-->--}}
    {{--                    --}}{{--                    </div>--}}
    {{--                    <!--end::Modal body-->--}}
    {{--                    <!--begin::Modal footer-->--}}
    {{--                    <div class="modal-footer flex-center">--}}
    {{--                        <!--begin::Button-->--}}
    {{--                        <button id="kt_modal_create_api_key_cancel" class="btn btn-light me-3" autofocus--}}
    {{--                                data-bs-dismiss="modal">No--}}
    {{--                        </button>--}}
    {{--                        <!--end::Button-->--}}
    {{--                        <!--begin::Button-->--}}
    {{--                        <button type="submit" id="kt_modal_create_api_key_submit" class="btn btn-danger">--}}
    {{--                            <span class="indicator-label">Yes</span>--}}
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
    {{--    <!--end::Modal - Delete-->--}}
@endsection

@push('css')

@endpush
@push('scripts')

@endpush
