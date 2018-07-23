var RoleShow = function () {
    var handleValidation = function() {
        var form = $('#form_role_edit');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                name: {
                    required: true
                },
                label: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'الرمز إلزامي'
                },
                label: {
                    required: 'الاسم إلزامي'
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
                var panel = $('#panel_role');
                panel.block({
                    message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                    css: {
                        border: '1px solid #fff'
                    }
                });
                $(form).ajaxSubmit({
                    url: '/ajax/roles/' + $(form).find('input[name=role_id]').val(),
                    type: 'PUT',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#label').val(data.role.label);
                        $('#description').val(data.role.description);
                        panel.unblock();
                        $.toast({
                            heading: 'تعديل مجموعة',
                            text: data.message,
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    },
                    error: function () {
                        $('#panel_job').unblock();
                        $.toast({
                            heading: 'تعديل مجموعة',
                            text: 'تعذر تعديل مجموعة',
                            position: 'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            textAlign: 'right',
                            stack: 6
                        });
                    }
                });
                return false;
            }
        });
    };
    var handleCheckboxSelection = function () {
        $('#btn_check_all').on('click', function () {
            $('.permission_checkbox').prop('checked', true);
        });
        $('#btn_uncheck_all').on('click', function () {
            $('.permission_checkbox').prop('checked', false);
        });
    };
    return {
        init: function () {
            handleValidation();
            handleCheckboxSelection();
        }
    }
}();

jQuery(document).ready(function () {
    RoleShow.init();
});