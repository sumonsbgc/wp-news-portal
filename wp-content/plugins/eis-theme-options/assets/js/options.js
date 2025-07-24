document.addEventListener("DOMContentLoaded", function () {
	const sportsContainer = document.getElementById("sports-container");
	const addSportsBtn = document.getElementById("add-sports-news");
	const youtubePlaylistContainer = document.getElementById(
		"youtube-playlist-container"
	);
	const addYoutubePlaylistBtn = document.getElementById("add-youtube-playlist");
	const imageInput = document.getElementById("imageInput");
	const uploadBtn = document.getElementById("uploadBtn");
	const removeBtn = document.getElementById("removeBtn");
	const imagePreview = document.getElementById("imagePreview");
	const form = document.querySelector(".eis-options-form");

	let sportsRowCount = sportsContainer ? sportsContainer.children.length : 0;
	let playlistRowCount = youtubePlaylistContainer
		? youtubePlaylistContainer.children.length
		: 0;

	// Sports News Management
	if (addSportsBtn && sportsContainer) {
		addSportsBtn.addEventListener("click", function () {
			const newRow = document.createElement("div");
			newRow.className = "sports-row dynamic-field-row";
			newRow.innerHTML = `
        <div class="sports-inputs">
          <div class="input-group">
            <label>Sports Name</label>
            <input type="text" name="sports[${sportsRowCount}][sports_name]" 
                   value="" class="regular-text" placeholder="Enter sports name" />
          </div>
          <div class="input-group">
            <label>Sports News</label>
            <textarea name="sports[${sportsRowCount}][sports_news]" 
                      rows="1" class="large-text" placeholder="Enter sports news"></textarea>
          </div>
        </div>
        <button type="button" class="button-secondary remove-sports">
          Remove
        </button>
      `;

			sportsContainer.appendChild(newRow);
			sportsRowCount++;

			// Add animation
			newRow.style.opacity = "0";
			newRow.style.transform = "translateY(-10px)";
			setTimeout(() => {
				newRow.style.transition = "all 0.3s ease";
				newRow.style.opacity = "1";
				newRow.style.transform = "translateY(0)";
			}, 10);
		});

		// Remove sports news
		sportsContainer.addEventListener("click", function (e) {
			if (e.target.closest(".remove-sports")) {
				const row = e.target.closest(".sports-row");
				if (row && sportsContainer.children.length > 1) {
					// Add exit animation
					row.style.transition = "all 0.3s ease";
					row.style.opacity = "0";
					row.style.transform = "translateX(-100%)";

					setTimeout(() => {
						row.remove();
						reindexSportsRows();
					}, 300);
				} else if (sportsContainer.children.length === 1) {
					showNotification("At least one sports entry is required.", "warning");
				}
			}
		});
	}

	// YouTube Playlist Management
	if (addYoutubePlaylistBtn && youtubePlaylistContainer) {
		addYoutubePlaylistBtn.addEventListener("click", function () {
			const newRow = document.createElement("div");
			newRow.className = "dynamic-field-row";
			newRow.innerHTML = `
        <input name="ytd_playlist_id[]" type="text" value="" 
               class="regular-text" placeholder="Enter Playlist ID" />
        <button type="button" class="button-secondary remove-field">
          Remove
        </button>
      `;

			youtubePlaylistContainer.appendChild(newRow);
			playlistRowCount++;

			// Add animation
			newRow.style.opacity = "0";
			newRow.style.transform = "translateY(-10px)";
			setTimeout(() => {
				newRow.style.transition = "all 0.3s ease";
				newRow.style.opacity = "1";
				newRow.style.transform = "translateY(0)";
			}, 10);
		});

		// Remove playlist
		youtubePlaylistContainer.addEventListener("click", function (e) {
			if (e.target.closest(".remove-field")) {
				const row = e.target.closest(".dynamic-field-row");
				if (row && youtubePlaylistContainer.children.length > 1) {
					// Add exit animation
					row.style.transition = "all 0.3s ease";
					row.style.opacity = "0";
					row.style.transform = "translateX(-100%)";

					setTimeout(() => {
						row.remove();
						playlistRowCount--;
					}, 300);
				} else if (youtubePlaylistContainer.children.length === 1) {
					// Clear the input instead of removing the row
					const input = row.querySelector("input");
					if (input) input.value = "";
				}
			}
		});
	}

	// Image Upload Management
	if (uploadBtn && imageInput && imagePreview && removeBtn) {
		uploadBtn.addEventListener("click", () => {
			imageInput.click();
		});

		imageInput.addEventListener("change", (e) => {
			const file = e.target.files[0];
			if (file) {
				if (!file.type.startsWith("image/")) {
					showNotification("Please select a valid image file.", "error");
					return;
				}

				if (file.size > 5 * 1024 * 1024) {
					// 5MB limit
					showNotification("File size must be less than 5MB.", "error");
					return;
				}

				const reader = new FileReader();
				reader.onload = function (e) {
					imagePreview.innerHTML = `<img src="${e.target.result}" class="preview-image" />`;
					removeBtn.style.display = "inline-flex";
					showNotification("Image selected successfully!", "success");
				};
				reader.readAsDataURL(file);
			}
		});

		removeBtn.addEventListener("click", () => {
			imageInput.value = "";
			imagePreview.innerHTML = "";
			removeBtn.style.display = "none";
			showNotification("Image removed.", "info");
		});
	}

	// Form Validation
	if (form) {
		form.addEventListener("submit", function (e) {
			// Temporarily disable validation to allow form submission
			// if (!validateForm()) {
			// 	e.preventDefault();
			// 	return false;
			// }

			// Show loading state
			form.classList.add("loading");
			const submitBtn = form.querySelector('input[type="submit"]');
			if (submitBtn) {
				submitBtn.value = "Saving...";
				submitBtn.disabled = true;
			}
		});
	}

	// Utility Functions
	function reindexSportsRows() {
		const rows = sportsContainer.querySelectorAll(".sports-row");
		rows.forEach((row, index) => {
			const nameInput = row.querySelector("input[name*='sports_name']");
			const newsTextarea = row.querySelector("textarea[name*='sports_news']");

			if (nameInput) nameInput.name = `sports[${index}][sports_name]`;
			if (newsTextarea) newsTextarea.name = `sports[${index}][sports_news]`;
		});
		sportsRowCount = rows.length;
	}

	function validateForm() {
		let isValid = true;
		const errors = [];

		// Validate required fields
		const requiredFields = [
			{ selector: 'input[name="editor_name"]', name: "Editor Name" },
			{ selector: 'input[name="publisher_name"]', name: "Publisher Name" },
		];

		requiredFields.forEach((field) => {
			const element = document.querySelector(field.selector);
			if (element && !element.value.trim()) {
				errors.push(`${field.name} is required.`);
				element.style.borderColor = "#dc3545";
				isValid = false;
			} else if (element) {
				element.style.borderColor = "";
			}
		});

		// Validate YouTube API Key format (basic validation)
		const apiKeyInput = document.querySelector('input[name="ytd_api_key"]');
		if (apiKeyInput && apiKeyInput.value && apiKeyInput.value.length < 30) {
			errors.push("YouTube API Key appears to be invalid.");
			apiKeyInput.style.borderColor = "#dc3545";
			isValid = false;
		} else if (apiKeyInput) {
			apiKeyInput.style.borderColor = "";
		}

		// Validate sports entries
		const sportsInputs = document.querySelectorAll(
			'input[name*="sports_name"]'
		);
		sportsInputs.forEach((input, index) => {
			const newsTextarea = document.querySelector(
				`textarea[name="sports[${index}][sports_news]"]`
			);
			if (input.value.trim() && newsTextarea && !newsTextarea.value.trim()) {
				errors.push(`Sports news is required for "${input.value}".`);
				newsTextarea.style.borderColor = "#dc3545";
				isValid = false;
			} else if (newsTextarea) {
				newsTextarea.style.borderColor = "";
			}
		});

		if (errors.length > 0) {
			showNotification(errors.join("<br>"), "error");
		}

		return isValid;
	}

	function showNotification(message, type = "info") {
		// Remove existing notifications
		const existingNotifications =
			document.querySelectorAll(".eis-notification");
		existingNotifications.forEach((n) => n.remove());

		const notification = document.createElement("div");
		notification.className = `notice notice-${type} eis-notification`;
		notification.innerHTML = `<p>${message}</p>`;

		const wrap = document.querySelector(".eis-theme-options");
		if (wrap) {
			wrap.insertBefore(notification, wrap.firstChild);

			// Auto dismiss after 5 seconds
			setTimeout(() => {
				notification.style.opacity = "0";
				setTimeout(() => notification.remove(), 300);
			}, 5000);
		}
	}

	// Auto-save draft functionality
	let autoSaveTimeout;
	const autoSaveInputs = document.querySelectorAll("input, textarea, select");

	autoSaveInputs.forEach((input) => {
		input.addEventListener("input", function () {
			clearTimeout(autoSaveTimeout);
			autoSaveTimeout = setTimeout(() => {
				saveDraft();
			}, 2000); // Save draft after 2 seconds of inactivity
		});
	});

	function saveDraft() {
		const formData = new FormData(form);
		const draftData = {};

		for (let [key, value] of formData.entries()) {
			if (
				key !== "submit_options" &&
				key !== "_wpnonce" &&
				key !== "_wp_http_referer"
			) {
				draftData[key] = value;
			}
		}

		localStorage.setItem("eis_theme_options_draft", JSON.stringify(draftData));
	}

	function loadDraft() {
		const draftData = localStorage.getItem("eis_theme_options_draft");
		if (draftData) {
			try {
				const data = JSON.parse(draftData);
				Object.keys(data).forEach((key) => {
					const element = document.querySelector(`[name="${key}"]`);
					if (element && !element.value) {
						element.value = data[key];
					}
				});
			} catch (e) {
				console.log("Could not load draft data");
			}
		}
	}

	// Load draft on page load
	loadDraft();

	// Clear draft on successful save
	if (window.location.search.includes("status=success")) {
		localStorage.removeItem("eis_theme_options_draft");
	}

	// Enhanced accessibility
	function enhanceAccessibility() {
		// Add ARIA labels
		const timeInputs = document.querySelectorAll('input[type="time"]');
		timeInputs.forEach((input) => {
			const label = input.previousElementSibling;
			if (label && label.tagName === "LABEL") {
				const id = input.name.replace(/[[\]]/g, "_");
				input.id = id;
				label.setAttribute("for", id);
			}
		});

		// Add keyboard navigation for dynamic fields
		document.addEventListener("keydown", function (e) {
			if (e.key === "Enter" && e.ctrlKey) {
				const activeElement = document.activeElement;
				if (activeElement && activeElement.closest(".dynamic-field-row")) {
					const addButton = activeElement
						.closest(".eis-section")
						.querySelector('button[id*="add"]');
					if (addButton) {
						addButton.click();
					}
				}
			}
		});
	}

	enhanceAccessibility();
});
