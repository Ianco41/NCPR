<?php
require "config.php";
$user_role = $_SESSION['role'];
// Function to check if the role is allowed
function isAuthorized($allowed_roles)
{
    global $user_role;
    return in_array($user_role, $allowed_roles);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">

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
                    <a href="#"><?php echo $user_role ?></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item active">
                    <a href="engineer_dashboard.php" class="sidebar-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="ncprlist_engineer.php" class="sidebar-link">
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
                    <a href="setting.php" class="sidebar-link">
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
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <a href="ncprlist.php" class="text-decoration-none">
                        <div class="card text-white mb-3 shadow-sm border-0 hover-shadow">
                            <div class="card border-0 shadow-sm flex-fill hover-shadow">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-5 align-items-center">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h5>NCPR Files</h5>
                                                <p class="mb-0">#</p>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <img src="asset/folder.png" alt="Icon" class="img-fluid" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="ncprlist.php" class="text-decoration-none">
                        <div class="card text-white mb-3 shadow-sm border-0 hover-shadow">
                            <div class="card border-0 shadow-sm flex-fill hover-shadow">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-5 align-items-center">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h5>Open Files</h5>
                                                <p class="mb-0">#</p>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <img src="asset/open.png" alt="Icon" class="img-fluid" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="productkey.php" class="text-decoration-none">
                        <div class="card text-white mb-3 shadow-sm border-0 hover-shadow">
                            <div class="card border-0 shadow-sm flex-fill hover-shadow">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-5 align-items-center">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h5>Closed NCPR</h5>
                                                <p class="mb-0">#</p>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <img src="asset/close.png" alt="Icon" class="img-fluid" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="status.php" class="text-decoration-none">
                        <div class="card text-white mb-3 shadow-sm border-0 hover-shadow">
                            <div class="card border-0 shadow-sm flex-fill hover-shadow">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-5 align-items-center">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h5>Urgent NCPR</h5>
                                                <p class="mb-0">#</p>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <img src="asset/eng.png" alt="Icon" class="img-fluid" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5 class="mb-3">NCPR Table</h5>
                    </div>
                    <div class="table-container table-responsive mt-3">
                        <table id="ncprTable" class="table table-bordered table-hover" style="width:100%">
                            <thead class="table-secondary">
                                <tr>
                                    <th hidden>ID</th>
                                    <th>NCPR Number</th>
                                    <th>Initiator</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; position: relative;">
                    <!-- First Image (Left Corner) -->
                    <img src="asset/Picture1.png" alt="Logo" style="height: 50px; object-fit: contain;">

                    <!-- Second Image (Right Corner) -->
                    <div style="position: relative;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="position: absolute; top: -10px; right: -10px;" class="m-5">
                        </button>
                        <img src="asset/Picture2.png" alt="Logo" style="height: 50px; object-fit: contain;">
                    </div>
                </div>

                <div class="modal-body">
                    <!-- Content will be loaded here via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <!-- Dispo Approval Modal -->
    <div class="modal fade" id="dispoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Disposition Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded here  -->
                    <?php include "disposition.php"; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/bootstrap/js/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/all.min.js"></script>
    <script src="assets/vendor/bootstrap/js/fontawesome.min.js"></script>
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="assets/js/viewmodal.js"></script>
    <script src="assets/js/approval.js"></script>

    <!-- DataTable Initialization -->
    <script>
        $(document).ready(function() {
            var table = $('#ncprTable').DataTable({
                "ajax": {
                    "url": "fetch_ncpr.php",
                    "type": "GET",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id",
                        "visible": false
                    }, // Hides ID column
                    {
                        "data": "ncpr_num"
                    },
                    {
                        "data": "initiator"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "date"
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row) {
                            return `
                        <button class="btn btn-primary btn-sm view-btn" data-id="${row.ncpr_num}">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-success btn-sm dispo-btn" 
                                data-id="${row.ncpr_num}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#dispoModal"><i class="fas fa-add"></i>
                            Dispo
                        </button>`;
                        }
                    }
                ],
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "emptyTable": "No Available NCPR Filing"
                }
            });
            let selectedId = "";

            // Handle dynamically created "Add" buttons using event delegation
            $('#ncprTable tbody').on('click', '.add-btn', function() {
                selectedId = $(this).data('id'); // Get the ID from the clicked button
                console.log("Button clicked, selectedId:", selectedId); // Debugging
                $("#modal-id").text(selectedId); // Display ID inside modal
            });
        });

        function fetchNcprDetails(ncprNum, viewOnly) {
            $.ajax({
                url: 'fetch_ncpr_details2.php',
                method: 'GET', // Use GET to match PHP script
                data: {
                    ncpr_num: ncprNum,
                    viewOnly: viewOnly
                },
                success: function(response) {
                    $('#viewModal .modal-body').html(response); // Insert HTML response into modal
                    $('#viewModal').modal('show'); // Show modal
                },
                error: function() {
                    alert('Error fetching data.');
                }
            });
        }

        // Attach event listener to button
        $(document).on('click', '.view-btn', function() {
            var ncprNum = $(this).data('id');
            fetchNcprDetails(ncprNum, true);
        });

        $(document).ready(function() {
            $('#ncprTable tbody').on('click', '.dispo-btn', function() {
                var ncprNum = $(this).data('id');

                $.ajax({
                    url: 'fetch_dispo_details.php', // New PHP script to fetch dispo_id
                    method: 'POST',
                    data: {
                        ncpr_num: ncprNum
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.dispo_id) {
                            // If dispo_id exists, disable inputs
                            $('#dispoModal input, #dispoModal select, #dispoModal textarea').prop('disabled', true);
                        } else {
                            // If dispo_id does not exist, allow user input
                            $('#dispoModal input, #dispoModal select, #dispoModal textarea').prop('disabled', false);
                        }

                        // Populate fields with existing data
                        $('#modal-id').text(response.ncpr_num);
                        $('#non-conformance').val(response.non_conformance);
                        $('input[name="corrective_action"][value="' + response.corrective_action + '"]').prop('checked', true);

                        // Populate checkboxes
                        setCheckboxValue('input[name="car"]', response.car);
                        setCheckboxValue('input[name="scar"]', response.scar);

                        // Populate text fields
                        $('input[name="car_no"]').val(response.car_no);
                        $('input[name="scar_no"]').val(response.scar_no);
                        $('input[name="id_no"]').val(response.id_no);
                        $('input[name="name"]').val(response.name);

                        // Populate multiple checkboxes
                        $('input[name="cause[]"]').prop('checked', false);
                        response.causes.forEach(function(cause) {
                            $('input[name="cause[]"][value="' + cause + '"]').prop('checked', true);
                        });

                        // Handle radio buttons
                        setRadioButtonValue('potential_failure', response.potential_failure);
                        setRadioButtonValue('bd_report', response.bd_report);

                        $('#dispoModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to fetch disposition data.');
                    }
                });
            });
        });

        // Utility functions
        function setCheckboxValue(selector, value) {
            $(selector).prop("checked", value === "yes");
        }

        function setRadioButtonValue(name, value) {
            if (value === "yes") {
                $('input[name="' + name + '"][value="yes"]').prop("checked", true);
            } else {
                $('input[name="' + name + '"][value="no"]').prop("checked", true);
            }
        }
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
</body>

</html>