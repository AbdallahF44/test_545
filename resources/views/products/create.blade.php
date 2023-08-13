@extends('dashboard.layouts.master')


@section('content_title')
    @if(isset($product))
        Edit Product
    @else
        Create Product
    @endif
@endsection


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
        <li class="breadcrumb-item text-muted">  @if(isset($product))
                Edit Product
            @else
                Create Product
            @endif</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    @if(isset($product))
        <!--begin::Modal header-->
        <div class="modal-header" id="kt_modal_create_api_key_header">
            <!--begin::Modal title-->
            <h2>Edit Product | {{$product->name}}</h2>
            <!--end::Modal title-->
        </div>
        <!--end::Modal header-->
        <!--begin::Form-->
        <form class="form" action="{{route('products.update',$product->id)}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('Put')
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Product Name" name="name" value="{{$product->name}}"/>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Price</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Product Price" name="price" value="{{$product->price}}"/>
                    <!--end::Input-->
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Description</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <textarea class="form-control form-control-solid" required rows="5"
                              placeholder="Your Product Description"
                              name="description">{{$product->description}}</textarea>
                    <!--end::Input-->
                    @error('description')
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
                            <span class="required">Enable, Disable This Product</span>
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
                <!--end::Input group-->
                <div class="d-flex flex-column mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Colors</label>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select name="colors[]" multiple data-control="select2" data-hide-search="true" required
                            data-placeholder="Select a Colors..." class="form-select form-select-solid">
                        <option value="">Select a Colors...</option>
                        @foreach($colors as $color)
                            @if(in_array($color->id, $product->colors->pluck('id')->all()))
                                <option value="{{$color->id}}" selected>{{$color->name}}</option>
                            @else
                                <option value="{{$color->id}}">{{$color->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <!--end::Select-->
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Category</label>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select name="category_id" data-control="select2" data-hide-search="true"
                            data-placeholder="Select a Category..." class="form-select form-select-solid">
                        <option value="">Select a Category...</option>
                        @foreach($categories as $category)
                            @if($category->name==$product->category->name)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <!--end::Select-->
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--end::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Image</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <div style="display: flex; gap: 5px">
                        @foreach ($product->getMedia('product_images') as $image)
                            <div>
                                <img src="{{ $image->getUrl() }}" alt="{{ $image->getUrl() }}"
                                     style="width: 100px;height: 100px;border-radius: 10px;display: inline-block;margin-bottom: 5px"
                                     class="w-20 h-20 shadow">
                                <div style="display: flex;gap: 5px">
                                    <a href="{{ route('products.editImage', ['product' => $product->id, 'imageId' => $image->id]) }}"
                                       class="btn btn-sm btn-primary"><i style="padding: 0"
                                                                         class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('products.deleteImage', ['product' => $product->id, 'imageId' => $image->id]) }}"
                                       class="btn btn-sm btn-danger"><i style="padding: 0"
                                                                         class="bi bi-trash-fill"></i></a>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <input type="file" multiple class="form-control form-control-solid" accept="image/*"
                           placeholder="Your Product Images" name="image[]" value="{{old('image')}}"/>
                    <!--end::Input-->
                    @error('image')
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
        <form class="form" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Product Name" name="name" value="{{old('name')}}"/>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Price</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" required
                           placeholder="Your Product Price" name="price" value="{{old('price')}}"/>
                    <!--end::Input-->
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Description</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <textarea class="form-control form-control-solid" required rows="5"
                              placeholder="Your Product Description"
                              name="description">{{old('description')}}</textarea>
                    <!--end::Input-->
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <div class="d-flex flex-column mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Colors</label>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select name="colors[]" multiple data-control="select2" data-hide-search="true" required
                            data-placeholder="Select a Colors..." class="form-select form-select-solid">
                        <option value="">Select a Colors...</option>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}">{{$color->name}}</option>
                        @endforeach
                    </select>
                    <!--end::Select-->
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Category</label>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select name="category_id" data-control="select2" data-hide-search="true"
                            data-placeholder="Select a Category..." class="form-select form-select-solid">
                        <option value="">Select a Category...</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <!--end::Select-->
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--end::Input group-->
                <div class="mb-5 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-5 fw-bold mb-2">Product Image</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="file" multiple required class="form-control form-control-solid" accept="image/*"
                           placeholder="Your Product Images" name="image[]" value="{{old('image')}}"/>
                    <!--end::Input-->
                    @error('image')
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
