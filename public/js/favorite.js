$(document).ready(function () {
    $(document).on('click', '#favorite', function () {
        var $this = $(this);
        var $amount = parseInt($this.find('#favorite_amount').text());
        var token = $this.data('token');
        var type = $this.data('type');
        var id = $this.data('id');
        $.post('/favorites/' + type + '/' + id, {
            '_token': token
        }, function (result) {
            if (result.status == 'favorite') {
                $this.addClass('glyphicon-heart').addClass('favorite__color').removeClass('glyphicon-heart-empty');
                $this.find('#favorite_amount').html($amount + 1);
            } else {
                $this.addClass('glyphicon-heart-empty').removeClass('favorite__color').removeClass('glyphicon-heart');
                $this.find('#favorite_amount').html($amount - 1);
            }
        });
    });
});