var NeedIndex = function () {

    var deleteNeed = function () {
        $('table#table_needs').delegate('button.btn_delete_need', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_need',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var need_id = $(this).data('id');
                    var panel = $('#panel_need');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/item-needs',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            need_id: need_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_needs tbody').empty();
                                fetchNeeds();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف وظيفة',
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
                                    heading: 'حذف وظيفة',
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
                                heading: 'حذف وظيفة',
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

    var addNeed = function () {
        var modal = $('#modal_add_need');
        var btn_save = modal.find('#btn_save_add_need');
        var input = modal.find("#form_add_need input#need_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postNeed();
        });

        $('#btn_add_need').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postNeed() {
            if (input.val() === '') {
                return false;
            }
            var need = $('#form_add_need').find('input#need_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/item-needs',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    item: need
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_needs tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.need.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_need" data-column="need">').text(data.need.item));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_need" data-id="'
                            + data.need.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة احتياج مالي ',
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
                            heading: 'إضافة احتياح مالي ',
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
                        heading: 'إضافة اجتياج مالي',
                        text: 'تعذرت عملية إضافة وظيفة',
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


    var fetchNeeds = function () {
        $.ajax({
            url: '/ajax/item-needs',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_needs tbody');
                if (data.status === 'success') {
                    $.each(data.needs, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_need" data-column="need">').text(value.item));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_need" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_needs tbody');
        cellForm.on('click', 'td.td_need', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var need_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="item" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="need_id" class="form-control" value="' + need_id +'"/>' +
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
            $('#panel_need').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري التعديل ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/item-needs/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.need.item);
                    cell.off('click');
                    $('#panel_need').unblock();
                    $.toast({
                        heading: 'تعديل وظيفة',
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
                    $('#panel_need').unblock();
                    $.toast({
                        heading: 'تعديل وظيفة',
                        text: 'تعذر تعديل الوظيفة',
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
            fetchNeeds();
            deleteNeed();
            addNeed();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    NeedIndex.init();
});