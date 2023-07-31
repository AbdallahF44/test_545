@extends('dashboard.layouts.master')


@section('content_title')
    Disabled Products
@endsection

{{--@section('btn_toolbar')--}}
{{--    <a href="{{route('products.index')}}" class="btn btn-sm btn-primary" >All Products</a>--}}
{{--@endsection--}}

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
        <li class="breadcrumb-item text-muted">Disabled Products</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    @if(count($products)!=0)
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                <tr>
                    <th class="p-0 w-20px">#</th>
                    <th class="p-0 w-20px">Product Name</th>
                    <th class="p-0 w-50px">Product Price</th>
                    <th class="p-0 w-50px">Product Category</th>
                    <th class="p-0 w-50px">Enable</th>
                </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                @foreach($products as $product)
                        <tr>
                            <th style="text-align: center">
                                <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    {{$loop->iteration}}
                                </div>
                            </th>
                            <td style="text-align: center">
                                <div style="text-align: start" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    {{$product->name}}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="text-align: start" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    <sup>$</sup>{{$product->price}}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="text-align: start" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                    {{$product->category->name}}
                                </div>
                            </td>
                            @if($product->category->status)
                                <td style="text-align: center">
                                    <div style="text-align: start" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                        <form method="post" action="{{route('products_status.update',$product->id)}}"
                                              style="display: inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-primary" type="submit" role="button">Enable</button>
                                        </form>
                                        {{--                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Delete</a>--}}
                                    </div>
                                </td>
                            @else
                                <td class="fw-bolder text-hover-primary mb-1 fs-8">You Cannot Enable This Product, Because It's Category is Disabled!</td>
                            @endif

                        </tr>

                @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    @else
        There is No Disabled Products Yet!
    @endif

@endsection

@push('css')

@endpush
@push('scripts')

@endpush
