<?php
  require("./backend_fetch_hobbies.php");
  include_once("./header.php");
?>


<div class="container mt-5 post">
    <h1>Add New Post</h1>
    <form action="./backend_add_post.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="postImage" class="form-label">Upload Image</label>
            <input class="form-control" name="image"  type="file" id="postImage" accept="image/*">
        </div>

        <div class="mb-4">
            <label for="postDescription" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="postDescription" rows="3" placeholder="Write something about your post..."></textarea>
        </div>

        <div class="mb-4">
            <label for="hobbiesDropdown" class="form-label">Select Hobbies</label>
            <select id="hobbiesDropdown" class="form-select" name="hobbies[]">
                <option value="" disabled selected>Select a hobby</option>
                <?php foreach ($hobbies as $hobby): ?>
                    <option value="<?php echo htmlspecialchars($hobby['hobby_id']); ?>">
                        <?php echo htmlspecialchars($hobby['hobby_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Selected Hobbies</label>
            <div id="selectedHobbies" class="d-flex flex-wrap"></div>
        </div>

        <button type="submit" name="hobbies" class="btn btn-primary w-100">Submit Post</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hobbiesDropdown = document.getElementById('hobbiesDropdown');
        const selectedHobbies = document.getElementById('selectedHobbies');

        hobbiesDropdown.addEventListener('change', function () {
            const selectedOption = hobbiesDropdown.options[hobbiesDropdown.selectedIndex];
            const hobby = selectedOption.value;

            if (!Array.from(selectedHobbies.children).some(badge => badge.textContent.trim() === hobby)) {
                // Create a badge
                const badge = document.createElement('span');
                badge.className = 'badge me-2 mb-2';
                badge.textContent = hobby;

                const removeBtn = document.createElement('i');
                removeBtn.className = 'fa-solid fa-times ms-2';
                removeBtn.addEventListener('click', function () {
                    badge.remove();
                });

                badge.appendChild(removeBtn);
                selectedHobbies.appendChild(badge);
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
