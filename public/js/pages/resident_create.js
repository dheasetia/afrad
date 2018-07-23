var ResidentCreate = function() {
    jQuery.validator.addMethod("saudimobile", function(value, element) {
        return this.optional( element ) || /^05\d\d\d\d\d\d\d\d/.test( value );
    }, 'رقم الجوال غير صحيح');

    jQuery.validator.addMethod("iban", function(value, element) {
        return this.optional( element ) || /^SA\d{22}$/.test( value );
    }, 'رقم الجوال غير صحيح');

    var handleValidation = function() {
        var form = $('#form_create_resident');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                resident_kind_id: {
                    required: true
                },
                mobile: {
                    saudimobile: true
                },
                iban: {
                    iban: true
                },
                annually_cost: {
                    number: true
                }
            },
            messages: {
                resident_kind_id: {
                    required: 'إلزامي'
                },
                mobile: {
                    saudimobile: 'رقم الجوال غير صحيح'
                },
                iban: {
                    iban: 'رقم الآيبان غير صحيح'
                },
                annually_cost: {
                    number: 'المبلغ غير صحيح'
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

    var showErrors = function (form, inputId, errorMessage) {
        var input = form.find($('#' + inputId)),
            formGroup = input.closest('.form-group'),
            messageElement = $('<span class="help-block">').html(errorMessage);

        formGroup.addClass('has-error').append(messageElement);
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

    var addBank = function () {
        var modal = $('#modal_add_bank');
        var btn_save = modal.find('#btn_save_add_bank');
        var input = modal.find("#form_add_bank input#bank_add_input");

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

        $('#btn_add_bank').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postBank() {
            if (input.val() === '') {
                return false;
            }
            var bank = $('#form_add_bank').find('#bank_add_input').val(),
                select_bank = $('#bank_id'),
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
                    bank: bank
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var option = $('<option>');
                        option.val(data.bank.id);
                        option.text(data.bank.bank);
                        select_bank.append(option);
                        select_bank.val(data.bank.id);
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
                        var form = $('#form_add_bank');
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

    return {
        init: function() {
            handleValidation();
            addResidentKind();
            addBank();
        }
    };
}();

jQuery(document).ready(function() {
    ResidentCreate.init();
});