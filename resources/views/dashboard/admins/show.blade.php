{{-- MODIFICATIONS FROM HERE --}}
<div class="row">
    {{-- Left Side --}}
    <div class="col-sm-12 col-md-4 bg-light">
        <div class="row">
            <div class="form-group col-12">
                <label class="form-label">{{ __('lang.name') }}</label>
                <p class="border form-control">{{$admin->name ?? '--'}}</p>
            </div>

            <div class="form-group col-12">
                <label class="form-label">{{ __('lang.email') }}</label>
                <p class="border form-control">{{$admin->email ?? '--'}}</p>
            </div>

            <div class="form-group col-12">
                <label class="form-label">{{ __('lang.status') }}</label>
                <div class="mt-2">
                    <span class="badge {{ $admin->status->color() }}">
                        <i class="{{ $admin->status->icon() }} font-size-16 align-middle"></i> 
                        {{ $admin->status->lang() }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Side --}}
    <div class="col-sm-12 col-md-8">
        <div class="row">
            <div class="form-group col-md-12">
                <label class="form-label">{{ __('lang.id_number') }}</label>
                <p class="border form-control mb-1">{{$admin->id_number ?? '--'}}</p>
            </div>
            
            <div class="form-group col-md-12">
                <label class="form-label">{{ __('lang.branch') }}</label>
                <p class="border form-control mb-1">{{$admin->branch?->name ?? '--'}}</p>
            </div>
            
            <div class="form-group col-md-12">
                <label class="form-label">{{ __('lang.role') }}</label>
                <p class="border form-control mb-1">{{$admin->getRoleNames()[0] ?? '--'}}</p>
            </div>
    
            <div class="form-group col-md-12">
                <label class="form-label">{{ __('lang.phone') }}</label>
                <p class="border form-control mb-1">{{$admin->phone ?? '--'}}</p>
            </div>
    
            <div class="form-group col-md-12">
                <label class="form-label">{{ __('lang.address') }}</label>
                <p class="border form-control mb-1">{{$admin->address ?? '--'}}</p>
            </div>
        </div>
    </div>
</div>
{{-- MODIFICATIONS TO HERE --}}

<hr class="text-muted">

<div class="form-group float-end">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('lang.close') }}</button>
</div>