@extends('layouts.main')

@section('custom_style')
    <style>
        button.btn-delete {
            margin-top: 25px;
        }

        .income_input_group {
            display: none;
        }

        .expense_input_group {
            display: none;
        }

        .money_need_input_group {
            display: none;
        }

        .item_need_input_group {
            display: none;
        }

        .sub-total {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            border-radius: 10px;
            color: white;
        }

        .sub-total h1, h2 {
            color: white;
        }

        .sub-total p {
            font-family: DroidKufi, sans-serif;
        }

        .bg-merah {
            background-color: darkred;
        }

        .item_form_group {
            display: none;
            background-color: slategray;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 10px 20px;
            color: white;
        }

        .item_form_group .box-title{
            color: white;
        }

        .btn_delete_item_need {
            background: transparent;
            border: 0;
            font-size: 14pt;
            float: left;
            margin: 5px 0 0 0;
            display: inline-block;
        }

        .total-money-need {
            background-color: darkblue;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
        }

        .total-need-label {
            font-family: DroidKufi, sans-serif;
            font-size: 12pt;
            text-align: center;
        }
        .total-need {
            font-size: 26pt;
            padding: 5px;
            text-align: center;
        }
        .total-need-wrapper {
            width: 100%;
        }

        .total-all-wrapper {
            background-color: darkmagenta;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 10px;
        }
        .total-all-label {
            font-size: 14pt;
            font-family: DroidKufi, sans-serif;
        }

        .total-all {
            font-size: 32pt;
            padding: 5px;
        }

        .select2-container .select2-selection--single {
            height: 38px;
            border-radius: 0px !important;
            border: 1px solid #e4e7ea;
            padding-top: 5px;

        }

        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            .btn-add {
                margin-top: 0;
                margin-bottom: 20px;
                width: 100%;
            }

            button.btn-delete {
                width: 100% !important;
            }

            .total-need-wrapper {
                width: 100%;
            }

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
                    <h4 class="modal-title">إضافة نوع حالة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_kind" autocomplete="off">
                        <div class="form-group">
                            <label for="kind_add_input" class="control-label">اسم الحالة</label>
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

    <!--ADD INCOME MODAL-->
    <div id="modal_add_income" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مصدر دخل جديد</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_income" autocomplete="off">
                        <div class="form-group">
                            <label for="income_add_input" class="control-label">اسم مصدر الدخل</label>
                            <input type="text" class="form-control" name="income" id="income_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_income">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD INCOME MODAL-->

    <!--ADD EXPENSE MODAL-->
    <div id="modal_add_expense" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مصروف جديد</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_expense" autocomplete="off">
                        <div class="form-group">
                            <label for="expense_add_input" class="control-label">اسم المصروف</label>
                            <input type="text" class="form-control" name="expense" id="expense_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_expense">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD EXPENSE MODAL-->

    <!--ADD MONEY NEED MODAL-->
    <div id="modal_add_money_need" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة احتياج مالي</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_money_need" autocomplete="off">
                        <div class="form-group">
                            <label for="money_need_add_input" class="control-label">الاحتياج المالي</label>
                            <input type="text" class="form-control" name="money_need" id="money_need_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_money_need">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD MONEY NEED MODAL-->

    <!--ADD ITEM NEED MODAL-->
    <div id="modal_add_item_need" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة احتياج عيني</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_item_need" autocomplete="off">
                        <div class="form-group">
                            <label for="item_need_add_input" class="control-label">الاحتياج العيني</label>
                            <input type="text" class="form-control" name="item_need" id="item_need_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_item_need">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD ITEM NEED MODAL-->



    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-search"></i> دراسة حالة </h4>
        </div>
    </div>


