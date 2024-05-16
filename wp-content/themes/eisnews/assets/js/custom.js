document.addEventListener("DOMContentLoaded", function () {
	document.querySelector(".loader-wrapper").style.display = "flex";
});

window.addEventListener("load", function () {
	document.querySelector(".loader-wrapper").style.display = "none";
});

(function ($) {
	$(document).ready(function () {
		$("#news-ticker-wrap").webTicker({
			height: "100%",
		});

		sticky_header();
		
		filterNews("literature-and-culture", "bg-pink", "border-pink");

		function sticky_header() {
			let bottomHeader = $(".bottom-header");
			let headerOffset = bottomHeader.offset().top + bottomHeader.height();
			$(window).on("scroll", function (params) {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > headerOffset) {
					if (!bottomHeader.hasClass("stick-header")) {
						// bottomHeader.addClass("stick-header");
						bottomHeader.addClass("stick-header");
						bottomHeader.stop().animate({ top: "0" }, 1000);
					}
				} else {
					bottomHeader.removeClass("stick-header");
					bottomHeader.animate({ top: "" }, 300); // Animate to default position
				}
			});
		}

		function filterNews(category, bgColor, borderColor) {
			var _filter = category;
			var _bg_color = bgColor;
			var _border_color = borderColor;

			$.ajax({
				url: eis_ajax.url,
				type: "POST",
				data: {
					action: "tabnews",
					category: _filter,
					bgColor: _bg_color,
					borderColor: _border_color,
					nonce: eis_ajax.nonce,
				},
				beforeSend: function () {
					$("#" + _filter)
						.empty()
						.html("Loading.....");
				},
				success: function (res) {
					$(".tab_content").empty().toggleClass(_border_color).html(res.data);
				},
				error: function (err) {
					console.log(err);
				},
			});
		}

		$(".link").on("click", function (e) {
			e.preventDefault();
			var _filter = $(this).data("filter");
			var _bg_color = $(this).data("bg");
			var _border_color = $(this).data("border");

			$(this)
				.addClass("active")
				.parent()
				.siblings()
				.find("a")
				.removeClass("active");

			// $("#" + _filter)
			// 	.addClass("active")
			// 	.siblings()
			// 	.removeClass("active");

			filterNews(_filter, _bg_color, _border_color);
		});
	});
})(jQuery);
