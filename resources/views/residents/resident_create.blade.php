@extends('layouts.main')

@section('custom_style')
    <style>
        .panel-footer {
            padding: 25px 0px !important;
        }
    </style>
@endsection

@section('content')

    <!--ADD RESIDENT KIND MODAL-->
    <div id="modal_add_resident_kind" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة نوع السكن</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_resident_kind" autocomplete="off">
                        <div class="form-group">
                            <label for="resident_kind_add_input" class="control-label">نوع السكن</label>
                            <input type="text" class="form-control" name="resident_kind" id="resident_kind_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_resident_kind">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD RESIDENT KIND MODAL-->

    <!--ADD BANK MODAL-->
    <div id="modal_add_bank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة بنك جديد</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_bank" autocomplete="off">
                        <div class="form-group">
                            <label for="bank_add_input" class="control-label">اسم البنك</label>
                            <input type="text" class="form-control" name="bank" id="bank_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_bank">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD BANK MODAL-->


    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-user"></i> السكن </h4>
        </div>
    </div>

    <div class="row" id="panel_beneficiary">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="{{url('beneficiaries', $beneficiary->id) . '/residents'}}" method="post" accept-charset="utf-8"  id="form_create_resident">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="form-body">
                                <h4 class="box-title">إضافة معلومات السكن للمستفيد:  {{$beneficiary->name}}</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="resident_kind_id" class="control-label">نوع السكن</label>
                                            <select id="resident_kind_id" class="form-control" name="resident_kind_id">
                                                <option value="">--- اختر ---</option>
                                                @if (count($resident_kinds) > 0)
                                                    @foreach($resident_kinds as $kind)
                                                        <option {{old('resident_kind_id') == $kind->id ? 'selected' : ''}} value="{{$kind->id}}" >{{$kind->kind}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('resident_kind_id'))
                                                <span class="help-block">{{$errors->first('resident_kind_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_resident_kind_modal" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('owner') ? ' has-error' : ''}}">
                                            <label class="control-label" for="owner" >اسم الجهة/ صاحب العقار</label>
                                            <input type="text" id="owner" name="owner" value="{{old('owner')}}" class="form-control">
                                            @if ($errors->has('owner'))
                                                <span class="help-block">{{$errors->first('owner')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('responsible_person') ? ' has-error' : ''}}">
                                            <label class="control-label" for="responsible_person" >اسم الشحص المسؤول</label>
                                            <input type="text" id="responsible_person" name="responsible_person" value="{{old('responsible_person')}}" class="form-control">
                                            @if ($errors->has('responsible_person'))
                                                <span class="help-block">{{$errors->first('responsible_person')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mobile') ? ' has-error' : ''}}">
                                            <label class="control-label" for="mobile" >رقم الجوال</label>
                                            <input type="text" id="mobile" name="mobile" value="{{old('mobile')}}" class="form-control">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">{{$errors->first('mobile')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('phone') ? ' has-error' : ''}}">
                                            <label class="control-label" for="phone" >رقم الهاتف</label>
                                            <input type="text" id="phone" name="phone" value="{{old('phone')}}" class="form-control">
                                            @if ($errors->has('phone'))
                                                <span class="help-block">{{$errors->first('phone')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('fax') ? ' has-error' : ''}}">
                                            <label class="control-label" for="fax" >رقم الفاكس</label>
                                            <input type="text" id="fax" name="fax" value="{{old('fax')}}" class="form-control">
                                            @if ($errors->has('fax'))
                                                <span class="help-block">{{$errors->first('fax')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                            <label class="control-label" for="email" >البريد الإلكتروني</label>
                                            <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control">
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="bank_id" class="control-label">اسم البنك</label>
                                            <select id="bank_id" class="form-control" name="bank_id">
                                                <option value="">بدون</option>
                                                @foreach($banks as $bank)
                                                    <option {{old('bank_id') == $bank->id ? 'selected' : ''}} value="{{$bank->id}}" >{{$bank->bank}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_bank" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('iban') ? ' has-error' : ''}}">
                                            <label class="control-label" for="iban" >رقم الأيبان</label>
                                            <input type="text" id="iban" name="iban" value="{{old('iban')}}" class="form-control">
                                            @if ($errors->has('iban'))
                                                <span class="help-block">{{$errors->first('iban')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('payment_way') ? ' has-error' : ''}}">
                                            <label class="control-label" for="payment_way" >طريقة الدفع</label>
                                            <select id="payment_way" name="payment_way" class="form-control">
                                                <option value="">بدون</option>
                                                <option {{old('payment_way') == 'نقدا' ? 'selected' : ''}} value="نقدا">نقدا</option>
                                                <option {{old('payment_way') == 'شيك' ? 'selected' : ''}} value="شيك">شيك</option>
                                                <option {{old('payment_way') == 'تحويل' ? 'selected' : ''}} value="تحويل">تحويل</option>
                                                <option {{old('payment_way') == 'أخرى' ? 'selected' : ''}} value="أخرى">أخرى</option>
                                            </select>
                                            @if ($errors->has('payment_way'))
                                                <span class="help-block">{{$errors->first('payment_way')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('annually_cost') ? ' has-error' : ''}}">
                                            <label class="control-label" for="annually_cost" >التكلفة بالسنة</label>
                                            <input type="text" id="annually_cost" name="annually_cost" value="{{old('annually_cost')}}" class="form-control">
                                            @if ($errors->has('annually_cost'))
                                                <span class="help-block">{{$errors->first('annually_cost')}}</span>
                                            @endif
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('coordinate') ? ' has-error' : ''}}">
                                            <label class="control-label" for="description" > معلومات إضافية</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{$errors->first('description')}}</span>
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
    <script src="{{asset('js/pages/resident_create.js')}}"></script>
@endsection