<form action="" method="post" accept-charset="utf-8" id="form_research_create">
    <div class="row" id="research_panel">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <h4 class="box-title">عمل دراسة حالة للمستفيد:  {{$beneficiary->name}}</h4>
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label for="research_kind_id" class="control-label">نوع الحالة <span class="required">*</span> </label>
                                        <select id="research_kind_id" name="research_kind_id" class="form-control">
                                            <option value="">--- اختر ---</option>
                                            @foreach($research_kinds as $kind)
                                                <option value="{{$kind->id}}">{{$kind->kind}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-info btn-block text-white btn-add" id="btn_add_kind" data-toggle="tooltip" title="إضافة نوع حالة"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label for="hijri_research_date" class="control-label">التاريخ الهجري <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="hijri_research_date" name="hijri_research_date" data-mask="99/ 99/ 9999">
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label for="research_date" class="control-label"> التاريخ الميلادي (تلقائي)</label>
                                        <input type="text" class="form-control" id="research_date" name="research_date" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label for="place" class="control-label">المكان <span class="required">*</span> </label>
                                        <input type="text" class="form-control" id="place" name="place">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="researcher_name" class="control-label">الباحث <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="researcher_name" name="researcher_name" value="{{$researcher->name}}" readonly>
                                        <input type="hidden" name="researcher_id" id="researcher_id" value="{{$researcher->id}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_research_name" class="control-label"> باحث ثاني </label>
                                        <input type="text" class="form-control" id="employee_research_name" name="employee_research_name" value="{{$setting->employee_research_name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="director_research_name" class="control-label">رئيس مجلس الإدارة </label>
                                        <input type="text" class="form-control" id="director_research_name" name="director_research_name" value="{{$setting->director_research_name}}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="ben_panel">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">معلومات المستفيد</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group {{$errors->has('beneficiary_id') ? ' has-error' : ''}}">
                                        <label class="control-label">اسم المستفيد <span class="required">*</span> </label>
                                        <p class="form-control">{{$beneficiary->name}}</p>
                                        <input type="hidden" name="beneficiary_id" value="{{$beneficiary->id}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label" for="national_number">رقم الهوية الوطنية </label>
                                        <span class="form-control" id="national_number">{{$beneficiary->national_number}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">الجنسية</label>
                                        <span class="form-control" id="nationality">{{($beneficiary->nationality) != '' ? $beneficiary->nationality->nationality : ''}}</span>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">الحالة الاجتماعية</label>
                                        <span class="form-control" id="marital_status">{{$beneficiary->marital_status->status}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">عدد أفراد الأسرة</label>
                                        <span class="form-control" id="family_member_count">{{$beneficiary->family_number_count}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">عدد البنين</label>
                                        <span class="form-control" id="son_count">{{$beneficiary->son_count}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">عدد البنات</label>
                                        <span class="form-control" id="daughter_count">{{$beneficiary->daughter_count}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-wraper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">مصادر الدخل</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="select_income" class="control-label">إضافة مصدر دخل <span class="required">*</span></label>
                                        <select name="select_income" id="select_income" class="form-control">
                                            <option value="">--- اختر ---</option>
                                            @foreach($incomes as $income)
                                                <option value="{{$income->id}}">{{$income->income}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6  after-input">
                                    <button type="button" class="btn btn-info btn-block text-white" id="btn_add_income" data-toggle="tooltip" title="إضافة مصدر دخل"> إضافة مصدر دخل آخر </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="income_list"></div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="sub-total bg-primary">
                                        <p>إجمالي الدخل</p>
                                        <h2 id="total_income">0</h2>
                                        <p style="font-family: DroidNaskh, sans-serif">ريال سعودي</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-wraper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">المصروفات الشهرية</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="select_expense" class="control-label">إضافة مصروف شهري <span class="required">*</span></label>
                                        <select name="select_expense" id="select_expense" class="form-control">
                                            <option value="">--- اختر ---</option>
                                            @foreach($expenses as $expense)
                                                <option value="{{$expense->id}}">{{$expense->expense}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 after-input">
                                    <button type="button" class="btn btn-info btn-block text-white" id="btn_add_expense" data-toggle="tooltip" title="إضافة مصروف"> إضافة مصروف آخر</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="expense_list"></div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="sub-total bg-primary">
                                        <p>إجمالي المصروف</p>
                                        <h2 id="total_expense">0</h2>
                                        <p style="font-family: DroidNaskh, sans-serif">ريال سعودي</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title text-center">النتيجة</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 m-b-10">
                                    <div class="sub-total bg-info">
                                        <p>الفرق</p>
                                        <h1 id="total_diff">0</h1>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sub-total bg-info">
                                        <p>النسبة المئوية</p>
                                        <h1 id="total_percentage">0%</h1>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">الاحتياجات المالية</h3>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select_money_need" class="control-label">تحديد الاحتياجات المالية <span class="required">*</span></label>
                                        <select id="select_money_need" class="form-control">
                                            <option value="">--- اختر ---</option>
                                            @foreach($money_needs as $need)
                                                <option value="{{$need->id}}">{{$need->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-block after-input waves-effect waves-light" id="btn_add_money_need" data-toggle="tooltip" title="إضافة احتياج آخر"><i class="fa fa-plus"></i> إضافة احتياج آخر </button>
                                </div>
                            </div>
                            <hr>

                            <div class="row" id="money_need_list">

                            </div>
                            <hr>
                            <div class="total-need-wrapper">
                                <div class="total-money-need">
                                    <div class="total-need-label">إجمالي الاحتياجات المالية</div>
                                    <div class="total-need" id="total_money_need">0</div>
                                    <div class="text-center">ريال سعودي</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">الاحتياجات العينية</h3>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select_item_need" class="control-label">تحديد الاحتياجات العينية <span class="required">*</span></label>
                                        <select id="select_item_need" class="form-control">
                                            <option value="">--- اختر ---</option>
                                            @foreach($item_needs as $need)
                                                <option value="{{$need->id}}">{{$need->item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-block after-input waves-effect waves-light" id="btn_add_item_need" data-toggle="tooltip" title="إضافة احتياج آخر"><i class="fa fa-plus"></i> إضافة احتياج آخر </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="item_need_list">

                            </div>
                            <hr>
                            <div class="total-need-wrapper">
                                <div class="total-money-need">
                                    <div class="total-need-label">إجمالي الاحتياجات العينية</div>
                                    <div class="total-need" id="total_item_need">0</div>
                                    <div class="text-center">ريال سعودي</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="well">
        <div class="total-all-wrapper">
            <div class="total-all-label">إجمالي المبلغ المطلوب</div>
            <div class="total-all" id="total_all_need">0</div>
            <div class="text-center">ريال سعودي</div>
        </div>
    </div>

    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="researcher_recommendation">توصيات الباحث</label>
                    <textarea class="form-control" rows="4" name="researcher_recommendation" id="researcher_recommendation"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" id="btn_save_research" style="float: left"><i class="fa fa-save"></i>  حفظ </button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('plugin_scripts')
    <script src="{{asset('js/mask.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.plus.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-calendar/dist/js/jquery.calendars.ummalqura.min.js')}}"></script>

    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/pages/beneficiary_research_create.js')}}"></script>
@endsection