@if (session('success'))
    <div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show material-shadow"
        role="alert">
        <i class="ri-check-double-line label-icon"></i>
        <strong>Success</strong> - {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show material-shadow"
        role="alert">
        <i class="ri-error-warning-line label-icon"></i>
        <strong>Error</strong> - {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    setTimeout(() => {
        const successAlert = document.querySelector('.alert.alert-success');
        if (successAlert) {
            successAlert.classList.remove('show');
            successAlert.classList.add('hide');
        }

        const errorAlert = document.querySelector('.alert.alert-danger');
        if (errorAlert) {
            errorAlert.classList.remove('show');
            errorAlert.classList.add('hide');
        }
    }, 5000); // 5 detik
</script>
