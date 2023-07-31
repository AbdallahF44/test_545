@extends('dashboard.layouts.master')


@section('content_title')
    All Users
@endsection

@section('btn_toolbar')
    <a href="{{route('users.create')}}" class="me-5 btn btn-sm btn-primary" id="kt_toolbar_primary_button">Create</a>
    <a href="{{route('users_status.index')}}" class="btn btn-sm me-5 btn-primary" id="kt_toolbar_primary_button">Disabled
        Users</a>
@endsection

@section('toolbar_path')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            All Users
        </li>
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
    @if(count($users)!=0)
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                <tr>
                    <th class="p-0 w-20px">#</th>
                    <th class="p-0 w-50px">User Name</th>
                    <th class="p-0 w-50px">Show</th>
                    {{--                    <th class="p-0 w-50px">Delete</th>--}}
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
                            <div style="display: flex;gap: 5px">
                                <div style="text-align: start" class="text-dark fw-bolder  mb-1 fs-6">
                                    <a href="{{route('users.show',$user->id)}}" class="btn btn-sm btn-primary"
                                       id="kt_toolbar_primary_button"><i style="padding: 0" class="bi bi-eye-fill"></i></a>
                                </div>
                                <div style="text-align: start" class="text-dark fw-bolder mb-1 fs-6">
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-primary"
                                       id="kt_toolbar_primary_button"><i class="bi bi-pencil-square"
                                                                         style="padding: 0"></i></a>
                                </div>
                                <div style="text-align: start" class="text-dark fw-bolder mb-1 fs-6">
                                    <form method="post" action="{{route('users.destroy',$user->id)}}"
                                          style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" type="submit" role="button"><i
                                                style="padding: 0" class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        {{--                        <td style="text-align: center">--}}
                        {{--                            <div style="text-align: start"--}}
                        {{--                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">--}}
                        {{--                                <form method="post" action="{{route('users.destroy',$user->id)}}"--}}
                        {{--                                      style="display: inline-block">--}}
                        {{--                                    @csrf--}}
                        {{--                                    @method('delete')--}}
                        {{--                                    <button class="btn btn-sm btn-danger" type="submit" role="button">Delete--}}
                        {{--                                    </button>--}}
                        {{--                                </form>--}}
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
        There is No User Yet!
    @endif

@endsection

@push('css')

@endpush
@push('scripts')

@endpush
