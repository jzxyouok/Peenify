$(document).ready(function () {
    $('.bookmark').hover(function () {
        $(this).removeClass('fa-bookmark-o').addClass('fa-bookmark');
    }, function() {
        if (! $(this).hasClass('bookmark__color')) {
            $(this).removeClass('fa-bookmark').addClass('fa-bookmark-o');
        }
    });

    $(document).on('click', '.bookmark', function () {
        var $this = $(this);
        var $amount = parseInt($this.find('#bookmark_amount').text());
        var token = $this.data('token');
        var type = $this.data('type');
        var id = $this.data('id');
        $.post('/bookmarks/' + type + '/' + id, {
            '_token': token
        }, function (result) {
            if (result.status == 'bookmark') {
                $this.removeClass('fa-bookmark-o').addClass('fa-bookmark').addClass('bookmark__color');
                $this.find('#bookmark_amount').html($amount + 1);
            } else {
                $this.removeClass('bookmark__color').removeClass('fa-bookmark').addClass('fa-bookmark-o');
                $this.find('#bookmark_amount').html($amount - 1);
            }
        });
    });
});