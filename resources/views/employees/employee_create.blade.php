@extends('layouts.main')

@section('custom_style')
    <style>
        .panel-footer {
            padding: 25px 0px !important;
        }
    </style>
@endsection

@section('content')

    <!--ADD JOB MODAL-->
    <div id="modal_add_job" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة وظيفة جديدة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_job" autocomplete="off">
                        <div class="form-group">
                            <label for="job_add_input" class="control-label">اسم الوظيفة</label>
                            <input type="text" class="form-control" name="job" id="job_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_job">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD JOB MODAL-->

    <!--ADD DEPARTMENT MODAL-->
    <div id="modal_add_department" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة إدارة جديدة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_department" autocomplete="off">
                        <div class="form-group">
                            <label for="department_add_input" class="control-label">اسم الإدارة</label>
                            <input type="text" class="form-control" name="department" id="department_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_department">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD DEPARTMENT MODAL-->


    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-user"></i> الموظفون <span class="small">إضافة موظف جديد</span> </h4>
        </div>
    </div>

    <div class="row" id="panel_beneficiary">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="{{url('employees')}}" method="post" accept-charset="utf-8"  id="form_create_employee">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="form-body">
                                <h5 class="box-title">معلومات الموظف</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                                            <label class="control-label" for="name" >اسم الموظف <span class="required">*</span></label>
                                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control">
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="job_id" class="control-label">الوظيفة <span class="required">*</span></label>
                                            <select id="job_id" class="form-control" name="job_id">
                                                <option value="">--- اختر ---</option>
                                                @if (count($jobs) > 0)
                                                    @foreach($jobs as $job)
                                                        <option {{old('job_id') == $job->id ? 'selected' : ''}} value="{{$job->id}}" >{{$job->job}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('job_id'))
                                                <span class="help-block">{{$errors->first('job_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_job_modal" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="department_id" class="control-label">الإدارة <span class="required">*</span></label>
                                            <select id="department_id" class="form-control" name="department_id">
                                                <option value="">--- اختر ---</option>
                                                @if (count($departments) > 0)
                                                    @foreach($departments as $department)
                                                        <option {{old('department_id') == $department->id ? 'selected' : ''}} value="{{$department->id}}" >{{$department->department}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('department_id'))
                                                <span class="help-block">{{$errors->first('department_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_department_modal" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mobile') ? ' has-error' : ''}}">
                                            <label class="control-label" for="mobile" >رقم الجوال <span class="required">*</span></label>
                                            <input type="text" id="mobile" name="mobile" value="{{old('mobile')}}" class="form-control">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">{{$errors->first('mobile')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                            <label class="control-label" for="email" >البريد الإلكتروني </label>
                                            <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control">
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('notes') ? ' has-error' : ''}}">
                                            <label class="control-label" for="notes" > معلومات إضافية</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="3">{{old('notes')}}</textarea>
                                            @if ($errors->has('notes'))
                                                <span class="help-block">{{$errors->first('notes')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i>  حفظ </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/pages/employee_create.js')}}"></script>
@endsection