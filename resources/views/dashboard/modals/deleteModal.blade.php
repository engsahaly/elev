<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="delete_alert_div"></div>
            <div class="modal-body" id="modal-body">
                {{ __('messages.delete_record_message') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('lang.close') }}</button>
                <a href="#" class="btn btn-danger" id="submit_delete">{{ __('lang.delete') }}</a>
            </div>
        </div>
    </div>
</div>