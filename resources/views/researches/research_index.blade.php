@extends('layouts.main')


@section('custom_style')
    <style>
        .res-group {
            margin: 10px 5px;
        }
        .res-label {
            display: inline-block;
            min-width: 150px;
            font-weight: bold;

        }
        .res-value {
            margin-right: 8px;
        }
        .colon {
            float: left;
        }
        .res-title {
            margin-bottom: 15px;
            display: block;
            border-bottom: 1px solid darkgray;
            padding: 10px 0 10px 20px;
        }
        .res-result-value {
            font-size: 250%;
            direction: ltr;
        }
        .res-last-table-row {
            background-color: #f2f2f2;
            font-family: DroidKufi, sans-serif;
        }
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-weight: bold;
        }
        th {
            text-align: center;
        }
        .fa-edit {
            font-size: 85% !important;

        }
        .fa-trash {
            font-size: 110%;
        }
        .res-column-action {
            min-width: 140px;
        }
    </style>
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-search"></i> دراسة حالات </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="table-responsive">
                    <h5>قائمة دراسات حالات سابقة</h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>م</th>
                            <th>اسم المستفيد</th>
                            <th>الجنسية</th>
                            <th>رقم الجوال</th>
                            <th>الدخل</th>
                            <th>المصروفات الشهرية</th>
                            <th>الفرق</th>
                            <th>النسبة المئوية</th>
                            <th>الاحتياجات المالية</th>
                            <th>الاحتياجات العينية</th>
                            <th>المبلغ المطلوب</th>
                            <th class="res-column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($researches as $research)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$research->beneficiary->name}}</td>
                                <td>{{$research->beneficiary->nationality != '' ? $research->beneficiary->nationality->nationality : ''}}</td>
                                <td>{{$research->beneficiary->mobile}}</td>
                                <td>{{number_format($research->total_income)}}</td>
                                <td>{{number_format($research->total_expense)}}</td>
                                <td>{{number_format($research->difference)}}</td>
                                <td>{{$research->percentage}}%</td>
                                <td>{{number_format($research->total_money_need)}}</td>
                                <td>{{number_format($research->total_item_need)}}</td>
                                <td>{{number_format($research->total_need)}}</td>
                                <td>
                                    <a href="{{url('/researches', $research->id)}}" class="btn btn-info" data-toggle="tooltip" data-title="تفاصيل"><i class="fa fa-info-circle"></i></a>
                                    <a href="{{url('/researches', $research->id) .'/edit'}}" class="btn btn-info" data-toggle="tooltip" data-title="تعديل"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger" data-toggle="tooltip" data-title="حذف"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection