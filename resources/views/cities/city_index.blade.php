@extends('layouts.main')
@section('content')

    <!--ADD CITY MODAL-->
    <div id="modal_add_city" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة إدارة جديدة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_city" autocomplete="off">
                        <div class="form-group">
                            <label for="city_add_input" class="control-label">اسم المدينة</label>
                            <input type="text" class="form-control" name="city" id="city_add_input" autocomplete="off" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="city_id" class="control-label">المنطقة</label>
                            <select class="form-control" id="city_id" name="city_id">
                                <option>--- اختر ---</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}">{{$area->area}}</option>
                                @endforeach
                            </select>
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


    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المدن</h4>
        </div>
    </div>

    <div class="row" id="panel_city">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة المدن</h3>
                <div class="box-actions">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="إضافة مدينة" id="btn_add_city"><i class="fa fa-plus"></i> إضافة </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table_cities">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>المدينة</th>
                            <th>المنطقة</th>
                            <th class="column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($cities as $city)--}}
                            {{--<tr>--}}
                                {{--<td>{{$loop->iteration}}</td>--}}
                                {{--<td>{{$city->city}}</td>--}}
                                {{--<td>{{$city->area->area}}</td>--}}
                                {{--<td class="column-action">--}}
                                    {{--<a href="#" data-toggle="tooltip" data-original-title="تعديل"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-original-title="حذف"> <i class="fa fa-close text-danger"></i> </a>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/bootstrap-confirmation2/bootstrap-confirmation.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/pages/city_index.js')}}"></script>
@endsection