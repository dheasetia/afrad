@extends('layouts.main')

@section('custom_style')
    <link rel="stylesheet" href="{{asset('plugins/bower_components/dropify/dist/css/dropify.min.css')}}">
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
                            <label for="name" class="control-label">الاسم <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="control-label">الجوال <span class="required">*</span></label>
                            <input type="text" name="mobile" id="mobile" class="form-control" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">البريد الإلكتروني</label>
                            <input type="text" name="email" id="email" class="form-control" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">صفته</label>
                            <input type="text" name="description" id="description" class="form-control" autocomplete="off" autofocus>
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
    <!--END ADD BANK MODAL-->


    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-user"></i> المستفيدون </h4>
        </div>
    </div>

    <div class="row" id="panel_beneficiary">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <form action="/beneficiaries" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form_beneficiary_create">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="form-body">
                                <h3 class="box-title">إضافة مستفيد جديد</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                                            <label class="control-label" for="name">الاسم الكامل <span class="required">*</span> </label>
                                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" autofocus>
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('national_number') ? ' has-error' : ''}}">
                                            <label class="control-label" for="national_number">رقم الهوية الوطنية <span class="required">*</span></label>
                                            <input type="text" id="national_number" name="national_number" class="form-control" value="{{old('national_number')}}">
                                            @if ($errors->has('national_number'))
                                                <span class="help-block">{{$errors->first('national_number')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mobile') ? ' has-error' : ''}}">
                                            <label class="control-label" for="mobile">رقم الجوال <span class="required">*</span></label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="{{old('mobile')}}">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">{{$errors->first('mobile')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('phone') ? ' has-error' : ''}}">
                                            <label class="control-label" for="phone">هاتف المنزل </label>
                                            <input type="text" id="phone" name="phone" class="form-control" value="{{old('phone')}}">
                                            @if ($errors->has('phone'))
                                                <span class="help-block">{{$errors->first('phone')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                            <label class="control-label" for="email">البريد الإلكتروني </label> <span class="mute">(إن وجد)</span>
                                            <input type="text" id="email" name="email" class="form-control" value="{{old('email')}}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('sex') ? ' has-error' : ''}}">
                                            <label class="control-label">الجنس <span class="required">*</span></label>
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="sex" id="sex1" value="ذكر" {{old('sex') == null ? 'checked' : ''}} {{old('sex') == 'ذكر' ? 'checked' : ''}} >
                                                        <label for="sex1">ذكر</label>
                                                    </div>
                                                </label>
                                                <label class="radio-inline">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="sex" id="sex2" value="أنثى" {{old('sex') == 'أنثى' ? 'checked' : ''}}>
                                                        <label for="sex2">أنثى </label>
                                                    </div>
                                                </label>
                                            </div>
                                            @if ($errors->has('sex'))
                                                <span class="help-block">{{$errors->first('sex')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('dob') ? ' has-error' : ''}}">
                                            <label class="control-label" for="dob" >تاريخ الميلاد بالهجري</label>
                                            <input type="text" id="dob" name="dob" value="{{old('dob')}}" data-mask="99/ 99/ 9999" class="form-control">
                                            <span class="font-13 text-muted">يوم/ شهر/ سنة (مثال: 07/ 04/ 1439)</span>
                                            @if ($errors->has('dob'))
                                                <span class="help-block">{{$errors->first('dob')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group {{$errors->has('marital_status_id') ? ' has-error' : ''}}">
                                            <label for="marital_status_id" class="control-label">الحالة الاجتماعية<span class="required">*</span></label>
                                            <select id="marital_status_id" class="form-control" name="marital_status_id">
                                                <option value="">-- اختر --</option>
                                                @foreach($marital_statuses as $status)
                                                <option {{old('marital_status_id') == '1' ? 'selected' : ''}} value="{{$status->id}}" >{{$status->status}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('marital_status_id'))
                                                <span class="help-block">{{$errors->first('marital_status_id')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_marital_status" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_role_id" class="control-label">العلاقة الأسرية</label>
                                            <select id="family_role_id" class="form-control" name="family_role_id">
                                                <option value="">بدون</option>
                                                @foreach($family_roles as $role)
                                                    <option {{old('family_role_id') == '1' ? 'selected' : ''}} value="{{$role->id}}" >{{$role->role}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_family_role" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="nationality_id" class="control-label">الجنسية</label>
                                            <select id="nationality_id" class="form-control" name="nationality_id">
                                                <option value="">بدون</option>
                                                @foreach($nationalities as $nationality)
                                                    <option {{old('nationality_id') == '1' ? 'selected' : ''}} value="{{$nationality->id}}" >{{$nationality->nationality}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_nationality" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('family_member_count') ? ' has-error' : ''}}">
                                            <label class="control-label" for="family_member_count" >عدد أعضاء الأسرة</label>
                                            <input type="number" id="family_member_count" name="family_member_count" min="1" max="20" value="{{old('family_member_count')}}" class="form-control">
                                            @if ($errors->has('family_member_count'))
                                                <span class="help-block">{{$errors->first('family_member_count')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('son_count') ? ' has-error' : ''}}">
                                            <label class="control-label" for="son_count" >عدد البنين</label>
                                            <input type="number" id="son_count" name="son_count" min="1" max="20" value="{{old('son_count')}}" class="form-control">
                                            @if ($errors->has('son_count'))
                                                <span class="help-block">{{$errors->first('son_count')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('daughter_count') ? ' has-error' : ''}}">
                                            <label class="control-label" for="daughter_count" >عدد البنات</label>
                                            <input type="number" id="daughter_count" name="daughter_count" min="1" max="20" value="{{old('daughter_count')}}" class="form-control">
                                            @if ($errors->has('daughter_count'))
                                                <span class="help-block">{{$errors->first('daughter_count')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="graduation_id" class="control-label">المؤهل الدراسي</label>
                                            <select id="graduation_id" class="form-control" name="graduation_id">
                                                <option value="">بدون</option>
                                                @foreach($graduations as $graduation)
                                                    <option {{old('graduation_id') == $graduation->id ? 'selected' : ''}} value="{{$graduation->id}}" >{{$graduation->graduation}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_graduation" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="education_specialty_id" class="control-label">التخصص الدراسي</label>
                                            <select id="education_specialty_id" class="form-control" name="education_specialty_id">
                                                <option value="">بدون</option>
                                                @foreach($education_specialties as $specialty)
                                                    <option {{old('education_specialty_id') == $specialty->id ? 'selected' : ''}} value="{{$specialty->id}}" >{{$specialty->specialty}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light"  id="btn_add_education_specialty" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="profession_id" class="control-label">المهنة</label>
                                            <select id="profession_id" class="form-control" name="profession_id">
                                                <option value="">بدون</option>
                                                @foreach($professions as $profession)
                                                    <option {{old('profession_id') == $profession->id ? 'selected' : ''}} value="{{$profession->id}}" >{{$profession->profession}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_profession"  data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="expertise_id" class="control-label">الحرفة التي يتقنها</label>
                                            <select id="expertise_id" class="form-control" name="expertise_id">
                                                <option value="">بدون</option>
                                                @foreach($expertises as $expertise)
                                                    <option {{old('expertise_id') == $expertise->id ? 'selected' : ''}} value="{{$expertise->id}}" >{{$expertise->expertise}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_expertise" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company_name" class="control-label">جهة العمل الحالي</label>
                                            <input type="text" name="company_name" id="company_name" class="form-control" value="{{old('company_name')}}">
                                            @if ($errors->has('company_name'))
                                                <span class="help-block">{{$errors->first('company_name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="work_experience" class="control-label">خبرات العمل</label>
                                            <textarea name="work_experience" rows="3" id="work_experience" class="form-control">{{old('work_experience')}}</textarea>
                                            @if ($errors->has('work_experience'))
                                                <span class="help-block">{{$errors->first('work_experience')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label for="guardian_id" class="control-label">الشخص المسؤول عنه</label>
                                            <select id="guardian_id" class="form-control" name="guardian_id">
                                                <option value="">بدون</option>
                                                @foreach($guardians as $guardian)
                                                    <option {{old('guardian_id') == $guardian->id ? 'selected' : ''}} value="{{$guardian->id}}" >{{$guardian->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_guardian" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="bank_id" class="control-label">اسم البنك</label>
                                            <select id="bank_id" class="form-control" name="bank_id">
                                                <option value="">بدون</option>
                                                @foreach($banks as $bank)
                                                    <option {{old('bank_id') == $bank->id ? 'selected' : ''}} value="{{$bank->id}}" >{{$bank->bank}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info btn-add waves-effect waves-light" id="btn_add_bank" data-toggle="tooltip" title="إضافة"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('iban') ? ' has-error' : ''}}">
                                            <label class="control-label" for="iban" >رقم الأيبان</label>
                                            <input type="text" id="iban" name="iban" value="{{old('iban')}}" class="form-control">
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
                                            <textarea name="notes" rows="3" id="notes" class="form-control">{{old('notes')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-muted m-r-20"><i class="fa fa-warning"></i> يمكنكم إضافة الصورة الشخصية وعنوان المنزل بعد عملية الحفظ. </p>
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
    <script src="{{asset('js/mask.js')}}"></script>
    <script src="{{asset('plugins/bower_components/dropify/dist/js/dropify.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugins/bower_components/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/pages/beneficiary_create.js')}}"></script>
@endsection