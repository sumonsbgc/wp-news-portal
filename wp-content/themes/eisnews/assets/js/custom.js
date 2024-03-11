; (function ($) {
    $('#news-ticker-wrap').webTicker();
    
    $(document).ready(function () {
        $(".link").on("click", function (e) {
            e.preventDefault();
            var _filter = $(this).data("filter");
            $(this).addClass('active').parent().siblings().find('a').removeClass('active');
            $("#" + _filter).addClass("active").siblings().removeClass("active");

            $.ajax({
                url: eis_ajax.url,
                type: "POST",
                data: {
                    action: "tabnews",
                    category: _filter,
                    nonce: eis_ajax.nonce,
                },
                beforeSend: function () {
                    $("#" + _filter).empty().html("Loading.....");
                },
                success: function (res) {
                    $("#" + _filter).empty().html(res.data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
        //$(window).on("scroll", function (params) {
        //    var mainnews = $("#main_news").offset().top;
        //    var category_news = $("#category_news").offset().top;
        //    var pos = $("#main_news").position().top;
        //    console.log(pos);
        //});
    });
})(jQuery);