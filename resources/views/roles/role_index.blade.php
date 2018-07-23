@extends('layouts.main')
@section('custom_style')
    <style>
        .btn-sm {
            min-width: 35px;
            margin-right: 3px;
        }
    </style>
@endsection

@section('content')

    <!--ADD ROLE MODAL-->
    <div id="modal_add_role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مجموعة جديدة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_role" autocomplete="off">
                        <div class="form-group">
                            <label for="role_name_input" class="control-label">الرمز</label>
                            <input type="text" class="form-control" name="role_name_input" id="role_name_input" autocomplete="off" autofocus>
                            <span class="help-block">كلمة واحدة باللغة الإنجليزية</span>
                        </div>
                        <div class="form-group">
                            <label for="role_label_input" class="control-label">اسم المجموعة</label>
                            <input type="text" class="form-control" name="role_label_input" id="role_label_input">
                            <span class="help-block">اسم باللغة العربية</span>
                        </div>
                        <div class="form-group">
                            <label for="role_description_input" class="control-label">وصف المجموعة</label>
                            <textarea class="form-control" name="role_description_input" id="role_description_input"></textarea>
                            <span class="help-block">تفاصيل عن هذه المجموعة</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_role">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD ROLE MODAL-->



    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-users"></i> المجموعات</h4>
        </div>
    </div>

    <div class="row" id="panel_role">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة المجموعات</h3>
                <div class="box-actions">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="إضافة مجموعة" id="btn_add_role"><i class="fa fa-plus"></i> إضافة </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table_roles">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>الرمز</th>
                            <th>اسم المجموعة</th>
                            <th class="column-action">العملية</th>
                        </tr>
                        </thead>
                        <tbody>

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
    <script src="{{asset('js/pages/role_index.js')}}"></script>
@endsection