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
            gregInput = document.getElementById('distribution_date');


        hijriInput.addEventListener('blur', function () {
            gregInput.value = hijriToGreg('/ ', hijriInput.value);
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

    var addItem = function () {
        var modal = $('#modal_add_item');
        var input = modal.find("#form_add_item #item_add_input");
        var select = modal.find("#form_add_item #item_id");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        $('#input_item_id').on('change', function () {
            if ($(this).val() === 'add_new') {
                input.val('');
                select.val('');
                modal.modal();
            }
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

        modal.find('#btn_save_add_item').on('click', function () {
            postArea();
        });

        function postArea() {
            if (input.val() === '' || select.val() === '') {
                return false;
            }
            var item = $('#form_add_item').find('#item_add_input').val(),
                select_item = $('#input_item_id');

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/items',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    item: item
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.item.id);
                        option.text(data.item.item);
                        select_item.append(option);
                        select_item.val(data.item.id);
                        modal.unblock();
                        $.toast({
                            heading: 'إضافة بند الماسعدة ',
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
                            heading: 'إضافة بند المساعدة',
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
                        heading: 'إضافة بند المساعدة',
                        text: 'تعذرت عملية إضافة بند المساعدة',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                },
                complete: function () {
                    $('#input_cost').focus();
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

    var showErrors = function (form, inputId, errorMessage) {
        var input = form.find($('#' + inputId)),
            formGroup = input.closest('.form-group'),
            messageElement = $('<span class="help-block">').html(errorMessage);

        formGroup.addClass('has-error').append(messageElement);
    };

    var prepareItemInputFields = function () {
        var seq_num = $('table#table_items tbody').find('tr').length;
        $('#input_seq').val(seq_num);
        $('#input_is_money').val(1);
        $('#input_item_id').val('');
        $('#input_cost').val('');
        $('#input_quantity').val('');

    };

    var handleSubmitItem = function () {
        $('#btn_add_item').on('click', function () {
            var panel = $('#panel_distribution_item'),
                seq_num = $('#input_seq').val(),
                distribution_id = $('#distribution_id').val(),
                item_id = $('#input_item_id').val(),
                is_money    = $('#input_is_money').val(),
                cost    = $('#input_cost').val(),
                quantity = $('#input_quantity').val();
            if (seq_num == '' || distribution_id == '' || is_money == '' || cost == '' || quantity == '') {
                alert('الرجاء تعبئة جميع الخانات');
                return false;
            } else {
                if (isNaN(cost) || isNaN(quantity)) {
                    alert('السعر أو الكمية غير صحيح');
                    return false;
                }
            }
            panel.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });
            $.ajax({
                url: '/ajax/distribution-items',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    seq_num: seq_num,
                    distribution_id: distribution_id,
                    is_money: is_money,
                    item_id: item_id,
                    cost: cost,
                    quantity: quantity
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var tr = $('<tr><td>' + data.seq_num + '</td><td>' + data.is_money + '</td><td>' + data.item + '</td><td>' + data.cost + '</td><td>' + data.quantity + '</td><td class="subtotal">' + data.subtotal + '</td></tr>');
                        var last_tr = $('table#table_items tbody tr#tr_total');
                        tr.insertBefore(last_tr);
                        prepareItemInputFields();
                        updateTotal();
                        $.toast({
                            heading: 'إضافة بند الماسعدة ',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    } else {
                        $.toast({
                            heading: 'إضافة بند المساعدة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        var form = $('#form_item');
                        form.find('div.form-group.has-error').find('span.help-block').remove();
                        form.find('div.form-group.has-error').removeClass('has-error');
                        $.each(errors, function (key, value) {
                            showErrors(form, key, value[0]);
                        });

                        $.toast({
                            heading: 'إضافة بند المساعدة',
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
                            heading: 'إضافة بند المساعدة',
                            text: 'تعذر حفظ البند',
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
            })
        })
    };

    var updateDistribution = function () {
        $('#btn_update_distribution').click(function (e) {
            e.preventDefault();
            var data = $('form#form_distribution').serialize();
            var distribution_id = $('form#form_distribution').find('input[name=distribution_id]').val();
            var panel = $('#panel_distribution');
            panel.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري التحديث ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });
            $.ajax({
                url: '/ajax/distributions/' + distribution_id,
                type: 'PUT',
                dataType: 'JSON',
                data: data,
                success: function (data) {
                    if (data.status === 'success') {
                        $('#beneficiary_id').val(data.beneficiary_id);
                        $('#distribution_kind_id').val(data.distribution_kind_id);
                        $('#hijri_distribution_date').val(data.hijri_distribution_date);
                        $('#distribution_date').val(data.distribution_date);
                        $('#city_id').val(data.city_id);
                        $('#place').val(data.place);
                        if (data.is_periodic == 1) {
                            $('#is_periodic_1').prop('checked', true);
                        } else {
                            $('#is_periodic_2').prop('checked', true);

                        }
                        $.toast({
                            heading: 'تحديث بيانات الصرف',
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
                            heading: 'تحديث بيانات الصرف',
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
                        var form = $('#form_distribution');
                        form.find('div.form-group.has-error').find('span.help-block').remove();
                        form.find('div.form-group.has-error').removeClass('has-error');
                        $.each(errors, function (key, value) {
                            showErrors(form, key, value[0]);
                        });

                        $.toast({
                            heading: 'تحديث بيانات الصرف',
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

    var updateTotal = function () {
        var subtotalTd = $('table#table_items .subtotal'),
            subtotal = 0;

        $.each(subtotalTd, function (index, value) {
            subtotal += parseInt(value.innerText);
        });
        $('td#total_money').html('<h3>' + new Intl.NumberFormat().format(subtotal));
    };
/*
    var validateItem = function () {
        var form = $('#form_item');
        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                kind_id: {
                    required: true
                },
                item_id: {
                    required: true
                },
                cost: {
                    required: true,
                    numeric: true
                },
                quantity: {
                    required: true,
                    numeric: true
                }

            },
            messages: {
                kind_id: {
                    required: 'إلزامي'
                },
                item_id: {
                    required: 'إلزمامي'
                },
                cost: {
                    required: 'إلزامي',
                    numeric: 'خطأ'
                },
                quantity: {
                    required: 'إلزامي',
                    numeric: 'خطأ'
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
    */
    return {
        init: function () {
            handleHijri();
            addKind();
            addCity();
            addArea();
            addItem();
            handleSubmitItem();
            handleValidation();
            updateDistribution();
            prepareItemInputFields();
            updateTotal();
        }
    }

}();

jQuery(document).ready(function () {
    DistributionCreate.init();
});