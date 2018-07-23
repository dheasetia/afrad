@extends('layouts.main')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-cart-arrow-down"></i> أنواع المصروفات </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة نوع مصروف جديد</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="/expenses" method="post" accept-charset="utf-8">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('income') ? ' has-error' : ''}}">
                                            <label class="control-label" for="income"> نوع المصروف <span class="required">*</span> </label>
                                            <input type="text" id="income" name="income" class="form-control">
                                            @if ($errors->has('income'))
                                                <span class="help-block">{{$errors->first('income')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="/expenses" class="btn btn-default waves-effect waves-light" data-toggle="tooltip" title="عودة لقائمة أنواع المصروفات"> <i class="fa fa-undo"></i>  إلغاء </a>
                            <button type="submit" class="btn btn-success waves-effect waves-light"> <i class="fa fa-save"></i>  حفظ </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection