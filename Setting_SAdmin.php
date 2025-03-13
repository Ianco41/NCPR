<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "superadmin") {
    header("Location: loginform.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>admin Dashboard</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.7.2-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

</head>
<style>
    ::after,
    ::before {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    a {
        text-decoration: none;
    }

    li {
        list-style: none;
    }

    h1 {
        font-weight: 600;
        font-size: 1.5rem;
    }

    body {
        font-family: 'Roboto', sans-serif;
    }

    .wrapper {
        display: flex;
    }

    .main {
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
        transition: all 0.35s ease-in-out;
        background-color: #fafbfe;
    }

    #sidebar {
        width: 70px;
        min-width: 70px;
        z-index: 1000;
        transition: all .25s ease-in-out;
        background-color: #0e2238;
        display: flex;
        flex-direction: column;
    }

    #sidebar.expand {
        width: 260px;
        min-width: 260px;
    }

    .toggle-btn {
        background-color: transparent;
        cursor: pointer;
        border: 0;
        padding: 1rem 1.5rem;
    }

    .toggle-btn i {
        font-size: 1.5rem;
        color: #FFF;
    }

    .sidebar-logo {
        margin: auto 0;
    }

    .sidebar-logo a {
        color: #FFF;
        font-size: 1.15rem;
        font-weight: 600;
    }

    #sidebar:not(.expand) .sidebar-logo,
    #sidebar:not(.expand) a.sidebar-link span {
        display: none;
    }

    .sidebar-nav {
        padding: 2rem 0;
        flex: 1 1 auto;
    }

    a.sidebar-link {
        padding: .625rem 1.5rem;
        color: #FFF;
        display: block;
        font-size: 0.9rem;
        white-space: nowrap;
        border-left: 3px solid transparent;
    }

    .sidebar-item,
    .sidebar-footer {
        position: relative;
    }

    .sidebar-link i {
        font-size: 1.2rem;
        color: white;
        margin-right: 10px;
    }

    a.sidebar-link:hover {
        background-color: rgba(255, 255, 255, .075);
        border-left: 3px solid #3b7ddd;
    }

    .sidebar-item {
        position: relative;
    }

    #sidebar:not(.expand) .sidebar-link span {
        display: none;
        position: absolute;
        left: 80px;
        top: 50%;
        transform: translateY(-50%);
        background: #0e2238;
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 0.85rem;
        white-space: nowrap;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    #sidebar:not(.expand) .sidebar-item:hover .sidebar-link span,
    #sidebar:not(.expand) .sidebar-footer:hover .sidebar-link span {
        display: block;
    }

    .sidebar-item,
    .sidebar-footer {
        position: relative;
    }

    .sidebar-item.active a {
        background-color: rgba(255, 255, 255, 0.1);
        border-left: 3px solid #3b7ddd;
        color: #3b7ddd;
    }

    .hover-shadow:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3) !important;
        transform: translateY(-5px);
        transition: all 0.3s ease-in-out;
        background-color: #0e2238 !important;
        color: white;
    }
</style>

