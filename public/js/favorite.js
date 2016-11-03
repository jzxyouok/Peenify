$(document).ready(function () {
    $('.favorite').hover(function () {
        $(this).removeClass('fa-heart-o').addClass('fa-heart');
    }, function() {
        if (! $(this).hasClass('favorite__color')) {
            $(this).removeClass('fa-heart').addClass('fa-heart-o');
        }
    });

    $(document).on('click', '.favorite', function () {
        var $this = $(this);
        var $amount = parseInt($this.find('#favorite_amount').text());
        var token = $this.data('token');
        var type = $this.data('type');
        var id = $this.data('id');
        $.post('/favorites/' + type + '/' + id, {
            '_token': token
        }, function (result) {
            if (result.status == 'favorite') {
                $this.removeClass('fa-heart-o').addClass('fa-heart').addClass('favorite__color');
                $this.find('#favorite_amount').html($amount + 1);
            } else {
                $this.removeClass('favorite__color').removeClass('fa-heart').addClass('fa-heart-o');
                $this.find('#favorite_amount').html($amount - 1);
            }
        });
    });
});