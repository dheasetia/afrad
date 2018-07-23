@extends('layouts.main')

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-book"></i> التخصصات الدراسية</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">إضافة تخصص دراسي جديد</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="/education-specialties" method="post" accept-charset="utf-8">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('specialty') ? ' has-error' : ''}}">
                                            <label class="control-label" for="specialty"> اسم التخصص دراسي <span class="required">*</span> </label>
                                            <input type="text" id="specialty" name="specialty" class="form-control">
                                            @if ($errors->has('specialty'))
                                                <span class="help-block">{{$errors->first('specialty')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="/education-specialties" class="btn btn-default waves-effect waves-light" data-toggle="tooltip" title="عودة لقائمة التخصصات الدراسية"> <i class="fa fa-undo"></i>  إلغاء </a>
                            <button type="submit" class="btn btn-success waves-effect waves-light"> <i class="fa fa-save"></i>  حفظ </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection