var RoleIndex = function () {

    var deleteRole = function () {
        $('table#table_roles').delegate('button.btn_delete_role', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_role',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkIcon: 'fa fa-check',
                btnCancelIcon: 'fa fa-close',
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var role_id = $(this).data('id');
                    var panel = $('#panel_role');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/roles',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            role_id: role_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_roles tbody').empty();
                                fetchRoles();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف مجموعة',
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
                                    heading: 'حذف مجموعة',
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
                                heading: 'حذف مجموعة',
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

    var addRole = function () {
        var modal = $('#modal_add_role');
        var btn_save = modal.find('#btn_save_add_role');
        var input = modal.find("#form_add_role input");
        var inputName = modal.find("#form_add_role input#role_name_input");
        var inputLabel = modal.find("#form_add_role input#role_label_input");
        var inputDescription = modal.find("#form_add_role textarea#role_description_input");

        modal.on('shown.bs.modal', function () {
            inputName.focus();
        });

        modal.on('hidden.bs.modal', function () {
            inputName.val('');
            inputLabel.val('');
            inputDescription.val('');
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postRole();
        });

        $('#btn_add_role').on('click', function () {
            modal.modal();
        });

        function postRole() {
            if (input.val() === '') {
                return false;
            }

            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/roles',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: inputName.val(),
                    label: inputLabel.val(),
                    description: inputDescription.val()
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_roles tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.role.id + '">');
                        tr.append($('<td>').text(tr_length));
                        tr.append($('<td>').text(data.role.name));
                        tr.append($('<td>').text(data.role.label));

                        var btn = $('<td class="column-action">' +
                                    '<a href="/roles/' + data.role.id + '?prev_page=roles" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>' +
                                    '<button type="button" class="btn btn-danger btn-sm btn_delete_role" data-id="' + data.role.id + '"><i class="fa fa-trash"></i></button>' +
                                    '</td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة مجموعة جديدة',
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
                            heading: 'إضافة مجموعة جديدة',
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
                        heading: 'إضافة مجموعة',
                        text: 'تعذرت عملية إضافة مجموعة',
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

    var fetchRoles = function () {
        $.ajax({
            url: '/ajax/roles',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_roles tbody');
                if (data.status === 'success') {
                    $.each(data.roles, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td>').text(index + 1));
                        tr.append($('<td>').text(value.name));
                        tr.append($('<td>').text(value.label));

                        var btn = $('<td class="column-action">' +
                            '<a href="/roles/' + value.id + '?prev_page=roles" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>' +
                            '<button type="button" class="btn btn-danger btn-sm btn_delete_role" data-id="' + value.id + '"><i class="fa fa-trash"></i></button>' +
                            '</td>');
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
        var cellForm = $('table#table_roles tbody');
        cellForm.on('click', 'td.td_role', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var role_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="role" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="role_id" class="form-control" value="' + role_id +'"/>' +
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
            $('#panel_role').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/roles/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.role.role);
                    cell.off('click');
                    $('#panel_role').unblock();
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
                error: function (err) {
                    cell.html(prevContent);
                    cell.off('click');
                    $('#panel_role').unblock();
                    $.toast({
                        heading: 'تعديل مجموعة',
                        text: 'تعذر تعديل المجموعة',
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
            fetchRoles();
            deleteRole();
            addRole();
            //editItem();
        }
    }
}();

jQuery(document).ready(function () {
    RoleIndex.init();
});