@extends('layouts.main')

@section('custom_style')
    <style>
        .after-input {
            width: 100%;
        }
    </style>
@endsection

@section('content')


    <!--ADD CITY MODAL-->
    <div id="modal_add_city" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مدينة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_city" autocomplete="off">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city_add_input" class="control-label">اسم المدينة</label>
                                    <input type="text" class="form-control" name="city" id="city_add_input" autocomplete="off" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="area_id" class="control-label">المنطقة</label>
                                    <select class="form-control" id="area_id" name="area_id">
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info after-input waves-effect waves-light" id="btn_add_area_modal" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_city">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD CITY MODAL-->

    <!--ADD AREA MODAL-->
    <div id="modal_add_area" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة منطقة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_area" autocomplete="off">
                        <div class="form-group">
                            <label for="area_add_input" class="control-label">اسم المنطقة</label>
                            <input type="text" class="form-control" name="area" id="area_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_area">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD AREA MODAL-->

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-user"></i> المستفيدون </h4>
        </div>
    </div>

    <div class="row" id="panel_beneficiary">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="{{url('beneficiaries', $beneficiary->id) . '/address'}}" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form_create_address">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="form-body">
                                <h3 class="box-title">إضافة عنوان المنزل للمستفيد: {{$beneficiary->name}}</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city_id" class="control-label">المدينة</label>
                                            <select id="city_id" class="form-control" name="city_id">
                                                <option value="">--- اختر ---</option>
                                                @foreach($cities as $city)
                                                    <option {{old('city_id') == $city->id ? 'selected' : ''}} value="{{$city->id}}" >{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city_id'))
                                                <span class="help-block">{{$errors->first('city_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_city" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('building_name') ? ' has-error' : ''}}">
                                            <label class="control-label">المنطقة</label>
                                            <p class="form-control" id="province"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('building_name') ? ' has-error' : ''}}">
                                            <label class="control-label" for="building_name" >اسم المبنى</label>
                                            <input type="text" id="building_name" name="building_name" value="{{old('building_name')}}" class="form-control">
                                            @if ($errors->has('building_name'))
                                                <span class="help-block">{{$errors->first('building_name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('building_no') ? ' has-error' : ''}}">
                                            <label class="control-label" for="building_no" >رقم المبنى</label>
                                            <input type="text" id="building_no" name="building_no" value="{{old('building_no')}}" class="form-control">
                                            @if ($errors->has('building_no'))
                                                <span class="help-block">{{$errors->first('building_no')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('street') ? ' has-error' : ''}}">
                                            <label class="control-label" for="street" >الشارع</label>
                                            <input type="text" id="street" name="street" value="{{old('street')}}" class="form-control">
                                            @if ($errors->has('street'))
                                                <span class="help-block">{{$errors->first('street')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('district') ? ' has-error' : ''}}">
                                            <label class="control-label" for="district" >الحي</label>
                                            <input type="text" id="district" name="district" value="{{old('district')}}" class="form-control">
                                            @if ($errors->has('district'))
                                                <span class="help-block">{{$errors->first('district')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('po_box') ? ' has-error' : ''}}">
                                            <label class="control-label" for="po_box" >صندوق البريد</label>
                                            <input type="text" id="po_box" name="po_box" value="{{old('po_box')}}" class="form-control">
                                            @if ($errors->has('po_box'))
                                                <span class="help-block">{{$errors->first('po_box')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('zip_code') ? ' has-error' : ''}}">
                                            <label class="control-label" for="zip_code" >الرمز البريدي</label>
                                            <input type="text" id="zip_code" name="zip_code" value="{{old('zip_code')}}" class="form-control">
                                            @if ($errors->has('zip_code'))
                                                <span class="help-block">{{$errors->first('zip_code')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('additional_no') ? ' has-error' : ''}}">
                                            <label class="control-label" for="additional_no" >الرقم الإضافي</label>
                                            <input type="text" id="additional_no" name="additional_no" value="{{old('additional_no')}}" class="form-control">
                                            @if ($errors->has('additional_no'))
                                                <span class="help-block">{{$errors->first('additional_no')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('coordinate') ? ' has-error' : ''}}">
                                            <label class="control-label" for="coordinate" > الاحداثيات</label>
                                            <input type="text" id="coordinate" name="coordinate" value="{{old('coordinate')}}" class="form-control" readonly>
                                            <span class="help-block">الرجاء سحب الدبوس ووضعه في منزل المستفيد في الخريطة</span>
                                            @if ($errors->has('coordinate'))
                                                <span class="help-block">{{$errors->first('coordinate')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="office_map" style="height: 600px; width: auto;"></div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXi_ikrgat68ZL6SeidLuihVWh81L6ILc&language=ar"></script>
    <script src="{{ asset('plugins/bower_components/gmaps/gmaps.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/pages/address_create.js')}}"></script>
@endsection