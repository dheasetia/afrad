@extends('layouts.main')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-map-signs"></i>المناطق</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة منطقة جديدة</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="/areas" method="post" accept-charset="utf-8" id="form_area_create">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('area') ? ' has-error' : ''}}">
                                            <label class="control-label" for="area"> اسم المنطقة <span class="required">*</span> </label>
                                            <input type="text" id="area" name="area" class="form-control" value="{{old('area')}}" autofocus>
                                            @if ($errors->has('area'))
                                                <span class="help-block">{{$errors->first('area')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="/areas" class="btn btn-default waves-effect waves-light" data-toggle="tooltip" title="عودة لقائمة المناطق"> <i class="fa fa-undo"></i>  إلغاء </a>
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
    <script src="{{asset('plugins/bower_components/jquery-validation/js/localization/messages_ar.js')}}"></script>
    <script src="{{asset('js/pages/area_create.js')}}"></script>
@endsection