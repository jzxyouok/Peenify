$(document).ready(function () {
    $(document).on('click', '#collection', function () {
        var $this = $(this);
        var token = $this.data('token');
        var collection = $this.data('collection');
        var id = $this.data('id');
        $.post('/collections/' + collection + '/product/' + id, {
            '_token': token
        }, function (result) {
            if (result.status == 'attach') {
                $this.addClass('collection__color');
            } else {
                $this.removeClass('collection__color');
            }
        });
    });
});