@extends('dashboard.layouts.master')

@section('content_title')
    Edit Image - {{ $product->name }}
@endsection

@section('content')
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_create_api_key_header">
                <!--begin::Modal title-->

                <h2>Edit Product Image | <img src="{{$image->getUrl()}}" style="width: 100px;height: 100px;border-radius: 10px;display: inline-block"></h2>
                <!--end::Modal title-->
            </div>
            <!--end::Modal header-->
            <!--begin::Form-->
            <form class="form" action="{{ route('products.updateImage', ['product' => $product->id, 'imageId' => $image->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <!--end::Input group-->
                    <div class="mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="required fs-5 fw-bold mb-2">Product Image</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="file" required class="form-control form-control-solid" accept="image/*"
                               placeholder="Your Product Images" name="image" value="{{old('image')}}"/>
                        <!--end::Input-->
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Input group-->
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

@endsection
