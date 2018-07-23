@extends('layouts.main')
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-folder-open-o"></i> المستندات</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة المستندات</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>اسم الوظيفة</th>
                            <th class="column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="3">هنا قائمة المستندات</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection