document.addEventListener("DOMContentLoaded", function () {
    // Handler untuk perubahan status approval
    document.addEventListener("change", function (e) {
        if (e.target.classList.contains("approval-status")) {
            const rejectContainerId = e.target.getAttribute("data-target");
            const rejectTextareaId = e.target.getAttribute("data-textarea");

            const rejectContainer = document.getElementById(rejectContainerId);
            const rejectTextarea = document.getElementById(rejectTextareaId);

            if (e.target.value === "Rejected") {
                rejectContainer.style.display = "block";
                rejectTextarea.required = true;
                // Focus ke textarea untuk UX yang lebih baik
                setTimeout(() => {
                    rejectTextarea.focus();
                }, 100);
            } else {
                rejectContainer.style.display = "none";
                rejectTextarea.required = false;
                rejectTextarea.value = "";
            }
        }
    });

    // Handler untuk submit form approval
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("approval-submit-btn")) {
            e.preventDefault();

            const formId = e.target.getAttribute("data-form-id");
            const form = document.getElementById(formId);
            const statusSelect = form.querySelector(".approval-status");
            const status = statusSelect.value;

            if (!status) {
                alert("Silakan pilih status approval terlebih dahulu!");
                statusSelect.focus();
                return false;
            }

            if (status === "Rejected") {
                const rejectTextarea = form.querySelector(".reject-textarea");
                if (!rejectTextarea.value.trim()) {
                    alert("Silakan masukkan alasan penolakan!");
                    rejectTextarea.focus();
                    return false;
                }
            }

            const message =
                status === "Approved"
                    ? "Apakah Anda yakin ingin menyetujui data ini?"
                    : "Apakah Anda yakin ingin menolak data ini?";

            if (confirm(message)) {
                // Tampilkan loading state
                e.target.disabled = true;
                e.target.innerHTML =
                    '<i class="fa fa-spinner fa-spin"></i> Processing...';

                // Submit form
                form.submit();
            }
        }
    });

    // Handler untuk reset form ketika modal ditutup
    document.addEventListener("hidden.bs.modal", function (e) {
        if (e.target.id.startsWith("showModal")) {
            const modal = e.target;
            const form = modal.querySelector(".approval-form");

            if (form) {
                // Reset form
                form.reset();

                // Hide reject reason container
                const rejectContainer =
                    modal.querySelector(".reject-container");
                if (rejectContainer) {
                    rejectContainer.style.display = "none";
                }

                // Reset button state
                const submitBtn = modal.querySelector(".approval-submit-btn");
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML =
                        '<i class="fa fa-save"></i> Proses Approval';
                }
            }
        }
    });

    // Handler untuk validasi real-time
    document.addEventListener("input", function (e) {
        if (e.target.classList.contains("reject-textarea")) {
            const submitBtn = e.target
                .closest("form")
                .querySelector(".approval-submit-btn");
            const statusSelect = e.target
                .closest("form")
                .querySelector(".approval-status");

            if (statusSelect.value === "Rejected") {
                if (e.target.value.trim().length > 0) {
                    submitBtn.disabled = false;
                    e.target.classList.remove("is-invalid");
                } else {
                    submitBtn.disabled = true;
                    e.target.classList.add("is-invalid");
                }
            }
        }
    });

    // Function untuk menampilkan modal programmatically (jika diperlukan)
    window.showLansiaModal = function (modalId) {
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    };

    // Function untuk menutup modal programmatically (jika diperlukan)
    window.hideLansiaModal = function (modalId) {
        const modal = bootstrap.Modal.getInstance(
            document.getElementById(modalId)
        );
        if (modal) {
            modal.hide();
        }
    };
});

// Fungsi untuk konfirmasi approval (backup jika diperlukan)
function confirmApproval(lansiaId) {
    const statusSelect = document.getElementById("approval_status" + lansiaId);
    const status = statusSelect.value;

    if (!status) {
        alert("Silakan pilih status approval!");
        return false;
    }

    const message =
        status === "Approved"
            ? "Apakah Anda yakin ingin menyetujui data ini?"
            : "Apakah Anda yakin ingin menolak data ini?";

    return confirm(message);
}
