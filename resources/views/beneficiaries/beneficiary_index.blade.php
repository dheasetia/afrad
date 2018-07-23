@extends('layouts.main')
@section('custom_style')
    <link href="{{asset('plugins/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/bower_components/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .btn-icon-only {
            width: 32px;
        }
        .column-action {
            width: 1٠0px!important;
        }
        table.dataTable thead .sorting::after {
            display: none;
        }
        .img-responsive {
            height: 60px;
            width: 60px;
            margin: 5px auto;
        }
        small {
            margin-right: 10px;
        }
        .ben_item {
            margin-right: 15px;
        }
        .ben_summary {
            display: block;
            height: 100%;
            width: 100%;
            background: darkslategrey;
            padding: 5px;
            text-align: center;
            color: white;
        }
        .ben_summary_title {
            font-family: DroidKufi, sans-serif;
            font-size: 1em;
            margin-top: 5px;
        }
        .ben_box {
            /*height: 180px;*/
        }
        .ben_summary_percentage {
            font-size: 3em;
            margin-top: 5px;
        }
        .ben_address {
            margin-bottom: 25px;
        }
        img.card-img-top {
            width: 60%;
            margin: 10px auto auto;
            border-radius: 50%;
        }
        .card-block {
            text-align: center;
        }
        .card-block .btn{
            margin-bottom: 10px;
        }
        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            .ben_summary_title {
                margin-top: 0;
            }
            .ben_box {
                height: 300px;
            }
            .ben_summary_percentage {
                font-size: 2em;
                margin-top: 5px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المستفيدون</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">قائمة المستفيدين</h3>
                <hr>
                @if (count($beneficiaries) > 0)
                <div class="row">
                    <div class="table-responsive">
                        <table id="example" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="width: 50px">الرقم</th>
                                <th>الاسم</th>
                                <th style="width: 15%">الجنسية</th>
                                <th style="width: 10%">الجنس</th>
                                <th style="width: 20%">الهوية الوطنية</th>
                                <th style="width: 20%">الجوال</th>
                                <th class="column-action">العملية</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($beneficiaries as $beneficiary)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$beneficiary->name}}</td>
                                    <td>{{($beneficiary->nationality != '') ? $beneficiary->nationality->nationality : ''}}</td>
                                    <td>{{$beneficiary->sex}}</td>
                                    <td>{{$beneficiary->national_number}}</td>
                                    <td>{{$beneficiary->mobile}}</td>
                                    <td>
                                        <a href="{{url('beneficiaries', $beneficiary->id)}}" class="btn btn-sm btn-info btn-icon-only" data-toggle="tooltip" data-title="تفاصيل"><i class="fa fa-info"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="row m-t-20">
                            <div class="col-md-12 text-center">
                                <p class="text-danger"> لا يوجد مستفيد مسجل. </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{url('beneficiaries/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> إضافة مستفيد جديد </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection