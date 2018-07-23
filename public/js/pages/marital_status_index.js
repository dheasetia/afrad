var MaritalStatusIndex = function () {

    var deleteMaritalStatus = function () {
        $('table#table_statuses').delegate('button.btn_delete_status', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_status',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var status_id = $(this).data('id');
                    var panel = $('#panel_status');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/marital-statuses',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            status_id: status_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_statuses tbody').empty();
                                fetchMaritalStatuses();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف حالة اجتماعية',
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
                                    heading: 'حذف حالة اجتماعية',
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
                                heading: 'حذف حالة اجتماعية',
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

    var addMaritalStatus = function () {
        var modal = $('#modal_add_status');
        var btn_save = modal.find('#btn_save_add_status');
        var input = modal.find("#form_add_status input#status_add_input");

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postMaritalStatus();
        });

        $('#btn_add_status').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postMaritalStatus() {
            if (input.val() === '') {
                return false;
            }
            var status = $('#form_add_status').find('input#status_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/marital-statuses',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status: status
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_statuses tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.marital_status.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_status" data-column="status">').text(data.marital_status.status));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_status" data-id="'
                            + data.marital_status.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة حالة اجتماعية جديدة',
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
                            heading: 'إضافة حالة اجتماعية جديدة',
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
                        heading: 'إضافة حالة اجتماعية',
                        text: 'تعذرت عملية إضافة حالة اجتماعية',
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


    var fetchMaritalStatuses = function () {
        $.ajax({
            url: '/ajax/marital-statuses',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_statuses tbody');
                if (data.status === 'success') {
                    $.each(data.statuses, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_status" data-column="status">').text(value.status));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_status" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_statuses tbody');
        cellForm.on('click', 'td.td_status', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var status_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="status" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="status_id" class="form-control" value="' + status_id +'"/>' +
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
            $('#panel_status').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/marital-statuses/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.status.status);
                    cell.off('click');
                    $('#panel_status').unblock();
                    $.toast({
                        heading: 'تعديل حالة اجتماعية',
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
                    $('#panel_status').unblock();
                    $.toast({
                        heading: 'تعديل منظقة',
                        text: 'تعذر تعديل الحالة اجتماعية',
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
            fetchMaritalStatuses();
            deleteMaritalStatus();
            addMaritalStatus();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    MaritalStatusIndex.init();
});