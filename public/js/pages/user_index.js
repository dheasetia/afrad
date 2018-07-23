var UserIndex = function () {
/*
    var deleteUser = function () {
        $('table#table_users').delegate('button.btn_delete_user', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_user',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkIcon: 'fa fa-check',
                btnCancelIcon: 'fa fa-close',
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var user_id = $(this).data('id');
                    var panel = $('#panel_user');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/users',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            user_id: user_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_users tbody').empty();
                                fetchUsers();
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

    var addUser = function () {
        var modal = $('#modal_add_user');
        var btn_save = modal.find('#btn_save_add_user');
        var input = modal.find("#form_add_user input");
        var inputName = modal.find("#form_add_user input#user_name_input");
        var inputLabel = modal.find("#form_add_user input#user_label_input");
        var inputDescription = modal.find("#form_add_user textarea#user_description_input");

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
            postUser();
        });

        $('#btn_add_user').on('click', function () {
            modal.modal();
        });

        function postUser() {
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
                url: '/ajax/users',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: inputName.val(),
                    label: inputLabel.val(),
                    description: inputDescription.val()
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_users tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.user.id + '">');
                        tr.append($('<td>').text(tr_length));
                        tr.append($('<td>').text(data.user.name));
                        tr.append($('<td>').text(data.user.label));

                        var btn = $('<td class="column-action">' +
                                    '<a href="/users/' + data.user.id + '?prev_page=users" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>' +
                                    '<button type="button" class="btn btn-danger btn-sm btn_delete_user" data-id="' + data.user.id + '"><i class="fa fa-trash"></i></button>' +
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

    var fetchUsers = function () {
        $.ajax({
            url: '/ajax/users',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_users tbody');
                if (data.status === 'success') {
                    $.each(data.users, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td>').text(index + 1));
                        tr.append($('<td>').text(value.name));
                        tr.append($('<td>').text(value.label));

                        var btn = $('<td class="column-action">' +
                            '<a href="/users/' + value.id + '?prev_page=users" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>' +
                            '<button type="button" class="btn btn-danger btn-sm btn_delete_user" data-id="' + value.id + '"><i class="fa fa-trash"></i></button>' +
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
        var cellForm = $('table#table_users tbody');
        cellForm.on('click', 'td.td_user', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var user_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="user" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="user_id" class="form-control" value="' + user_id +'"/>' +
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
            $('#panel_user').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/users/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.user.user);
                    cell.off('click');
                    $('#panel_user').unblock();
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
                    $('#panel_user').unblock();
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
*/

    var banUser = function () {
    $('table#table_users').delegate('button.btn_ban_user', 'mouseenter', function () {
        $(this).confirmation({
            rootSelector: '.btn_ban_user',
            title: 'تجميد حساب هذا المستخدم؟',
            singleton: true,
            popout: true,
            btnOkIcon: 'fa fa-check',
            btnCancelIcon: 'fa fa-close',
            btnOkLabel: 'نعم',
            btnCancelLabel: 'لا',
            onConfirm: function() {
                var user_id = $(this).data('id');
                var panel = $('#panel_user');
                panel.block({
                    message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                    css: {
                        border: '1px solid #fff'
                    }
                });
                $.ajax({
                    url: '/ajax/users/ban',
                    type: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id: user_id
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            panel.unblock();
                            $.toast({
                                heading: 'تجميد حساب المستخدم',
                                text: 'تم تجميد حساب مستخدم: ' + data.user_name,
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'success',
                                hideAfter: 3500,
                                textAlign: 'right',
                                stack: 6
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            panel.unblock();
                            $.toast({
                                heading: 'تجميد حساب المستخدم',
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
                            heading: 'تجميد حساب المستخدم',
                            text: 'تعذرت عملية تجميد حساب المستخدم',
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
}

    var unbanUser = function () {
        $('table#table_users').delegate('button.btn_unban_user', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_unban_user',
                title: 'تنشيط حساب هذا المستخدم؟',
                singleton: true,
                popout: true,
                btnOkIcon: 'fa fa-check',
                btnCancelIcon: 'fa fa-close',
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var user_id = $(this).data('id');
                    var panel = $('#panel_user');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/users/unban',
                        type: 'post',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            user_id: user_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                panel.unblock();
                                $.toast({
                                    heading: 'تنشيط حساب المستخدم',
                                    text: 'تم تنشيط حساب مستخدم: ' + data.user_name,
                                    position: 'top-right',
                                    loaderBg:'#ff6849',
                                    icon: 'success',
                                    hideAfter: 3500,
                                    textAlign: 'right',
                                    stack: 6
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            } else {
                                panel.unblock();
                                $.toast({
                                    heading: 'تنشيط حساب المستخدم',
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
                                heading: 'تنشيط حساب المستخدم',
                                text: 'تعذرت عملية تنشيط حساب المستخدم',
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
    }
    return {
        init: function () {
            banUser();
            unbanUser();
        }
    }
}();

jQuery(document).ready(function () {
    UserIndex.init();
});