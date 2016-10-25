$(document).ready(function () {
    $(document).on('click', '.emoji', function () {
        var $this = $(this);
        var token = $this.data('token');
        var id = $this.data('id');
        var type = $this.data('type');
        var emoji = $this.data('emoji');
        var amount = parseInt($this.find('.amount').text());

        var bad = $('#bad');
        var bad_amount = parseInt(bad.find('.amount').text());
        var like = $('#like');
        var like_amount = parseInt(like.find('.amount').text());
        $.post('/emojis/' + type + '/' + id, {
            '_token': token,
            'emoji': emoji
        }, function (result) {
            if (result.status == 'emoji') {
                $this.find('.amount').html(amount + 1);
                if (emoji == 'like') {
                    $this.addClass('like__color');
                } else {
                    $this.addClass('bad__color');
                }
            } else if (result.status == 'updateEmoji') {
                if (emoji == 'like') {
                    bad.removeClass('bad__color').find('.amount').html(bad_amount - 1);
                    $this.addClass('like__color');
                } else {
                    like.removeClass('like__color').find('.amount').html(like_amount - 1);
                    $this.addClass('bad__color');
                }

                $this.find('.amount').html(parseInt($this.find('.amount').text()) + 1);
            } else {
                $this.find('.amount').html(amount - 1);
                $this.removeClass('like__color').removeClass('bad__color');
            }
        });
    });
});