var UserCreate = function () {
    jQuery.validator.addMethod("saudimobile", function(value, element) {
        return this.optional( element ) || /^05\d\d\d\d\d\d\d\d/.test( value );
    }, 'رقم الجوال غير صحيح');

    var handleDropify = function () {
        $('.dropify').dropify({
            messages: {
                default: 'انقر أو اسحب الملف إلى هنا',
                replace: 'انقر أو اسحب الملف إلى هنا للتبديل',
                remove: 'خذف',
                error: 'خطأ، حاول اختيار ملف بالحجم المطلوب وصيغة صحيحة'
            }
        });
    };

    var addDepartment = function () {
        var modal = $('#modal_add_department');
        var input = modal.find("#form_add_department #department_add_input");
        var select = modal.find("#form_add_department #department_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#btn_add_department_modal').on('click', function () {
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

        modal.find('#btn_save_add_department').on('click', function () {
            postDepartment();
        });
        function postDepartment() {
            var title = 'إضافة وظيفة';
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var department = $('#form_add_department').find('#department_add_input').val(),
                select_department = $('#department_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/departments',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    department: department
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.department.id);
                        option.text(data.department.department);
                        select_department.append(option);
                        select_department.val(data.department.id);
                        modal.unblock();
                        $.toast({
                            heading: title,
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
                            heading: title,
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
                        heading: title,
                        text: 'تعذرت عملية إضافة وظيفةclo',
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

    var addJob = function () {
        var modal = $('#modal_add_job');
        var input = modal.find("#form_add_job #job_add_input");
        var select = modal.find("#form_add_job #job_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#btn_add_job_modal').on('click', function () {
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

        modal.find('#btn_save_add_job').on('click', function () {
            postJob();
        });
        function postJob() {
            var title = 'إضافة وظيفة';
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var job = $('#form_add_job').find('#job_add_input').val(),
                select_job = $('#job_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/jobs',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    job: job
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.job.id);
                        option.text(data.job.job);
                        select_job.append(option);
                        select_job.val(data.job.id);
                        modal.unblock();
                        $.toast({
                            heading: title,
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
                            heading: title,
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
                        heading: title,
                        text: 'تعذرت عملية إضافة وظيفةclo',
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

    var handleValidation = function() {
        var form = $('#form_user_create');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password_confirmation: {
                    equalTo: "#password"
                },
                mobile: {
                    required: true,
                    saudimobile: true
                },
                phone: {
                    number: true
                },
                ext: {
                    number: true
                },
                job_id: {
                    required: true
                },
                department_id: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'إلزامي'
                },
                email: {
                    required: 'إلزامي',
                    email: 'عنوان البريد غير صحيح'
                },
                password_confirmation: {
                    equalTo: 'كلمة المرور غير مطابق'
                },
                mobile: {
                    required: 'إلزامي',
                    saudimobile: 'رقم الجوال غير صحيح'
                },
                phone: {
                    number: 'رقم الهاتف غير صحيح'
                },
                ext: {
                    number: 'رفم الامتداد غير صحيح'
                },
                job_id: {
                    required: 'إلزامي'
                },
                department_id: {
                    required: 'إلزامي'
                }
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

    return {
        init: function () {
            handleValidation();
            addDepartment();
            addJob();
        }
    }
}();

jQuery(document).ready(function () {
    UserCreate.init();
});