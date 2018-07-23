var BankIndex = function () {

    var deleteBank = function () {
        $('table#table_banks').delegate('button.btn_delete_bank', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_bank',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var bank_id = $(this).data('id');
                    var panel = $('#panel_bank');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/banks',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            bank_id: bank_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_banks tbody').empty();
                                fetchBanks();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف بنك',
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
                                    heading: 'حذف بنك',
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
                                heading: 'حذف بنك',
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
            var bank = $('#form_add_bank').find('input#bank_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
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
                        var table = $('table#table_banks tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.bank.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_bank" data-column="bank">').text(data.bank.bank));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_bank" data-id="'
                            + data.bank.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة بنك جديد',
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
                            heading: 'إضافة بنك جديد',
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
                        heading: 'إضافة بنك',
                        text: 'تعذرت عملية إضافة بنك',
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


    var fetchBanks = function () {
        $.ajax({
            url: '/ajax/banks',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_banks tbody');
                if (data.status === 'success') {
                    $.each(data.banks, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_bank" data-column="bank">').text(value.bank));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_bank" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_banks tbody');
        cellForm.on('click', 'td.td_bank', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var bank_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="bank" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="bank_id" class="form-control" value="' + bank_id +'"/>' +
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
            $('#panel_bank').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/banks/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.bank.bank);
                    cell.off('click');
                    $('#panel_bank').unblock();
                    $.toast({
                        heading: 'تعديل بنك',
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
                    $('#panel_bank').unblock();
                    $.toast({
                        heading: 'تعديل بنك',
                        text: 'تعذر تعديل البنك',
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
            fetchBanks();
            deleteBank();
            addBank();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    BankIndex.init();
});