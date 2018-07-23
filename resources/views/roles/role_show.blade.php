@extends('layouts.main')

@section('custom_style')
    <style>
        .panel .panel-heading a i {
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-users"></i> المجموعات</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel_role">
                <div class="panel-heading"> تفاصيل المجموعة: {{$role->label}}
                    <div class="box-actions">
                        <a href="{{url('roles')}}" class="btn btn-sm btn-default" data-toggle="tooltip" title="عودة لقائمة المجموعات"><i class="fa fa-list"></i></a>
                        <a href="{{url('roles/create')}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="إضافة مجموعة جديدة"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="/" method="post" accept-charset="utf-8" id="form_role_edit">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <input type="hidden" name="role_id" value="{{$role->id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                                            <label class="control-label" for="name"> الرمز <span class="required">*</span> </label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{old('name', $role->name)}}" readonly>
                                            <span class="help-block">كلمة واحدة وباللغة الإنجليزية</span>
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('label') ? ' has-error' : ''}}">
                                            <label class="control-label" for="label"> الاسم <span class="required">*</span> </label>
                                            <input type="text" id="label" name="label" class="form-control" value="{{old('label', $role->label)}}">
                                            @if ($errors->has('label'))
                                                <span class="help-block">{{$errors->first('label')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{$errors->has('description') ? ' has-error' : ''}}">
                                        <label class="control-label" for="description"> الوصف </label>
                                        <textarea id="description" name="description" class="form-control">{{old('description', $role->description)}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">{{$errors->first('description')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{url('roles', $role->id)}}" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" title="إلغاء التغييرات"> <i class="fa fa-refresh"></i>  إلغاء </a>
                            <button type="submit" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="حفظ التغييرات"> <i class="fa fa-save"></i>  حفظ </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel_permissions">
                <div class="panel-heading">الصلاحيات لهذه المجوعة
                    <div class="box-actions">
                        <button type="button" class="btn btn-sm btn-success" id="btn_check_all" data-toggle="tooltip" title="اختيار الكل"><i class="fa fa-check-square-o"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" id="btn_uncheck_all" data-toggle="tooltip" title="إلغاء الكل"><i class="fa fa-square-o"></i></button>
                    </div>
                </div>

                <form method="post" action="{{url('roles/assign-permissions')}}" accept-charset="utf-8">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{csrf_field()}}
                        <input type="hidden" name="role_id" value="{{$role->id}}">
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="{{$permission->name}}" class="permission_checkbox" name="permission[]" value="{{$permission->name}}" type="checkbox" {{$role->hasPermissionTo($permission) ? 'checked' : ''}}>
                                            <label for="{{$permission->name}}"> {{$permission->label}} </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{url('roles', $role->id)}}" class="btn btn-primary waves-effect waves-light" data-toggle="tooltip" title="إلغاء التغييرات"> <i class="fa fa-refresh"></i>  إلغاء </a>
                        <button type="submit" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="حفظ التغييرات" id="btn_assign_permissions"> <i class="fa fa-save"></i>  حفظ </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{{asset('js/pages/role_show.js')}}"></script>
@endsection