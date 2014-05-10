$(function() {
    var feed_up_button = $(".feed-up");
    var feed_down_button = $(".feed-down");
    var feed_block_button = $(".feed-block");

    feed_block_button.click(function() {
        var self = this;
        var feed_id = $(self).attr('data-id');

        $.post('/feed/block', { feed_id: feed_id }, function(data) {
            result = $.parseJSON(data);
            if (result.is_success) {
                // TODO >> Remove all that has the same token
                $(self).closest("tr").detach();
            }
        }).fail(function() {
            console.log('BLOCK FAILED');
        });
    });

    feed_up_button.click(function() {
        var feed_id = $(this).attr('data-id');

        $.post('/feed/vote', { feed_id: feed_id, type: 'positive' }, function(data) {
            result = $.parseJSON(data);
            if (result.is_success) {
                // TODO >> Update DOM score value
                console.log("+1");
            }
        }).fail(function() {
            console.log('BLOCK FAILED');
        });
    });

    feed_down_button.click(function() {
        var feed_id = $(this).attr('data-id');
        $.post('/feed/vote', { feed_id: feed_id, type: 'negative' }, function(data) {
            result = $.parseJSON(data);
            if (result.is_success) {
                // TODO >> Update DOM score value
                console.log("-1");
            }
        }).fail(function() {
            console.log('BLOCK FAILED');
        });
    });
});