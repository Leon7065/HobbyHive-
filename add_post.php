<?php include_once("./header.php") ?>
<div class="container mt-5 post">
    <h1>Add New Post</h1>
    <form>
        <!-- Image Upload -->
        <div class="mb-4">
            <label for="postImage" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="postImage" accept="image/*">
        </div>
        <!-- Description -->
        <div class="mb-4">
            <label for="postDescription" class="form-label">Description</label>
            <textarea class="form-control" id="postDescription" rows="3" placeholder="Write something about your post..."></textarea>
        </div>
        <!-- Dropdown for Hobbies -->
        <div class="mb-4">
            <label for="hobbiesDropdown" class="form-label">Select Hobbies</label>
            <select id="hobbiesDropdown" class="form-select">
                <option value="" disabled selected>Select a hobby</option>
                <option value="Photography">Photography</option>
                <option value="Cooking">Cooking</option>
                <option value="Traveling">Traveling</option>
                <option value="Drawing">Drawing</option>
                <option value="Gaming">Gaming</option>
                <option value="Gardening">Gardening</option>
            </select>
        </div>
        <!-- Badges Container -->
        <div class="mb-4">
            <label class="form-label">Selected Hobbies</label>
            <div id="selectedHobbies" class="d-flex flex-wrap">
                <!-- Hobbies badges will appear here -->
            </div>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Submit Post</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hobbiesDropdown = document.getElementById('hobbiesDropdown');
        const selectedHobbies = document.getElementById('selectedHobbies');
        hobbiesDropdown.addEventListener('change', function () {
            const selectedOption = hobbiesDropdown.options[hobbiesDropdown.selectedIndex];
            const hobby = selectedOption.value;
            // Check if the hobby already exists as a badge
            if (!Array.from(selectedHobbies.children).some(badge => badge.textContent.trim() === hobby)) {
                // Create a badge
                const badge = document.createElement('span');
                badge.className = 'badge me-2 mb-2';
                badge.textContent = hobby;
                // Add a remove button to the badge
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