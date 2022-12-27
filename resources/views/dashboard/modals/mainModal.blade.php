<div class="modal fade" id="mainModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="loading" class="mt-2">
                @include('dashboard.modals.spinner')
            </div>
            <div class="modal-body" id="modal-body"></div>
        </div>
    </div>
</div>
