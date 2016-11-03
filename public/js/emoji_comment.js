$(document).ready(function () {
    $('#like_comment').hover(function () {
        $(this).removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
    }, function() {
        if (! $(this).hasClass('like__color')) {
            $(this).removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
        }
    });

    $('#bad_comment').hover(function () {
        $(this).removeClass('fa-thumbs-o-down').addClass('fa-thumbs-down');
    }, function() {
        if (! $(this).hasClass('bad__color')) {
            $(this).removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
        }
    });

    $(document).on('click', '.emoji_comment', function () {
        var $this = $(this);
        var token = $this.data('token');
        var id = $this.data('id');
        var type = $this.data('type');
        var emoji = $this.data('emoji');
        var amount = parseInt($this.find('.amount').text());

        var bad = $('#bad_comment' + id);
        var bad_amount = parseInt(bad.find('.amount').text());
        var like = $('#like_comment' + id);
        var like_amount = parseInt(like.find('.amount').text());
        $.post('/emojis/' + type + '/' + id, {
            '_token': token,
            'emoji': emoji
        }, function (result) {
            if (result.status == 'emoji') {
                $this.find('.amount').html(amount + 1);
                if (emoji == 'like') {
                    $this.addClass('fa-thumbs-up').removeClass('fa-thumbs-o-up').addClass('like__color');
                } else {
                    $this.addClass('fa-thumbs-down').removeClass('fa-thumbs-o-down').addClass('bad__color');
                }
            } else if (result.status == 'updateEmoji') {
                if (emoji == 'like') {
                    bad.removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down').removeClass('bad__color').find('.amount').html(bad_amount - 1);
                    $this.removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up').addClass('like__color');
                } else {
                    like.removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up').removeClass('like__color').find('.amount').html(like_amount - 1);
                    $this.removeClass('fa-thumbs-o-down').addClass('fa-thumbs-down').addClass('bad__color');
                }

                $this.find('.amount').html(parseInt($this.find('.amount').text()) + 1);
            } else {
                $this.find('.amount').html(amount - 1);
                if (emoji == 'like') {
                    $this.addClass('fa-thumbs-o-up').removeClass('fa-thumbs-up').removeClass('like__color');
                }
                else {
                    $this.addClass('fa-thumbs-o-down').removeClass('fa-thumbs-down').removeClass('bad__color');
                }
            }
        });
    });
});