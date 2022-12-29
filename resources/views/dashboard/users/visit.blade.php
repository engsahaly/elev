<form action="{{ route('admin.visits.store') }}" method="post" id="add_form" enctype="multipart/form-data">
  @csrf

    <div id="add_form_messages"></div>

    {{-- MODIFICATIONS FROM HERE --}}
    <div class="row">
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="form-group col-12">
            <label class="form-label">{{ __('lang.data') }}</label>
            <input type="text" class="border form-control" name="data" placeholder="{{ __('lang.please_enter') }} {{ __('lang.data') }}...">
        </div>
    </div>
    {{-- MODIFICATIONS TO HERE --}}

    <div class="form-group float-right mt-2">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
        <button type="button" class="btn btn-primary" id="submit_add_form">{{ __('lang.submit') }}</button>
    </div>
</form>