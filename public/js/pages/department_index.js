var DepartmentIndex = function () {

    var deleteDepartment = function () {
        $('table#table_departments').delegate('button.btn_delete_department', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_department',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var department_id = $(this).data('id');
                    var panel = $('#panel_department');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/departments',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            department_id: department_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_departments tbody').empty();
                                fetchDepartments();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف إدارة',
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
                                    heading: 'حذف إدارة',
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
                                heading: 'حذف إدارة',
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

    var addDepartment = function () {
        var modal = $('#modal_add_department');
        var btn_save = modal.find('#btn_save_add_department');
        var input = modal.find("#form_add_department input#department_add_input");

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postDepartment();
        });

        $('#btn_add_department').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postDepartment() {
            if (input.val() === '') {
                return false;
            }
            var department = $('#form_add_department').find('input#department_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/departments',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    department: department
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_departments tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.department.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_department" data-column="department">').text(data.department.department));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_department" data-id="'
                            + data.department.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة إدارة جديدة',
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
                            heading: 'إضافة إدارة جديدة',
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
                        heading: 'إضافة إدارة',
                        text: 'تعذرت عملية إضافة إدارة',
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


    var fetchDepartments = function () {
        $.ajax({
            url: '/ajax/departments',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_departments tbody');
                if (data.status === 'success') {
                    $.each(data.departments, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_department" data-column="department">').text(value.department));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_department" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_departments tbody');
        cellForm.on('click', 'td.td_department', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var department_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="department" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="department_id" class="form-control" value="' + department_id +'"/>' +
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
            $('#panel_department').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/departments/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.department.department);
                    cell.off('click');
                    $('#panel_department').unblock();
                    $.toast({
                        heading: 'تعديل إدارة',
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
                    $('#panel_department').unblock();
                    $.toast({
                        heading: 'تعديل منظقة',
                        text: 'تعذر تعديل الإدارة',
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
            fetchDepartments();
            deleteDepartment();
            addDepartment();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    DepartmentIndex.init();
});