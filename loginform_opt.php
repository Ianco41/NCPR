<?php
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NCPR System</title>

    <link rel="stylesheet" href="assets/vendor/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">

</head>

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

            <!-- Regular Login Form -->
            <form id="loginForm" method="POST" action="login.php">
                <input type="hidden" name="login" value="1">
                <div class="mb-3">
                    <label class="form-label">EMAIL</label>
                    <input type="text" class="form-control p-2 fs-6" id="username" name="username" placeholder="Enter email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">PASSWORD</label>
                    <div class="position-relative">
                        <input type="password" class="form-control p-2 fs-6 pe-5" id="password" name="password" placeholder="Enter password" required>
                        <button class="btn position-absolute end-0 top-50 translate-middle-y p-0 border-0 bg-transparent shadow-none me-2 togglePassword" type="button">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 p-2">
                    <span class="fs-5 fw-bold text-dark">LOGIN</span>
                </button>
            </form>

            <hr>

            <!-- Guest Login Form -->
            <form id="guestForm" method="POST" action="login.php">
                <div class="mb-3">
                    <label for="guestAccess" class="form-label">Select Guest Access:</label>
                    <select id="guestAccess" name="guest_role" class="form-select" required>
                        <option value="" selected disabled>Choose...</option>
                        <option value="guest1">GUEST1</option>
                        <option value="guest2">GUEST2</option>
                        <option value="guest3">GUEST3</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-2">
                    <span class="fs-5 fw-bold text-dark">GUEST</span>
                </button>
            </form>

            <p class="text-end mt-2">
                <a href="requestOTP.php" class="text-decoration-none text-dark fw-medium"
                   onmouseover="this.style.color='#007bff'; this.style.textDecoration='underline';"
                   onmouseout="this.style.color='#333'; this.style.textDecoration='none';">
                    <span style="font-size: 15px">Forgot Password?</span>
                </a>
            </p>
        </div>
    </div>

    <script src="assets/vendor/bootstrap/js/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/all.min.js"></script>
    <script src="assets/vendor/bootstrap/js/fontawesome.min.js"></script>
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {
            // Toggle Password Visibility
            $(".togglePassword").click(function () {
                var passwordField = $("#password");
                var icon = $(this).find("i");

                if (passwordField.attr("type") === "password") {
                    passwordField.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    passwordField.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });

            // Handle Login Form Submission
            $("#loginForm").submit(function (e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var submitButton = $(this).find("button");

                submitButton.prop("disabled", true);

                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Login Successful",
                                text: response.message,
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
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong. Please try again.",
                            confirmButtonColor: "#d33"
                        });
                    },
                    complete: function () {
                        submitButton.prop("disabled", false);
                    }
                });
            });

            // Handle Guest Form Submission
            $("#guestForm").submit(function (e) {
                var guestRole = $("#guestAccess").val();
                if (!guestRole) {
                    e.preventDefault();
                    Swal.fire({
                        icon: "warning",
                        title: "Guest Role Required",
                        text: "Please select a guest role before logging in.",
                        confirmButtonColor: "#d33"
                    });
                }
            });
        });
    </script>
</body>

</html>
