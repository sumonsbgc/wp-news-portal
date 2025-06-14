document.addEventListener("DOMContentLoaded", function () {
  const sportsContainer = document.getElementById("sports-container");
  const addNewsBtn = document.getElementById("add-sports-news");
  const youtubePlaylistContainer = document.getElementById(
    "youtube-playlist-container"
  );
  const addYoutubePlaylistBtn = document.getElementById("add-youtube-playlist");
  const imageInput = document.getElementById("imageInput");
  const uploadBtn = document.getElementById("uploadBtn");
  const removeBtn = document.getElementById("removeBtn");
  const imagePreview = document.getElementById("imagePreview");

  let rowCount = 1;
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
    sportsContainer.appendChild(newRow);
    rowCount++;

    // Enable delete button on first row if there are multiple rows
    if (sportsContainer.children.length > 1) {
      sportsContainer.firstElementChild.querySelector(
        ".delete-sports-news"
      ).disabled = false;
    }
  });

  sportsContainer.addEventListener("click", function (e) {
    if (e.target.classList.contains("delete-sports-news")) {
      const row = e.target.closest("tr");
      if (row && sportsContainer.children.length > 1) {
        row.remove();

        // Disable delete button on first row if only one row left
        if (sportsContainer.children.length === 1) {
          sportsContainer.firstElementChild.querySelector(
            ".delete-sports-news"
          ).disabled = true;
        }

        // Re-index remaining rows
        const rows = sportsContainer.querySelectorAll("tr");
        rows.forEach((row, index) => {
          row.querySelector("input").name = `sports[${index}][sports_name]`;
          row.querySelector("textarea").name = `sports[${index}][sports_news]`;
        });
        rowCount = rows.length;
      }
    }
  });

  addYoutubePlaylistBtn.addEventListener("click", function () {
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
				<div class="margin-youtube flex">
                    <input name="ytd_playlist_id[]" type="text" id="salat_routine" value="" class="regular-text" />
                    <div class="flex ">
                    <button type="button" class="delete-sports-news"> <span class="dashicons dashicons-dismiss"></span></button>
                </div>
                </div>
	`;
    youtubePlaylistContainer.appendChild(newRow);
    rowCount++;

    if (youtubePlaylistContainer.children.length > 1) {
      youtubePlaylistContainer.firstElementChild.querySelector(
        ".delete-sports-news"
      ).disabled = false;
    }
  });

  youtubePlaylistContainer.addEventListener("click", function (e) {
    if (e.target.classList.contains("delete-sports-news")) {
      const row = e.target.closest("tr");
      if (row && youtubePlaylistContainer.children.length > 0) {
        row.remove();

        if (youtubePlaylistContainer.children.length === 1) {
          youtubePlaylistContainer.firstElementChild.querySelector(
            ".delete-sports-news"
          ).disabled = true;
        }
        const rows = youtubePlaylistContainer.querySelectorAll("tr");
        rows.forEach((row, index) => {
          row.querySelector("input").name = `ytd_playlist_id[${index}]`;
        });
        rowCount = row.length;
      }
    }
  });

  uploadBtn.addEventListener("click", () => {
    imageInput.click();
  });

  imageInput.addEventListener("change", () => {
    const file = imageInput.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.innerHTML = `<img src="${e.target.result}" class="preview-image" />`;
        removeBtn.style.display = "inline-block";
      };
      reader.readAsDataURL(file);
    }
  });

  removeBtn.addEventListener("click", () => {
    imageInput.value = "";
    imagePreview.innerHTML = "";
    removeBtn.style.display = "none";
  });
});