<body class="bg-white">
    <div class="wrapper bg-white">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">LOGO</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item active">
                    <a href="admin_dashboard.php" class="sidebar-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="ncprfiling.php" class="sidebar-link">
                        <i class="fa-regular fa-folder-open"></i>
                        <span>NCPR Filing</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="ncprlist.php" class="sidebar-link">
                        <i class="fa-regular fa-address-card"></i>
                        <span>NCPR List</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="productkey.php" class="sidebar-link">
                        <i class="fa-solid fa-helmet-safety"></i>
                        <span>Product Key</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="status.php" class="sidebar-link">
                        <i class="fa-solid fa-paperclip"></i>
                        <span>Engineer List</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Setting_SAdmin.php" class="sidebar-link">
                        <i class="fa-solid fa-gear"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">

            <div class="card">
                <div class="card-body">
                    <header class="py-3 shadow-sm" style="background-color: #0e2238">
                        <div class="container d-flex align-items-center">
                            <a class="navbar-brand text-white" href="#">
                                <span class="fs-4 fw-bold ms-2">LOGO</span>
                            </a>
                        </div>
                    </header>

                    <div class="container d-flex flex-grow-1 justify-content-center align-items-center">
                        <div class="login-form bg-light p-4 rounded shadow" style="width: 500px;">
                            <h2 class="text-center">ADD ACCESS ACCOUNTS</h2>
                            <form id="accessForm" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">EMAIL/USERNAME</label>
                                    <input type="text" class="form-control p-2 fs-6" name="username" placeholder="Enter email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">PASSWORD</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control p-2 fs-6 pe-5" id="password" name="password" placeholder="Enter password" required>
                                        <button type="button" class="btn position-absolute end-0 top-50 translate-middle-y p-0 border-0 bg-transparent shadow-none me-2" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ROLE</label>
                                    <select class="form-control p-2 fs-6" id="role" name="role" required>
                                        <option value="" disabled selected>Select a role</option>
                                        <option value="admin">Admin</option>
                                        <option value="editor">Sub-admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success w-100 p-2"><span class="fs-5 fw-bold text-dark">ADD NEW</span></button>
                                <button type="button" class="btn btn-primary w-100 p-2 mt-2" data-bs-toggle="modal" data-bs-target="#viewAccountsModal">
                                    <span class="fs-5 fw-bold text-white">VIEW ALL ACCOUNTS</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal for Viewing Accounts -->
                    <div class="modal fade" id="viewAccountsModal" tabindex="-1" aria-labelledby="viewAccountsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewAccountsModalLabel">All Access Accounts</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="accountList">
                                            <tr>
                                                <td colspan="4" class="text-center">Loading...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Change Password Form -->
                                    <div id="changePasswordForm" style="display: none;">
                                        <h4>Change Password</h4>
                                        <form id="passwordForm">
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label">New Password</label>
                                                <input type="password" class="form-control" id="newPassword" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmPassword" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                            <button type="button" class="btn btn-secondary" onclick="hideChangePassword()">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- DataTable Initialization -->
        <script>
            $(document).ready(function() {
                $('#ncprTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excelHtml5',
                            text: 'Export Excel',
                            className: 'btn btn-success'
                        },
                        {
                            extend: 'csvHtml5',
                            text: 'Export CSV',
                            className: 'btn btn-primary'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'Export PDF',
                            className: 'btn btn-danger'
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            className: 'btn btn-warning'
                        }
                    ]
                });
            });
        </script>
        <script>
            const hamBurger = document.querySelector(".toggle-btn");

            hamBurger.addEventListener("click", function() {
                document.querySelector("#sidebar").classList.toggle("expand");
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#togglePassword").click(function() {
                    let passwordField = $("#password");
                    let icon = $(this).find("i");

                    if (passwordField.attr("type") === "password") {
                        passwordField.attr("type", "text");
                        icon.removeClass("fa-eye").addClass("fa-eye-slash");
                    } else {
                        passwordField.attr("type", "password");
                        icon.removeClass("fa-eye-slash").addClass("fa-eye");
                    }
                });

                $('#viewAccountsModal').on('show.bs.modal', function() {
                    $.ajax({
                        url: 'setting_register.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            let rows = "";
                            if (response.length > 0) {
                                response.forEach(function(user) {
                                    rows += `<tr>
                                    <td>${user.id}</td>
                                    <td>${user.username}</td>
                                    <td>${user.role}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm change-password" data-userid="${user.id}">Change Password</button>
                                    </td>
                                </tr>`;
                                });
                            } else {
                                rows = `<tr><td colspan="4" class="text-center">No accounts found.</td></tr>`;
                            }
                            $('#accountList').html(rows);
                        }
                    });
                });
                // Handle Change Password button click (Event Delegation for dynamically added elements)
    $(document).on('click', '.change-password', function () {
        let userId = $(this).data('userid');
        let username = $(this).data('username');

        // Set user details in the form
        $('#changePasswordUserId').val(userId);
        $('#changePasswordUsername').text(username);

        // Show the change password form
        $('#changePasswordForm').show();
    });

    // Handle Cancel button click
    $('#cancelChangePassword').click(function () {
        $('#changePasswordForm').hide();
    });
            });
        </script>
</body>

</html>