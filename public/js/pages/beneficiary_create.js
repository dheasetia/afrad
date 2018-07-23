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
            nameInput   = form.find('input[name=name]'),
            mobileInput   = form.find('input[name=mobile]'),
            emailInput   = form.find('input[name=email]'),
            descriptionInput   = form.find('input[name=description]');

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
            addNationality();
        }
    }
}();

jQuery(document).ready(function () {
    BeneficiaryCreate.init();
});