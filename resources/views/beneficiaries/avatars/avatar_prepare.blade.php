@extends('layouts.main')

@section('custom_style')
    <link rel="stylesheet" href="{{asset('plugins/bower_components/Jcrop/css/Jcrop.min.css')}}" type="text/css">
@endsection

@section('content')
    <div class="row" id="panel_beneficiary">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="{{url('beneficiaries', $beneficiary->id) . '/avatars'}}" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form_beneficiary_create">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="form-body">
                                <h3 class="box-title">إضافة صورة شخصية للمستفيد: {{$beneficiary->name}}</h3>
                                <hr>
                                <div class="row">
                                    <img id="image_upload_preview" src="http://placehold.it/100x100" alt="avatar" />
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group {{$errors->has('avatar') ? ' has-error' : ''}}">
                                        <label for="avatar">صورة شخصية</label>
                                        <input type="file" id="avatar" name="avatar"/>
                                        <span class="help-block">اختر ملف الصورة بحجم لا يتجاوز ٢ ميغا، ثم اختر موضع الصورة للقص بالمحاذاة الصحيحة</span>
                                        @if ($errors->has('avatar'))
                                            <span class="help-block">{{$errors->first('avatar')}}</span>
                                        @endif
                                    </div>
                                    <input type="hidden" id="x" name="x" value="50">
                                    <input type="hidden" id="y" name="y" value="50">
                                    <input type="hidden" id="x2" name="x2">
                                    <input type="hidden" id="y2" name="y2">
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i>  حفظ </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('plugin_scripts')
    <script src="{{asset('plugins/bower_components/Jcrop/js/Jcrop.min.js')}}"></script>
    <script>
        jQuery(function ($) {
            var target = $('img#image_upload_preview');
            var updateCoords = function (c) {
                $('#x').val(c.x);
                $('#x2').val(c.x2);
                $('#y').val(c.y);
                $('#y2').val(c.y2);
            };

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        target.attr('src', e.target.result);
                        target.Jcrop({
                            onChange: updateCoords,
                            aspectRatio: 1,
                            setSelect: [50, 50, 300, 300],
                            minSize: [300, 300],
                            maxSize: [300, 300]
                        });
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('input#avatar').change(function () {
                readURL(this);

            });


        });
    </script>
@endsection