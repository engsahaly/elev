<form action="{{ route('admin.users.store') }}" method="post" id="add_form" enctype="multipart/form-data">
  @csrf

    <div id="add_form_messages"></div>

    {{-- MODIFICATIONS FROM HERE --}}
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label class="form-label">{{ __('lang.name') }}</label>
            <input type="text" class="border form-control" name="name" placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}...">
        </div>

        <div class="form-group col-12 col-md-6">
            <label class="form-label">{{ __('lang.email') }}</label>
            <input type="email" class="border form-control" name="email" placeholder="{{ __('lang.please_enter') }} {{ __('lang.email') }}...">
        </div>

        <div class="form-group col-12 col-md-6">
            <label class="form-label">{{ __('lang.password') }}</label>
            <input type="password" class="border form-control" name="password" placeholder="{{ __('lang.please_enter') }} {{ __('lang.password') }}...">
        </div>

        <div class="form-group col-12 col-md-6">
            <label class="form-label">{{ __('lang.password_confirmation') }}</label>
            <input type="password" class="border form-control" name="password_confirmation" placeholder="{{ __('lang.please_enter') }} {{ __('lang.password_confirmation') }}...">
        </div>

        @if (super_admin_permission())
            <div class="form-group col-10">
                <label class="form-label">{{ __('lang.admin') }}</label>
                <select class="border form-control" name="admin_id">
                    <option value="">{{ __('lang.select_admin') }}</option>
                    @foreach ($admins as $item)
                        <option value="{{$item->id}}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group col-2">
            <label class="form-label">{{ __('lang.status') }}</label>
            <div class="form-check form-switch form-switch-md mb-3">
                <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                <label>{{ __('lang.active') }}</label>
            </div>
        </div>
    </div>
    {{-- MODIFICATIONS TO HERE --}}

    <div class="form-group float-right mt-2">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('lang.close') }}</button>
        <button type="button" class="btn btn-primary" id="submit_add_form">{{ __('lang.submit') }}</button>
    </div>
</form>