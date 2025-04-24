document.addEventListener("DOMContentLoaded", function () {
	const container = document.getElementById("sports-container");
	const addNewsBtn = document.getElementById("add-sports-news");
	let rowCount = 1; // Start from 1 since we have initial row

	addNewsBtn.addEventListener("click", function () {
		const newRow = document.createElement("tr");
		newRow.innerHTML = `
            <div >
                <div class="flex">
                    <div class="input-group ">
                        <label for="">Sports Name</label>
                        <input type="text" class="regular-text" name="sports[${rowCount}][sports_name]" value="" style="border: 1px solid gray" />
                    </div>
                    <div class="input-group">
                        <label for="">Sports News</label>
                        <textarea name="sports[${rowCount}][sports_news]" id="" rows="2" class="regular-text resize"></textarea>
                    </div>
                </div>
                <div class="flex ">
                    <button type="button" class="delete-sports-news"> <span class="dashicons dashicons-dismiss"></span> Delete</button>
                </div>
            </div>
        `;
		container.appendChild(newRow);
		rowCount++;

		// Enable delete button on first row if there are multiple rows
		if (container.children.length > 1) {
			container.firstElementChild.querySelector(
				".delete-sports-news"
			).disabled = false;
		}
	});

	container.addEventListener("click", function (e) {
		if (e.target.classList.contains("delete-sports-news")) {
			const row = e.target.closest("tr");
			if (row && container.children.length > 1) {
				row.remove();

				// Disable delete button on first row if only one row left
				if (container.children.length === 1) {
					container.firstElementChild.querySelector(
						".delete-sports-news"
					).disabled = true;
				}

				// Re-index remaining rows
				const rows = container.querySelectorAll("tr");
				rows.forEach((row, index) => {
					row.querySelector("input").name = `sports[${index}][sports_name]`;
					row.querySelector("textarea").name = `sports[${index}][sports_news]`;
				});
				rowCount = rows.length;
			}
		}
	});
});
