<?php include_once("header.php") ?>
<main class="main-content">
    <div class="bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 mb-4 text-center">
                    <div class="profile-header position-relative mb-4"></div>

                    <div class="position-relative d-inline-block">
                        <img src="uploads/<?php echo $user['profile_pic']; ?>" id="profile-pic" style="height:200px" class="rounded-circle profile-pic" alt="Profile Picture">
                        <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle" data-bs-toggle="modal" data-bs-target="#changePicModal">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>

                    <h3 class="mt-3 mb-1"><?php echo htmlspecialchars($user['fullname']); ?></h3>
                    <p class="text-muted mb-3"><?php echo htmlspecialchars($user['bio']); ?></p>
                </div>

                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-9 mx-auto">
                                    <div class="p-4">
                                        <form action="./backend_edit_profile.php" method="POST" enctype="multipart/form-data">
                                            <div class="mb-4">
                                                <h5 class="mb-4">Personal Information</h5>
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Full Name</label>
                                                        <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Phone</label>
                                                        <input type="tel" name="phonenumber" class="form-control" value="<?php echo htmlspecialchars($user['phonenumber']); ?>">
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Bio</label>
                                                        <textarea class="form-control" name="bio" rows="4"><?php echo htmlspecialchars($user['bio']); ?></textarea>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Gender:</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="male" value="M" <?php echo ($user['gender'] == 'M') ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="male">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="female" value="F" <?php echo ($user['gender'] == 'F') ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="female">Female</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="prefer-not-to-say" value="N" <?php echo ($user['gender'] == 'N') ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="prefer-not-to-say">Prefer Not to Say</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12" style="color:black;">
                                                        <label class="form-label">Hobbies</label>
                                                        <select class="form-select" name="hobbies[]" multiple>
                                                            <?php
                                                            $sqlHobbies = "SELECT * FROM hobbies";
                                                            $stmtHobbies = $connect->prepare($sqlHobbies);
                                                            $stmtHobbies->execute();
                                                            $allHobbies = $stmtHobbies->fetchAll(PDO::FETCH_ASSOC);

                                                            $sqlUserHobbies = "SELECT hobby_id FROM user_hobbies WHERE user_id = :user_id";
                                                            $stmtUserHobbies = $connect->prepare($sqlUserHobbies);
                                                            $stmtUserHobbies->bindParam(':user_id', $user['user_id']);
                                                            $stmtUserHobbies->execute();
                                                            $userHobbies = $stmtUserHobbies->fetchAll(PDO::FETCH_COLUMN);

                                                            foreach ($allHobbies as $hobby) {
                                                                $selected = in_array($hobby['id'], $userHobbies) ? 'selected' : '';
                                                                echo "<option value='{$hobby['id']}' {$selected}>{$hobby['hobby_name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <small class="text-muted">Hold Ctrl (Cmd on Mac) to select multiple hobbies.</small>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" name="edit" class="btn btn-custom w-100">Update Profile</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
</div>

<div class="modal fade" id="changePicModal" tabindex="-1" aria-labelledby="changePicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePicModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="update_profile_picture.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profilePic" class="form-label">Select New Profile Picture</label>
                        <input type="file" class="form-control" id="profilePic" name="profilePic" accept="image/*" required>
                    </div>
                    <!-- <button type="submit" name="edit" class="btn btn-primary">Upload</button> -->
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
