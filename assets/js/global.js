import 'bootstrap/dist/js/bootstrap.bundle';


const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

jQuery(document).ready(function () {
    var $wrapperImg = $('.js-image-wrapper');
    $wrapperImg.on('click', '.js-remove-image', function (e) {
        e.preventDefault();

        $(this).closest('.js-item')
            .fadeOut()
            .remove();
    });
    $wrapperImg.on('click', '.js-add-image', function (e) {
        e.preventDefault();


        // Get the data-prototype explained earlier
        var prototype = $wrapperImg.data('prototype');

        // get the new index
        var index = $wrapperImg.data('index');

        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $wrapperImg.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        $(this).before(newForm);
    })
   var $wrapperVdo = $('.js-video-wrapper');
    $wrapperVdo.on('click', '.js-remove-video', function (e) {
        e.preventDefault();

        $(this).closest('.js-item')
            .fadeOut()
            .remove();
    });
    $wrapperVdo.on('click', '.js-add-video', function (e) {
        e.preventDefault();


        // Get the data-prototype explained earlier
        var prototype = $wrapperVdo.data('prototype');

        // get the new index
        var index = $wrapperVdo.data('index');

        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $wrapperVdo.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        $(this).before(newForm);
    })


});
