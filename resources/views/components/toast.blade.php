<div>
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="toast align-items-center" id="toast" role="alert" aria-live="assertive" aria-atomic="true"
                data-autohide="true">
                <div class="d-flex text-{{ $type == 'error' ? 'danger' : 'success' }} p-2">
                    <i class="fa-solid {{ $type == 'error' ? 'fa-circle-xmark' : 'fa-circle-check' }} me-2"
                        style="margin-top: 3px"></i>
                    <div class="toast-body m-0 p-0">
                        {{ $slot }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastLive = document.getElementById('toast')
            const toast = new bootstrap.Toast(toastLive)

            toast.show()
        });
    </script>

</div>
