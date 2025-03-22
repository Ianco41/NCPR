<?= htmlspecialchars($ncpr['initiator'] ?? 'N/A') ?>

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

<script>
    $(document).ready(function() {
        $(document).ready(function() {
            console.log("viewModal.js is loaded and running.");
            $('#ncprTable tbody').on('click', '.view-btn', function() {
                var ncprNum = $(this).data('id');

                $.ajax({
                    url: 'fetch_ncpr_details.php',
                    method: 'POST',
                    data: {
                        ncpr_num: ncprNum
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#viewModal #view-id').text(response.id);
                        $('#viewModal #view-initiator').text(response.initiator);
                        $('#viewModal #view-ncpr-num').text(response.ncpr_num);
                        $('#viewModal #view-date').text(response.date);
                        $('#viewModal #view-part-number').text(response.part_number);
                        $('#viewModal #view-part-name').text(response.part_name);
                        $('#viewModal #view-process').text(response.process);
                        $('#viewModal #view-issue').text(response.issue);

                        setCheckboxValue('#viewModal #view-urgent-checkbox', response.urgent);
                        setCheckboxValue('#viewModal #repeating-yes', response.repeating);
                        setCheckboxValue('#viewModal #deviation-yes', response.deviation);
                        setCheckboxValue('#viewModal #view-mcs', response.mcs);
                        setCheckboxValue('#viewModal #view-customer_notif', response.customer_notif);

                        setRadioButtonValue('viewModal view-recall', response.recall);
                        setRadioButtonValue('viewModal view-shipment', response.shipment);
                        setRadioButtonValue('viewModal view-stop_proc', response.stop_proc);
                        setRadioButtonValue('viewModal view-seven', response.seven);

                        $('#viewModal #view-awpi').text(response.awpi);
                        $('#viewModal #view-dc').text(response.dc);
                        $('#viewModal #view-cavity').text(response.cavity);
                        $('#viewModal #view-machine').text(response.machine);

                        var materialTable = $('#viewModal #material-table tbody');
                        materialTable.empty();

                        if (response.materials.length > 0) {
                            response.materials.forEach(function(material) {
                                materialTable.append(`
                            <tr>
                                <td>${material.ntdj_num}</td>
                                <td>${material.mns_num}</td>
                                <td>${material.lot_sublot_qty}</td>
                                <td>${material.qty_affected} - ${material.qty_affected_text}</td>
                                <td>${material.defect_rate}%</td>
                            </tr>
                        `);
                            });
                        } else {
                            materialTable.append('<tr><td colspan="7">No material records found</td></tr>');
                        }

                        var filesContainer = $('#viewModal #file-list');
                        filesContainer.empty();

                        if (response.files.length > 0) {
                            response.files.forEach(function(file) {
                                let fileLink = file.file_type.toLowerCase().match(/jpg|png|jpeg|gif/) ?
                                    `<img src="${file.file_path}" class="img-thumbnail" style="max-width: 150px; margin: 5px; margin-bottom: 10px;" />` :
                                    `<a href="${file.file_path}" download="${file.file_name}" class="btn btn-primary btn-sm">
                                <i class="fa fa-download"></i> Download ${file.file_name}
                              </a>`;
                                filesContainer.append(`<div>${fileLink}</div>`);
                            });
                        } else {
                            filesContainer.append('<p>No files uploaded</p>');
                        }
                    },
                    error: function() {
                        alert('Failed to fetch data.');
                    }
                });
            });
        });

        function setCheckboxValue(selector, value) {
            $(selector).prop("checked", value === "yes");
        }

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
        $('#ncprTable tbody').on('click', '.submit-btn', function() {
            var ncprNum = $(this).data('id'); // Get the NCPR number
            console.log("Clicked add button for NCPR number:", ncprNum);

            // First AJAX to check dispo_id
            $.ajax({
                url: 'check_dispo.php', // PHP script to check dispo_id
                method: 'POST',
                data: {
                    ncpr_num: ncprNum
                },
                dataType: 'json',
                beforeSend: function() {
                    console.log("Checking dispo_id for NCPR number:", ncprNum);
                },
                success: function(response) {
                    console.log("AJAX Response from check_dispo.php:", response);

                    if (response.has_dispo) {
                        console.log("Dispo ID exists for NCPR number:", ncprNum, "- Switching to view-only mode.");
                        fetchNcprDetails(ncprNum, true);
                    } else {
                        console.log("No dispo ID found for NCPR number:", ncprNum, "- Allowing editing.");
                        fetchNcprDetails(ncprNum, false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error in AJAX request:", status, error);
                    console.log("XHR Response:", xhr.responseText);
                    alert('Failed to check dispo status.');
                }
            });
        });

        function fetchNcprDetails(ncprNum, viewOnly) {
            $.ajax({
                url: 'fetch_dispo_details.php',
                method: 'POST',
                data: {
                    ncpr_num: ncprNum
                },
                dataType: 'json',
                success: function(response) {
                    $('#view-id').text(response.id);
                    $('#view-ncpr-num').text(response.ncpr_num);

                    // Disposition Details
                    $('#view-dispo-name').text(response.dispo_name);
                    $('#view-method').text(response.method);
                    $('#view-machine').text(response.machine);

                    // CNC Material Details
                    $('#view-nfld-item').text(response.nfld_item);
                    $('#view-nfld-item-pur-item').text(response.nfld_item_pur_item);
                    $('#view-fe-expired').text(response.FE_expired);
                    $('#view-local-supp').text(response.local_supp);
                    $('#view-imi').text(response.imi);
                    $('#view-pff').text(response.pff);

                    // CAR Details
                    $('#view-car-is-approved').text(response.car_is_approved);
                    $('#view-car-num-active').text(response.car_num_active);
                    $('#view-car-num').text(response.car_num);
                    $('#view-8d-report-active').text(response["8d_report_active"]);
                    $('#view-scar-active').text(response.scar_active);
                    $('#view-scar-num').text(response.scar_num);

                    // DRF Details
                    $('#view-ntpi-active').text(response.NTPI_active);
                    $('#view-mrb-active').text(response.MRB_active);
                    $('#view-nfld-active').text(response.NFLD_active);
                    $('#view-cust-is-approve').text(response.cust_is_approve);
                    $('#view-doc-alert-num').text(response.doc_alert_num);

                    // Product Disposition Details
                    setCheckboxValue('#view-use-as-is', response.use_as_isActive);
                    setCheckboxValue('#view-re-inspection', response.re_inspectionActive);
                    setCheckboxValue('#view-run-normal', response.run_normalActive);
                    setCheckboxValue('#view-regrade', response.regrade_Active);
                    setCheckboxValue('#view-rework', response.rework_Active);
                    setCheckboxValue('#view-repair', response.repair_Active);
                    setCheckboxValue('#view-rework-traveler', response.rework_traveler_Active);
                    setCheckboxValue('#view-scrap', response.scrap_Active);
                    setCheckboxValue('#view-rtv', response.RTV_Active);

                    $('#view-yield-off').text(response.yield_off);
                    $('#view-da-no').text(response.da_no);
                    $('#view-rework-da-no').text(response.rework_da_no);
                    $('#view-wis-no').text(response.wis_no);
                    $('#view-scrap-amount').text(response.scrap_amount);
                    $('#view-shipment-date').text(response.shipment_date);

                    // Additional Disposition Details
                    $('#view-intervention-id').text(response.intervention_id);
                    $('#view-rework-type-id').text(response.rework_type_id);

                    // Handling Files


                    // View-only mode: Disable form fields
                    console.log("AJAX Response Data:", response); // Debugging the response
                    if (viewOnly) {
                        $('#ncprModal input, #ncprModal textarea, #ncprModal select').prop('disabled', true);
                    } else {
                        $('#ncprModal input, #ncprModal textarea, #ncprModal select').prop('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    console.error("Response Text:", jqXHR.responseText || "No response from server");

                    alert('Failed to fetch data. Check the console for details.');
                }
            });
        }

        // Checkbox Setter
        function setCheckboxValue(selector, value) {
            $(selector).prop("checked", value === "yes");
        }

        // Radio Button Setter
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
    });
</script>