@extends('layouts.main')

@section('custom_style')
    <link rel="stylesheet" href="{{asset('plugins/bower_components/dropify/dist/css/dropify.min.css')}}">
@endsection

@section('content')
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
    <!--END EDIT DEPARTMENT MODAL-->

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

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المستخدمون <span class="small">إضافة مستخدم</span></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="{{url('users')}}" method="post" id="form_user_create" accept-charset="utf-8">
                            {{csrf_field()}}
                            <div class="form-body">
                                <h3 class="box-title">معلومات حساب</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                                            <label class="control-label" for="name">الاسم الكامل <span class="required">*</span> </label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                            <label class="control-label" for="email">البريد الإلكتروني <span class="required">*</span> </label>
                                            <input type="text" id="email" name="email" class="form-control" value="{{old('email')}}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
                                            <label class="control-label" for="password"> كلمة المرور <span class="required">*</span> </label>
                                            <input type="password" id="password" name="password" class="form-control" value="{{old('password')}}">
                                            @if ($errors->has('password'))
                                                <span class="help-block">{{$errors->first('password')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('password_confirmation') ? ' has-error' : ''}}">
                                            <label class="control-label" for="password_confirmation"> تأكيد كلمة المرور <span class="required">*</span> </label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('mobile') ? ' has-error' : ''}}">
                                            <label class="control-label" for="mobile"> الجوال <span class="required">*</span> </label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="{{old('mobile')}}">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">{{$errors->first('mobile')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('phone') ? ' has-error' : ''}}">
                                            <label class="control-label" for="phone"> الهاتف  </label>
                                            <input type="text" id="phone" name="phone" class="form-control" value="{{old('phone')}}">
                                            @if ($errors->has('phone'))
                                                <span class="help-block">{{$errors->first('phone')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('ext') ? ' has-error' : ''}}">
                                            <label class="control-label" for="ext">امتداد  </label>
                                            <input type="text" id="ext" name="ext" class="form-control" value="{{old('ext')}}">
                                            @if ($errors->has('ext'))
                                                <span class="help-block">{{$errors->first('ext')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('job_id') ? ' has-error' : ''}}">
                                            <label for="job_id" class="control-label">الوظيفة<span class="required">*</span></label>
                                            <select id="job_id" class="form-control" name="job_id">
                                                <option value="">-- اختر --</option>
                                                @foreach($jobs as $job)
                                                    <option {{old('job_id') == $job->id ? 'selected' : ''}} value="{{$job->id}}" >{{$job->job}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" data-toggle="tooltip" title="إضافة" id="btn_add_job_modal"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('department_id') ? ' has-error' : ''}}">
                                            <label for="department_id" class="control-label">الإدارة<span class="required">*</span></label>
                                            <select id="department_id" class="form-control" name="department_id">
                                                <option value="">-- اختر --</option>
                                                @foreach($departments as $department)
                                                    <option {{old('department_id') == $department->id ? 'selected' : ''}} value="{{$department->id}}" >{{$department->department}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" data-toggle="tooltip" title="إضافة" id="btn_add_department_modal"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('role_id') ? ' has-error' : ''}}">
                                            <label for="role_id" class="control-label">مجموعة الصلاحية<span class="required">*</span></label>
                                            <select id="role_id" class="form-control" name="role_id">
                                                <option value="">-- اختر --</option>
                                                @foreach($roles as $role)
                                                    <option {{old('role_id') == $role->id ? 'selected' : ''}} value="{{$role->id}}" >{{$role->label}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row col-md-12">
                                    <p class="text-info"><i class="fa fa-warning"></i> يمكنك رفع الصورة الشحصية بعد عملية الحفظ. </p>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i>  حفظ </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/dropify/dist/js/dropify.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/pages/user_create.js')}}"></script>
@endsection