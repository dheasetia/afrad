var FamilyRoleIndex = function () {

    var deleteFamilyRole = function () {
        $('table#table_roles').delegate('button.btn_delete_role', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_role',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var role_id = $(this).data('id');
                    var panel = $('#panel_role');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/family-roles',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            role_id: role_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_roles tbody').empty();
                                fetchFamilyRoles();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف علاقة أسرية',
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
                                    heading: 'حذف علاقة أسرية',
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
                                heading: 'حذف علاقة أسرية',
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

    var addFamilyRole = function () {
        var modal = $('#modal_add_role');
        var btn_save = modal.find('#btn_save_add_role');
        var input = modal.find("#form_add_role input#role_add_input");

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postFamilyRole();
        });

        $('#btn_add_role').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postFamilyRole() {
            if (input.val() === '') {
                return false;
            }
            var role = $('#form_add_role').find('input#role_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/family-roles',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    role: role
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_roles tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.role.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_role" data-column="role">').text(data.role.role));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_role" data-id="'
                            + data.role.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة علاقة أسرية جديدة',
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
                            heading: 'إضافة علاقة أسرية جديدة',
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
                        heading: 'إضافة علاقة أسرية',
                        text: 'تعذرت عملية إضافة علاقة أسرية',
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


    var fetchFamilyRoles = function () {
        $.ajax({
            url: '/ajax/family-roles',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_roles tbody');
                if (data.status === 'success') {
                    $.each(data.roles, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_role" data-column="role">').text(value.role));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_role" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
                url: '/ajax/family-roles/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.role.role);
                    cell.off('click');
                    $('#panel_role').unblock();
                    $.toast({
                        heading: 'تعديل علاقة أسرية',
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
                        heading: 'تعديل علاقة أسرية',
                        text: 'تعذر تعديل العلاقة الأسرية',
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
            fetchFamilyRoles();
            deleteFamilyRole();
            addFamilyRole();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    FamilyRoleIndex.init();
});