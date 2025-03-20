<?php
//require "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>admin Dashboard</title>
    <!-- Bootstrap CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
                    <a href="#">ENGINEER</a>
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
                    <a href="ncprfiling.php" class="sidebar-link">
                        <i class="fa-regular fa-folder-open"></i>
                        <span>NCPR Filing</span>
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
                    <div class="row d-flex">
                        <div class="border mb-3 align-items-center p-2">
                            <h5 class="text-center">NON-CONFORMING PRODUCT RECORD</h5>
                        </div>
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
                                    <input class="form-check-input form-check-input-sm" type="checkbox" id="deviation-yes">
                                    <label class="form-check-label" for="deviation-yes" style="font-size: 10px;">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-sm" type="checkbox" id="deviation-no">
                                    <label class="form-check-label" for="deviation-no" style="font-size: 10px;">No</label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="m-0" style="font-size: 12px;"><strong>Issue Repeating?</strong></p>
                                <div class="form-check form-check-inline" style="margin-left: 12px;">
                                    <input class="form-check-input form-check-input-sm" type="checkbox" id="repeating-yes">
                                    <label class="form-check-label" for="repeating-yes" style="font-size: 10px;">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input form-check-input-sm" type="checkbox" id="repeating-no">
                                    <label class="form-check-label" for="repeating-no" style="font-size: 10px;">No</label>
                                </div>
                            </div>
                            <div style="display: d-block; align-items: center;">
                                <span class="d-inline-block" style="font-size: 12px;"><strong>Cavity Affected:</strong></span>
                                <span id="view-cavity" class="border-bottom border-dark d-inline-block text-center" style="min-width: 100px; font-size: 12px"></span>
                            </div>

                            <div style="display: d-block; align-items: center;">
                                <span class="d-inline-block" style="font-size: 12px;"><strong>Machine:</strong></span>
                                <span id="view-machine" class="border-bottom border-dark d-inline-block text-center" style="min-width: 100px; font-size: 12px"></span>
                            </div>
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
                                    <input type="checkbox" class="form-check-input" id="view-one" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span style="font-size: 12px;">1. Segregate affected part/s - write custodian of the segregated parts</span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-one-one" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span style="font-size: 12px;"><strong>1.1. At Hotpress:</strong>Put on hold inventory of affected lay-up materials together with the parts</span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-two" style="width: 12px; height: 12px; margin-right: 5px;">

                                    <span style="font-size: 12px;" class="me-2">2. Yield off/ 100% inspection. <strong>INSPECTION RESULTS:</strong></span>
                                    <span id="view-two-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 100px;"></span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-three" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span style="font-size: 12px;" class="me-2">3. Call the attention of QAE/PE/EE/TECH/CHIEF:</span>
                                    <span id="view-three-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 200px;"></span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-four" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span id="view-four" style="font-size: 12px;" class="me-2">4. Attach On-hold Tag and put in On-Hold cage/area</span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-five" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span id="view-five" style="font-size: 12px;">5. Check MCS stock for similar Lot Number/AWPI/DC and request to file NCPR</span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-six" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span id="view-six" style="font-size: 12px;">6. Attach copy of OCAP if available, and/or other log forms as part of the containment action</span>
                                </div>
                            </div>
                            <div style="display: inline-flex; align-items: center; gap: 10px;">
                                <span style="font-size: 12px;">7. File Shutdown Record</span>

                                <label style="font-size: 12px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-seven-yes" style="width: 12px; height: 12px; margin-right: 5px;"> Yes
                                </label>

                                <label style="font-size: 12px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-seven-no" style="width: 12px; height: 12px; margin-right: 5px;"> No
                                </label>
                                <span style="font-size: 12px;">WHO:</span>
                                <span id="view-seven-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 80px;"></span>
                                <span style="font-size: 12px;">TIME/SHIFT:</span>
                                <span id="view-seven-two" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 80px;"></span>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-eight" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span style="font-size: 12px;" class="me-2">8. Others (please specify):</span>
                                    <span id="view-eight-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 300px;"></span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-nine" style="width: 12px; height: 12px; margin-right: 5px;">
                                    <span style="font-size: 12px;" class="me-2">9. Find affected WIP, FG & raw materials - specify DJ/s and LN/s</span>
                                    <span id="view-nine-one" style="font-size: 12px; display: inline-block; border-bottom: 1px solid black; min-width: 150px;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border p-2">
                            <div style="display: inline-flex; align-items: center; gap: 100px;" class="mb-3">
                                <span style="font-size: 15px;">Product Recall</span>

                                <label style="font-size: 15px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-recall-yes" style="margin-right: 5px;"> Yes
                                </label>

                                <label style="font-size: 15px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-recall-no" style="margin-right: 5px;"> No
                                </label>
                            </div>
                            <div style="display: inline-flex; align-items: center; gap: 50px;" class="mb-3">
                                <div style="display: block;">
                                    <div style="display: inline-flex; align-items: center;">
                                        <input type="checkbox" class="form-check-input" id="view-fgparts" style="margin-right: 5px;">
                                        <span id="view-fgparts" style="font-size: 15px;">FG PARTS</span>
                                    </div>
                                </div>

                                <span style="font-size: 15px;">Cancel Shipment</span>

                                <label style="font-size: 15px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-shipment-yes" style="margin-right: 5px;"> Yes
                                </label>

                                <label style="font-size: 15px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-shipment-no" style="margin-right: 5px;"> No
                                </label>
                            </div>

                            <span class="d-inline-block" style="font-size: 15px;"><strong>Shipment SCHEDULE:</strong></span>
                            <span id="view-ship_sched" class="border-bottom border-dark d-inline-block text-center" style="min-width: 500px; font-size: 15px"></span>
                            <div style="display: inline-flex; align-items: center; gap: 50px;" class="mt-3">
                                <div style="display: block;">
                                    <div style="display: inline-flex; align-items: center;">
                                        <input type="checkbox" class="form-check-input" id="view-wip" style="margin-right: 5px;">
                                        <span id="view-wip" style="font-size: 15px;">WIP</span>
                                    </div>
                                </div>

                                <span style="font-size: 15px;">Stop Process</span>

                                <label style="font-size: 15px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-stop_proc-yes" style="margin-right: 5px;"> Yes
                                </label>

                                <label style="font-size: 15px; display: flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-stop_proc-no" style="margin-right: 5px;"> No
                                </label>
                            </div>
                            <div style="display: block;">
                                <div style="display: d-block; align-items: center;">
                                    <span class="d-inline-block" style="font-size: 15px;"><strong>LOCATIONS:</strong></span>
                                    <span id="view-location" class="border-bottom border-dark d-inline-block text-center" style="min-width: 500px; font-size: 15px"></span>
                                </div>
                            </div>
                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-mcs" style="margin-right: 5px;">
                                    <div style="display: d-block; align-items: center;">
                                        <span id="view-mcs" style="font-size: 15px;">MCS</span>
                                        <span id="view-mcs_details" class="border-bottom border-dark d-inline-block text-center" style="min-width: 300px; font-size: 15px"></span>
                                    </div>
                                </div>
                            </div>

                            <div style="display: block;">
                                <div style="display: inline-flex; align-items: center;">
                                    <input type="checkbox" class="form-check-input" id="view-customer_notif" style="margin-right: 5px;">
                                    <span id="view-customer_notif" style="font-size: 15px;">Customer notification if non-conforming products have been shipped.</span>
                                </div>
                            </div>
                        </div>
                    </div>



                    <h5 class="text-center mb-5 mt-5">File Attachments</h5>
                    <div id="file-list" class="d-block flex-wrap">
                        <!-- Files will be dynamically inserted here -->
                    </div>
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
                    <form id="dispoForm" action="dispo_process.php" method="POST">

                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="containment" id="containment" placeholder="Enter details here..." style="height: 100px;"></textarea>
                            <label for="containment">This space is intended for QA verification, containment and investigation activities</label>
                        </div>

                        <!-- Cause of Non-Conformance Table -->
                        <table class="table table-bordered align-middle">
                            <tr>
                                <td>
                                    <div class="form-floating">
                                        <input class="form-control" name="non-conformance" id="non-conformance">
                                        <label for="non-conformance">Cause of Non-conformance:</label>
                                    </div>
                                </td>
                                <td>
                                    <strong>Potential Field Failure:</strong><br>
                                </td>
                                <!-- Corrective Action Request -->
                                <td class="d-flex align-items-center gap-3 mt-3">
                                    <strong class="me-2">Corrective Action Request:</strong>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="corrective_action" value="YES" id="corrective_yes">
                                            <label class="form-check-label" for="corrective_yes">YES</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="corrective_action" value="NO" id="corrective_no">
                                            <label class="form-check-label" for="corrective_no">NO</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="corrective_action" value="NA" id="corrective_na">
                                            <label class="form-check-label" for="corrective_na">NA</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <!-- Cause of Non-Conformance -->
                                <td>
                                    <div class="d-flex">
                                        <!-- Left Side -->
                                        <div class="me-4">
                                            <input type="checkbox" name="cause[]" value="Man"> Man<br>
                                            <label>ID No:</label>
                                            <input type="text" name="id_no" class="border-0 border-bottom w-75"><br>
                                            <label>Name:</label>
                                            <input type="text" name="name" class="border-0 border-bottom w-75"><br>
                                            <input type="checkbox" name="cause[]" value="Method"> Method<br>
                                            <input type="checkbox" name="cause[]" value="Machine"> Machine<br>
                                        </div>

                                        <!-- Right Side -->
                                        <div>
                                            <input type="checkbox" name="cause[]" value="Material"> Material<br>
                                            <input type="checkbox" name="cause[]" value="NID Item"> N.I.D Item<br>
                                            <input type="checkbox" name="cause[]" value="NID Purchased Item"> N.I.D Purchased Item<br>
                                            <input type="checkbox" name="cause[]" value="For Expiry Expired"> For Expiry Expired<br>
                                            <input type="checkbox" name="cause[]" value="Local Supplier"> Local Supplier<br>
                                            <input type="checkbox" name="cause[]" value="Customer Furnish Material">
                                            <span style="color: blue; text-decoration: underline;">Customer Furnish Material</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input type="radio" name="potential_failure" value="Yes" class="mb-5"> Yes<br>
                                    <input type="radio" name="potential_failure" value="No"> No<br>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="checkbox" name="car" value="CAR"> CAR, CAR No:
                                        <input type="text" name="car_no" class="border-0 border-bottom w-20 ms-2">
                                        <span class="me-2">8D Report:</span>
                                        <input type="radio" name="bd_report" value="YES" class="me-1"> YES
                                        <input type="radio" name="bd_report" value="NO" class="ms-3 me-1"> NO
                                    </div>
                                    <div class="d-flex align-items-center mt-5">
                                        <input type="checkbox" name="scar" value="SCAR"> SCAR, SCAR No:
                                        <input type="text" name="scar_no" class="border-0 border-bottom w-50"><br>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div>
                            <span class="fw-bold" style="font-size: 15px">
                                Disposition Required From:
                            </span>
                        </div>
                        <!-- Disposition Required From Section -->
                        <table class="table table-bordered align-middle">
                            <tr>
                                <td colspan="2">
                                    <input type="checkbox" name="dispo_from[]" value="NTPI"> NTPI

                                    <strong>MRB:</strong>
                                    <input type="radio" name="mrb" value="YES"> YES
                                    <input type="radio" name="mrb" value="NO"> NO

                                </td>
                                <td>
                                    <!-- First Checkbox Section -->
                                    <div class="mb-2">
                                        <input type="checkbox" name="dispo_from[]" value="NFLD"> NFLD (Attach reference e-mail)
                                    </div>

                                    <!-- Second Section with Spacing and Inline Layout -->
                                    <div class="d-flex align-items-center flex-wrap gap-3">
                                        <strong>Need Customer Approval?</strong>
                                        <input type="radio" name="customer_approval" value="YES"> YES
                                        <input type="radio" name="customer_approval" value="NO"> NO
                                        <span>Document Alert No:</span>
                                        <input type="text" name="document_alert" class="border-0 border-bottom w-25">
                                    </div>

                                </td>
                            </tr>

                            <table class="table border">
                                <tr>
                                    <!-- Left Side: Impact Analysis / Risk Assessment -->
                                    <td colspan="2">
                                        <strong>IMPACT ANALYSIS / RISK ASSESSMENT:</strong>
                                        <div class="d-flex gap-3 align-items-center flex-wrap mt-2">
                                            <input type="checkbox" name="impact_analysis[]" value="Review of NCP FMEA"> Review of NCP FMEA
                                            <input type="checkbox" name="impact_analysis[]" value="Review of NCP Control Plan"> Review of NCP Control Plan
                                        </div>
                                        <div class="form-floating w-100 mt-2">
                                            <textarea id="impact_analysis" name="impact_analysis" class="form-control" placeholder="Enter impact analysis here..." rows="2"></textarea>
                                            <label for="impact_analysis">Notes:</label>
                                        </div>
                                    </td>

                                    <!-- Right Section (Spanning Rows) -->
                                    <td style="width: 40%; vertical-align: top;" rowspan="2">
                                        <div class="h-100 d-flex flex-column justify-content-between">
                                            <div class="mb-2">
                                                <input type="checkbox" name="affected_business" value="Affected business"> Affected business unit/ contact person <br>
                                                <input type="text" name="contact_person" class="border-0 border-bottom w-100">
                                            </div>
                                            <div>
                                                <input type="checkbox" name="other_instructions" value="Other instructions"> Other instructions,
                                                <span>pls specify;</span><br>
                                                <input type="text" name="other_specify" class="border-0 border-bottom w-100">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Product Disposition (Left Side) -->
                                <tr>
                                    <td colspan="2">
                                        <strong>PRODUCT DISPOSITION:</strong>
                                        <div class="d-flex gap-3 align-items-center flex-wrap mt-2">
                                            <input type="checkbox" name="product_dispo[]" value="Use as is"> Use as is
                                            <input type="checkbox" name="product_dispo[]" value="Re-inspection"> Re-inspection
                                            <input type="checkbox" name="product_dispo[]" value="Run under normal process"> Run under normal process
                                        </div>
                                        <div class="d-flex align-items-center mt-2">
                                            Yield-off $ <input type="text" name="yield_off" class="border-0 border-bottom w-25 ms-2">
                                        </div>
                                        <div class="d-flex align-items-center mt-2 gap-2">
                                            <input type="checkbox" name="product_dispo[]" value="Re-grade"> Re-grade, DA No:
                                            <input type="text" name="da_no" class="border-0 border-bottom w-25 ms-2">
                                        </div>
                                        <div class="d-flex align-items-center mt-2 gap-2">
                                            <input type="checkbox" name="product_dispo[]" value="Rework"> Rework, DA No:
                                            <input type="text" name="rework_da_no" class="border-0 border-bottom w-25 ms-2">
                                            WIS No:
                                            <input type="text" name="wis_no" class="border-0 border-bottom w-25 ms-2">
                                        </div>
                                        <div class="d-flex gap-3 align-items-center flex-wrap mt-2 gap-2">
                                            <input type="checkbox" name="product_dispo[]" value="Re-press"> Re-press
                                            <input type="checkbox" name="product_dispo[]" value="Re-plate"> Re-plate
                                            <input type="checkbox" name="product_dispo[]" value="Re-Etest"> <span>Re-Etest</span>
                                            <input type="checkbox" name="product_dispo[]" value="Re-measure"> Re-measure
                                            <input type="checkbox" name="product_dispo[]" value="Rework Traveler"> Rework Traveler
                                        </div>
                                        <div class="d-flex align-items-center mt-2 gap-2">
                                            <input type="checkbox" name="product_dispo[]" value="Repair"> Repair, Document Alert #:
                                            <input type="text" name="document_alert" class="border-0 border-bottom w-25 ms-2">
                                            <input type="checkbox" name="product_dispo[]" value="Rework Traveler"> Rework Traveler
                                        </div>
                                        <div class="d-flex align-items-center mt-2 gap-2">
                                            <input type="checkbox" name="product_dispo[]" value="Scrap"> Scrap $
                                            <input type="text" name="scrap_amount" class="border-0 border-bottom w-25 ms-2">
                                        </div>
                                        <div class="d-flex align-items-center mt-2">
                                            <input type="checkbox" name="product_dispo[]" value="RTV"> RTV <span style="color: blue; text-decoration: underline; margin-left: 20px;">Shipment Date:</span>
                                            <input type="text" name="shipment_date" class="border-0 border-bottom w-25 ms-2">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div>
                                <span class="fw-bold" style="font-size: 15px">
                                    For non-conforming product disposition requiring PE/ EE intervention; Otherwise, not applicable.
                                </span>
                            </div>

                            <table class="table table-bordered">

                                <!-- Actions Taken & Reason for Resumption -->
                                <tr>
                                    <td style="width: 33%; vertical-align: top;">
                                        <strong>Actions Taken:</strong><br>
                                        <input type="checkbox" name="actions_taken[]" value="Problem solving/troubleshooting"> Problem solving/troubleshooting<br>
                                        <input type="checkbox" name="actions_taken[]" value="Process Verification/Engg Eval"> Process Verification /
                                        <span>Eng'g Eval.</span>

                                        <br><br>
                                        <strong>Process Disposition:</strong><br>
                                        <input type="checkbox" name="process_dispo[]" value="Resume Production"> Resume Production<br>
                                        <input type="checkbox" name="process_dispo[]" value="Stop Production"> Stop Production
                                        <br><br>
                                        <span>Affected process/es:</span>
                                        <input type="text" name="affected_process" class="border-0 border-bottom w-100"><br><br>
                                        <input type="checkbox" name="further_eval" value="For further Eng'g Evaluation">
                                        <span>For further Eng’g Evaluation</span>
                                    </td>

                                    <td style="width: 33%; vertical-align: top;">
                                        <strong>Reason for Resumption:</strong><br>
                                        <input type="checkbox" name="resumption_reason[]" value="Criteria"> Criteria
                                        <input type="checkbox" name="resumption_reason[]" value="Method"> Method
                                        <input type="checkbox" name="resumption_reason[]" value="Materials"> Materials
                                        <input type="checkbox" name="resumption_reason[]" value="Machine"> Machine
                                        <br><br>
                                        <input type="checkbox" name="resumption_reason[]" value="Machine/fixture repair"> Machine/fixture repair<br>
                                        <input type="checkbox" name="resumption_reason[]" value="Others">
                                        <span>Others, pls specify</span>
                                        <br>
                                        <input type="text" name="other_resumption" class="border-0 border-bottom w-100"><br><br>

                                        <strong>Process Instruction in general:</strong>
                                        <span>(for <span>DJs</span> other than the affected)</span>
                                        <textarea class="form-control mt-2" name="process_instruction" rows="2"></textarea>
                                    </td>

                                    <td style="width: 33%; vertical-align: top;">
                                        <strong>Instructions in detail, see reference doc:</strong><br>
                                        <input type="checkbox" name="instructions_detail[]" value="Document Alert #"> Document Alert #:
                                        <input type="text" name="document_alert" class="border-0 border-bottom w-75"><br>

                                        <input type="checkbox" name="instructions_detail[]" value="Other">
                                        <span>Other (pls specify)</span>
                                        <input type="text" name="other_specify" class="border-0 border-bottom w-75">
                                        <br><br>

                                        <strong>Documents needing revision:</strong><br>
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="documents_revision[]" value="N/A" id="doc_na">
                                                <label class="form-check-label" for="doc_na" style="font-size: 12px;">N/A</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="documents_revision[]" value="WIS" id="doc_wis">
                                                <label class="form-check-label" for="doc_wis" style="font-size: 12px;">WIS</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="documents_revision[]" value="DJ" id="doc_dj">
                                                <label class="form-check-label" for="doc_dj" style="font-size: 12px;">DJ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="documents_revision[]" value="PROC" id="doc_proc">
                                                <label class="form-check-label" for="doc_proc" style="font-size: 12px;">PROC</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="documents_revision[]" value="CP" id="doc_cp">
                                                <label class="form-check-label" for="doc_cp" style="font-size: 12px;">CP</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="documents_revision[]" value="PFMEA" id="doc_pfmea">
                                                <label class="form-check-label" for="doc_pfmea" style="font-size: 12px;">PFMEA</label>
                                            </div>
                                        </div>

                                        <br><br>

                                        <strong>Process Released By:</strong>
                                        <input type="text" name="released_by" class="border-0 border-bottom w-100">
                                        <br>
                                        <div class="text-center mt-3">
                                            <small>(Signature Above Printed Name/ Date)</small>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <!-- Approving Authorities & Distribution Section -->
                            <table class="table table-bordered mt-3">
                                <tr>
                                    <th colspan="4" class="text-center">Approving Authorities</th>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>QA Engineer / NT Representative:</strong><br>
                                        (Signature & Date)
                                    </td>
                                    <td>
                                        <strong>QA Manager or his/her appointee:</strong><br>
                                        (Signature & Date)
                                    </td>
                                    <td>
                                        <strong>Sheilah / NT Representative:</strong><br>
                                        (Signature & Date)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-floating">
                                            <input type="text" name="acknowledgment_signature" class="form-control" id="acknowledgment_signature" placeholder="Signature">
                                            <label for="acknowledgment_signature"><strong>Acknowledgment</strong></label>
                                        </div>
                                        <small class="text-muted">(Applies only with CAR & COPQ issues)</small>
                                    </td>

                                    <!-- PE or EE Head Section -->
                                    <td>
                                        <div class="form-floating">
                                            <input type="text" name="pe_ee_head_signature" class="form-control" id="pe_ee_head_signature" placeholder="PE or EE Head">
                                            <label for="pe_ee_head_signature"><strong>PE or EE Head or his/her appointee:</strong></label>
                                        </div>
                                    </td>

                                    <!-- Production Manager Section -->
                                    <td>
                                        <div class="form-floating">
                                            <input type="text" name="prod_manager_signature" class="form-control" id="prod_manager_signature" placeholder="Production Manager">
                                            <label for="prod_manager_signature"><strong>Production Manager or his/her appointee:</strong></label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered mt-3">
                                <!-- File Attachment Section -->
                                <tr>
                                    <td colspan="3">
                                        <strong>Attach Supporting Documents:</strong><br>
                                        <div id="fileUploadContainer">
                                            <div class="file-input-group d-flex align-items-center">
                                                <input type="file" name="attachments[]" class="form-control mb-2">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-sm mt-2" onclick="addFileInput()">Add More Files</button>
                                        <small class="text-muted d-block mt-1">You can upload multiple files (Excel, PDF, Images, etc.).</small>
                                    </td>
                                </tr>
                            </table>

                            <script>
                                function addFileInput() {
                                    let container = document.getElementById('fileUploadContainer');

                                    let div = document.createElement('div');
                                    div.className = "file-input-group d-flex align-items-center";

                                    let input = document.createElement('input');
                                    input.type = 'file';
                                    input.name = 'attachments[]';
                                    input.className = 'form-control mb-2';

                                    let removeBtn = document.createElement('button');
                                    removeBtn.type = 'button';
                                    removeBtn.className = 'btn btn-danger ms-2';
                                    removeBtn.innerHTML = 'Delete';
                                    removeBtn.onclick = function() {
                                        removeFileInput(this);
                                    };

                                    div.appendChild(input);
                                    div.appendChild(removeBtn);
                                    container.appendChild(div);
                                }

                                function removeFileInput(button) {
                                    button.parentElement.remove();
                                }
                            </script>

                            <div class="text-end p-3">
                                <button type="submit" class="btn btn-success">APPROVE</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">REJECT</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <button class="btn btn-primary btn-sm view-btn" 
                                data-id="${row.ncpr_num}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#viewModal">
                            View
                        </button>
                        <button class="btn btn-success btn-sm add-btn" 
                                data-id="${row.ncpr_num}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#dispoModal">
                            Dispo
                        </button>`;
                        }
                    }
                ],
                "order": [
                    [0, "desc"]
                ],
            });
        });
        $(document).ready(function() {
            // Use event delegation to handle dynamically created elements
            $('#ncprTable tbody').on('click', '.view-btn', function() {
                var ncprNum = $(this).data('id'); // Get the ID from the clicked button

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

                        // Set checkbox values
                        setCheckboxValue('#view-urgent-checkbox', response.urgent);
                        setCheckboxValue('#repeating-yes', response.repeating);
                        setCheckboxValue('#deviation-yes', response.deviation);
                        setCheckboxValue('#view-mcs', response.mcs);
                        setCheckboxValue('#view-customer_notif', response.customer_notif);
                        setCheckboxValue('#view-fgparts', response.fgparts);
                        setCheckboxValue('#view-wip', response.wip);
                        setCheckboxValue('#view-one', response.one);
                        setCheckboxValue('#view-one-one', response.one_one);
                        setCheckboxValue('#view-two', response.two);
                        setCheckboxValue('#view-three', response.three);
                        setCheckboxValue('#view-four', response.four);
                        setCheckboxValue('#view-five', response.five);
                        setCheckboxValue('#view-six', response.six);
                        setCheckboxValue('#view-eight', response.eight);
                        setCheckboxValue('#view-nine', response.nine);

                        // Handle radio buttons for recall, shipment, stop_proc, and seven
                        setRadioButtonValue('view-recall', response.recall);
                        setRadioButtonValue('view-shipment', response.shipment);
                        setRadioButtonValue('view-stop_proc', response.stop_proc);
                        setRadioButtonValue('view-seven', response.seven);

                        // Handle text fields
                        $('#view-awpi').text(response.awpi);
                        $('#view-dc').text(response.dc);
                        $('#view-cavity').text(response.cavity);
                        $('#view-machine').text(response.machine);
                        $('#view-ref').text(response.ref);
                        $('#view-bg').text(response.bg);
                        $('#view-mcs_details').text(response.mcs_details);
                        $('#view-location').text(response.location);
                        $('#view-ship_proc').text(response.ship_proc);
                        $('#view-ship_sched').text(response.ship_sched);
                        $('#view-two-one').text(response.two_one);
                        $('#view-three-one').text(response.three_one);
                        $('#view-seven-one').text(response.seven_one);
                        $('#view-seven-two').text(response.seven_two);
                        $('#view-eight-one').text(response.eight_one);
                        $('#view-nine-one').text(response.nine_one);

                        // Supplier details
                        $('#view-supplier').text(response.supplier);
                        $('#view-supplier-part-name').text(response.supplier_part_name);
                        $('#view-supplier-part-number').text(response.supplier_part_number);
                        $('#view-invoice-num').text(response.invoice_num);
                        $('#view-purchase-order').text(response.purchase_order);

                        // Show/hide supplier details
                        if (
                            !response.supplier &&
                            !response.supplier_part_name &&
                            !response.supplier_part_number &&
                            !response.invoice_num &&
                            !response.purchase_order
                        ) {
                            $('.supplier-details').hide();
                        } else {
                            $('.supplier-details').show();
                        }

                        // Handle material records
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

                        // Handle file attachments
                        var filesContainer = $('#file-list');
                        filesContainer.empty();

                        if (response.files.length > 0) {
                            response.files.forEach(function(file) {
                                let fileLink;
                                let fileType = file.file_type.toLowerCase();

                                if (['jpg', 'png', 'jpeg', 'gif'].includes(fileType)) {
                                    // Image preview
                                    fileLink = `<img src="${file.file_path}" class="img-thumbnail" style="max-width: 150px; margin: 5px; margin-bottom: 10px;" />`;
                                } else {
                                    // Download link
                                    fileLink = `<a href="${file.file_path}" download="${file.file_name}" class="btn btn-primary btn-sm" 
                                style="margin-bottom: 10px;">
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

        // Function to set checkbox value
        function setCheckboxValue(selector, value) {
            $(selector).prop("checked", value === "yes");
        }

        // Function to set radio button values
        function setRadioButtonValue(name, value) {
            if (value === "yes") {
                $(`#${name}-yes`).prop("checked", true);
                $(`#${name}-no`).prop("checked", false);
            } else if (value === "no") {
                $(`#${name}-yes`).prop("checked", false);
                $(`#${name}-no`).prop("checked", true);
            } else {
                $(`#${name}-yes`).prop("checked", false);
                $(`#${name}-no`).prop("checked", false);
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