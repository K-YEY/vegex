@props(['IS_ERROR' => false, 'HEAD' => '', 'TITLE' => ''])
<div class="position-fixed bottom-1 end-1 z-index-2 ">
    <div class="toast fade p-2 bg-white hide " role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
        <div class="toast-header border-0">
            <i
                class="material-symbols-rounded @if ($IS_ERROR) text-danger @else text-success @endif  me-2">
                @if ($IS_ERROR)
                    campaign
                @else
                    check
                @endif
            </i>
            <span
                class="me-auto font-weight-bold @if ($IS_ERROR) text-gradient text-danger @else text-success @endif">
                {{ $HEAD }}
            </span>
            <i data-bs-dismiss="toast" class="material-symbols-rounded text-md ms-3 cursor-pointer" aria-label="Close">
                close
            </i>

        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
            {{ $TITLE }}
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let toastElement = new bootstrap.Toast(document.getElementById("successToast"), {
            delay: 3000 // Auto-hide after 3 seconds
        });

        toastElement.show(); // Show the toast

        // Hide the toast automatically after the delay
        setTimeout(() => {
            toastElement.hide();
        }, 3000);
    });
</script>
