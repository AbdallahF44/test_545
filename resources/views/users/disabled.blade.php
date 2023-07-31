@extends('dashboard.layouts.master')


@section('content_title')
    Disabled Users
@endsection

{{--@section('btn_toolbar')--}}
{{--    <a href="{{route('users.index')}}" class="btn btn-sm btn-primary">All Users</a>--}}
{{--@endsection--}}

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
        <li class="breadcrumb-item text-muted">Disabled Users</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    @if(count($users)!=0)
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                <tr>
                    <th class="p-0 w-20px">#</th>
                    <th class="p-0 w-50px">User Name</th>
                    <th class="p-0 w-50px">Enable</th>
                </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th style="text-align: center">
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$loop->iteration}}
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$user->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="text-align: start" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                <form method="post" action="{{route('users_status.update',$user->id)}}"
                                      style="display: inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-primary" type="submit" role="button">Enable
                                    </button>
                                </form>
                                {{--                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Delete</a>--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    @else
        There is No Disabled Users Yet!
    @endif

@endsection

@push('css')

@endpush
@push('scripts')

@endpush
