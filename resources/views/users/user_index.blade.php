@extends('layouts.main')

@section('custom_style')
    <style>
        .btn-icon-only {
            width: 32px;
        }
        .column-action {
            width: 150px!important;
        }
    </style>
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-users"></i> المستخدمون </h4>
        </div>
    </div>

    <div class="row" id="panel_user">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة المستخدمين</h3>
                <div class="box-actions">
                    <a href="{{url('users/create')}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="إضافة مستخدم" id="btn_add_user"><i class="fa fa-plus"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table_users">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>اسم المستخدم</th>
                            <th>الوظيفة</th>
                            <th>الإدارة</th>
                            <th>رقم الجوال</th>
                            <th>محموعة صلاحية</th>
                            <th>الحالة</th>
                            <th class="column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->job->job}}</td>
                                    <td>{{$user->department->department}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>{{$user->first_role_label}}</td>
                                    <td id="td_status_{{$user->id}}">{!! $user->label_status !!}</td>
                                    <td>
                                        <a href="{{url('users', $user->id)}}" class="btn btn-sm btn-icon-only btn-info"><i class="fa fa-info"></i></a>
                                        @role('admin')
                                        @if(Auth::user()->id != $user->id)
                                            <span id="btn_ban_{{$user->id}}">
                                                @if($user->is_banned == 0)
                                                    <button type="button" class="btn btn-sm btn-warning btn-icon-only btn_ban_user" data-id="{{$user->id}}"><i class="fa fa-ban"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success btn-icon-only btn_unban_user" data-id="{{$user->id}}"><i class="fa fa-check"></i></button>
                                                @endif
                                            </span>
                                        <a href="{{url('users', $user->id) . '/delete_confirmation'}}"  class="btn btn-sm btn-danger btn-icon-only" data-toggle="tooltip" title="حذف المستخدم"><i class="fa fa-trash"></i></a>
                                        @endif
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center">لا يوجد مستخدم مسجل</h4>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/bootstrap-confirmation2/bootstrap-confirmation.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/pages/user_index.js')}}"></script>
@endsection