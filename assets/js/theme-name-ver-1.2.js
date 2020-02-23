/*Public JS - Version 1.1*/
(function ($) {
    $(document).ready(function () {
        var $window = $(window);
        $window.on("load", function () {

        });

        $('.top-left-social').find('a').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: data.ajax_url,
                type: 'post',
                data: {
                    action: 'sample_ajax_call_1',
                    msn_ajax_sample: data.msn_ajax_sample,
                    security: data.ajax_nonce
                },
                success: function (response) {
                    console.log(response);
                },
                error: function () {

                }
            });
        });

        $(document).on('click', '.msn-sample-vote', function (e) {
            e.preventDefault();
            var $this = $(this);
            var $post_id = $this.data('pid');
            if ($this.data('liked')) {
                alert('You have voted already!!!');
                return false;
            }
            $.ajax({
                url: data.ajax_url,
                type: 'post',
                //dataType: 'Text',
                dataType: 'json',
                data: {
                    action: 'sample_ajax_call_2',
                    security: data.ajax_nonce,
                    post_id: $post_id
                },
                success: function (response) {

                    //var response = JSON.parse(response);
                    if (response.success) {
                        var itag = $this.find('.msn-sample-count');
                        itag.html(response.count);
                        $this.data('liked', 1);
                        itag.addClass('msn-red');
                    }
                },
                error: function () {

                }
            });


        });


    });

})(jQuery);