@extends('layouts.main')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-file"></i> المستندات</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة مستند للمستفيد: {{$beneficiary->name}}</div>
                @if(count($errors) > 0)
                <div class="alert alert-info">
                    <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="{{url('beneficiaries', $beneficiary->id) . '/documents'}}" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form_document_create">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <input type="hidden" name="beneficiary_id" value="{{$beneficiary->id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('label') ? ' has-error' : ''}}">
                                            <label class="control-label" for="label"> اسم المستند <span class="required">*</span> </label>
                                            <input type="text" id="label" name="label" class="form-control" autofocus>
                                            @if ($errors->has('label'))
                                                <span class="help-block">{{$errors->first('label')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success after-input">
                                                <input id="check_expiry" type="checkbox" name="check_expiry">
                                                <label for="check_expiry"> متابعة تاريخ الانتهاء </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="check_expiry_area" style="display: none">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('hijri_expiry_date') ? ' has-error' : ''}}">
                                            <label class="control-label" for="hijri_expiry_date"> تاريخ الانتهاء (هجري) <span class="required">*</span></label>
                                            <input type="text" id="hijri_expiry_date" name="hijri_expiry_date" class="form-control" value="{{old('hijri_expiry_date')}}" data-mask="99/ 99/ 9999">
                                            @if ($errors->has('hijri_expiry_date'))
                                                <span class="help-block">{{$errors->first('hijri_expiry_date')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expiry_date" class="control-label"> التاريخ الميلادي (تلقائي)</label>
                                            <input type="text" class="form-control" id="expiry_date" name="expiry_date" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">رفع الملف</label>
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>
                                                    <span class="fileinput-filename"></span>
                                                </div>
                                                <span class="input-group-addon btn btn-default btn-file">
                                                    <span class="fileinput-new">اختيار ملف</span>
                                                    <span class="fileinput-exists">تغيير</span>
                                                    <input type="file" name="path">
                                                </span>
                                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">حذف</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{url('beneficiaries', $beneficiary->id) . '?tab_active=documents'}}" class="btn btn-default waves-effect waves-light" data-toggle="tooltip" title="عودة"> <i class="fa fa-undo"></i>  إلغاء </a>
                            <button type="submit" class="btn btn-success waves-effect waves-light"> <i class="fa fa-save"></i>  حفظ </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('plugin_scripts')
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
    <script src="{{asset('js/mask.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.plus.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.ummalqura.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/pages/document_create.js')}}"></script>

@endsection