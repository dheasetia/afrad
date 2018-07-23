var JobIndex = function () {

    var deleteJob = function () {
        $('table#table_jobs').delegate('button.btn_delete_job', 'mouseenter', function () {
            $(this).confirmation({
                rootSelector: '.btn_delete_job',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {
                    var tr = $(this).closest('tr');
                    var job_id = $(this).data('id');
                    var panel = $('#panel_job');
                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/jobs',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            job_id: job_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                $('table#table_jobs tbody').empty();
                                fetchJobs();
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

    var addJob = function () {
        var modal = $('#modal_add_job');
        var btn_save = modal.find('#btn_save_add_job');
        var input = modal.find("#form_add_job input#job_add_input");

        modal.on('shown.bs.modal', function () {
            input.focus();
        });

        input.on('keydown', function (event) {
            if(event.keyCode === 13) {
                event.preventDefault();
            }
        });

        btn_save.on('click', function () {
            postJob();
        });

        $('#btn_add_job').on('click', function () {
            input.val('');
            modal.modal();
        });

        function postJob() {
            if (input.val() === '') {
                return false;
            }
            var job = $('#form_add_job').find('input#job_add_input').val();
            modal.block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/jobs',
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    job: job
                },
                success: function (data) {
                    if (data.status === 'success') {
                        var table = $('table#table_jobs tbody');
                        var tr_length = $('tr.tr_added').length + 1;
                        var tr = $('<tr class="tr_added" data-id="' + data.job.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(tr_length));
                        tr.append($('<td class="td_job" data-column="job">').text(data.job.job));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_job" data-id="'
                            + data.job.id + '"><i class="fa fa-trash"></i></button> </td>');
                        tr.append(btn);
                        tr.hide();
                        table.append(tr);
                        tr.fadeIn();

                        modal.unblock();
                        $.toast({
                            heading: 'إضافة وظيفة جديدة',
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
                            heading: 'إضافة وظيفة جديدة',
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
                        heading: 'إضافة وظيفة',
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

    var fetchJobs = function () {
        $.ajax({
            url: '/ajax/jobs',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var table = $('table#table_jobs tbody');
                if (data.status === 'success') {
                    $.each(data.jobs, function (index, value) {
                        var tr = $('<tr class="tr_added" data-id="' + value.id + '">');
                        tr.append($('<td class="td_added" data-column="seq">').text(index + 1));
                        tr.append($('<td class="td_job" data-column="job">').text(value.job));

                        var btn = $('<td class="column-action"><button type="button" class="btn btn-danger btn-sm btn_delete_job" data-id="' + value.id + '"><i class="fa fa-trash"></i></button> </td>');
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
        var cellForm = $('table#table_jobs tbody');
        cellForm.on('click', 'td.td_job', function () {
            displayForm($(this));
        });

        function displayForm(cell) {
            var job_id = cell.closest('tr').data('id'),
                prevContent = cell.text(),
                form =  '<form>' +
                    '<input type="text" name="job" class="form-control" value="' + prevContent + '"/>' +
                    '<input type="hidden" name="job_id" class="form-control" value="' + job_id +'"/>' +
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
            $('#panel_job').block({
                message: '<h4><img src="../plugins/images/busy.gif" /> جاري العملية ... </h4>',
                css: {
                    border: '1px solid #fff'
                }
            });

            $.ajax({
                url: '/ajax/jobs/edit',
                type: 'post',
                dataType: 'JSON',
                data: post_data,
                success: function (data) {
                    cell.html(data.job.job);
                    cell.off('click');
                    $('#panel_job').unblock();
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
                    $('#panel_job').unblock();
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
            fetchJobs();
            deleteJob();
            addJob();
            editItem();
        }
    }
}();

jQuery(document).ready(function () {
    JobIndex.init();
});