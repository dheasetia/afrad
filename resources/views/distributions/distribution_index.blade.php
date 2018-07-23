@extends('layouts.main')

@section('custom_style')
    <style>
        .btn-icon-only {
            width: 32px;
        }

    </style>
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-gift"></i> المساعدات <span class="small"> المساعدات المصروفة</span> </h4>
        </div>
    </div>

    <div class="row" id="panel_distribution">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة المساعدات المصروفة</h3>
                <div class="box-actions">
                    <a href="{{url('distributions/create')}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="صرف مساعدة جديدة" id="btn_add_distribution"><i class="fa fa-plus"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table_distributions">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>اسم المستفيد</th>
                            <th>نوع المساعدة</th>
                            <th>تاريخ الصرف </th>
                            <th>المدينة</th>
                            <th>إجمالي المبلغ المصروف</th>
                            <th class="column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($distributions) > 0)
                            @foreach($distributions as $distribution)
                                <tr id="tr_{{$distribution->id}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$distribution->beneficiary->name}}</td>
                                    <td>{{$distribution->distribution_kind->kind}}</td>
                                    <td>{{$distribution->hijri_distribution_date}} هـ </td>
                                    <td>{{$distribution->city->city}}</td>
                                    <td>{{$distribution->amount != '' ? $distribution->amount : '---'}}</td>
                                    <td>
                                        <a href="{{url('distributions', $distribution->id)}}" class="btn btn-sm btn-icon-only btn-info"><i class="fa fa-info"></i></a>
                                        <button type="button" class="btn btn-sm btn-danger btn-icon-only btn_delete_distribution" data-id="{{$distribution->id}}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h4>لا يوجد صرف مساعدة مسجل</h4>
                                </td>
                            </tr>
                        @endif
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
    <script src="{{asset('js/pages/distribution_index.js')}}"></script>
@endsection