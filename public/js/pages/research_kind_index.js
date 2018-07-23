var ResearchKindIndex = function () {

    var deleteResearchKind = function () {
        $('table#table_kinds').delegate('button.btn_delete_kind', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_kind',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var kind_id = $(this).data('id');
                    var panel = $('#panel_kind');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/research-kinds',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            kind_id: kind_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_kinds tbody').empty();
                                fetchResearchKinds();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف نوع حالة',
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
                                    heading: 'حذف نوع حالة',
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
                                heading: 'حذف نوع حالة',
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

    var addResearchKind = function () {
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
            postResearchKind();
        });

        $('#btn_add_kind').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postResearchKind() {
            if (input.val() === '') {
                return false;
            }
            var kind = $('#form_add_kind').find('input#kind_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/research-kinds',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    kind: kind
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_kinds tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.kind.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_kind" data-column="kind">').text(data.kind.kind));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_kind" data-id="'
                            + data.kind.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة نوع حالة ',
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
                            heading: 'إضافة نوع حالة ',
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
                        heading: 'إضافة نوع حالة',
                        text: 'تعذرت عملية إضافة نوع حالة',
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


    var fetchResearchKinds = function () {
        $.ajax({
            url: '/ajax/research-kinds',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_kinds tbody');
                if (data.status === 'success') {
                    $.each(data.kinds, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_kind" data-column="kind">').text(value.kind));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_kind" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_kinds tbody');
        cellForm.on('click', 'td.td_kind', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var kind_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="kind" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="kind_id" class="form-control" value="' + kind_id +'"/>' +
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
            $('#panel_kind').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/research-kinds/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.kind.kind);
                    cell.off('click');
                    $('#panel_kind').unblock();
                    $.toast({
                        heading: 'تعديل نوع حالة',
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
                    $('#panel_kind').unblock();
                    $.toast({
                        heading: 'تعديل نوع حالة',
                        text: 'تعذر تعديل نوع حالة',
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
            fetchResearchKinds();
            deleteResearchKind();
            addResearchKind();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    ResearchKindIndex.init();
});