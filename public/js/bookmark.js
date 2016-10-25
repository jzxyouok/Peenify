$(document).ready(function () {
    $(document).on('click', '#bookmark', function () {
        var $this = $(this);
        var $amount = parseInt($this.find('#bookmark_amount').text());
        var token = $this.data('token');
        var type = $this.data('type');
        var id = $this.data('id');
        $.post('/bookmarks/' + type + '/' + id, {
            '_token': token
        }, function (result) {
            if (result.status == 'bookmark') {
                $this.addClass('bookmark__color');
                $this.find('#bookmark_amount').html($amount + 1);
            } else {
                $this.removeClass('bookmark__color').removeClass('glyphicon-heart');
                $this.find('#bookmark_amount').html($amount - 1);
            }
        });
    });
});