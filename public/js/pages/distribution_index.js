var DistributionIndex = function () {
    var deleteDistribution = function () {
        $('table#table_distributions').delegate('button.btn_delete_distribution', 'mouseenter', function () {
            var distribution_id = $(this).data('id');
            var tr = $(this).closest('tbody').find('tr#tr_' + distribution_id);
            var panel = $('#panel_distribution');
            $(this).confirmation({
                rootSelector: '.btn_delete_distribution',
                title: 'هل أنت متأكد؟',
                singleton: true,
                popout: true,
                btnOkLabel: 'نعم',
                btnCancelLabel: 'لا',
                onConfirm: function() {

                    panel.block({
                        message: '<h4><img src="../plugins/images/busy.gif" /> جاري الحذف ... </h4>',
                        css: {
                            border: '1px solid #fff'
                        }
                    });
                    $.ajax({
                        url: '/ajax/distributions',
                        type: 'delete',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            distribution_id: distribution_id
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                panel.unblock();
                                console.log(tr);
                                tr.hide('slow', function () {
                                    tr.remove();
                                });
                                $.toast({
                                    heading: 'حذف مساعدة',
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
                                    heading: 'حذف مساعدة',
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
                                heading: 'حذف مساعدة',
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

    return {
        init: function () {
            deleteDistribution();
        }
    }
}();
$(document).ready(function () {
    DistributionIndex.init();
});