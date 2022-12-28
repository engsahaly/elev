<form action="{{ route('admin.admins.store') }}" method="post" id="add_form" enctype="multipart/form-data">
  @csrf

  <div id="add_form_messages"></div>

  {{-- MODIFICATIONS FROM HERE --}}
  <div class="row">

        {{-- Left Side --}}
        <div class="col-sm-12 col-md-4 bg-light">
            <div class="row">
                <div class="form-group col-12">
                    <label class="form-label">{{ __('lang.name') }}</label>
                    <input type="text" class="border form-control" name="name" placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}...">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">{{ __('lang.email') }}</label>
                    <input type="email" class="border form-control" name="email" placeholder="{{ __('lang.please_enter') }} {{ __('lang.email') }}...">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">{{ __('lang.password') }}</label>
                    <input type="password" class="border form-control" name="password" placeholder="{{ __('lang.please_enter') }} {{ __('lang.password') }}...">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">{{ __('lang.password_confirmation') }}</label>
                    <input type="password" class="border form-control" name="password_confirmation" placeholder="{{ __('lang.please_enter') }} {{ __('lang.password_confirmation') }}...">
                </div>

                <div class="form-group col-12">
                    <label class="form-label">{{ __('lang.status') }}</label>
                    <div class="form-check form-switch form-switch-md mb-3">
                        <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side --}}
        <div class="col-sm-12 col-md-8">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="form-label">{{ __('lang.id_number') }}</label>
                    <input type="text" class="border form-control" name="id_number" placeholder="{{ __('lang.please_enter') }} {{ __('lang.id_number') }}...">
                </div>
                
                <div class="form-group col-md-12">
                    <label class="form-label">{{ __('lang.branch') }}</label>
                    <select class="border form-control" name="branch_id">
                        <option value="">{{ __('lang.select_branch') }}</option>
                        @foreach ($activeBranches as $item)
                            <option value="{{$item->id}}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-12">
                    <label class="form-label">{{ __('lang.role') }}</label>
                    <select class="border form-control" name="role">
                        <option value="">{{ __('lang.select_role') }}</option>
                        @foreach ($roles as $item)
                            <option value="{{$item->name}}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="form-group col-md-12">
                    <label class="form-label">{{ __('lang.phone') }}</label>
                    <input type="text" class="border form-control" name="phone" placeholder="{{ __('lang.please_enter') }} {{ __('lang.phone') }}...">
                </div>
        
                <div class="form-group col-md-12">
                    <label class="form-label">{{ __('lang.address') }}</label>
                    <input type="text" class="border form-control" name="address" placeholder="{{ __('lang.please_enter') }} {{ __('lang.address') }}...">
                </div>
            </div>
        </div>

        


  </div>
  {{-- MODIFICATIONS TO HERE --}}

  <hr class="text-muted">

  <div class="form-group float-end">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('lang.close') }}</button>
        <button type="button" class="btn btn-primary" id="submit_add_form">{{ __('lang.submit') }}</button>
  </div>
</form>