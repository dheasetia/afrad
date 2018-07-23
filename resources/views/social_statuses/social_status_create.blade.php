@extends('layouts.main')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">إضافة حالة اجتماعية جديدة</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="/social-statuses" method="post" accept-charset="utf-8">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('status') ? ' has-error' : ''}}">
                                            <label class="control-label" for="status"> الحالة الاجتماعية <span class="required">*</span> </label>
                                            <input type="text" id="status" name="status" class="form-control">
                                            @if ($errors->has('status'))
                                                <span class="help-block">{{$errors->first('status')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <a href="/social-statuses" class="btn btn-default waves-effect waves-light" data-toggle="tooltip" title="عودة لقائمة الحالات الاجتماعية"> <i class="fa fa-undo"></i>  إلغاء </a>
                                <button type="submit" class="btn btn-success waves-effect waves-light"> <i class="fa fa-save"></i>  حفظ </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection