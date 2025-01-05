<?php include_once("header.php") ?>
<main class="main-content">
          <div class="bg-light">
              <div class="container py-5">
                  <div class="row justify-content-center">
                      <!-- Profile Header -->
                      <div class="col-12 mb-4 text-center">
                          <div class="profile-header position-relative mb-4"></div>
                          <!-- Profile Picture with Edit Button -->
                          <div class="position-relative d-inline-block">
                              <img src="https://randomuser.me/api/portraits/men/40.jpg" id="profile-pic" class="rounded-circle profile-pic" alt="Profile Picture">
                              <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle" data-bs-toggle="modal" data-bs-target="#changePicModal">
                                  <i class="fas fa-camera"></i>
                              </button>
                          </div>
                          <h3 class="mt-3 mb-1">Alex Johnson</h3>
                          <p class="text-muted mb-3">Product designer with 5+ years of experience in creating user-centered digital solutions.</p>
                      </div>
                      <!-- Personal Information Form -->
                      <div class="col-12">
                          <div class="card border-0 shadow-sm">
                              <div class="card-body p-0">
                                  <div class="row g-0">
                                      <div class="col-lg-9 mx-auto">
                                          <div class="p-4">
                                              <!-- Personal Information Section -->
                                              <div class="mb-4">
                                                  <h5 class="mb-4">Personal Information</h5>
                                                  <div class="row g-3">
                                                      <!-- Full Name -->
                                                      <div class="col-md-12">
                                                          <label class="form-label">Full Name</label>
                                                          <input type="text" name="fullname" class="form-control" value="Alex Johnson">
                                                      </div>
                                                      <!-- Email -->
                                                      <div class="col-md-6">
                                                          <label class="form-label">Email</label>
                                                          <input type="email" name="email" class="form-control" value="alex.johnson@example.com" readonly>
                                                      </div>
                                                      <!-- Phone -->
                                                      <div class="col-md-6">
                                                          <label class="form-label">Phone</label>
                                                          <input type="tel" name="phonenumber" class="form-control" value="+1 (555) 123-4567">
                                                      </div>
                                                      <!-- Bio -->
                                                      <div class="col-12">
                                                          <label class="form-label">Bio</label>
                                                          <textarea class="form-control" rows="4">Product designer with 5+ years of experience in creating user-centered digital solutions. Passionate about solving complex problems through simple and elegant designs.</textarea>
                                                      </div>
                                                      <!-- Gender Selection -->
                                                      <div class="col-12">
                                                          <label class="form-label">Gender:</label>
                                                          <div class="form-check form-check-inline">
                                                              <input class="form-check-input" type="radio" name="gender" id="male" value="M" checked>
                                                              <label class="form-check-label" for="male">Male</label>
                                                          </div>
                                                          <div class="form-check form-check-inline">
                                                              <input class="form-check-input" type="radio" name="gender" id="female" value="F">
                                                              <label class="form-check-label" for="female">Female</label>
                                                          </div>
                                                          <div class="form-check form-check-inline">
                                                              <input class="form-check-input" type="radio" name="gender" id="prefer-not-to-say" value="N">
                                                              <label class="form-check-label" for="prefer-not-to-say">Prefer Not to Say</label>
                                                          </div>
                                                      </div>
                                                      <!-- Hobbies -->
                                                      <div class="col-12">
                                                          <label class="form-label">Hobbies</label>
                                                          <textarea class="form-control" rows="3">Traveling, reading, coding, photography</textarea>
                                                      </div>
                                                      <!-- Submit Button -->
                                                      <div class="col-12">
                                                          <button type="submit" class="btn btn-custom w-100">Update Profile</button>
                                                      </div>
                                                  </div>
                                              </div>
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
    <!-- Modal for Changing Profile Picture -->
    <div class="modal fade" id="changePicModal" tabindex="-1" aria-labelledby="changePicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePicModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profilePic" class="form-label">Select New Profile Picture</label>
                            <input type="file" class="form-control" id="profilePic" name="profilePic" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>