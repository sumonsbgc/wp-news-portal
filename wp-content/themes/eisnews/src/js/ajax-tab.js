jQuery(document).ready(function ($) {
	var ajaxUrl = ajaxTabData.ajaxUrl;
	var _nonce = ajaxTabData.nonce;
	var activeTab = ajaxTabData.activeTab;
	var categories = ajaxTabData.categories;

	$(".tabs-filter li").click(function (e) {
		e.preventDefault();

		var clickedTab = $(this).data("tab");
		
		var activeBg = $(this).data("active");
		var defaultBg = $(this).data('bg');

		$(this).addClass(activeBg).removeClass(defaultBg).siblings().addClass(defaultBg);

		$(".ajax-tabs-content .tab-content").addClass("hidden").removeClass('active');
		$(
			'.ajax-tabs-content .tab-content[data-tab="' + clickedTab + '"]'
		).removeClass("hidden").addClass('active');

		// Make AJAX request to fetch content for the new tab (if not already loaded)
		if (
			$('.ajax-tabs-content .tab-content[data-tab="' + clickedTab + '"]')
				.html()
				.trim() === ""
		) {
      $.ajax({
				url: ajaxUrl,
				type: "POST",
				data: {
					action: "tabnews",
					category: clickedTab,
					// bgColor: _bg_color,
					// borderColor: _border_color,
					nonce: _nonce,
				},
				beforeSend: function () {
					$("#" + clickedTab)
						.empty()
						.html("Loading.....");
				},
				success: function (res) {
					// $(".tab_content").empty().toggleClass(_border_color).html(res.data);
          $(
						'.ajax-tabs-content .tab-content[data-tab="' + clickedTab + '"]'
					).html(res.data);
				},
				error: function (err) {
					console.log(err);
				},
			});

			// $.ajax({
			// 	url: ajaxUrl,
			// 	type: "post",
			// 	data: {
			// 		action: "fetch_category_news", // Custom action for AJAX request
			// 		category: clickedTab,
			// 	},
			// 	success: function (response) {
					// $(
					// 	'.ajax-tabs-content .tab-content[data-tab="' + clickedTab + '"]'
					// ).html(response);
			// 	},
			// });
		}
	});
});
