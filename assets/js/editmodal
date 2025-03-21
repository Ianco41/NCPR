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
                    if (response.urgent === "on") {
                        $("#edit-urgent-checkbox").prop("checked", true);
                    } else {
                        $("#edit-urgent-checkbox").prop("checked", false);
                    }

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
                    // Set checkboxes
                    setCheckboxValue("#edit-one", response.one);
                    setCheckboxValue("#edit-one_one", response.one_one);
                    setCheckboxValue("#edit-two", response.two);
                    $("#edit-two_one").val(response.two_one);
                    setCheckboxValue("#edit-three", response.three);
                    $("#edit-three_one").val(response.three_one);
                    setCheckboxValue("#edit-four", response.four);
                    setCheckboxValue("#edit-five", response.five);
                    setCheckboxValue("#edit-six", response.six);
                    // Set the value of the text inputs
                    $("#edit-seven_one").val(response.seven_one);
                    $("#edit-seven_two").val(response.seven_two);
                    // Check the correct checkbox based on response.seven value
                    if (response.seven === "yes") {
                        $("#seven-yes").prop("checked", true);
                        $("#seven-no").prop("checked", false);
                    } else if (response.seven === "no") {
                        $("#seven-no").prop("checked", true);
                        $("#seven-yes").prop("checked", false);
                    } else {
                        $("#seven-yes").prop("checked", false);
                        $("#seven-no").prop("checked", false);
                    }
                    setCheckboxValue("#edit-eight", response.eight);
                    $("#edit-eight_one").val(response.eight_one);
                    setCheckboxValue("#edit-nine", response.nine);
                    $("#edit-nine_one").val(response.nine_one);

                    // Product Recall and Shipment
                    if (response.recall === "yes") {
                        $("#recall_yes").prop("checked", true);
                        $("#recall_no").prop("checked", false);
                    } else if (response.recall === "no") {
                        $("#recall_yes").prop("checked", false);
                        $("#recall_no").prop("checked", true);
                    } else {
                        $("#recall_yes").prop("checked", false);
                        $("#recall_no").prop("checked", false);
                    }
                    setCheckboxValue("#edit-fgparts", response.fgparts);
                    if (response.shipment === "yes") {
                        $("#shipment_yes").prop("checked", true);
                        $("#shipment_no").prop("checked", false);
                    } else if (response.shipment === "no") {
                        $("#shipment_yes").prop("checked", false);
                        $("#shipment_no").prop("checked", true);
                    } else {
                        $("#shipment_yes").prop("checked", false);
                        $("#shipment_no").prop("checked", false);
                    }
                    $("#edit-ship_sched").val(response.ship_sched);

                    // WIP and Stop Process
                    setCheckboxValue("#edit-wip", response.wip);
                    if (response.stop_proc === "yes") {
                        $("#stop_proc_yes").prop("checked", true);
                        $("#stop_proc_no").prop("checked", false);
                    } else if (response.stop_proc === "no") {
                        $("#stop_proc_yes").prop("checked", false);
                        $("#stop_proc_no").prop("checked", true);
                    } else {
                        $("#stop_proc_yes").prop("checked", false);
                        $("#stop_proc_no").prop("checked", false);
                    }

                    // Locations and MCS
                    $("#edit-location").val(response.location);
                    setCheckboxValue("#edit-mcs", response.mcs);
                    $("#edit-mcs_details").val(response.mcs_details);

                    // Customer Notification
                    setCheckboxValue("#edit-customer_notif", response.customer_notif);

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
                            <td class="d-flex gap-2">
                                <input type="number" class="form-control" name="qty_affected[]" value="${material.qty_affected}" required>
                                <input type="text" class="form-control" name="qty_affected_text[]" value="${material.qty_affected_text}" placeholder="Enter text">
                            </td>

                            <td><input type="text" class="form-control" name="defect_rate[]" value="${material.defect_rate}"></td>
                        </tr>
                    `);
                        });
                    } else {
                        materialTable.append(`<tr><td colspan="7">No material records found</td></tr>`);
                    }

                    // Handling file attachments
                    var filesContainer = $('#edit-file-list'); // Ensure this matches the ID in your HTML
                    filesContainer.empty();

                    if (response.files.length > 0) {
                        response.files.forEach(function(file) {
                            let fileLink;
                            let fileType = file.file_type.toLowerCase();

                            if (fileType === "jpg" || fileType === "png" || fileType === "jpeg" || fileType === "gif") {
                                // Image preview
                                fileLink = `<img src="${file.file_path}" class="img-thumbnail" style="max-width: 150px; margin: 5px; margin-bottom: 10px;" />`;
                            } else {
                                // Download link
                                fileLink = `<a href="${file.file_path}" download="${file.file_name}" class="btn btn-primary btn-sm" 
                style="margin-bottom: 10px;">
                    <i class="fa fa-download"></i> Download ${file.file_name}
                </a>`;
                            }

                            // Delete button
                            let deleteButton = `<button class="btn btn-danger btn-sm delete-file" 
                            data-id="${file.id}" style="margin-left: 10px;">
                                <i class="fa fa-trash"></i> Delete
                            </button>`;

                            filesContainer.append(`<div class="file-item d-flex align-items-center">${fileLink}${deleteButton}</div>`);
                        });
                    } else {
                        filesContainer.append(`<p>No files uploaded</p>`);
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