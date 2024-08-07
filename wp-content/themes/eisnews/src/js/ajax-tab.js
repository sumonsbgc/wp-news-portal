jQuery(document).ready(function ($) {
	$(".filter").on("click", function (e) {
		e.preventDefault();
		const ajaxUrl = ajaxTabData.ajaxUrl;
		const _nonce = ajaxTabData.nonce;

		const _activeTab = $(this).data("tab");
		const activeBg = $(this).data("active-bg");
		const borderColor = $(this).data("border-color");

		$(this)
			.removeClass("filter-inactive")
			.addClass("active")
			.siblings()
			.removeClass("active")
			.addClass("filter-inactive");

		$("#" + _activeTab)
			.removeClass("hidden")
			.addClass("active")
			.siblings()
			.removeClass("active")
			.addClass("hidden");

			$("#" + _activeTab).html("")

		// Make AJAX request to fetch content for the new tab (if not already loaded)
		if (
			$("#" + _activeTab)
				.html().trim() === ""
		) {
			$.ajax({
				url: ajaxUrl,
				type: "POST",
				data: {
					action: "tabnews",
					category: _activeTab,
					bgColor: activeBg,
					borderColor: borderColor,
					nonce: _nonce,
				},
				beforeSend: function () {
					$("#" + _activeTab)
						.empty()
						.html(
							'<div class="flex justify-center items-center h-[420px] w-full">Loading.....</div>'
						);
				},
				success: function (res) {
					$("#" + _activeTab).html(res.data);
				},
				error: function (err) {
					console.log(err, ">>> Error Axjax Response");
				},
			});
		}
	});
});
