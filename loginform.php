<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NCPR System</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.7.2-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
</style>

<body class="d-flex flex-column min-vh-100">
    <header class="py-3 shadow-sm" style="background-color: #0e2238">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand" href="#">
                <span class="fs-4 fw-bold ms-2">LOGO</span>
            </a>
        </div>
    </header>
    <div class="container d-flex flex-grow-1 justify-content-center align-items-center">
        <div class="login-form bg-light p-4 rounded shadow" style="width: 500px;">
            <h2 class="text-center">Login</h2>
            <form method="POST" action="login.php">
                <input type="hidden" name="login" value="1">
                <div class="mb-3">
                    <label class="form-label">EMAIL</label>
                    <input type="text" class="form-control p-2 fs-6" name="username" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label class="form-label">PASSWORD</label>
                    <div class="position-relative">
                        <input type="password" class="form-control p-2 fs-6 pe-5" id="password" name="password" placeholder="Enter password">
                        <button class="btn position-absolute end-0 top-50 translate-middle-y p-0 border-0 bg-transparent shadow-none me-2" type="button" id="togglePassword">
                            <i class="fas fa-eye" style="font-size: 1rem;"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 p-2" name="login"><span class="fs-5 fw-bold text-dark">LOGIN</span></button>
            </form>
            <hr>
            <form method="POST" action="login.php">
                <input type="hidden" name="guest" id="guestHidden" value="">
                <div class="mb-3">
                    <label for="guestAccess" class="form-label">Select Guest Access:</label>
                    <select id="guestAccess" name="guest_role" class="form-select">
                        <option value="" selected disabled>Choose...</option>
                        <option value="guest1">GUEST1</option>
                        <option value="guest2">GUEST2</option>
                        <option value="guest3">GUEST3</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-2" name="guest" id="guestLogin"><span class="fs-5 fw-bold text-dark">GUEST</span></button>
            </form>
            <!-- JavaScript (Ensure guest role is selected before submitting) -->
            <script>
                document.getElementById('guestAccess').addEventListener('change', function() {
                    document.getElementById('guestHidden').value = this.value;
                });
                document.getElementById('guestLogin').addEventListener('click', function(event) {
                    const guestRole = document.getElementById('guestAccess').value;
                    if (!guestRole) {
                        alert("Please select a guest role before logging in.");
                        event.preventDefault(); // Prevent form submission
                    }
                });
            </script>

            <p class="text-end mt-2">
                <a href="requestOTP.php"
                    style="text-decoration: none; color: #333; font-weight: 500; transition: color 0.3s ease-in-out;"
                    onmouseover="this.style.color='#007bff'; this.style.textDecoration='underline';"
                    onmouseout="this.style.color='#333'; this.style.textDecoration='none';">
                    <span style="font-size: 15px">Forgot Password?</span>
                </a>
            </p>
        </div>
    </div>


    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Added modal-dialog-centered -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#resetPasswordForm").on("submit", function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "reset_password.php",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Password Reset Successful",
                                text: response.message,
                                confirmButtonColor: "#577BC1"
                            }).then(() => {
                                $("#resetPasswordModal").modal("hide");
                            });
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Error",
                                text: response.message,
                                confirmButtonColor: "#d33"
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong. Please try again.",
                            confirmButtonColor: "#d33"
                        });
                    }
                });
            });

            $("form:not(#resetPasswordForm)").on("submit", function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Login Successful",
                                text: response.message,
                                showConfirmButton: true,
                                confirmButtonColor: "#577BC1"
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Login Failed",
                                text: response.message,
                                confirmButtonColor: "#d33"
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong. Please try again.",
                            confirmButtonColor: "#d33"
                        });
                    }
                });
            });

            document.getElementById('togglePassword').addEventListener('click', function() {
                var passwordField = document.getElementById('password');
                var icon = this.querySelector('i');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>