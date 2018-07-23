var IncomeIndex = function () {

    var deleteIncome = function () {
        $('table#table_incomes').delegate('button.btn_delete_income', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_income',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var income_id = $(this).data('id');
                    var panel = $('#panel_income');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/incomes',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            income_id: income_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_incomes tbody').empty();
                                fetchIncomes();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف مصدر دخل',
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
                                    heading: 'حذف مصدر دخل',
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
                                heading: 'حذف مصدر دخل',
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

    var addIncome = function () {
        var modal = $('#modal_add_income');
        var btn_save = modal.find('#btn_save_add_income');
        var input = modal.find("#form_add_income input#income_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postIncome();
        });

        $('#btn_add_income').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postIncome() {
            if (input.val() === '') {
                return false;
            }
            var income = $('#form_add_income').find('input#income_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/incomes',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    income: income
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_incomes tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.income.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_income" data-column="income">').text(data.income.income));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_income" data-id="'
                            + data.income.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مصدر دخل جديد',
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
                            heading: 'إضافة مصدر دخل جديد',
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
                        heading: 'إضافة مصدر دخل',
                        text: 'تعذرت عملية إضافة مصدر دخل',
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


    var fetchIncomes = function () {
        $.ajax({
            url: '/ajax/incomes',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_incomes tbody');
                if (data.status === 'success') {
                    $.each(data.incomes, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_income" data-column="income">').text(value.income));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_income" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_incomes tbody');
        cellForm.on('click', 'td.td_income', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var income_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="income" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="income_id" class="form-control" value="' + income_id +'"/>' +
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
            $('#panel_income').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/incomes/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.income.income);
                    cell.off('click');
                    $('#panel_income').unblock();
                    $.toast({
                        heading: 'تعديل مصدر دخل',
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
                    $('#panel_income').unblock();
                    $.toast({
                        heading: 'تعديل مصدر دخل',
                        text: 'تعذر تعديل المصدر دخل',
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
            fetchIncomes();
            deleteIncome();
            addIncome();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    IncomeIndex.init();
});