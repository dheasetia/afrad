var BeneficiaryCreate = function () {

    jQuery.validator.addMethod("saudimobile", function(value, element) {
        return this.optional( element ) || /^05\d\d\d\d\d\d\d\d/.test( value );
    }, 'رقم الجوال غير صحيح');

    jQuery.validator.addMethod("iban", function(value, element) {
        return this.optional( element ) || /^SA\d{22}$/.test( value );
    }, 'رقم الجوال غير صحيح');

    jQuery.validator.addMethod("hijri", function(value, element) {
        return this.optional( element ) || /(0[1-9]|[1-2][0-9]|30)\/\s(0[1-9]|1[0-2])\/\s(13[3-9][0-9]|14[0-4][0-9])$/.test( value );
    }, 'تاريخ الهجري غير صحيح');


    var token = $('meta[name=csrf-token]').attr('content');

    var handleValidation = function() {
        var form = $('#form_beneficiary_create');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                name: {
                    required: true,
                    minlength: 6
                },
                national_number: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                    saudimobile: true
                },
                phone: {
                    number: true
                },
                email: {
                    email: true
                },
                sex: {
                    required: true
                },
                dob: {
                    hijri: true
                },
                marital_status_id: {
                    required: true
                },
                family_member_count: {
                    number: true
                },
                son_count: {
                    number: true
                },
                daughter_count: {
                    number: true
                },
                iban: {
                    iban: true
                }
                // ,
                // avatar: {
                //     accept: "image/*",
                //     extension: "jpg|jpeg|bmp|png|gif"
                // }
            },
            messages: {
                name: {
                    required: 'إلزامي',
                    minlength: 'الاسم لا بد أن يكون أكثر من ٦ أحرف'
                },
                national_number: {
                    required: 'إلزامي',
                    number: 'لا بد أن يكون أرقاماً بالإنجليزية',
                    minlength: 'رقم الجوال غير صحيح',
                    maxlength: 'رقم الجوال غير صحيح'
                },
                mobile: {
                    required: 'إلزامي',
                    number: 'لا بد أن يكون أرقاماً بالإنجليزية',
                    minlength: 'الرقم غير صحيح',
                    maxlength: 'الرقم غير صحيح'
                },
                phone: {
                    number: 'لا بد أن يكون أرقاماً بالإنجليزية'
                },
                email: {
                    email: 'الإيميل غير صحيح'
                },
                sex: {
                    required: 'إلزامي'
                },
                marital_status_id: {
                    required: 'إلزامي'
                },
                family_member_count: {
                    number: 'لا بد أن يكون أرقاماً بالإنجليزية'
                },
                son_count: {
                    number: 'لا بد أن يكون أرقاماً بالإنجليزية'
                },
                daughter_count: {
                    number: 'لا بد أن يكون أرقاماً بالإنجليزية'
                },

                iban: {
                    iban: 'رقم الآيبان غير صحيح'
                }
                // ,
                // avatar: {
                //     accept: 'نوع ملف الصورة غير صحيح',
                //     extension: 'صيغة ملف الصورة غير صحيح'
                // }
            },

            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    };

    var addSocialStatus = function () {
        var select      = $('#marital_status_id'),
            button      = $('#btn_add_marital_status'),
            modal       = $('#modal_add_marital_status'),
            header      = modal.find('.modal-title'),
            form        = modal.find('form'),
            label       = form.find('label'),
            input       = form.find('input'),
            btn_save    = modal.find('button.btn_save');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('show.bs.modal', function () {
            input.val('');
            header.text('إضافة حالة اجتماعية ');
            label.text('الحالة ');
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
            header.text('');
            label.text('');
        });

        button.on('click', function () {
            modal.modal();
        });

        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_marital_status = input.val().trim();
            if (new_marital_status === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postSocialStatus(new_marital_status);
        });

        function postSocialStatus(new_marital_status) {
            $.ajax({
                url: '/ajax/marital-statuses',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    status: new_marital_status
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.marital_status.id + '">' + data.marital_status.status + '</option>');
                        select.append(option);
                        select.val(data.marital_status.id);
                        $.toast({
                            heading: 'إضافة حالة اجتماعية',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: 'إضافة حالة اجتماعية',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: 'إضافة حالة اجتماعية',
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addFamilyRole = function () {
        var select      = $('#family_role_id'),
            button      = $('#btn_add_family_role'),
            modal       = $('#modal_add_family_role'),
            btn_save    = modal.find('button.btn_save'),
            input       = modal.find('form input');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
        });

        button.on('click', function () {
            modal.modal();
        });

        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_item = input.val().trim();
            if (new_item === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postFamilyRole(new_item, 'إضافة علاقة أسرية');
        });

        function postFamilyRole(new_item, title) {
            $.ajax({
                url: '/ajax/family-roles',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    role: new_item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.role.id + '">' + data.role.role + '</option>');
                        select.append(option);
                        select.val(data.role.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addGraduation = function () {
        var select      = $('#graduation_id'),
            button      = $('#btn_add_graduation'),
            modal       = $('#modal_add_graduation'),
            btn_save    = modal.find('button.btn_save'),
            input       = modal.find('form input');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
        });

        button.on('click', function () {
            modal.modal();
        });


        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_item = input.val().trim();
            if (new_item === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postNewItem(new_item, 'إضافة مؤهل دراسي');
        });

        function postNewItem(new_item, title) {
            $.ajax({
                url: '/ajax/graduations',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    graduation: new_item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.graduation.id + '">' + data.graduation.graduation + '</option>');
                        select.append(option);
                        select.val(data.graduation.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addEducationSpecialty = function () {
        var select      = $('#education_specialty_id'),
            button      = $('#btn_add_education_specialty'),
            modal       = $('#modal_add_education_specialty'),
            btn_save    = modal.find('button.btn_save'),
            input       = modal.find('form input');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
        });

        button.on('click', function () {
            modal.modal();
        });


        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_item = input.val().trim();
            if (new_item === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postNewItem(new_item, 'إضافة تخصص دراسي');
        });

        function postNewItem(new_item, title) {
            $.ajax({
                url: '/ajax/education-specialties',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    specialty: new_item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.specialty.id + '">' + data.specialty.specialty + '</option>');
                        select.append(option);
                        select.val(data.specialty.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addProfession = function () {
        var select      = $('#profession_id'),
            button      = $('#btn_add_profession'),
            modal       = $('#modal_add_profession'),
            btn_save    = modal.find('button.btn_save'),
            input       = modal.find('form input');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
        });

        button.on('click', function () {
            modal.modal();
        });


        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_item = input.val().trim();
            if (new_item === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postNewItem(new_item, 'إضافة مهنة');
        });

        function postNewItem(new_item, title) {
            $.ajax({
                url: '/ajax/professions',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    profession: new_item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.profession.id + '">' + data.profession.profession + '</option>');
                        select.append(option);
                        select.val(data.profession.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addExpertise = function () {
        var select      = $('#expertise_id'),
            button      = $('#btn_add_expertise'),
            modal       = $('#modal_add_expertise'),
            btn_save    = modal.find('button.btn_save'),
            input       = modal.find('form input');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
        });

        button.on('click', function () {
            modal.modal();
        });


        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_item = input.val().trim();
            if (new_item === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postNewItem(new_item, 'إضافة حرفة');
        });

        function postNewItem(new_item, title) {
            $.ajax({
                url: '/ajax/expertises',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    expertise: new_item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.expertise.id + '">' + data.expertise.expertise + '</option>');
                        select.append(option);
                        select.val(data.expertise.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addBank = function () {
        var select      = $('#bank_id'),
            button      = $('#btn_add_bank'),
            modal       = $('#modal_add_bank'),
            btn_save    = modal.find('button.btn_save'),
            input       = modal.find('form input');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
        });

        button.on('click', function () {
            modal.modal();
        });


        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_item = input.val().trim();
            if (new_item === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postNewItem(new_item, 'إضافة بنك');
        });

        function postNewItem(new_item, title) {
            $.ajax({
                url: '/ajax/banks',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    bank: new_item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.bank.id + '">' + data.bank.bank + '</option>');
                        select.append(option);
                        select.val(data.bank.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addGuardian = function () {
        var select      = $('#guardian_id'),
            button      = $('#btn_add_guardian'),
            modal       = $('#modal_add_guardian'),
            btn_save    = modal.find('button.btn_save'),
            form        = modal.find('form'),
            input       = form.find('input'),
            nameInput   = form.find('#guardian_name'),
            mobileInput   = form.find('#guardian_mobile'),
            emailInput   = form.find('#guardian_email'),
            descriptionInput   = form.find('#guardian_description');

        modal.on('shown.bs.modal', function () {
            nameInput.focus();
        });

        modal.on('hide.bs.modal', function () {
            nameInput.val('');
            mobileInput.val('');
            emailInput.val('');
            descriptionInput.val('');
        });

        button.on('click', function () {
            modal.modal();
        });


        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var data = {
                name: nameInput.val().trim(),
                mobile: mobileInput.val().trim(),
                email: emailInput.val().trim(),
                description: descriptionInput.val().trim(),
                _token: token
            } ;

            if (data.name === '') {
                alert('الحقل فارغ');
                nameInput.focus();
                return false;
            }
            if (data.mobile === '') {
                alert('الحقل فارغ');
                mobileInput.focus();
                return false;
            }
            if (data.mobile.length !== 10) {
                alert('رقم الجوال خطأ');
                mobileInput.focus();
                return false;
            }
            if (!data.mobile.match(/^05\d{8}$/)) {
                alert('رقم الجوال خطأ');
                mobileInput.focus();
                return false;
            }
            if ((data.email !== '') && (!data.email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))) {
                alert('عنوان البريد الإلكتروني خطأ');
                emailInput.focus();
                return false;
            }
            postNewItem(data, 'إضافة شخص مسؤول');
        });

        function postNewItem(data, title) {
            $.ajax({
                url: '/ajax/guardians',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.guardian.id + '">' + data.guardian.name + '</option>');
                        select.append(option);
                        select.val(data.guardian.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        if (errors['name']) {
                            nameInput.closest('.form-group').addClass('has-error').append($('<span class="help-block">').html(errors['name'][0]));
                        }

                        if (errors['mobile']) {
                            mobileInput.closest('.form-group').addClass('has-error').append($('<span class="help-block">').html(errors['mobile'][0]));
                        }

                        if (errors['email']) {
                            console.log('Mobile error: ' + errors['email'][0]);
                            emailInput.closest('.form-group').addClass('has-error').append($('<span class="help-block">').html(errors['email'][0]));
                        }

                        return false;
                    }
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var addCity = function () {
        var modal = $('#modal_add_city');
        var input = modal.find("#form_add_city #city_add_input");
        var select = modal.find("#form_add_city #city_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#btn_add_city').on('click', function () {
            input.val('');
            select.val('');
            modal.modal();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        select.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        modal.find('#btn_save_add_city').on('click', function () {
            postCity();
        });
        function postCity() {
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var city = $('#form_add_city').find('#city_add_input').val(),
                area_id = $('#form_add_city').find('#area_id').val(),
                select_city = $('#city_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/cities',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    city: city,
                    area_id: area_id
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.city.id);
                        option.text(data.city.city);
                        select_city.append(option);
                        select_city.val(data.city.id);
                        $('#province').text(data.city.area);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مدينة ',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                        modal.modal('hide');
                    } else {
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مدينة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                    return false;
                },
                error: function () {
                    modal.unblock();
                    modal.modal('hide');
                    $.toast({
                        heading: 'إضافة مدينة',
                        text: 'تعذرت عملية إضافة مدينة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            })
        }
    };

    var addArea = function () {
        var modal = $('#modal_add_area');
        var input = modal.find("#form_add_area #area_add_input");
        var select = modal.find("#form_add_area #area_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#btn_add_area_modal').on('click', function () {
            input.val('');
            select.val('');
            modal.modal();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        select.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        modal.find('#btn_save_add_area').on('click', function () {
            postArea();
        });

        function postArea() {
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var area = $('#form_add_area').find('#area_add_input').val(),
                select_area = $('#area_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/areas',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    area: area
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.area.id);
                        option.text(data.area.area);
                        select_area.append(option);
                        select_area.val(data.area.id);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة منطقة ',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                        modal.modal('hide');
                    } else {
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة منطقة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                    return false;
                },
                error: function () {
                    modal.unblock();
                    modal.modal('hide');
                    $.toast({
                        heading: 'إضافة منطقة',
                        text: 'تعذرت عملية إضافة مطقة',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            })
        }
    };

    var addResidentKind = function () {
        var modal = $('#modal_add_resident_kind');
        var input = modal.find("#form_add_resident_kind #resident_kind_add_input");
        var select = modal.find("#form_add_resident_kind #resident_kind_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#btn_add_resident_kind_modal').on('click', function () {
            input.val('');
            select.val('');
            modal.modal();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        select.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        modal.find('#btn_save_add_resident_kind').on('click', function () {
            postResidentKind();
        });

        function postResidentKind() {
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var resident_kind = $('#form_add_resident_kind').find('#resident_kind_add_input').val(),
                select_resident_kind = $('#resident_kind_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/resident-kinds',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    kind: resident_kind
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.resident_kind.id);
                        option.text(data.resident_kind.kind);
                        select_resident_kind.append(option);
                        select_resident_kind.val(data.resident_kind.id);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة نوع السكن ',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                        modal.modal('hide');
                    } else {
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة نوع السكن',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                    return false;
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        var form = $('#form_add_resident_kind');
                        form.find('div.form-group.has-error').find('span.help-block').remove();
                        form.find('div.form-group.has-error').removeClass('has-error');
                        $.each(errors, function (key, value) {
                            showErrors(form, key, value[0]);
                        });
                        $.toast({
                            heading: 'إضافة نوع السكن',
                            text: 'الرجاء تصحيح المدخلات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: 'إضافة نوع السكن',
                            text: 'تعذر إضافة نوع السكن',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                complete: function () {
                    modal.unblock();
                }
            })
        }
    };

    var addResidentBank = function () {
        var modal = $('#modal_add_resident_bank');
        var btn_save = modal.find('#btn_save_add_resident_bank');
        var input = modal.find("#form_add_resident_bank input#resident_bank_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postBank();
        });

        $('#btn_add_resident_bank').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postBank() {
            if (input.val() === '') {
                return false;
            }
            var resident_bank = $('#form_add_resident_bank').find('#resident_bank_add_input').val(),
                select_resident_bank = $('#resident_bank_id'),
                title = 'إضافة بنك';

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/banks',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    bank: resident_bank
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.bank.id);
                        option.text(data.bank.bank);
                        select_resident_bank.append(option);
                        select_resident_bank.val(data.bank.id);
                        modal.unblock();
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                        modal.modal('hide');
                    } else {
                        modal.unblock();
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                    return false;
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        var form = $('#form_add_resident_bank');
                        form.find('div.form-group.has-error').find('span.help-block').remove();
                        form.find('div.form-group.has-error').removeClass('has-error');
                        $.each(errors, function (key, value) {
                            showErrors(form, key, value[0]);
                        });
                        $.toast({
                            heading: title,
                            text: 'الرجاء تصحيح المدخلات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: 'تعذر إضافة بنك',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                complete: function () {
                    modal.unblock();
                }
            })
        }
    };

    var showErrors = function (form, inputId, errorMessage) {
        var input = form.find($('#' + inputId)),
            formGroup = input.closest('.form-group'),
            messageElement = $('<span class="help-block">').html(errorMessage);

        formGroup.addClass('has-error').append(messageElement);
    };

    var addNationality = function () {
        var select      = $('#nationality_id'),
            button      = $('#btn_add_nationality'),
            modal       = $('#modal_add_nationality'),
            btn_save    = modal.find('button.btn_save'),
            input       = modal.find('form input');

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        modal.on('hide.bs.modal', function () {
            input.val('');
        });

        button.on('click', function () {
            modal.modal();
        });


        input.on('keydown', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });

        btn_save.on('click', function () {
            var new_item = input.val().trim();
            if (new_item === '') {
                alert('الحقل فارغ');
                input.val('');
                input.focus();
                return false;
            }
            postNewItem(new_item, 'إضافة جنسية');
        });

        function postNewItem(new_item, title) {
            $.ajax({
                url: '/ajax/nationalities',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    nationality: new_item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        modal.modal('hide');
                        var option = $('<option value="' + data.nationality.id + '">' + data.nationality.nationality + '</option>');
                        select.append(option);
                        select.val(data.nationality.id);
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function () {
                    modal.modal('hide');
                    $.toast({
                        heading: title,
                        text: 'تعذرت عملية الإضافة',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        textAlign: 'right',
                        stack: 6
                    });
                }
            });
        }

    };

    var updateMap = function () {
        var coordinate = $('#coordinate');
        if (coordinate.length > 0) {
            var map;
            var myPos = new google.maps.LatLng({
                lat: 26.437214,
                lng: 50.110941
            });
            var coordinate = $('#coordinate').val().split(', ');
            var lat = coordinate[0];
            var lng = coordinate[1];
            if ((lat.length > 0) && (lng.length > 0)) {
                myPos = new google.maps.LatLng({
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                });
            }

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: myPos,
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                });

                var marker = new google.maps.Marker({
                    position: myPos,
                    animation: google.maps.Animation.DROP,
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(marker, 'dragend', function() {
                    document.getElementById('coordinate').value = marker.position.lat() + ', ' + marker.position.lng();
                });

            }
            return initMap();
        }
    };

    var handleAddressMap = function () {
        $('[data-toggle="tab"]').on('shown.bs.tab', function () {
            updateMap();
        });
    };

    var handleUpdateProfile = function () {
        $('#btn_save_profile').click(function () {
            var data = $('form#form_profile').serialize();
            var beneficiary_id = $('form#form_profile').find('input[name=beneficiary_id]').val();
            var panel = $('#profile');
            panel.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري التحديث ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });
            $.ajax({
                url: '/ajax/beneficiaries/' + beneficiary_id,
                type: 'PUT',
                dataType: 'JSON',
                data: data,
                success: function (data) {
                    if (data.status == 'success') {
                        $.toast({
                            heading: 'تحديث بيانات المستفيد',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: 'تحديث بيانات المستفيد',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                error: function (xhr) {

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        var form = $('#form_profile');
                        form.find('div.form-group.has-error').find('span.help-block').remove();
                        form.find('div.form-group.has-error').removeClass('has-error');
                        $.each(errors, function (key, value) {
                            showErrors(form, key, value[0]);
                        });

                        $.toast({
                            heading: 'تحديث بيانات المستفيد',
                            text: 'الرجاء تصحيح المدخلات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });

                    } else {
                        $.toast({
                            heading: 'تحديث بيانات المستفيد',
                            text: 'تعذر حفظ التحديثات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                complete: function () {
                    panel.unblock();
                }
            });
        });

    };

    var handleUpdateAddress = function () {
        $('#btn_save_address').click(function () {
            var data = $('form#form_address').serialize();
            var address_id = $('form#form_address').find('input[name=address_id]').val();
            var panel = $('#address');
            panel.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري التحديث ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });
            $.ajax({
                url: '/ajax/addresses/' + address_id,
                type: 'PUT',
                dataType: 'JSON',
                data: data,
                success: function (data) {
                    if (data.status === 'success') {
                        $.toast({
                            heading: 'تحديث بيانات العنوان',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: 'تحديث بيانات العنوان',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                error: function (xhr) {

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        var form = $('#form_address');
                        form.find('div.form-group.has-error').find('span.help-block').remove();
                        form.find('div.form-group.has-error').removeClass('has-error');
                        $.each(errors, function (key, value) {
                            showErrors(form, key, value[0]);
                        });

                        $.toast({
                            heading: 'تحديث بيانات العنوان',
                            text: 'الرجاء تصحيح المدخلات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });

                    } else {
                        $.toast({
                            heading: 'تحديث بيانات العنوان',
                            text: 'تعذر حفظ الحديثات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                complete: function () {
                    panel.unblock();
                }
            });
        });
    };

    var handleUpdateResident = function () {
        $('#btn_save_resident').click(function () {
            var data = $('form#form_resident').serialize();
            var resident_id = $('form#form_resident').find('input[name=resident_id]').val();
            var panel = $('#resident');
            var title = 'تحديث بيانات السكن';

            panel.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري التحديث ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });
            $.ajax({
                url: '/ajax/residents/' + resident_id,
                type: 'PUT',
                dataType: 'JSON',
                data: data,
                success: function (data) {
                    if (data.status === 'success') {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: title,
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                error: function (xhr) {

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        var form = $('#form_resident');
                        form.find('div.form-group.has-error').find('span.help-block').remove();
                        form.find('div.form-group.has-error').removeClass('has-error');
                        $.each(errors, function (key, value) {
                            showErrors(form, key, value[0]);
                        });

                        $.toast({
                            heading: title,
                            text: 'الرجاء تصحيح المدخلات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });

                    } else {
                        $.toast({
                            heading: title,
                            text: 'تعذر حفظ الحديثات',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            textAlign: 'right',
                            stack: 6
                        });
                    }

                },
                complete: function () {
                    panel.unblock();
                }
            });
        });
    };

    var handleDeleteDocument = function () {

        $('.row#document_area').delegate('button.btn_delete_document', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_document',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var panel = $('#documents');
                    var doc_id = $(this).data('doc_id');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/documents',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            doc_id: doc_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                var me = $('#document_item_' + doc_id);
                                me.hide('slow').remove();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف مستند',
                                    text: data.message,
                                    position: 'top-right',
                                    loaderBg:'#ff6849',
                                    icon: 'success',
                                    hideAfter: 3500,
                                    textAlign: 'right',
                                    stack: 6
                                });
                            } else {
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف مستند',
                                    text: data.message,
                                    position: 'top-right',
                                    loaderBg:'#ff6849',
                                    icon: 'error',
                                    hideAfter: 3500,
                                    textAlign: 'right',
                                    stack: 6
                                });
                            }

                        },
                        error: function () {
                            panel.unblock();
                            $.toast({
                                heading: 'حذف مستند',
                                text: 'تعذرت عملية الحذف',
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'error',
                                hideAfter: 3500,
                                textAlign: 'right',
                                stack: 6
                            });
                        }
                    });
                }
            });
        });
    };



    return {
        init: function () {
            handleValidation();
            addSocialStatus();
            addFamilyRole();
            addGraduation();
            addEducationSpecialty();
            addProfession();
            addExpertise();
            addGuardian();
            addBank();
            addCity();
            addArea();
            addNationality();
            addResidentBank();
            addResidentKind();
            handleAddressMap();
            updateMap();
            handleUpdateProfile();
            handleUpdateAddress();
            handleUpdateResident();
            handleDeleteDocument();
        }
    }
}();

jQuery(document).ready(function () {
    BeneficiaryCreate.init();
});