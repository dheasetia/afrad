var ExpenseIndex = function () {

    var deleteExpense = function () {
        $('table#table_expenses').delegate('button.btn_delete_expense', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_expense',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var expense_id = $(this).data('id');
                    var panel = $('#panel_expense');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/expenses',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            expense_id: expense_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_expenses tbody').empty();
                                fetchExpenses();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف نوع مصروف',
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
                                    heading: 'حذف نوع مصروف',
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
                                heading: 'حذف نوع مصروف',
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

    var addExpense = function () {
        var modal = $('#modal_add_expense');
        var btn_save = modal.find('#btn_save_add_expense');
        var input = modal.find("#form_add_expense input#expense_add_input");


        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postExpense();
        });

        $('#btn_add_expense').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postExpense() {
            if (input.val() === '') {
                return false;
            }
            var expense = $('#form_add_expense').find('input#expense_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/expenses',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    expense: expense
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_expenses tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.expense.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_expense" data-column="expense">').text(data.expense.expense));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_expense" data-id="'
                            + data.expense.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة نوع مصروف جديد',
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
                            heading: 'إضافة نوع مصروف جديد',
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
                        heading: 'إضافة نوع مصروف',
                        text: 'تعذرت عملية إضافة نوع مصروف',
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


    var fetchExpenses = function () {
        $.ajax({
            url: '/ajax/expenses',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_expenses tbody');
                if (data.status === 'success') {
                    $.each(data.expenses, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_expense" data-column="expense">').text(value.expense));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_expense" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        table.append(tr);
                        tr.hide();
                        tr.fadeIn();
                    });
                }
            }
        });
    };

    var editItem = function () {
        var cellForm = $('table#table_expenses tbody');
        cellForm.on('click', 'td.td_expense', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var expense_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="expense" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="expense_id" class="form-control" value="' + expense_id +'"/>' +
                    '<input type="hidden" name="_token" class="form-control" value="' + $('meta[name="csrf-token"]').attr('content') + '"/>' +
                    '</form>';
            cell.html(form).find('input[type=text]').focus();
            cell.on('click', function () {
                return false;
            });
            cell.on('focusout', function () {
                cell.text(prevContent);
                cell.off('click');
            });

            cell.on('keydown', function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    changeField(cell, prevContent);
                } else if (e.keyCode === 27) {
                    cell.text(prevContent);
                    cell.off('click');
                }
            });
        }

        function changeField(cell, prevContent) {
            cell.off('keydown');
            var post_data = cell.find('form').serialize();
            $('#panel_expense').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/expenses/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.expense.expense);
                    cell.off('click');
                    $('#panel_expense').unblock();
                    $.toast({
                        heading: 'تعديل نوع مصروف',
                        text: data.message,
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        textAlign: 'right',
                        stack: 6
                    });
                },
                error: function (err) {
                    cell.html(prevContent);
                    cell.off('click');
                    $('#panel_expense').unblock();
                    $.toast({
                        heading: 'تعديل مصروع دخل',
                        text: 'تعذر تعديل النوع مصروف',
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
    };

    return {
        init: function () {
            fetchExpenses();
            deleteExpense();
            addExpense();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    ExpenseIndex.init();
});