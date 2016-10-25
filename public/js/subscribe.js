$(document).ready(function () {
    $(document).on('click', '.subscribe', function () {
        var $this = $(this);
        var token = $this.data('token');
        var id = $this.data('id');
        var type = $this.data('type');
        var subscribe = $('#subscribe' + id);
        var subscribe_amount = parseInt(subscribe.find('#amount').text());
        $.post('/subscribes/' + type + '/' + id, {
            '_token': token
        }, function (result) {
            if (result.status == 'subscribe') {
                subscribe.find('#amount').html(subscribe_amount + 1);
                $this.addClass('btn-danger').removeClass('btn-default').text('取消');
            } else {
                subscribe.find('#amount').html(subscribe_amount - 1);
                $this.addClass('btn-default').removeClass('btn-danger').text('訂閱');
            }
        });
    });
});