@extends('dashboard.layouts.master')


@section('content_title')
    {{$category->name}}
@endsection

@section('btn_toolbar')
    <a href="{{route('categories.edit',$category)}}" class="btn btn-sm me-5 btn-primary"
       id="kt_toolbar_primary_button"><i class="bi bi-pencil-square" style="padding: 0"></i></a>
    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
       data-bs-target="#kt_modal_delete" id="kt_toolbar_primary_button"><i
            style="padding: 0" class="bi bi-trash-fill"></i></a>
@endsection

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('categories.index')}}" class="text-muted text-hover-primary">All Categories</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{$category->name}}</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <div style="display: flex;justify-content: space-between">
        <h2 class="mb-10">Products in {{$category->name}} Category:</h2>
        <a href="{{route('products.create')}}"
           class="btn btn-sm btn-primary"
           style="height: fit-content"
           id="kt_toolbar_primary_button">Add Product</a>
    </div>
    @if(count($category->products)==0)
        There is No Products in {{$category->name}} Category Yet!
    @else
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                <tr>
                    <th class="p-0 w-20px">#</th>
                    <th class="p-0 w-70px">Product Name</th>
                    <th class="p-0 w-70px">Product Price</th>
                    <th class="p-0 w-50px">Actions</th>
                    {{--                    <th class="p-0 w-50px">Delete</th>--}}
                </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                @foreach($category->products as $product)
                    @if($product->status)
                        <tr>
                            <th style="text-align: center">
                                <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    {{$loop->iteration}}
                                </div>
                            </th>
                            <td style="text-align: center">
                                <div style="text-align: start"
                                     class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    <a  class="text-dark fw-bolder text-hover-primary mb-1 fs-6" href="{{route('products.show',$product->id)}}">{{$product->name}}</a>
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="text-align: start"
                                     class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    <sup>$</sup>{{$product->price}}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="display: flex;gap: 5px">
                                    <div style="text-align: start" class="text-dark fw-bolder  mb-1 fs-6">
                                        <a href="{{route('products.show',$product->id)}}" class="btn btn-sm btn-primary"
                                           id="kt_toolbar_primary_button"><i style="padding: 0" class="bi bi-eye-fill"></i></a>
                                    </div>
                                    <div style="text-align: start" class="text-dark fw-bolder mb-1 fs-6">
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-primary"
                                           id="kt_toolbar_primary_button"><i class="bi bi-pencil-square"
                                                                             style="padding: 0"></i></a>
                                    </div>
                                    <div style="text-align: start" class="text-dark fw-bolder mb-1 fs-6">
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_delete{{$product->id}}" id="kt_toolbar_primary_button"><i
                                                style="padding: 0" class="bi bi-trash-fill"></i></a>
                                    </div>
                                </div>
                                <!--begin::Modal - Delete-->
                                <div class="modal fade" id="kt_modal_delete{{$product->id}}" tabindex="-1"
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

                            </td>
                            {{--                            <td style="text-align: center">--}}
                            {{--                                <div style="text-align: start"--}}
                            {{--                                     class="text-dark fw-bolder text-hover-primary mb-1 fs-6">--}}
                            {{--                                    <form method="post" action="{{route('products.destroy',$product->id)}}"--}}
                            {{--                                          style="display: inline-block">--}}
                            {{--                                        @csrf--}}
                            {{--                                        @method('delete')--}}
                            {{--                                        <button class="btn btn-sm btn-danger" type="submit" role="button">Delete--}}
                            {{--                                        </button>--}}
                            {{--                                    </form>--}}
                            {{--                                </div>--}}
                            {{--                            </td>--}}

                        </tr>
                    @endif
                @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    @endif

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
                      action="{{route('products.destroy',$category->id)}}">
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

@endsection

@push('css')

@endpush
@push('scripts')

@endpush
