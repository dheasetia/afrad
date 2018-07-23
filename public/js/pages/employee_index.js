var EmployeeIndex = function () {

    var deleteEmployee = function () {
        $('.btn_delete_employee').on('click', function () {
            $(this).confirmation({
                rootSelector: $(this),
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                btnOkIcon: 'fa fa-check',
                btnCancelIcon: 'fa fa-close',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var employee_id = $(this).data('id');
                    var panel = $('#panel_employee');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/employees',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            employee_id: employee_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_employees tbody').empty();
                                tr.remove();
                                $.toast({
                                    heading: 'حذف موظف',
                                    text: data.message,
                                    position: 'top-right',
                                    loaderBg:'#ff6849',
                                    icon: 'success',
                                    hideAfter: 3500,
                                    textAlign: 'right',
                                    stack: 6
                                });
                            } else {
                                $.toast({
                                    heading: 'حذف موظف',
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
                            $.toast({
                                heading: 'حذف موظف',
                                text: 'تعذرت عملية الحذف',
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'error',
                                hideAfter: 3500,
                                textAlign: 'right',
                                stack: 6
                            });
                        },
                        complete: function () {
                            panel.unblock();
                        }
                    });
                }
            });
        });
    };

    return {
        init: function () {
            deleteEmployee();
        }
    }
}();

jQuery(document).ready(function () {
    EmployeeIndex.init();
});