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
        .res-page-title {
            display: inline-block;
        }
        .res-top-action a{
            float: left;
        }
        .fcbtn {
            margin-left: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-search"></i> دراسة حالة </h4>
        </div>
    </div>
        <div class="white-box">
            <div class="row res-title-wrapper">
                <div class="col-md-3">
                    <h3 class="res-page-title">ملخص حالة طارئة</h3>
                </div>

                <div class="col-md-9 res-top-action">
                    <a href="{{url('/researches', $research->id) . '/edit'}}" class="btn fcbtn btn btn-outline btn-danger btn-1b" data-toggle="tooltip" data-title="تعديل"><i class="fa fa-edit"></i> تعديل </a>
                    <a href="{{url('/researches', $research->id) . '/print'}}" class="btn fcbtn btn btn-outline btn-info btn-1b" data-toggle="tooltip" data-title="طباعة"><i class="fa fa-print"></i> طباعة </a>
                    <a href="{{url('/beneficiaries', $beneficiary->id) . '?tab_active=researches'}}" class="btn fcbtn btn btn-outline btn-primary btn-1b" data-toggle="tooltip" data-title="عودة"><i class="fa fa-undo"></i> عودة </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 res-wrapper">
                    <h5 class="res-title">معلومات البحث</h5>
                    <div class="row res-group">
                        <div class="res-label">نوع الحالة <span class="colon">:</span></div>
                        <div class="res-value">{{$research->research_kind->kind}} </div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">التاريخ الهجري <span class="colon">:</span></div>
                        <div class="res-value">{{$research->formatted_research_hijri_date}} هـ </div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">التاريخ الميلادي <span class="colon">:</span></div>
                        <div class="res-value">{{$research->research_date->format('d/ m/ Y')}} م </div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">المكان <span class="colon">:</span></div>
                        <div class="res-value">{{$research->place}}</div>
                    </div>
                    <div class="row res-group">
                        <div class="res-label">الباحث <span class="colon">:</span></div>
                        <div class="res-value">{{$research->researcher->name}}</div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">الباحث الثاني <span class="colon">:</span></div>
                        <div class="res-value">{{$research->employee_research_name}}</div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">الأمين العام <span class="colon">:</span></div>
                        <div class="res-value">{{$research->director_research_name}}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="res-title">معلومات المستفيد</h5>
                    <div class="row res-group">
                        <div class="res-label">الاسم <span class="colon">:</span></div>
                        <div class="res-value">{{$beneficiary->name}}</div>
                    </div>
                    <div class="row res-group">
                        <div class="res-label">الجنسية <span class="colon">:</span></div>
                        <div class="res-value">{{($beneficiary->nationality != '') ? $beneficiary->nationality->nationality : ''}}</div>
                    </div>
                    <div class="row res-group">
                        <div class="res-label">الحالة الاجتماعية <span class="colon">:</span></div>
                        <div class="res-value">{{$beneficiary->marital_status->status}}</div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">رقم الهوية <span class="colon">:</span></div>
                        <div class="res-value">{{$beneficiary->national_number}}</div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">أفراد الأسرة <span class="colon">:</span></div>
                        <div class="res-value">{{$beneficiary->family_member_count}}</div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">عدد البنين <span class="colon">:</span></div>
                        <div class="res-value">{{$beneficiary->son_count}}</div>
                    </div>

                    <div class="row res-group">
                        <div class="res-label">عدد البنات <span class="colon">:</span></div>
                        <div class="res-value">{{$beneficiary->daughter_count}}</div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-6">
            <div class="white-box">
                <div class="table-responsive">
                    <h5>معلومات الدخل</h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>مصادر الدخل</th>
                            <th>المبلغ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($incomes) == 0)
                            <tr>
                                <td colspan="3"><h5 class="text-center">لا توجد</h5></td>
                            </tr>
                        @else
                            @foreach($incomes as $income)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$income->income->income}}</td>
                                    <td><span class="text-success">{{number_format($income->amount)}}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr class="res-last-table-row">
                            <td colspan="2">إجمالي الدخل</td>
                            <td class="text-success">{{number_format($research->total_income)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="white-box">
                <div class="table-responsive">
                    <h5>معلومات المصروفات</h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المصروفات الشهرية</th>
                            <th>المبلغ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($expenses) == 0)
                            <tr>
                                <td colspan="3"><h5 class="text-center">لا توجد</h5></td>
                            </tr>
                        @else
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$expense->expense->expense}}</td>
                                <td><span class="text-danger">{{number_format($expense->amount)}}</span>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="res-last-table-row">
                            <td colspan="2">إجمالي المصروف</td>
                            <td class="text-danger">{{number_format($research->total_expense)}}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-wrapper">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h4 class="res-result-label">الفرق</h4>
                                <p class="res-result-value {{$research->difference <= 0 ? 'text-danger' : 'text-success'}}">{{number_format($research->difference)}}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <h4 class="res-result-label">النسبة المئوية</h4>
                                <p class="res-result-value {{$research->percentage <= 0 ? 'text-danger' : 'text-success'}}">{{$research->percentage}}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="white-box">
                <div class="table-responsive">
                    <h5>الاحتيادات المالية</h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>النوع</th>
                            <th>المبلغ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($money_needs) == 0)
                            <tr>
                                <td colspan="3"><h5 class="text-center">لا توجد</h5></td>
                            </tr>
                        @else
                        @foreach($money_needs as $need)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$need->money_need->description}}</td>
                                <td><span class="text-danger">{{number_format($need->amount)}}</span>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="res-last-table-row">
                            <td colspan="2">إجمالي الاحتياجات المالية</td>
                            <td class="text-danger">{{number_format($research->total_money_need)}}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="white-box">
                <div class="table-responsive">
                    <h5>الاحتيادات العينية</h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>النوع</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>التكلفة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($item_needs) == 0)
                            <tr>
                                <td colspan="5"><h5 class="text-center">لا توجد</h5></td>
                            </tr>
                        @else
                        @foreach($item_needs as $need)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$need->item_need->item}}</td>
                                <td>{{$need->price}}</td>
                                <td>{{$need->quantity}}</td>
                                <td><span class="text-danger">{{number_format($need->subtotal)}}</span>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="res-last-table-row">
                            <td colspan="4">إجمالي الاحتياجات العينية</td>
                            <td class="text-danger">{{number_format($research->total_item_need)}}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-wrapper">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="res-result-label">إجمالي المبلغ المطلوب</h4>
                                <p class="res-result-value text-primary">{{number_format($research->total_need)}}</p>
                                <p>ريال سعودي</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-wrapper">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="res-result-label">توصيات الباحث</h4>
                                <p style="white-space: pre-wrap">{{$research->researcher_recommendation}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection