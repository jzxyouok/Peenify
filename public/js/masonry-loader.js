$(document).ready(function() {
    var $boxes = $('.grid-item');
    $boxes.hide();

    var $container = $('.grid');
    $container.imagesLoaded( function() {
        $boxes.fadeIn();

        $container.masonry({
            itemSelector : '.grid-item'
        });
    });
});