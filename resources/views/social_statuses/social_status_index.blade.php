@extends('layouts.main')
@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">الحالات الاجتماعية</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة الحالات الاجتماعية</h3>
                <div class="box-actions">
                    <a href="/social-statuses/create" class="btn btn-info btn-circle" data-toggle="tooltip" title="إضافة حالة اجتماعية"><i class="fa fa-plus"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>حالة اجتماعية</th>
                            <th class="column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($social_statuses as $status)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$status->status}}</td>
                                <td class="column-action">
                                    <a href="#" data-toggle="tooltip" data-original-title="تعديل"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <button type="button" data-toggle="tooltip" data-original-title="حذف"> <i class="fa fa-close text-danger"></i> </button>
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