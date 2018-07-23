@extends('layouts.main')
@section('content')


    <!--ADD DEPARTMENT MODAL-->
    <div id="modal_add_status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة حالة اجتماعية جديدة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_status" autocomplete="off">
                        <div class="form-group">
                            <label for="status_add_input" class="control-label">الحالة الاجتماعية</label>
                            <input type="text" class="form-control" name="status" id="status_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_status">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END EDIT DEPARTMENT MODAL-->

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-street-view"></i> الحالات الاجتماعية</h4>
        </div>
    </div>

    <div class="row" id="panel_status">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">قائمة الحالات الاجتماعية</h3>
                <div class="box-actions">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="إضافة حالة اجتماعية" id="btn_add_status"><i class="fa fa-plus"></i> إضافة </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table_statuses">
                        <thead>
                        <tr>
                            <th class="column-number">الرقم</th>
                            <th>الحالة الاجتماعية</th>
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
    <script src="{{asset('js/pages/marital_status_index.js')}}"></script>
@endsection