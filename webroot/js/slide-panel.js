 /**
 * Slide Panel JS
 * Module: Non-Granted → Granted Staff Transfer
 * Author: Resilient Lab
 */

/* ============================
   OPEN SLIDE PANEL
============================ */
$(document).on('click', '.js-open-transfer', function () {
    const caseId = $(this).data('id');
    $(document).trigger('transfer:openSlider', [caseId]);
});

/* ============================
   CLOSE SLIDE PANEL
============================ */
$(document).on('click', '.js-close-slider', function () {
    $(document).trigger('transfer:closeSlider');
});

/* ============================
   CUSTOM EVENTS
============================ */
$(document).on('transfer:openSlider', function (e, caseId) {
    loadTransferDetails(caseId);
    openSlidePanel();
});

$(document).on('transfer:closeSlider', function () {
    closeSlidePanel();
});

/* ============================
   CORE FUNCTIONS
============================ */
function openSlidePanel() {
    $('#transferSlider')
        .addClass('open')
        .attr('aria-hidden', 'false');
}

function closeSlidePanel() {
    $('#transferSlider')
        .removeClass('open')
        .attr('aria-hidden', 'true');
}

/* ============================
   ESC KEY SUPPORT
============================ */
$(document).on('keydown', function (e) {
    if (e.key === 'Escape') {
        closeSlidePanel();
    }
});

/* ============================
   LOAD CASE DETAILS (MOCK)
   Replace with AJAX
============================ */
function loadTransferDetails(caseId) {

    // Example: AJAX call (replace URL)
    /*
    $.get('/api/transfer/' + caseId, function (data) {
        bindTransferData(data);
    });
    */

    // Mock Data
    const data = {
        caseId: caseId,
        empName: 'Shri Ramesh Patil',
        designation: 'Assistant Teacher',
        school: 'ZP Primary School, Pune',
        remarks: 'Case is under scrutiny by Education Officer.'
    };

    bindTransferData(data);
}

/* ============================
   BIND DATA TO UI
============================ */
function bindTransferData(data) {
    $('#caseId').text(data.caseId);
    $('#empName').text(data.empName);
    $('#designation').text(data.designation);
    $('#school').text(data.school);
    $('#remarks').text(data.remarks);

    // Audit Event (optional)
    $(document).trigger('audit:transfer:view', [data.caseId]);
}

/* ============================
   AUDIT EVENT (OPTIONAL)
============================ */
$(document).on('audit:transfer:view', function (e, caseId) {
    console.log('Audit Log → Transfer case viewed:', caseId);
});
