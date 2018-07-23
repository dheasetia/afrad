var DistributionCreate = function () {

    jQuery.validator.addMethod("hijri", function(value, element) {
        return this.optional( element ) || /(0[1-9]|[1-2][0-9]|30)\/\s(0[1-9]|1[0-2])\/\s(13[3-9][0-9]|14[0-4][0-9])$/.test( value );
    }, 'تاريخ الهجري غير صحيح');

    jQuery.validator.addMethod("abah_date", function(value, element) {
        return this.optional( element ) || /(0[1-9]|[1-2][0-9]|30|31)\/\s(0[1-9]|1[0-2])\/\s(20[1-3][0-9])$/.test( value );
    }, 'تاريخ الميلادي غير صحيح');

    var hijriToGreg = function (delimiter, hijriString) {
        var gc = $.calendars.instance(),
            uc = $.calendars.instance('ummalqura', 'ar');

        var numbers = hijriString.split(delimiter),
            day     = parseInt(numbers[0]),
            month   = parseInt(numbers[1]),
            year    = parseInt(numbers[2]);
        if (uc.isValid(year, month, day)) {
            var JD = uc.newDate(year, month, day).toJD();
            gregDate = gc.fromJD(JD);
            return gc.formatDate('dd/ mm/ yyyy', gregDate);
        } else {
            return '';
        }
    };

    var handleHijri = function() {
        var hijriInput = document.getElementById('hijri_expiry_date'),
            gregInput = document.getElementById('expiry_date'),
            uqc = $.calendars.instance('ummalqura', 'ar'),
            todayHijri = uqc.today();

        if (hijriInput.value = uqc.formatDate('dd/ mm/ yyyy', todayHijri)) {
            gregInput.value = hijriToGreg('/ ', hijriInput.value);
        }

        hijriInput.addEventListener('blur', function () {
            gregInput.value = hijriToGreg('/ ', hijriInput.value);
        });

    };

    var handleCheckExpiry = function () {
        $('#check_expiry').on('change', function () {
            if ($(this).prop('checked') === true) {
                $('#check_expiry_area').slideDown();
            } else {
                handleHijri();
                $('#check_expiry_area').slideUp();
            }

        })
    };

    var addDocumentType = function () {
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

    var handleValidation = function() {
        var form = $('#form_document_create');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                label: {
                    required: true
                },
                hijri_expiry_date: {
                    hijri: true
                },
                expiry_date: {
                    abah_date: true
                },
                path: {
                    required: true,
                    accept: "image/*,application/pdf"
                }
            },
            messages: {
                label: {
                    required: 'اسم المستند إلزامي'
                },
                hijri_expiry_date: {
                    hijri: 'التاريخ الهجري للانتهاء خطأ'
                },
                expiry_date: {
                    abah_date: 'تايرخ الانتهاء خطأ'
                },
                path: {
                    required: 'الملف مطلوب',
                    accept: "صيغة الملف خطأ"
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
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function(element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    };

    return {
        init: function () {
            handleCheckExpiry();
            handleHijri();
            handleValidation();
        }
    }

}();

jQuery(document).ready(function () {
    DistributionCreate.init();
});