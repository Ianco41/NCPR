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
        font-family: 'Poppins', sans-serif;
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
        height: 100vh;
        /* Full viewport height */
        position: sticky;
        /* ✅ Keeps sidebar sticky */
        top: 0;
        /* ✅ Ensures it stays at the top when scrolling */
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
        flex-grow: 1;
        /* ✅ Allows it to take available space and push footer down */
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
                        <h5 class="mb-3">NCPR Recently Filed Table</h5>
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

    <!-- Modal Structure -->
    <div class="modal fade" id="dispoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Disposition Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dispoForm" action="dispo_process.php" method="POST">
                        <p>Selected ID: <span id="modal-id"></span></p>
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
                                        <?php if (isAuthorized([$user_role])): ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item approval-action" href="#" data-action="approve" data-role="QA Engineer">Approve</a></li>
                                                    <li><a class="dropdown-item approval-action" href="#" data-action="reject" data-role="QA Engineer">Reject</a></li>
                                                    <li><a class="dropdown-item approval-action" href="#" data-action="cancel" data-role="QA Engineer">Cancel</a></li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
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

    <script src="assets/vendor/bootstrap/js/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/all.min.js"></script>
    <script src="assets/vendor/bootstrap/js/fontawesome.min.js"></script>
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
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