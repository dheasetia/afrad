@extends('layouts.main')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-users"></i> المجموعات</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة مجموعة جديدة</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="{{url('roles')}}" method="post" accept-charset="utf-8" id="form_role_create">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                                            <label class="control-label" for="name"> الرمز <span class="required">*</span> </label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" autofocus>
                                            <span class="help-block">كلمة واحدة وباللغة الإنجليزية</span>
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('label') ? ' has-error' : ''}}">
                                            <label class="control-label" for="label"> الاسم <span class="required">*</span> </label>
                                            <input type="text" id="label" name="label" class="form-control" value="{{old('label')}}">
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
                                        <textarea id="description" name="description" class="form-control">{{old('description')}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">{{$errors->first('description')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{url('roles')}}" class="btn btn-default waves-effect waves-light" data-toggle="tooltip" title="عودة لقائمة المجموعات"> <i class="fa fa-undo"></i>  إلغاء </a>
                            <button type="submit" class="btn btn-success waves-effect waves-light"> <i class="fa fa-save"></i>  حفظ </button>
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
    <script src="{{asset('js/pages/role_create.js')}}"></script>
@endsection