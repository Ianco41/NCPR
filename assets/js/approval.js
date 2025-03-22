
$(document).ready(function () {
    
    $(".approval-action").click(function (e) {
        e.preventDefault();

        var action = $(this).data("action");
        var role = $(this).data("role");

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to approve this action.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, approve it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                sendApprovalRequest(action, role); // Call function to process approval
            }
        });
    });

    function sendApprovalRequest(action, role) {
        let selectedId = $("#modal-id").text(); // Ensure selected ID is correctly retrieved

        var nonConformance = $("#non-conformance").val().trim();
        var correctiveAction = $("input[name='corrective_action']:checked").val();
        var causes = [];
        $("input[name='cause[]']:checked").each(function () {
            causes.push($(this).val());
        });

        var idNo = $("input[name='id_no']").val().trim();
        var name = $("input[name='name']").val().trim();

        var potentialFailure = $("input[name='potential_failure']:checked").val();
        var carChecked = $("input[name='car']").is(":checked") ? "CAR" : "";
        var carNo = $("input[name='car_no']").val().trim();
        var bdReport = $("input[name='bd_report']:checked").val();
        var scarChecked = $("input[name='scar']").is(":checked") ? "SCAR" : "";
        var scarNo = $("input[name='scar_no']").val().trim();

        var dispoFrom = [];
        $("input[name='dispo_from[]']:checked").each(function () {
            dispoFrom.push($(this).val());
        });

        var mrb = $("input[name='mrb']:checked").val();
        var customerApproval = $("input[name='customer_approval']:checked").val();
        var documentAlert = $("input[name='document_alert']").val().trim();
        var impactAnalysis = [];
        $("input[name='impact_analysis[]']:checked").each(function () {
            impactAnalysis.push($(this).val());
        });

        var impactAnalysisNotes = $("#impact_analysis").val().trim();
        var affectedBusiness = $("input[name='affected_business']").is(":checked") ? "Yes" : "No";
        var contactPerson = $("input[name='contact_person']").val().trim();
        var otherInstructions = $("input[name='other_instructions']").is(":checked") ? "Yes" : "No";
        var otherSpecify = $("input[name='other_specify']").val().trim();
        var productDispo = [];
        $("input[name='product_dispo[]']:checked").each(function () {
            productDispo.push($(this).val());
        });

        var yieldOff = $("input[name='yield_off']").val().trim();
        var daNo = $("input[name='da_no']").val().trim();
        var reworkDaNo = $("input[name='rework_da_no']").val().trim();
        var wisNo = $("input[name='wis_no']").val().trim();
        var scrapAmount = $("input[name='scrap_amount']").val().trim();
        var shipmentDate = $("input[name='shipment_date']").val().trim();

        console.log("Sending AJAX request...");
        $.ajax({
            url: "approval.php",
            type: "POST",
            data: {
                action: action,
                role: role,
                ncpr_num: selectedId,
                non_conformance: nonConformance,
                corrective_action: correctiveAction,
                causes: causes,
                id_no: idNo,
                name: name,
                potential_failure: potentialFailure,
                car: carChecked,
                car_no: carNo,
                bd_report: bdReport,
                scar: scarChecked,
                scar_no: scarNo,
                dispo_from: dispoFrom,
                mrb: mrb,
                customer_approval: customerApproval,
                document_alert: documentAlert,
                impact_analysis: impactAnalysis,
                impact_analysis_notes: impactAnalysisNotes,
                affected_business: affectedBusiness,
                contact_person: contactPerson,
                other_instructions: otherInstructions,
                other_specify: otherSpecify,
                product_dispo: productDispo,
                yield_off: yieldOff,
                da_no: daNo,
                rework_da_no: reworkDaNo,
                wis_no: wisNo,
                scrap_amount: scrapAmount,
                shipment_date: shipmentDate
            },
            dataType: "json", // Expect JSON response
    beforeSend: function () {
        console.log("Sending AJAX request...");
    },
    success: function (response) {
        console.log("Raw response:", response);

        if (response.status === "success") {
            console.log("Parsed JSON:", response);

            Swal.fire({
                title: "Success",
                text: response.message,
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                location.reload(); // Reload the page after success
            });

        } else {
            console.error("Error from server:", response.message);
            Swal.fire("Error", response.message, "error");
        }
    },
    error: function (xhr, status, error) {
        console.error("AJAX Error:", error, xhr.responseText);
        Swal.fire("Error", "AJAX request failed. Check console.", "error");
    }
});
    }
});
