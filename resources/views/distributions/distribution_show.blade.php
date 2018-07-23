@extends('layouts.main')

@section('custom_style')
    <link rel="stylesheet" href="{{asset('plugins/bower_components/custom-select/custom-select.css')}}">
    <style>
        .panel .panel-heading {
            padding: 8px 15px;
        }
    </style>
@endsection

@section('content')

    <!--ADD KIND MODAL-->
    <div id="modal_add_kind" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة نوع المساعدة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_kind" autocomplete="off">
                        <div class="form-group">
                            <label for="kind_add_input" class="control-label">نوع المساعدة</label>
                            <input type="text" class="form-control" name="kind" id="kind_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_kind">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD KIND MODAL-->

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

    <!--ADD ITEM MODAL-->
    <div id="modal_add_item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة بند المساعدة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_item" autocomplete="off">
                        <div class="form-group">
                            <label for="item_add_input" class="control-label">بند المساعدة</label>
                            <input type="text" class="form-control" name="item" id="item_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_item">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD ITEM MODAL-->

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-user"></i> المساعدات <span class="small">صرف مساعدة</span> </h4>
        </div>
    </div>

    <div class="row" id="panel_distribution">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="/distributions" method="post" accept-charset="utf-8" id="form_distribution">
                        {{csrf_field()}}
                        <input type="hidden" name="distribution_id" value="{{$distribution->id}}">
                        <div class="panel-body">
                            <div class="form-body">
                                <h4 class="box-title">صرف مساعدات</h4>
                                <div class="box-actions">
                                    <a href="{{url('distributions')}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="قائمة المساعدات"><i class="fa fa-list text-white"></i></a>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="form-group {{$errors->has('beneficiary_id') ? ' has-error' : ''}}">
                                            <label for="beneficiary_id" class="control-label">المستفيد<span class="required">*</span></label>
                                            <select id="beneficiary_id" class="form-control selectpicker" name="beneficiary_id">
                                                <option value="">-- اختر --</option>
                                                @foreach($beneficiaries as $beneficiary)
                                                    <option {{old('beneficiary_id', $distribution->beneficiary_id) == $beneficiary->id ? 'selected' : ''}} value="{{$beneficiary->id}}" >{{$beneficiary->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('beneficiary_id'))
                                                <span class="help-block">{{$errors->first('beneficiary_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{url('beneficiaries/create')}}" class="btn btn-info btn-block text-white btn-add" data-toggle="tooltip" title="إضافة مستفيد جديد"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('distribution_kind_id') ? ' has-error' : ''}}">
                                            <label for="distribution_kind_id" class="control-label">نوع المساعدة<span class="required">*</span></label>
                                            <select id="distribution_kind_id" class="form-control" name="distribution_kind_id">
                                                <option value="">-- اختر --</option>
                                                @foreach($distribution_kinds as $kind)
                                                    <option {{old('distribution_kind_id', $distribution->distribution_kind_id) == $kind->id ? 'selected' : ''}} value="{{$kind->id}}" >{{$kind->kind}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('distribution_kind_id'))
                                                <span class="help-block">{{$errors->first('distribution_kind_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-block text-white btn-add" id="btn_add_kind" data-toggle="tooltip" title="إضافة نوع مساعدة آخر"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('hijri_distribution_date') ? ' has-error' : ''}}">
                                            <label class="control-label" for="hijri_distribution_date"> التاريخ الهجري <span class="required">*</span></label>
                                            <input type="text" id="hijri_distribution_date" name="hijri_distribution_date" class="form-control" value="{{old('hijri_distribution_date', $distribution->hijri_distribution_date)}}" data-mask="99/ 99/ 9999">
                                            @if ($errors->has('hijri_distribution_date'))
                                                <span class="help-block">{{$errors->first('hijri_distribution_date')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="distribution_date" class="control-label"> التاريخ الميلادي (تلقائي)</label>
                                            <input type="text" class="form-control" id="distribution_date" name="distribution_date" value="{{$distribution->greg_distribution_date}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('city_id') ? ' has-error' : ''}}">
                                            <label for="city_id" class="control-label">المدينة<span class="required">*</span></label>
                                            <select id="city_id" class="form-control" name="city_id">
                                                <option value="">-- اختر --</option>
                                                @foreach($cities as $city)
                                                    <option {{old('city_id', $distribution->city_id) == $city->id ? 'selected' : ''}} value="{{$city->id}}" >{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city_id'))
                                                <span class="help-block">{{$errors->first('city_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-block text-white btn-add" id="btn_add_city" data-toggle="tooltip" title="إضافة مدينة "><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('place') ? ' has-error' : ''}}">
                                            <label class="control-label" for="place">المكان </label>
                                            <input type="text" id="place" name="place" class="form-control" value="{{old('place', $distribution->place)}}">
                                            @if ($errors->has('place'))
                                                <span class="help-block">{{$errors->first('place')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('is_periodic') ? ' has-error' : ''}}">
                                            <label class="control-label">مواعيد <span class="required">*</span></label>
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="is_periodic" id="is_periodic_2" value="0" {{old('is_periodic', $distribution->is_periodic) == '0' ? 'checked' : ''}}>
                                                        <label for="is_periodic_2">طارئ </label>
                                                    </div>
                                                </label>
                                                <label class="radio-inline">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="is_periodic" id="is_periodic_1" value="1" {{old('is_periodic', $distribution->is_periodic) == '1' || old('is_periodic') == null ? 'checked' : ''}}>
                                                        <label for="is_periodic_1">دوري</label>
                                                    </div>
                                                </label>

                                            </div>
                                            @if ($errors->has('is_periodic'))
                                                <span class="help-block">{{$errors->first('is_periodic')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-success" id="btn_update_distribution"> <i class="fa fa-save"></i>  تحديث </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row panel_distribution_item">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading"> بنود المساعدات
                    <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="table_items">
                                <thead>
                                <tr>
                                    <th style="width: 60px">الرقم</th>
                                    <th style="width: 12%">نوع الصرف</th>
                                    <th>بند المساعدة</th>
                                    <th style="width: 10%">سعر الوحدة</th>
                                    <th style="width: 5%">الكمية</th>
                                    <th style="width: 100px">الإجمالي</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="info">
                                    <form id="form_item">
                                        <input type="hidden" name="distribution_id" value="{{$distribution->id}}" id="distribution_id">
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="seq" class="form-control" id="input_seq" readonly="readonly">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="is_money" id="input_is_money">
                                                    <option value="1">نقدي</option>
                                                    <option value="0">عيني</option>
                                                </select>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select type="text" name="item_id" class="form-control" id="input_item_id">
                                                    <option value="">--- اختر ---</option>
                                                    @foreach($items as $item)
                                                        <option value="{{$item->id}}">{{$item->item}}</option>
                                                    @endforeach
                                                    <option value="add_new">--- إضافة جديدة --- </option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="cost" class="form-control" id="input_cost">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="quantity" class="form-control" id="input_quantity">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success" id="btn_add_item"><i class="fa fa-plus"></i> إضافة </button>
                                        </td>
                                    </form>
                                </tr>
                                @foreach($distribution_items as $item)
                                    <tr>
                                        <td>{{$item->seq_num}}</td>
                                        <td>{{$item->is_money}}</td>
                                        <td>{{$item->item->item}}</td>
                                        <td>{{$item->cost}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td class="subtotal">{{$item->subtotal}}</td>
                                    </tr>
                                @endforeach
                                <tr class="danger" id="tr_total">
                                    <td colspan="5" class="text-center"><h3>إجمالي المبلغ </h3></td>
                                    <td id="total_money"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('js/mask.js')}}"></script>
    <script src="{{asset('plugins/bower_components/custom-select/custom-select.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.plus.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.ummalqura.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/typeahead/dist/typeahead.jquery.js')}}"></script>
    <script src="{{asset('js/pages/distribution_show.js')}}"></script>
@endsection