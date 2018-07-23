@extends('layouts.main')

@section('custom_style')
    <style>
        .btn-icon-only {
            width: 32px;
        }
    </style>
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-users"></i> الموظفون <span class="small">قائمة الموظفين</span> </h4>
        </div>
    </div>

    <div class="row" id="panel_employee">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة الموظفين</h3>
                <div class="box-actions">
                    <a href="{{url('employees/create')}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="إضافة موظف" id="btn_add_employee"><i class="fa fa-plus"></i> إضافة </a>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table_employees">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>اسم الموظف</th>
                            <th>الوظيفة</th>
                            <th>الإدارة</th>
                            <th>رقم الجوال</th>
                            <th>البريد الإلكتروني</th>
                            <th class="column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($employees) > 0)
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->job->job}}</td>
                                    <td>{{$employee->department->department}}</td>
                                    <td>{{$employee->mobile}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>
                                        <a href="{{url('employees', $employee->id)}}" class="btn btn-sm btn-icon-only btn-info"><i class="fa fa-info"></i></a>
                                        <button type="button" class="btn btn-sm btn-danger btn-icon-only btn_delete_employee" data-id="{{$employee->id}}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <h5>لا يوجد موظف مسجل</h5>
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
    <script src="{{asset('js/pages/employee_index.js')}}"></script>
@endsection