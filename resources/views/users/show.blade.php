@extends('dashboard.layouts.master')


@section('content_title')
    {{$user->name}}
@endsection

@section('btn_toolbar')
    <a href="{{route('users.edit',$user)}}" class="btn btn-sm me-5 btn-primary"
       id="kt_toolbar_primary_button"><i class="bi bi-pencil-square" style="padding: 0"></i></a>
    <form method="post" action="{{route('users.destroy',$user->id)}}"
          style="display: inline-block">
        @csrf
        @method('delete')
        <button class="btn btn-sm btn-danger" type="submit" role="button"><i style="padding: 0"
                                                                             class="bi bi-trash-fill"></i>
        </button>
    </form>
@endsection

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('users.index')}}" class="text-muted text-hover-primary">All users</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{$user->name}}</li>
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
                                User Name:
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$user->name}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                User Email:
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$user->email}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                User Mobile:
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$user->mobile}}
                            </div>
                        </td>
                    </tr>
                    {{--                        <tr>--}}
                    {{--                            <th>--}}
                    {{--                                <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">--}}
                    {{--                                    Product Category:--}}
                    {{--                                </div>--}}
                    {{--                            </th>--}}
                    {{--                            <td style="text-align: center">--}}
                    {{--                                <div style="display: flex;gap: 20px;align-items: center">--}}
                    {{--                                    <div style="text-align: start"--}}
                    {{--                                         class="text-dark fw-bolder text-hover-primary mb-1 fs-6">--}}
                    {{--                                        {{$product->category->name}}--}}
                    {{--                                    </div>--}}
                    {{--                                    <a href="{{route('categories.show',$product->category->id)}}"--}}
                    {{--                                       class="btn btn-sm btn-primary"--}}
                    {{--                                       style="height: fit-content"--}}
                    {{--                                       id="kt_toolbar_primary_button">Show This Category</a>--}}
                    {{--                                </div>--}}

                    {{--                            </td>--}}
                    {{--                        </tr>--}}
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card-->

        </div>
        <!--end::Container-->
    </div>

@endsection

@push('css')

@endpush
@push('scripts')

@endpush
