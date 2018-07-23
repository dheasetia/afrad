var NationalityIndex = function () {

    var deleteNationality = function () {
        $('table#table_nationalities').delegate('button.btn_delete_nationality', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_nationality',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var nationality_id = $(this).data('id');
                    var panel = $('#panel_nationality');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/nationalities',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            nationality_id: nationality_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_nationalities tbody').empty();
                                fetchNationalities();
                                panel.unblock();
                                $.toast({
                                    heading: 'حذف جنيسية',
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
                                    heading: 'حذف جنيسية',
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
                                heading: 'حذف جنيسية',
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

    var addNationality = function () {
        var modal = $('#modal_add_nationality');
        var btn_save = modal.find('#btn_save_add_nationality');
        var input = modal.find("#form_add_nationality input#nationality_add_input");

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postNationality();
        });

        $('#btn_add_nationality').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postNationality() {
            if (input.val() === '') {
                return false;
            }
            var nationality = $('#form_add_nationality').find('input#nationality_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/nationalities',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    nationality: nationality
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_nationalities tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.nationality.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_nationality" data-column="nationality">').text(data.nationality.nationality));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_nationality" data-id="'
                            + data.nationality.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة جنيسية جديدة',
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
                            heading: 'إضافة جنيسية جديدة',
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
                        heading: 'إضافة جنيسية',
                        text: 'تعذرت عملية إضافة جنيسية',
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


    var fetchNationalities = function () {
        $.ajax({
            url: '/ajax/nationalities',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_nationalities tbody');
                if (data.status === 'success') {
                    $.each(data.nationalities, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_nationality" data-column="nationality">').text(value.nationality));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_nationality" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_nationalities tbody');
        cellForm.on('click', 'td.td_nationality', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var nationality_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="nationality" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="nationality_id" class="form-control" value="' + nationality_id +'"/>' +
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
            $('#panel_nationality').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/nationalities/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.nationality.nationality);
                    cell.off('click');
                    $('#panel_nationality').unblock();
                    $.toast({
                        heading: 'تعديل جنيسية',
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
                    $('#panel_nationality').unblock();
                    $.toast({
                        heading: 'تعديل جنسية',
                        text: 'تعذر تعديل الجنيسية',
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
            fetchNationalities();
            deleteNationality();
            addNationality();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    NationalityIndex.init();
});