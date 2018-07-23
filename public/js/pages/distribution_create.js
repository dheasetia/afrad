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
            alert('التاريخ الهجري غير صحيح')
            return '';
        }
    };

    var handleHijri = function() {
        var hijriInput = document.getElementById('hijri_distribution_date'),
            gregInput = document.getElementById('distribution_date'),
            uqc = $.calendars.instance('ummalqura', 'ar'),
            todayHijri = uqc.today();

        if (hijriInput.value = uqc.formatDate('dd/ mm/ yyyy', todayHijri)) {
            gregInput.value = hijriToGreg('/ ', hijriInput.value);
        }

        hijriInput.addEventListener('blur', function () {
            gregInput.value = hijriToGreg('/ ', hijriInput.value);
        });

    };

    var handleSelect = function () {
        $('#beneficiary_id').select2({
            dir: "rtl",
            language: 'ar'
        });
    };

    var addKind = function () {
        var modal = $('#modal_add_kind');
        var btn_save = modal.find('#btn_save_add_kind');
        var input = modal.find("#form_add_kind input#kind_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postKind();
        });

        $('#btn_add_kind').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postKind() {
            if (input.val() === '') {
                $.toast({
                    heading: 'إضافة نوع حالة',
                    text: 'فضلا أدخل نوع الحالة',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    textAlign: 'right',
                    stack: 6
                });
                return false;
            }
            var kind = $('#form_add_kind').find('input#kind_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/distribution-kinds',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    kind: kind
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.kind.id);
                        option.text(data.kind.kind);
                        $('#distribution_kind_id').append(option).val(data.kind.id);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة نوع الحالة',
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
                            heading: 'إضافة نوع الحالة',
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
                        heading: 'إضافة نوع الحالة',
                        text: 'تعذرت عملية إضافة نوع الحالة',
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

    var handleValidation = function() {
        var form = $('#form_distribution_create');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                beneficiary_id: {
                    required: true
                },
                distribution_kind_id: {
                    required: true
                },
                hijri_distribution_date: {
                    required: true,
                    hijri: true
                },
                distribution_date: {
                    required: true,
                    abah_date: true
                },
                place: {
                    required: true
                },
                is_periodic: {
                    required: true
                }

            },
            messages: {
                distribution_kind_id: {
                    required: 'نوع الحالة إلزامي'
                },
                beneficiary_id: {
                    required: 'اسم المستفيد إلزامي'
                },
                hijri_distribution_date: {
                    required: 'التاريخ الهجري إلزامي',
                    hijri: 'التاريخ الهجري غير صحيح'
                },
                distribution_date: {
                    required: 'التاريخ الميلادي إلزامي',
                    abah_date: 'التاريخ الميلادي غير صحيح'
                },
                place: {
                    required: 'مكان صرف المساعدة إلزامي'
                },
                is_periodic: {
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
            handleHijri();
            handleSelect();
            addKind();
            addCity();
            addArea();
            handleValidation();
        }
    }

}();

jQuery(document).ready(function () {
    DistributionCreate.init();
});