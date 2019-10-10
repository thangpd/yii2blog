(function ($) {
    'use strict';
    
    var pjaxGetUrl = function (layout) {
        var current_url = window.location.href;
        if (current_url.includes('layout=') != false) {
            current_url = current_url.replace('layout=' + (layout == 'gridview' ? 'listview' : 'gridview'), 'layout=' + layout)
        } else {
            if (current_url.includes('?') != false) current_url += '&layout=';
            else current_url += '?layout=';
            current_url += layout;
        }
        console.log(current_url);
        return current_url;
    }

    $(document).on('click', 'a.list-view', function (e) {
        e.preventDefault();
        var ajax_url = pjaxGetUrl('listview');
        $.pjax.reload({url: ajax_url, container: '#blog-pjax'})
    });
    $(document).on('click', 'a.grid-view', function (e) {
        e.preventDefault();
        var ajax_url = pjaxGetUrl('gridview');
        $.pjax.reload({url: ajax_url, container: '#blog-pjax'})
    });
    $(document).ready(function () {
        pjaxGetUrl();
    });

})(jQuery);