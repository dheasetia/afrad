@extends('layouts.main')

@section('custom_style')
<style>
    strong {
        font-family: DroidKufi, sans-serif;
        margin-bottom: 10px;
    }
    h2.ben_number {
        display: inline-block;
    }
    .ben_mute {
        margin: 10px 5px;
        border-right: 2px solid white;
        padding: 0 7px !important;
    }
    .riyal {
        display: block;
    }
    .fa-edit {
        font-size: 85% !important;

    }
    .fa-info {
        width: 17px;
    }
    .fa-trash {
        font-size: 110%;
    }
    .res-column-action {
        min-width: 120px;
    }
    #map{
        margin-bottom: 30px;
    }
    #add_document {
        margin: 25px 1px 8px 10px;
    }
</style>
@endsection

@section('content')
    <!--ADD MARITAL STATUS MODAL-->
    <div id="modal_add_marital_status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalMaritalStatusLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة حالة اجتماعية جديدة</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">الحالة الاجتماعية</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD MARITAL STATUS MODAL-->

    <!--BEGIN ADD FAMILY ROLE MODAL-->
    <div id="modal_add_family_role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalFamilyRoleLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة علاقة أسرية جديدة</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">العلاقة الأسرية</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD FAMILY ROLE MODAL-->

    <!--BEGIN ADD GRADUATION MODAL-->
    <div id="modal_add_graduation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalGraduationLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مؤهل دراسي جديد</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">المؤهل الدراسي</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD GRADUATION MODAL-->

    <!--BEGIN ADD EDUCATION SPECIALTY MODAL-->
    <div id="modal_add_education_specialty" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalEducationSpecialtyLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة تخصص دراسي جديد</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">التخصص الدراسي</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD EDUCATION SPECIALTY MODAL-->

    <!--BEGIN ADD JOB MODAL-->
    <div id="modal_add_profession" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalProfessionLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مهنة جديدة</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">المهنة</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD JOB MODAL-->

    <!--BEGIN ADD PROFESSION MODAL-->
    <div id="modal_add_profession" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalProfessionLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مهنة جديدة</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">المهنة</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD PROFESSION MODAL-->

    <!--BEGIN ADD EXPERTISE MODAL-->
    <div id="modal_add_expertise" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalExpertiseLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة حرفة جديدة</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">الحرفة</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD EXPERTISE MODAL-->


    <!--BEGIN ADD BANK MODAL-->
    <div id="modal_add_bank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalBankLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة بنك جديد</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">اسم البنك</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD BANK MODAL-->

    <!--BEGIN ADD GUARDIAN MODAL-->
    <div id="modal_add_guardian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalGuardianLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة شخص مسؤول عن مستفيد</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label for="guardian_name" class="control-label">الاسم <span class="required">*</span></label>
                            <input type="text" id="guardian_name" name="guardian_name" class="form-control" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="guardian_mobile" class="control-label">الجوال <span class="required">*</span></label>
                            <input type="text" name="guardian_mobile" id="guardian_mobile" class="form-control" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="guardian_email" class="control-label">البريد الإلكتروني</label>
                            <input type="text" name="guardian_email" id="guardian_email" class="form-control" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="guardian_description" class="control-label">صفته</label>
                            <input type="text" name="guardian_description" id="guardian_description" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD EXPERTISE MODAL-->

    <!--BEGIN ADD NATIONALITY MODAL-->
    <div id="modal_add_nationality" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalNationalityLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة جنسية جديدة</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label class="control-label">اسم الجنسية</label>
                            <input type="text" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn_save">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD NATIONALITY MODAL-->

    <!--ADD CITY MODAL-->
    <div id="modal_add_city" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة مدينة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_city" autocomplete="off">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city_add_input" class="control-label">اسم المدينة</label>
                                    <input type="text" class="form-control" name="city" id="city_add_input" autocomplete="off" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="area_id" class="control-label">المنطقة</label>
                                    <select class="form-control" id="area_id" name="area_id">
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info after-input waves-effect waves-light" id="btn_add_area_modal" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_city">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD CITY MODAL-->

    <!--ADD AREA MODAL-->
    <div id="modal_add_area" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة منطقة</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_area" autocomplete="off">
                        <div class="form-group">
                            <label for="area_add_input" class="control-label">اسم المنطقة</label>
                            <input type="text" class="form-control" name="area" id="area_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_area">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD AREA MODAL-->

    <!--ADD RESIDENT KIND MODAL-->
    <div id="modal_add_resident_kind" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة نوع السكن</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_resident_kind" autocomplete="off">
                        <div class="form-group">
                            <label for="resident_kind_add_input" class="control-label">نوع السكن</label>
                            <input type="text" class="form-control" name="resident_kind" id="resident_kind_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_resident_kind">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD RESIDENT KIND MODAL-->

    <!--ADD BANK MODAL-->
    <div id="modal_add_resident_bank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">إضافة بنك جديد</h4>
                </div>
                <div class="modal-body">
                    <form id="form_add_resident_bank" autocomplete="off">
                        <div class="form-group">
                            <label for="resident_bank_add_input" class="control-label">اسم البنك</label>
                            <input type="text" class="form-control" name="resident_bank" id="resident_bank_add_input" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="btn_save_add_resident_bank">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <!--END ADD BANK MODAL-->


    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">المستفيدون</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="{{asset('plugins/images/avatar_background.jpg')}}">
                    <div class="overlay-box">
                        <div class="user-content">
                            @if ($beneficiary->sex == 'ذكر')
                                <img src="{{$beneficiary->avatar == '' ? asset('files/beneficiaries/avatars/blank_male.jpg') : asset('files/beneficiaries/avatars/thumbnails/thumb_') . $beneficiary->avatar}}" class="thumb-lg img-circle" alt="img">
                            @else
                                <img src="{{$beneficiary->avatar == '' ? asset('files/beneficiaries/avatars/blank_female.jpg') : asset('files/beneficiaries/avatars/thumbnails/thumb_') . $beneficiary->avatar}}" class="thumb-lg img-circle" alt="img">
                            @endif
                            <h4 class="text-white bold m-b-20">{{$beneficiary->name}}</h4>
                            <span class="text-white ben_mute">{{$beneficiary->marital_status != '' ? $beneficiary->marital_status->status : ''}}</span>
                            <span class="text-white ben_mute">{{$beneficiary->nationality != '' ? $beneficiary->nationality->nationality : ''}}</span>
                            <span class="text-white ben_mute">{{$beneficiary->mobile}}</span>
                        </div>
                    </div>
                </div>
                <div class="user-btm-box">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <p class="text-purple">احتياجات شهرية</p>
                        </div>
                        <div class="col-xs-4 text-center">
                            <p class="text-blue">نسبة الفقر</p>
                        </div>
                        <div class="col-xs-4 text-center">
                            <p class="text-danger">المساعدة المستلمة</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <h2 class="ben_number">{{number_format($monthly_need)}}</h2> </h3> <small class="riyal"> ريال</small>
                        </div>
                        <div class="col-xs-4 text-center">
                            <h2 class="ben_number">{{$percentage}}%</h2>
                        </div>
                        <div class="col-xs-4 text-center">
                            <h2 class="ben_number">{{number_format(0)}}</h2> <small class="riyal"> ريال</small>
                        </div>
                    </div>

                </div>
            </div>
            <div class="white-box">
                <div class="row m-b-10">
                    <a href="{{url('beneficiaries',  $beneficiary->id)  . '/avatars/prepare'}}" class="btn btn-primary btn-block"><i class="fa fa-image"></i>   رفع صورة شخصية </a>
                </div>
                <div class="row">
                    <a href="{{url('beneficiaries', $beneficiary->id) . '/addresses/prepare'}}" class="btn btn-info btn-block"><i class="fa fa-home"></i> إضافة عنوان المنزل </a>
                </div>

            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item"><a href="#profile" class="nav-link {{(Request::get('tab_active') == null) || (Request::get('tab_active') === 'profile') ? 'active' : ''}}" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">معلومات شخصية</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#address" id="btn_tab_address" class="nav-link {{Request::get('tab_active') === 'address' ? 'active' : ''}}" aria-controls="address" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-map"></i></span> <span class="hidden-xs">عنوان المنزل</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#resident" id="btn_tab_resident" class="nav-link {{Request::get('tab_active') === 'resident' ? 'active' : ''}}" aria-controls="resident" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">معلومات السكن</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#documents" id="btn_tab_documents" class="nav-link {{Request::get('tab_active') === 'documents' ? 'active' : ''}}" aria-controls="document" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-file"></i></span> <span class="hidden-xs">المستندات</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#researches" class="nav-link {{Request::get('tab_active') === 'researches' ? 'active' : ''}}" aria-controls="researches" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">دراسات حالة</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#last_gifts" class="nav-link {{Request::get('tab_active') === 'last_gifts' ? 'active' : ''}}" aria-controls="last_gifts" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">المساعدات المستلمة</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#next_gifts" class="nav-link {{Request::get('tab_active') === 'next_gifts' ? 'active' : ''}}" aria-controls="next_gifts" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-clock"></i></span> <span class="hidden-xs">المساعدات القادمة</span></a></li>
                </ul>
                <div class="tab-content">
                    {{-- ===== PROFILE ===== --}}
                    <div class="tab-pane {{(Request::get('tab_active') == null) || (Request::get('tab_active') === 'profile') ? 'active' : ''}}" id="profile">
                        <form id="form_profile">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <input type="hidden" name="beneficiary_id" value="{{$beneficiary->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                                        <label class="control-label" for="name">الاسم الكامل <span class="required">*</span> </label>
                                        <input type="text" id="name" name="name" value="{{old('name', $beneficiary->name)}}" class="form-control">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('national_number') ? ' has-error' : ''}}">
                                        <label class="control-label" for="national_number">رقم الهوية الوطنية <span class="required">*</span></label>
                                        <input type="text" id="national_number" name="national_number" class="form-control" value="{{old('national_number', $beneficiary->national_number)}}">
                                        @if ($errors->has('national_number'))
                                            <span class="help-block">{{$errors->first('national_number')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('mobile') ? ' has-error' : ''}}">
                                        <label class="control-label" for="mobile">رقم الجوال <span class="required">*</span></label>
                                        <input type="text" id="mobile" name="mobile" class="form-control" value="{{old('mobile', $beneficiary->mobile)}}">
                                        @if ($errors->has('mobile'))
                                            <span class="help-block">{{$errors->first('mobile')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('phone') ? ' has-error' : ''}}">
                                        <label class="control-label" for="phone">هاتف المنزل </label>
                                        <input type="text" id="phone" name="phone" class="form-control" value="{{old('phone', $beneficiary->phone)}}">
                                        @if ($errors->has('phone'))
                                            <span class="help-block">{{$errors->first('phone')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                        <label class="control-label" for="email">البريد الإلكتروني </label> <span class="mute">(إن وجد)</span>
                                        <input type="text" id="email" name="email" class="form-control" value="{{old('email', $beneficiary->email)}}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('sex') ? ' has-error' : ''}}">
                                        <label class="control-label">الجنس <span class="required">*</span></label>
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="sex" id="sex1" value="ذكر" {{old('sex', $beneficiary->sex) == 'ذكر' ? 'checked' : ''}}>
                                                    <label for="sex1">ذكر</label>
                                                </div>
                                            </label>
                                            <label class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input type="radio" name="sex" id="sex2" value="أنثى" {{old('sex', $beneficiary->sex) == 'أنثى' ? 'checked' : ''}}>
                                                    <label for="sex2">أنثى </label>
                                                </div>
                                            </label>
                                        </div>
                                        @if ($errors->has('sex'))
                                            <span class="help-block">{{$errors->first('sex')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('dob') ? ' has-error' : ''}}">
                                        <label class="control-label" for="dob" >تاريخ الميلاد بالهجري</label>
                                        <input type="text" id="dob" name="dob" value="{{old('dob', $beneficiary->dob_hijri_formatted)}}" data-mask="99/ 99/ 9999" class="form-control">
                                        <span class="font-13 text-muted">يوم/ شهر/ سنة (مثال: 07/ 04/ 1439)</span>
                                        @if ($errors->has('dob'))
                                            <span class="help-block">{{$errors->first('dob')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('marital_status_id') ? ' has-error' : ''}}">
                                        <label for="marital_status_id" class="control-label">الحالة الاجتماعية<span class="required">*</span></label>
                                        <select id="marital_status_id" class="form-control" name="marital_status_id">
                                            <option value="">-- اختر --</option>
                                            @foreach($marital_statuses as $status)
                                                <option {{old('marital_status_id', $beneficiary->marital_status_id) == $status->id ? 'selected' : ''}} value="{{$status->id}}" >{{$status->status}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('marital_status_id'))
                                            <span class="help-block">{{$errors->first('marital_status_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_marital_status" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="family_role_id" class="control-label">العلاقة الأسرية</label>
                                        <select id="family_role_id" class="form-control" name="family_role_id">
                                            <option value="">بدون</option>
                                            @foreach($family_roles as $role)
                                                <option {{old('family_role_id', $beneficiary->family_role_id) == $role->id ? 'selected' : ''}} value="{{$role->id}}" >{{$role->role}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_family_role" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nationality_id" class="control-label">الجنسية</label>
                                        <select id="nationality_id" class="form-control" name="nationality_id">
                                            <option value="">بدون</option>
                                            @foreach($nationalities as $nationality)
                                                <option {{old('nationality_id', $beneficiary->nationality_id) == $nationality->id ? 'selected' : ''}} value="{{$nationality->id}}" >{{$nationality->nationality}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_nationality" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('family_member_count') ? ' has-error' : ''}}">
                                        <label class="control-label" for="family_member_count" >عدد أعضاء الأسرة</label>
                                        <input type="number" id="family_member_count" name="family_member_count" min="1" max="20" value="{{old('family_member_count', $beneficiary->family_member_count)}}" class="form-control">
                                        @if ($errors->has('family_member_count'))
                                            <span class="help-block">{{$errors->first('family_member_count')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('son_count') ? ' has-error' : ''}}">
                                        <label class="control-label" for="son_count" >عدد البنين</label>
                                        <input type="number" id="son_count" name="son_count" min="1" max="20" value="{{old('son_count', $beneficiary->son_count)}}" class="form-control">
                                        @if ($errors->has('son_count'))
                                            <span class="help-block">{{$errors->first('son_count')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('daughter_count') ? ' has-error' : ''}}">
                                        <label class="control-label" for="daughter_count" >عدد البنات</label>
                                        <input type="number" id="daughter_count" name="daughter_count" min="1" max="20" value="{{old('daughter_count', $beneficiary->son_count)}}" class="form-control">
                                        @if ($errors->has('daughter_count'))
                                            <span class="help-block">{{$errors->first('daughter_count')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="graduation_id" class="control-label">المؤهل الدراسي</label>
                                        <select id="graduation_id" class="form-control" name="graduation_id">
                                            <option value="">بدون</option>
                                            @foreach($graduations as $graduation)
                                                <option {{old('graduation_id', $beneficiary->graduation_id) == $graduation->id ? 'selected' : ''}} value="{{$graduation->id}}" >{{$graduation->graduation}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_graduation" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education_specialty_id" class="control-label">التخصص الدراسي</label>
                                        <select id="education_specialty_id" class="form-control" name="education_specialty_id">
                                            <option value="">بدون</option>
                                            @foreach($education_specialties as $specialty)
                                                <option {{old('education_specialty_id', $beneficiary->education_specialty_id) == $specialty->id ? 'selected' : ''}} value="{{$specialty->id}}" >{{$specialty->specialty}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light"  id="btn_add_education_specialty" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="expertise_id" class="control-label">الحرفة التي يتقنها</label>
                                        <select id="expertise_id" class="form-control" name="expertise_id">
                                            <option value="">بدون</option>
                                            @foreach($expertises as $expertise)
                                                <option {{old('expertise_id', $beneficiary->expertise_id) == $expertise->id ? 'selected' : ''}} value="{{$expertise->id}}" >{{$expertise->expertise}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_expertise" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="profession_id" class="control-label">المهنة</label>
                                        <select id="profession_id" class="form-control" name="profession_id">
                                            <option value="">بدون</option>
                                            @foreach($professions as $profession)
                                                <option {{old('profession_id', $beneficiary->profession_id) == $profession->id ? 'selected' : ''}} value="{{$profession->id}}" >{{$profession->profession}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_profession"  data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name" class="control-label">جهة العمل الحالي</label>
                                        <input type="text" name="company_name" id="company_name" class="form-control" value="{{$beneficiary->company_name}}">
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">{{$errors->first('company_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="guardian_id" class="control-label">الشخص المسؤول عنه</label>
                                        <select id="guardian_id" class="form-control" name="guardian_id">
                                            <option value="">بدون</option>
                                            @foreach($guardians as $guardian)
                                                <option {{old('guardian_id', $beneficiary->guardian_id) == $guardian->id ? 'selected' : ''}} value="{{$guardian->id}}" >{{$guardian->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_guardian" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="work_experience" class="control-label">خبرات العمل</label>
                                        <textarea name="work_experience" rows="3" id="work_experience" class="form-control" style="white-space: pre-wrap">{{old('work_experience', $beneficiary->work_experience)}}</textarea>
                                        @if ($errors->has('work_experience'))
                                            <span class="help-block">{{$errors->first('work_experience')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_id" class="control-label">اسم البنك</label>
                                        <select id="bank_id" class="form-control" name="bank_id">
                                            <option value="">بدون</option>
                                            @foreach($banks as $bank)
                                                <option {{old('bank_id', $beneficiary->bank_id) == $bank->id ? 'selected' : ''}} value="{{$bank->id}}" >{{$bank->bank}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_bank" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('iban') ? ' has-error' : ''}}">
                                        <label class="control-label" for="iban" >رقم الأيبان</label>
                                        <input type="text" id="iban" name="iban" value="{{old('iban', $beneficiary->iban)}}" class="form-control">
                                        @if ($errors->has('iban'))
                                            <span class="help-block">{{$errors->first('iban')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">ملاحظات</label>
                                        <textarea name="notes" rows="3" id="notes" class="form-control">{{old('notes', $beneficiary->notes)}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-success" id="btn_save_profile"><i class="fa fa-save"></i> حفظ التغييرات</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- ===== ADDRESS ===== --}}
                    <div class="tab-pane {{Request::get('tab_active') === 'address' ? 'active' : ''}}" id="address">
                        @if (count($address) === 0)
                            <div class="alert alert-danger"> لم يسجل عنوان المنزل لهذا المستفيد. </div>
                            <a href="{{url('beneficiaries', $beneficiary->id) . '/address/create'}}" class="btn btn-primary"><i class="fa fa-plus"></i> إضافة عنوان </a>
                        @else
                        <form id="form_address">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <input type="hidden" name="address_id" value="{{$address->id}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city_id" class="control-label">المدينة</label>
                                        <select id="city_id" class="form-control" name="city_id">
                                            <option value="">بدون</option>
                                            @foreach($cities as $city)
                                                <option {{old('city_id', $address->city_id) == $city->id ? 'selected' : ''}} value="{{$city->id}}" >{{$city->city}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('city_id'))
                                            <span class="help-block">{{$errors->first('city_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_city" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('building_name') ? ' has-error' : ''}}">
                                        <label class="control-label" for="building_name" >اسم المبنى</label>
                                        <input type="text" id="building_name" name="building_name" value="{{old('building_name', $address->building_name)}}" class="form-control">
                                        @if ($errors->has('building_name'))
                                            <span class="help-block">{{$errors->first('building_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('building_no') ? ' has-error' : ''}}">
                                        <label class="control-label" for="building_no" >رقم المبنى</label>
                                        <input type="text" id="building_no" name="building_no" value="{{old('building_no', $address->building_no)}}" class="form-control">
                                        @if ($errors->has('building_no'))
                                            <span class="help-block">{{$errors->first('building_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('street') ? ' has-error' : ''}}">
                                        <label class="control-label" for="street" >الشارع</label>
                                        <input type="text" id="street" name="street" value="{{old('street', $address->street)}}" class="form-control">
                                        @if ($errors->has('street'))
                                            <span class="help-block">{{$errors->first('street')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('district') ? ' has-error' : ''}}">
                                        <label class="control-label" for="district" >الحي</label>
                                        <input type="text" id="district" name="district" value="{{old('district', $address->district)}}" class="form-control">
                                        @if ($errors->has('district'))
                                            <span class="help-block">{{$errors->first('district')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('po_box') ? ' has-error' : ''}}">
                                        <label class="control-label" for="po_box" >صندوق البريد</label>
                                        <input type="text" id="po_box" name="po_box" value="{{old('po_box', $address->po_box)}}" class="form-control">
                                        @if ($errors->has('po_box'))
                                            <span class="help-block">{{$errors->first('po_box')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('zip_code') ? ' has-error' : ''}}">
                                        <label class="control-label" for="zip_code" >الرمز البريدي</label>
                                        <input type="text" id="zip_code" name="zip_code" value="{{old('zip_code', $address->zip_code)}}" class="form-control">
                                        @if ($errors->has('zip_code'))
                                            <span class="help-block">{{$errors->first('zip_code')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('additional_no') ? ' has-error' : ''}}">
                                        <label class="control-label" for="additional_no" >الرقم الإضافي</label>
                                        <input type="text" id="additional_no" name="additional_no" value="{{old('additional_no', $address->additional_no)}}" class="form-control">
                                        @if ($errors->has('additional_no'))
                                            <span class="help-block">{{$errors->first('additional_no')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{$errors->has('coordinate') ? ' has-error' : ''}}">
                                        <label class="control-label" for="coordinate" >صندوق البريد</label>
                                        <input type="text" id="coordinate" name="coordinate" value="{{old('coordinate', $address->coordinate)}}" class="form-control" style="direction: ltr; text-align: right">
                                        @if ($errors->has('coordinate'))
                                            <span class="help-block">{{$errors->first('coordinate')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </form>


                        <div id="map" style="height: 400px; width: auto;"></div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-success" id="btn_save_address"><i class="fa fa-save"></i> حفظ التغييرات</button>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- ===== DOCUMENT ===== --}}
                    <div class="tab-pane {{Request::get('tab_active') === 'documents' ? 'active' : ''}}" id="documents">
                        @if (count($documents) === 0)
                            <div class="alert alert-danger"> لم يتم تسجيل أي مستند. </div>
                            <a href="{{url('beneficiaries', $beneficiary->id) . '/documents/create'}}" class="btn btn-primary"><i class="fa fa-plus"></i> إضاقة مستند </a>
                        @else
                            <div class="row" id="document_area">
                                @foreach($documents as $document)
                                    <div class="col-md-4" id="document_item_{{$document->id}}">
                                        <div class="card text-center" style="padding: 10px">
                                            <span class="file_icon"><i class="fa fa-file fa-5x"></i></span>
                                            <div class="card-block">
                                                <h4 class="card-title">{{$document->label}}</h4>
                                                <p class="card-text">{{$document->expiry_date->format('Y-m-d')}}</p>
                                                <a href="{{url('files/beneficiaries/documents') . '/' . $document->path}}" class="btn btn-primary" data-toggle="tooltip" title="مشاهدة" target="_blank"><i class="fa fa-eye"></i></a>
                                                <button type="button" class="btn btn-danger btn_delete_document" data-toggle="tooltip" title="حذف المستند" data-doc_id="{{$document->id}}"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row" id="add_document">
                                <a href="{{url('beneficiaries', $beneficiary->id) . '/documents/create'}}" class="btn btn-primary"><i class="fa fa-plus"></i> إضاقة مستند </a>
                            </div>
                        @endif
                    </div>

                    {{-- ===== RESIDENT ===== --}}
                    <div class="tab-pane {{Request::get('tab_active') === 'resident' ? 'active' : ''}}" id="resident">
                        @if (count($resident) === 0)
                            <div class="alert alert-danger"> لم تسجل معلومات السكن. </div>
                            <a href="{{url('beneficiaries', $beneficiary->id) . '/residents/create'}}" class="btn btn-primary"><i class="fa fa-plus"></i> تسجيل معلومات السكن </a>
                        @else
                            <form id="form_resident">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <input type="hidden" name="resident_id" value="{{$resident->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="resident_kind_id" class="control-label">نوع السكن</label>
                                            <select id="resident_kind_id" class="form-control" name="resident_kind_id">
                                                <option value="">--- اختر ---</option>
                                                @if (count($resident_kinds) > 0)
                                                    @foreach($resident_kinds as $kind)
                                                        <option {{old('resident_kind_id', $resident->resident_kind->id) == $kind->id ? 'selected' : ''}} value="{{$kind->id}}" >{{$kind->kind}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('resident_kind_id'))
                                                <span class="help-block">{{$errors->first('resident_kind_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_resident_kind_modal" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('owner') ? ' has-error' : ''}}">
                                            <label class="control-label" for="owner" >اسم الجهة/ صاحب العقار</label>
                                            <input type="text" id="owner" name="owner" value="{{old('owner', $resident->owner)}}" class="form-control">
                                            @if ($errors->has('owner'))
                                                <span class="help-block">{{$errors->first('owner')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('responsible_person') ? ' has-error' : ''}}">
                                            <label class="control-label" for="responsible_person" >اسم الشحص المسؤول</label>
                                            <input type="text" id="responsible_person" name="responsible_person" value="{{old('responsible_person', $resident->responsible_person)}}" class="form-control">
                                            @if ($errors->has('responsible_person'))
                                                <span class="help-block">{{$errors->first('responsible_person')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('mobile') ? ' has-error' : ''}}">
                                            <label class="control-label" for="mobile" >رقم الجوال</label>
                                            <input type="text" id="mobile" name="mobile" value="{{old('mobile', $resident->mobile)}}" class="form-control">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">{{$errors->first('mobile')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('phone') ? ' has-error' : ''}}">
                                            <label class="control-label" for="phone" >رقم الهاتف</label>
                                            <input type="text" id="phone" name="phone" value="{{old('phone', $resident->phone)}}" class="form-control">
                                            @if ($errors->has('phone'))
                                                <span class="help-block">{{$errors->first('phone')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('fax') ? ' has-error' : ''}}">
                                            <label class="control-label" for="fax" >رقم الفاكس</label>
                                            <input type="text" id="fax" name="fax" value="{{old('fax', $resident->fax)}}" class="form-control">
                                            @if ($errors->has('fax'))
                                                <span class="help-block">{{$errors->first('fax')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                            <label class="control-label" for="email" >البريد الإلكتروني</label>
                                            <input type="text" id="email" name="email" value="{{old('email', $resident->email)}}" class="form-control">
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="resident_bank_id" class="control-label">اسم البنك</label>
                                            <select id="resident_bank_id" class="form-control" name="bank_id">
                                                <option value="">بدون</option>
                                                @foreach($banks as $bank)
                                                    <option {{old('bank_id', $resident->bank_id) == $bank->id ? 'selected' : ''}} value="{{$bank->id}}" >{{$bank->bank}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_resident_bank" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('iban') ? ' has-error' : ''}}">
                                            <label class="control-label" for="iban" >رقم الأيبان</label>
                                            <input type="text" id="iban" name="iban" value="{{old('iban', $resident->iban)}}" class="form-control">
                                            @if ($errors->has('iban'))
                                                <span class="help-block">{{$errors->first('iban')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('payment_way') ? ' has-error' : ''}}">
                                            <label class="control-label" for="payment_way" >طريقة الدفع</label>
                                            <select id="payment_way" name="payment_way" class="form-control">
                                                <option value="">بدون</option>
                                                <option {{old('payment_way', $resident->payment_way) == 'نقدا' ? 'selected' : ''}} value="نقدا">نقدا</option>
                                                <option {{old('payment_way', $resident->payment_way) == 'شيك' ? 'selected' : ''}} value="شيك">شيك</option>
                                                <option {{old('payment_way', $resident->payment_way) == 'تحويل' ? 'selected' : ''}} value="تحويل">تحويل</option>
                                                <option {{old('payment_way', $resident->payment_way) == 'أخرى' ? 'selected' : ''}} value="أخرى">أخرى</option>
                                            </select>
                                            @if ($errors->has('payment_way'))
                                                <span class="help-block">{{$errors->first('payment_way')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('annually_cost') ? ' has-error' : ''}}">
                                            <label class="control-label" for="annually_cost" >التكلفة بالسنة</label>
                                            <input type="text" id="annually_cost" name="annually_cost" value="{{old('annually_cost', $resident->annually_cost)}}" class="form-control">
                                            @if ($errors->has('annually_cost'))
                                                <span class="help-block">{{$errors->first('annually_cost')}}</span>
                                            @endif
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('coordinate') ? ' has-error' : ''}}">
                                            <label class="control-label" for="description" > معلومات إضافية</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{old('description', $resident->description)}}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{$errors->first('description')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success" id="btn_save_resident"><i class="fa fa-save"></i> حفظ التغييرات</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- ===== RESEARCH ===== --}}
                    <div class="tab-pane {{Request::get('tab_active') === 'researches' ? 'active' : ''}}" id="researches">
                        @if (count($researches) === 0)
                            <div class="alert alert-danger"> لم تسجل دراسة حالة لهذا المستفيد. </div>
                            <a href="{{url('beneficiaries', $beneficiary->id) . '/researches/create'}}" class="btn btn-primary"><i class="fa fa-plus"></i> عمل دراسة حالة </a>
                        @else
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>تاريخ البحث</th>
                                        <th>الدخل</th>
                                        <th>المصروفات الشهرية</th>
                                        <th>الفرق</th>
                                        <th>النسبة المئوية</th>
                                        <th>الاحتياجات المالية</th>
                                        <th>الاحتياجات العينية</th>
                                        <th>المبلغ المطلوب</th>
                                        <th class="res-column-action">العملية</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($researches as $research)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td class="res-column-action">{{$research->formatted_research_hijri_date}}</td>
                                            <td>{{number_format($research->total_income)}}</td>
                                            <td>{{number_format($research->total_expense)}}</td>
                                            <td>{{number_format($research->difference)}}</td>
                                            <td>{{$research->percentage}}%</td>
                                            <td>{{number_format($research->total_money_need)}}</td>
                                            <td>{{number_format($research->total_item_need)}}</td>
                                            <td>{{number_format($research->total_need)}}</td>
                                            <td>
                                                <a href="{{url('/researches', $research->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-title="تفاصيل"><i class="fa fa-info-circle"></i></a>
                                                <a href="" class="btn btn-sm btn-danger" data-toggle="tooltip" data-title="حذف"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- ===== LAST GIFT ===== --}}
                    <div class="tab-pane {{Request::get('tab_active') === 'last_gifts' ? 'active' : ''}}" id="last_gifts">

                    </div>
                    <div class="tab-pane {{Request::get('tab_active') === 'last_gifts' ? 'active' : ''}}" id="next_gifts">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{asset('js/mask.js')}}"></script>
    <script src="{{asset('plugins/bower_components/bootstrap-confirmation2/bootstrap-confirmation.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
    <script src="{{asset('plugins/bower_components/dropify/dist/js/dropify.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXi_ikrgat68ZL6SeidLuihVWh81L6ILc&language=ar"></script>
    <script src="{{ asset('plugins/bower_components/gmaps/gmaps.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/pages/beneficiary_show.js')}}"></script>
@endsection