@extends('layouts.main')

@section('custom_style')
    <style>
        .thumb-lg {
            width: 100px;
            height: 100px;
            margin: 10px 0;
        }
        .thumb-wrapper {
            text-align: center;
        }
        .thumb-actions {
            text-align: center;
        }
        .btn-default {
            color: black !important;
        }
    </style>
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المستخدمون <span class="small">حذف مستخدم</span></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form action="{{url('users')}}" method="post" id="form_user_delete" accept-charset="utf-8">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="form-body">
                                <h3 class="box-title">حذف حساب مستخدم</h3>
                                <hr>
                                <div class="row">
                                    <div class="alert alert-danger">هل أنت متأكد من حذف هذا المستخدم:  <strong>{{$user->name}}</strong>؟ سوف يحذف معه جميع البيانات المتعلقة به.</div>

                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="حذف المستخدم"> <i class="fa fa-trash"></i>  موافق </button>
                                <a href="{{url($prev_page)}}" class="btn btn-default" data-toggle="tooltip" title="إلغاء"><i class="fa fa-undo"></i> إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/pages/user_show.js')}}"></script>
@endsection