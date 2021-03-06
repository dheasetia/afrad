@extends('layouts.main')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-money"></i> مصادر الدخل</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة مصدر دخل جديد</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="/incomes" method="post" accept-charset="utf-8">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('income') ? ' has-error' : ''}}">
                                            <label class="control-label" for="income">اسم مصدر الدخل <span class="required">*</span> </label>
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
                            <a href="/incomes" class="btn btn-default waves-effect waves-light" data-toggle="tooltip" title="عودة لقائمة أنواع الدخل"> <i class="fa fa-undo"></i>  إلغاء </a>
                            <button type="submit" class="btn btn-success waves-effect waves-light"> <i class="fa fa-save"></i>  حفظ </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection