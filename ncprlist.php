<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}


// Include your database connection file
include 'connection.php'; // Make sure you have a proper database connection here

// Fetch data from ncpr_table
$query = "SELECT id, initiator, ncpr_num, date, part_number, part_name, status, urgent FROM ncpr_table";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>admin Dashboard</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <li class="sidebar-item">
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
                <li class="sidebar-item active">
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
                        <span>Status</span>
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
        <div class="main">
            <div class="page-wrapper">
                <h2 class="mb-3">NCPR Table</h2>
                <table id="ncprTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th hidden>ID</th>
                            <th>NCPR Number</th>
                            <th>Initiator</th>
                            <th>Date</th>
                            <th>Part Number</th>
                            <th>Part Name</th>
                            <th>Urgent</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td hidden><?php echo $row['id']; ?></td>
                                <td><?php echo $row['ncpr_num']; ?></td>
                                <td><?php echo $row['initiator']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['part_number']; ?></td>
                                <td><?php echo $row['part_name']; ?></td>
                                <td><?php echo $row['urgent'] ? 'Yes' : 'No'; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm view-btn" data-id="<?php echo $row['ncpr_num']; ?>" data-bs-toggle="modal" data-bs-target="#viewModal">
                                        View
                                    </button>
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $row['ncpr_num']; ?>" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <span>Edit</span>
                                    </button>
                                    <button class="btn btn-success btn-sm add-btn" data-id="<?php echo $row['ncpr_num']; ?>" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <span>Dispo</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add New Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addForm" action="process_add.php" method="POST">
                                <div class="mb-3">
                                    <label for="ncpr_num" class="form-label">NCPR Number</label>
                                    <input type="text" class="form-control" id="add_ncpr_num" name="ncpr_num" readonly required>
                                </div>
                                <div class="mb-3">
                                    <label for="part_name" class="form-label">Part Name</label>
                                    <input type="text" class="form-control" id="part_name" name="part_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="part_number" class="form-label">Part Number</label>
                                    <input type="text" class="form-control" id="part_number" name="part_number" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Record</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">View NCPR Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row d-flex">
                                <!-- Left Side Content (Takes up 9 columns) -->
                                <div class="col-md-9 m-0">
                                    <div class="row">
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Initiator:</strong></span>
                                            <span id="view-initiator" style="font-size: 12px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>NCPR Number:</strong></span>
                                            <span id="view-ncpr-num" style="font-size: 14px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Date:</strong></span>
                                            <span id="view-date" style="font-size: 12px"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Part Number:</strong></span>
                                            <span id="view-part-number" style="font-size: 14px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Part Name:</strong></span>
                                            <span id="view-part-name" style="font-size: 14px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Process:</strong></span>
                                            <span id="view-process" style="font-size: 14px"></span>
                                        </div>
                                    </div>
                                    <div class="row supplier-details">
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 15px"><strong>FOR ON HOLD MATERIAL ONLY</strong></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Supplier Part Name:</strong></span>
                                            <span id="view-supplier-part-name" style="font-size: 14px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Supplier Part Number:</strong></span>
                                            <span id="view-supplier-part-number" style="font-size: 14px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Supplier:</strong></span>
                                            <span id="view-supplier" style="font-size: 14px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Invoice Number:</strong></span>
                                            <span id="view-invoice-num" style="font-size: 14px"></span>
                                        </div>
                                        <div class="col-md-4 border p-2">
                                            <span class="d-block" style="font-size: 12px"><strong>Purchase Order:</strong></span>
                                            <span id="view-purchase-order" style="font-size: 14px"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Box (Aligned to the right) -->
                                <div class="col-md-3 d-flex align-items-stretch g-0">
                                    <div class="right-box p-4 border w-100 text-center">
                                        <h3 style="color: red; font-weight: bold;">URGENT!</h3>
                                        <span>Check the checkbox if the held parts is a potential OTD Miss Shipment.</span>
                                        <!-- Large Checkbox -->
                                        <div class="mt-2">
                                            <input type="checkbox" id="view-urgent-checkbox" name="urgent" class="form-check-input" style="transform: scale(1.8);">
                                            <label for="view-urgent-checkbox" class="ms-2 fw-bold">Mark as Urgent</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row table-responsive m-0 g-0 p-0">
                                    <table class="table table-bordered text-center" id="material-table">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 15px">NT DJ Number</th>
                                                <th style="font-size: 15px">Material / NFLD Lob / Sublot Number</th>
                                                <th style="font-size: 15px">Lot / Sublot Quantity</th>
                                                <th style="font-size: 15px">Quantity Affected</th>
                                                <th style="font-size: 15px">Defect Rate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Material data will be inserted here dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <span style="font-size: 12px" class="fw-bold">Problem Description (specefic column/s where appropriate)</span>
                            <div class="row">
                                <div class="col-md-3 border p-2">
                                    <span class="d-block" style="font-size: 12px"><strong>Issue call out</strong></span><span id="view-issue" style="font-size: 15px"></span>
                                </div>
                                <div class="col-md-3 border p-2">
                                    <div class="d-flex">
                                        <p style="font-size: 10px;" class="me-5">
                                            <strong>AWPI:</strong>
                                            <span id="view-awpi" class="border-bottom border-dark d-inline-block text-center" style="min-width: 50px;"></span>
                                        </p>
                                        <p style="font-size: 10px;">
                                            <strong>DC:</strong>
                                            <span id="view-dc" class="border-bottom border-dark d-inline-block text-center" style="min-width: 50px;"></span>
                                        </p>
                                    </div>

                                    <div class="d-flex">
                                        <p style="font-size: 12px;"><strong>Deviation?</strong></p>
                                        <div class="form-check form-check-inline ms-5">
                                            <input class="form-check-input form-check-input-sm" type="checkbox" id="deviation-yes" disabled>
                                            <label class="form-check-label" for="deviation-yes" style="font-size: 10px;">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input form-check-input-sm" type="checkbox" id="deviation-no" disabled>
                                            <label class="form-check-label" for="deviation-no" style="font-size: 10px;">No</label>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <p class="m-0" style="font-size: 12px;"><strong>Issue Repeating?</strong></p>
                                        <div class="form-check form-check-inline" style="margin-left: 12px;">
                                            <input class="form-check-input form-check-input-sm" type="checkbox" id="repeating-yes" disabled>
                                            <label class="form-check-label" for="repeating-yes" style="font-size: 10px;">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input form-check-input-sm" type="checkbox" id="repeating-no" disabled>
                                            <label class="form-check-label" for="repeating-no" style="font-size: 10px;">No</label>
                                        </div>
                                    </div>

                                    <span class="d-inline-block" style="font-size: 12px;"><strong>Cavity Affected:</strong></span>
                                    <span id="view-cavity" class="border-bottom border-dark d-inline-block text-center" style="min-width: 100px; font-size: 12px"></span>
                                    <span class="d-inline-block" style="font-size: 12px;"><strong>Machine:</strong></span><span id="view-machine" class="border-bottom border-dark d-inline-block text-center" style="min-width: 100px; font-size: 12px"></span>
                                </div>
                                <div class="col-md-3 border p-2">
                                    <span class="d-block" style="font-size: 12px"><strong>Criteria / Doc Reference</strong></span><span id="view-ref" style="font-size: 12px"></span>
                                </div>
                                <div class="col-md-3 border p-2">
                                    <span class="d-block" style="font-size: 12px"><strong>Issue background or information relevant in determining this root cause of the problem</strong></span><span id="view-bg" style="font-size: 12px"></span>
                                </div>
                            </div>
                            <div class="row mt-3 border m-0">
                                <div class="col-md-6 border p-2">
                                    <span style="font-size: 12px" class="fw-bold">Immediate containment action/s or countermeasure/s taken (tick as many as appropriate):</span>
                                    <div style="display: block; margin-bottom: 5px;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-one" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span style="font-size: 12px;">1. Segregate affected part/s - write custodian of the segregated parts</span>
                                        </div>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-one-one" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span style="font-size: 12px;"><strong>1.1. At Hotpress:</strong>Put on hold inventory of affected lay-up materials together with the parts</span>
                                        </div>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-two" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span style="font-size: 12px;" class="me-2">2. Yield off/ 100% inspection. <strong>INSPECTION RESULTS:</strong></span>
                                            <span id="view-two-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 100px;"></span>
                                        </div>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-three" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span style="font-size: 12px;" class="me-2">3. Call the attention of QAE/PE/EE/TECH/CHIEF:</span>
                                            <span id="view-three-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 200px;"></span>
                                        </div>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-four" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span id="view-four" style="font-size: 12px;" class="me-2">4. Attach On-hold Tag and put in On-Hold cage/area</span>
                                        </div>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-five" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span id="view-five" style="font-size: 12px;">5. Check MCS stock for similar Lot Number/AWPI/DC and request to file NCPR</span>
                                        </div>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-six" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span id="view-six" style="font-size: 12px;">6. Attach copy of OCAP if available, and/or other log forms as part of the containment action</span>
                                        </div>
                                    </div>
                                    <div style="display: inline-flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 12px;">7. File Shutdown Record</span>

                                        <label style="font-size: 12px; display: flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-seven-yes" style="width: 12px; height: 12px; margin-right: 5px;" disabled> Yes
                                        </label>

                                        <label style="font-size: 12px; display: flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-seven-no" style="width: 12px; height: 12px; margin-right: 5px;" disabled> No
                                        </label>
                                        <span style="font-size: 12px;">WHO:</span>
                                        <span id="view-seven-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 80px;"></span>
                                        <span style="font-size: 12px;">TIME/SHIFT:</span>
                                        <span id="view-seven-two" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 80px;"></span>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-eight" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span style="font-size: 12px;" class="me-2">8. Others (please specify):</span>
                                            <span id="view-eight-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 300px;"></span>
                                        </div>
                                    </div>
                                    <div style="display: block;">
                                        <div style="display: inline-flex; align-items: center;">
                                            <input type="checkbox" class="form-check-input" id="view-nine" style="width: 12px; height: 12px; margin-right: 5px;" disabled>
                                            <span style="font-size: 12px;" class="me-2">9. Find affected WIP, FG & raw materials - specify DJ/s and LN/s</span>
                                            <span id="view-nine-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 150px;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border p-2">
                                    <span style="font-size: 12px;">Product Recall</span>

                                    <label style="font-size: 12px; display: flex; align-items: center;">
                                        <input type="checkbox" class="form-check-input" id="view-seven-yes" style="width: 12px; height: 12px; margin-right: 5px;" disabled> Yes
                                    </label>

                                    <label style="font-size: 12px; display: flex; align-items: center;">
                                        <input type="checkbox" class="form-check-input" id="view-seven-no" style="width: 12px; height: 12px; margin-right: 5px;" disabled> No
                                    </label>
                                    <p><strong>Recall:</strong> <span id="view-recall"></span></p>
                                    <p><strong>FG Parts:</strong> <span id="view-fgparts"></span></p>

                                    <p><strong>Cancel Shipment:</strong> <span id="view-shipment"></span></p>
                                    <p><strong>Shipment SCHEDULE:</strong> <span id="view-ship_sched"></span></p>
                                    <p><strong>WIP:</strong> <span id="view-wip"></span></p>
                                    <p><strong>Stop Process</strong> <span id="view-stop_proc"></span></p>
                                    <p><strong>Location:</strong> <span id="view-location"></span></p>
                                    <p><strong>MCS:</strong> <span id="view-mcs"></span></p>
                                    <p><strong>MCS Details:</strong> <span id="view-mcs-details"></span></p>
                                    <p><strong>Customer Notification:</strong> <span id="view-customer-notif"></span></p>
                                </div>
                            </div>



                            <h5>File Attachments</h5>
                            <div id="file-list" class="d-flex flex-wrap">
                                <!-- Files will be dynamically inserted here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit NCPR Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" id="edit-id" name="id">
                                <div class="mb-2">
                                    <label class="form-label">Initiator</label>
                                    <input type="text" class="form-control" id="edit-initiator" name="initiator">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">NCPR Number</label>
                                    <input type="text" class="form-control" id="edit-ncpr-num" name="ncpr_num">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" id="edit-date" name="date">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Part Number</label>
                                    <input type="text" class="form-control" id="edit-part-number" name="part_number">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Part Name</label>
                                    <input type="text" class="form-control" id="edit-part-name" name="part_name">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Process</label>
                                    <input type="text" class="form-control" id="edit-process" name="process">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Urgent</label>
                                    <select class="form-control" id="edit-urgent" name="urgent">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Issue</label>
                                    <textarea class="form-control" id="edit-issue" name="issue"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Repeating</label>
                                    <select class="form-control" id="edit-repeating" name="repeating">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Machine</label>
                                    <input type="text" class="form-control" id="edit-machine" name="machine">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Reference</label>
                                    <input type="text" class="form-control" id="edit-ref" name="ref">
                                </div>

                                <h5>Supplier Details</h5>
                                <div class="mb-3">
                                    <label class="form-label">Supplier</label>
                                    <input type="text" class="form-control" id="edit-supplier" name="supplier">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Supplier Part Name</label>
                                    <input type="text" class="form-control" id="edit-supplier-part-name" name="supplier_part_name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Supplier Part Number</label>
                                    <input type="text" class="form-control" id="edit-supplier-part-number" name="supplier_part_number">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Invoice Number</label>
                                    <input type="text" class="form-control" id="edit-invoice-num" name="invoice_num">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Purchase Order</label>
                                    <input type="text" class="form-control" id="edit-purchase-order" name="purchase_order">
                                </div>
                            </div>
                        </div>

                        <h5>Material Details</h5>
                        <table class="table table-bordered" id="edit-material-table">
                            <thead>
                                <tr>
                                    <th>Material ID</th>
                                    <th>NTDJ Number</th>
                                    <th>MNS Number</th>
                                    <th>Lot/Sublot Quantity</th>
                                    <th>Quantity Affected</th>
                                    <th>Quantity Affected (Text)</th>
                                    <th>Defect Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Material data will be inserted here dynamically -->
                            </tbody>
                        </table>
                        <h5>Additional Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">One</label>
                                    <input type="text" class="form-control" id="edit-one" name="one">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">One One</label>
                                    <input type="text" class="form-control" id="edit-one-one" name="one_one">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Two</label>
                                    <input type="text" class="form-control" id="edit-two" name="two">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Two One</label>
                                    <input type="text" class="form-control" id="edit-two-one" name="two_one">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Three</label>
                                    <input type="text" class="form-control" id="edit-three" name="three">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Three One</label>
                                    <input type="text" class="form-control" id="edit-three-one" name="three_one">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Four</label>
                                    <input type="text" class="form-control" id="edit-four" name="four">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Five</label>
                                    <input type="text" class="form-control" id="edit-five" name="five">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Six</label>
                                    <input type="text" class="form-control" id="edit-six" name="six">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Seven</label>
                                    <input type="text" class="form-control" id="edit-seven" name="seven">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Seven One</label>
                                    <input type="text" class="form-control" id="edit-seven-one" name="seven_one">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Seven Two</label>
                                    <input type="text" class="form-control" id="edit-seven-two" name="seven_two">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Eight</label>
                                    <input type="text" class="form-control" id="edit-eight" name="eight">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Eight One</label>
                                    <input type="text" class="form-control" id="edit-eight-one" name="eight_one">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Nine</label>
                                    <input type="text" class="form-control" id="edit-nine" name="nine">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Nine One</label>
                                    <input type="text" class="form-control" id="edit-nine-one" name="nine_one">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Recall</label>
                                    <input type="text" class="form-control" id="edit-recall" name="recall">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">FG Parts</label>
                                    <input type="text" class="form-control" id="edit-fgparts" name="fgparts">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Shipment</label>
                                    <input type="text" class="form-control" id="edit-shipment" name="shipment">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Ship Sched</label>
                                    <input type="text" class="form-control" id="edit-ship-sched" name="ship_sched">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">WIP</label>
                                    <input type="text" class="form-control" id="edit-wip" name="wip">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Stop Process</label>
                                    <input type="text" class="form-control" id="edit-stop-proc" name="stop_proc">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" id="edit-location" name="location">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">MCS</label>
                                    <input type="text" class="form-control" id="edit-mcs" name="mcs">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">MCS Details</label>
                                    <input type="text" class="form-control" id="edit-mcs-details" name="mcs_details">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Customer Notification</label>
                                    <input type="text" class="form-control" id="edit-customer-notif" name="customer_notif">
                                </div>
                            </div>
                        </div>

                        <h5>File Attachments</h5>
                        <div id="edit-file-list" class="d-flex flex-wrap"></div>

                        <div class="mb-2">
                            <label class="form-label">Upload New Files</label>
                            <input type="file" class="form-control" id="edit-file-upload" name="files[]" multiple>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
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

    <script>
        $(document).ready(function() {
            $('.view-btn').click(function() {
                var ncprNum = $(this).data('id');
                // AJAX call to fetch full details
                $.ajax({
                    url: 'fetch_ncpr_details.php', // Your PHP file to fetch full data
                    method: 'POST',
                    data: {
                        ncpr_num: ncprNum
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#view-id').text(response.id);
                        $('#view-initiator').text(response.initiator);
                        $('#view-ncpr-num').text(response.ncpr_num);
                        $('#view-date').text(response.date);
                        $('#view-part-number').text(response.part_number);
                        $('#view-part-name').text(response.part_name);
                        $('#view-process').text(response.process);
                        $('#view-issue').text(response.issue);
                        // Check if urgent is "on"
                        if (response.urgent === "on") {
                            $('#view-urgent-checkbox').prop('checked', true); // Check the checkbox
                        } else {
                            $('#view-urgent-checkbox').prop('checked', false); // Uncheck the checkbox
                        }
                        if (response.repeating === "Yes") {
                            $('#repeating-yes').prop('checked', true);
                        } else {
                            $('#repeating-no').prop('checked', true);
                        }

                        $('#view-awpi').text(response.awpi);
                        $('#view-dc').text(response.dc);
                        if (response.deviation === "Yes") {
                            $('#deviation-yes').prop('checked', true);
                            $('#deviation-no').prop('checked', false);
                        } else {
                            $('#deviation-no').prop('checked', true);
                            $('#deviation-yes').prop('checked', false);
                        }
                        $('#view-repeating').text(response.repeating);
                        $('#view-cavity').text(response.cavity);
                        $('#view-machine').text(response.machine);
                        $('#view-ref').text(response.ref);
                        $('#view-bg').text(response.bg);
                        $('#view-mcs').text(response.mcs);
                        $('#view-mcs-details').text(response.mcs_details);
                        $('#view-customer-notif').text(response.customer_notif);
                        $('#view-recall').text(response.recall);
                        $('#view-fgparts').text(response.fgparts);
                        $('#view-shipment').text(response.shipment);
                        $('#view-location').text(response.location);
                        $('#view-ship_proc').text(response.ship_proc);
                        $('#view-wip').text(response.wip);
                        $('#view-ship_sched').text(response.ship_sched);
                        $('#view-stop_proc').text(response.stop_proc);

                        // Adding FOMO data
                        $('#view-supplier').text(response.supplier);
                        $('#view-supplier-part-name').text(response.supplier_part_name);
                        $('#view-supplier-part-number').text(response.supplier_part_number);
                        $('#view-invoice-num').text(response.invoice_num);
                        $('#view-purchase-order').text(response.purchase_order);

                        // New fields
                        $('#view-one').prop('checked', response.one === "yes");
                        $('#view-one-one').prop('checked', response.one_one === "yes");
                        $('#view-two').prop('checked', response.two === "yes");
                        $('#view-two-one').text(response.two_one);
                        $('#view-three').prop('checked', response.three === "yes");
                        $('#view-three-one').text(response.three_one);
                        $('#view-four').prop('checked', response.four === "yes");
                        $('#view-five').prop('checked', response.five === "yes");
                        $('#view-six').prop('checked', response.six === "yes");
                        if (response.seven === "yes") {
                            $('#view-seven-yes').prop('checked', true);
                            $('#view-seven-no').prop('checked', false);
                        } else if (response.seven === "no") {
                            $('#view-seven-yes').prop('checked', false);
                            $('#view-seven-no').prop('checked', true);
                        } else {
                            $('#view-seven-yes').prop('checked', false);
                            $('#view-seven-no').prop('checked', false);
                        }

                        $('#view-seven-one').text(response.seven_one);
                        $('#view-seven-two').text(response.seven_two);
                        $('#view-eight').prop('checked', response.eight === "yes")
                        $('#view-eight-one').text(response.eight_one);
                        $('#view-nine').prop('checked', response.nine === "yes")
                        $('#view-nine-one').text(response.nine_one);

                        if (
                            !response.supplier &&
                            !response.supplier_part_name &&
                            !response.supplier_part_number &&
                            !response.invoice_num &&
                            !response.purchase_order
                        ) {
                            $('.supplier-details').hide(); // This hides the entire section

                        } else {
                            $('.supplier-details').show(); // Show the supplier section
                        }

                        // Handling multiple material records
                        var materialTable = $('#material-table tbody');
                        materialTable.empty();

                        if (response.materials.length > 0) {
                            response.materials.forEach(function(material) {
                                materialTable.append(`
                            <tr>
                                <td style="font-size: 15px">${material.ntdj_num}</td>
                                <td style="font-size: 15px">${material.mns_num}</td>
                                <td style="font-size: 15px">${material.lot_sublot_qty}</td>
                                <td style="font-size: 15px">${material.qty_affected} - ${material.qty_affected_text}</td>
                                <td style="font-size: 15px">${material.defect_rate}%</td>
                            </tr>
                        `);
                            });
                        } else {
                            materialTable.append(`<tr><td colspan="7">No material records found</td></tr>`);
                        }

                        // Handling file attachments
                        var filesContainer = $('#file-list');
                        filesContainer.empty();

                        if (response.files.length > 0) {
                            response.files.forEach(function(file) {
                                let fileLink;
                                let fileType = file.file_type.toLowerCase();

                                if (fileType === "jpg" || fileType === "png" || fileType === "jpeg" || fileType === "gif") {
                                    // Image preview
                                    fileLink = `<img src="${file.file_path}" class="img-thumbnail" style="max-width: 150px; margin: 5px;" />`;
                                } else {
                                    // Download link
                                    fileLink = `<a href="${file.file_path}" download="${file.file_name}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i> Download ${file.file_name}
                                        </a>`;
                                }

                                filesContainer.append(`<div>${fileLink}</div>`);
                            });
                        } else {
                            filesContainer.append(`<p>No files uploaded</p>`);
                        }
                    },
                    error: function() {
                        alert('Failed to fetch data.');
                    }
                });
            });
        });


        $(document).on("click", ".edit-btn", function() {
            var ncprId = $(this).data("id");

            $.ajax({
                url: "fetch_ncpr_details.php",
                type: "POST",
                data: {
                    ncpr_num: ncprId
                },
                dataType: "json",
                success: function(response) {
                    $("#edit-id").val(response.id);
                    $("#edit-initiator").val(response.initiator);
                    $("#edit-ncpr-num").val(response.ncpr_num);
                    $("#edit-date").val(response.date);
                    $("#edit-part-number").val(response.part_number);
                    $("#edit-part-name").val(response.part_name);
                    $("#edit-process").val(response.process);
                    $("#edit-urgent").val(response.urgent);
                    $("#edit-issue").val(response.issue);
                    $("#edit-repeating").val(response.repeating);
                    $("#edit-machine").val(response.machine);
                    $("#edit-ref").val(response.ref);
                    $("#edit-location").val(response.location);
                    $("#edit-supplier").val(response.supplier);
                    $("#edit-supplier-part-name").val(response.supplier_part_name);
                    $("#edit-supplier-part-number").val(response.supplier_part_number);
                    // New fields added
                    $("#edit-invoice-num").val(response.invoice_num);
                    $("#edit-purchase-order").val(response.purchase_order);
                    $("#edit-one").val(response.one);
                    $("#edit-one-one").val(response.one_one);
                    $("#edit-two").val(response.two);
                    $("#edit-two-one").val(response.two_one);
                    $("#edit-three").val(response.three);
                    $("#edit-three-one").val(response.three_one);
                    $("#edit-four").val(response.four);
                    $("#edit-five").val(response.five);
                    $("#edit-six").val(response.six);
                    $("#edit-seven").val(response.seven);
                    $("#edit-seven-one").val(response.seven_one);
                    $("#edit-seven-two").val(response.seven_two);
                    $("#edit-eight").val(response.eight);
                    $("#edit-eight-one").val(response.eight_one);
                    $("#edit-nine").val(response.nine);
                    $("#edit-nine-one").val(response.nine_one);
                    $("#edit-recall").val(response.recall);
                    $("#edit-fgparts").val(response.fgparts);
                    $("#edit-shipment").val(response.shipment);
                    $("#edit-ship-sched").val(response.ship_sched);
                    $("#edit-wip").val(response.wip);
                    $("#edit-stop-proc").val(response.stop_proc);
                    $("#edit-location").val(response.location);
                    $("#edit-mcs").val(response.mcs);
                    $("#edit-mcs-details").val(response.mcs_details);
                    $("#edit-customer-notif").val(response.customer_notif);



                    // Load Material Details into Edit Modal Table
                    var materialTable = $('#edit-material-table tbody');
                    materialTable.empty();

                    if (response.materials.length > 0) {
                        response.materials.forEach(function(material) {
                            materialTable.append(`
                        <tr>
                            <td><input type="text" class="form-control" name="material_id[]" value="${material.material_id}"></td>
                            <td><input type="text" class="form-control" name="ntdj_num[]" value="${material.ntdj_num}"></td>
                            <td><input type="text" class="form-control" name="mns_num[]" value="${material.mns_num}"></td>
                            <td><input type="text" class="form-control" name="lot_sublot_qty[]" value="${material.lot_sublot_qty}"></td>
                            <td><input type="text" class="form-control" name="qty_affected[]" value="${material.qty_affected}"></td>
                            <td><input type="text" class="form-control" name="qty_affected_text[]" value="${material.qty_affected_text}"></td>
                            <td><input type="text" class="form-control" name="defect_rate[]" value="${material.defect_rate}"></td>
                        </tr>
                    `);
                        });
                    } else {
                        materialTable.append(`<tr><td colspan="7">No material records found</td></tr>`);
                    }

                    // Load existing files
                    var fileContainer = $("#edit-file-list");
                    fileContainer.empty();

                    if (response.files.length > 0) {
                        response.files.forEach(function(file) {
                            let fileHtml = `<div class="file-item">
                                    <a href="${file.file_path}" target="_blank">${file.file_name}</a>
                                    <button class="btn btn-danger btn-sm remove-file" data-id="${file.id}">Remove</button>
                                </div>`;
                            fileContainer.append(fileHtml);
                        });
                    }

                    $("#editModal").modal("show");
                }
            });
        });

        // Handle form submission
        $("#editForm").submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "update_ncpr.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("NCPR updated successfully!");
                    $("#editModal").modal("hide");
                    location.reload();
                }
            });
        });

        // Remove file functionality
        $(document).on("click", ".remove-file", function() {
            var fileId = $(this).data("id");
            $(this).parent().remove();

            $.post("delete_file.php", {
                file_id: fileId
            }, function(response) {
                console.log("File removed:", response);
            });
        });
    </script>

    <!-- DataTable Initialization -->
    <script>
        $(document).ready(function() {
            $('#ncprTable').DataTable(); // Initialize DataTable for sorting, searching, and pagination
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
</body>

</html>