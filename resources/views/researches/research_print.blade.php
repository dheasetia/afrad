<!DOCTYPE html>
<html lang="en" dir="rtl">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="برنامج الأفراد لإدارة المساعدات">
    <meta name="author" content="مؤسسة سالم بن أحمد بالحمر وعائلته الخيرية">
    <meta property="og:title" content="أفراد لإدارة المساعدات">
    <meta property="og:description" content="برنامج إدارة المساعدات">
    <meta property="og:url" content="https://afrad.com">
    <meta property="og:image" content="https://afrad.com/plugins/images/icon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plugins/images/favicon.png')}}">
    <title>أفراد | لإدارة المساعدات</title>
    <style>
        @page {
            size: A4;
        }

        @page :right {
            margin-left: 2cm;
        }
        html, body {
            margin: 0;
            padding: 0;
            font-size: 11pt;

        }
        .container {
            width: 190mm;
        }

        .logo-pic {
            float: right;
            display: inline-block;
            width: 30%;
        }
        .logo-pic img {
            width: 155px;
        }

        .header-title {
            display: inline-block;
            width: 70%;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .wrapper {
            display: block;
            clear: both;
            margin: 10px 50px;
            text-align: center;
        }
        .income-wrapper {
            width: 48.5%;
            display: inline-block;
            horiz-align: center;
            vertical-align: top;

        }
        .expense-wrapper {
            width: 48.5%;
            display: inline-block;
            text-align: center;
            horiz-align: center;
            vertical-align: top;
        }
        table {
            border-collapse: collapse;
            width: 95%;
            margin: 5px auto;
        }
        td,
        th {
            border: 1px solid darkgray;
            padding: 3px;
        }
        .header {
            width: 80%;
            margin: 20px auto;
        }

        table td {
            text-align: right;
        }
        tr.total, td.total{
            background-color: #dedede;
            font-size: 105%;
        }
        tr.table-caption {
            font-size: 110%;
            color: white;
            background-color: #838383;
        }
        .need-total {
            font-weight: bold;
            font-size: 150%;
            margin-left: 10px;
        }
        .footer {
            margin-top: 50px !important;
        }
        table.table-footer th,
        table.table-footer td{
            border: hidden !important;
            text-align: center;
            padding: 5px;
        }
        .btns {
            float: left;
            margin-left: 75px;
        }
        .btn {
            background-color: #e7e7e7; /* Green */
            border: none;
            color: black;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 110%;
            cursor: pointer;
            margin-left: 5px;
        }
        @media print {
            .btns {
                display: none;
            }
            .btn {
                display: none;
            }


        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <h3 class="text-center">بسم الله الرحمن الرحيم</h3>
    <div class="btns">
        <button type="button" class="btn" id="btn-print" title="طباعة هذه الصفحة" onclick="window.print()">طباعة</button>
        <a href="{{url('researches', $research->id)}}" class="btn" id="btn-undo" title="إلغاء">عودة</a>
    </div>
    <div class="header">
        <div class="logo-pic">
            <img src="{{asset('plugins/images/balahmar-logo.png')}}">
        </div>
        <div class="header-title">
            <h2>ملخص حالة طارئة</h2>
            <h3>نوع الحالة: {{$research->research_kind->kind}}</h3>
        </div>
    </div>
    <div class="wrapper">
        <table>
            <thead>
            <tr class="table-caption">
                <th colspan="7">بيانات المستفيد</th>
            </tr>
            <tr class="table-caption">
                <th>الاسم</th>
                <th>الجنسية</th>
                <th>الحالة الاجتماعية</th>
                <th>رقم الهوية</th>
                <th>أفراد الأسرة</th>
                <th>عدد البنين</th>
                <th>عدد البنات</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$beneficiary->name}}</td>
                <td>{{$beneficiary->nationality->nationality}}</td>
                <td>{{$beneficiary->marital_status->status}}</td>
                <td>{{$beneficiary->national_number}}</td>
                <td>{{$beneficiary->family_member_count}}</td>
                <td>{{$beneficiary->son_count}}</td>
                <td>{{$beneficiary->daughter_count}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="wrapper">
        <div class="income-wrapper">
            <table>
                <thead>
                <tr class="table-caption">
                    <th colspan="2">معلومات الدخل</th>
                </tr>
                <tr class="table-caption">
                    <th>مصادر الدخل</th>
                    <th>المبلغ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($incomes as $income)
                    <tr>
                        <td>{{$income->income->income}}</td>
                        <td>{{number_format($income->amount)}}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td>الإجمالي</td>
                    <td colspan="2">{{number_format($research->total_income)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="expense-wrapper">
            <table>
                <thead>
                <tr class="table-caption">
                    <th colspan="2">معلومات المصروفات</th>
                </tr>
                <tr class="table-caption">
                    <th>المصروفات الشهرية</th>
                    <th>المبلغ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{$expense->expense->expense}}</td>
                        <td>{{number_format($expense->amount)}}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td>الإجمالي</td>
                    <td>{{number_format($research->total_expense)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="wrapper">
        <div class="income-wrapper">
            <table>
                <tbody >
                <tr>
                    <th>الفرق</th>
                    <td class="total text-center">{{$research->difference}} ريال سعودي </td>
                    <th>النسبة المئوية</th>
                    <td class="total text-center"> {{$research->percentage}}%</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="wrapper">
        <table>
            <tr class="table-caption">
                <th colspan="2">الاحتياجات المالية</th>
            </tr>
            <tr class="table-caption">
                <th>النوع</th>
                @foreach($money_needs as $need)
                    <th>{{$need->money_need->description}}</th>
                @endforeach
            </tr>
            <tr>
                <th>المبلغ</th>
                @foreach($money_needs as $need)
                    <td>{{number_format($need->amount)}}</td>
                @endforeach
            </tr>
            <tr class="total">
                <th>المجموع</th>
                <td colspan="{{count($money_needs)}}" class="text-center">{{number_format($research->total_money_need)}} ريال سعودي</td>
            </tr>
        </table>
    </div>

    <div class="wrapper">
        <table>
            <tr class="table-caption">
                <th colspan="2">الاحتياجات العينية</th>
            </tr>
            <tr class="table-caption">
                <th>النوع</th>
                @foreach($item_needs as $item_need)
                    <th>{{$item_need->item_need->item}}</th>
                @endforeach
            </tr>
            <tr>
                <th>السعر</th>
                @foreach($item_needs as $item_need)
                    <td>{{number_format($item_need->price)}}</td>
                @endforeach
            </tr>
            <tr>
                <th>الكمية</th>
                @foreach($item_needs as $item_need)
                    <td>{{$item_need->quantity}}</td>
                @endforeach
            </tr>
            <tr>
                <th>التكلفة</th>
                @foreach($item_needs as $item_need)
                    <td>{{number_format($item_need->subtotal)}}</td>
                @endforeach
            </tr>

            <tr class="total">
                <th>المجموع</th>
                <td colspan="{{count($item_needs)}}" class="text-center">{{number_format($research->total_item_need)}} ريال سعودي</td>
            </tr>
        </table>
    </div>

    <div class="wrapper">
        <div class="income-wrapper">
            <table>
                <tbody >
                <tr>
                    <th>إجمالي المبلغ المطلوب</th>
                    <td class="total text-center"><span class="need-total">{{number_format($research->total_need)}}</span> ريال سعودي لا غير </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="wrapper footer">
        <table class="table-footer">
            <thead>
            <tr>
                <th>مدير المشاريع والمنح</th>
                <th>الباحث</th>
                <th>الأمين العام</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>{{$research->project_manager->name}}</td>
                <td>{{$research->researcher->name}}</td>
                <td>{{$research->general_manager->name}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>