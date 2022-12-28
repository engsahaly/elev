{{-- MODIFICATIONS FROM HERE --}}
<div class="row">
    <div class="col-md-2 border-end">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link mb-2 active" id="v-pills-details-tab" data-bs-toggle="pill" href="#v-pills-details" role="tab" aria-controls="v-pills-details" aria-selected="true">{{ __('lang.details') }}</a>
        <a class="nav-link mb-2" id="v-pills-idImage-tab" data-bs-toggle="pill" href="#v-pills-idImage" role="tab" aria-controls="v-pills-idImage" aria-selected="false">{{ __('lang.id_image') }}</a>
        </div>
    </div>
    <div class="col-md-10">
        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
            {{-- Details --}}
            <div class="tab-pane fade show active" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab">

                <div class="row">
                    {{-- Left Side --}}
                    <div class="col-sm-12 col-md-4 bg-light">
                        <div class="row">
                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.name') }}</label>
                                <p class="border form-control">{{$user->name ?? '--'}}</p>
                            </div>
            
                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.email') }}</label>
                                <p class="border form-control">{{$user->email ?? '--'}}</p>
                            </div>
            
                            <div class="form-group col-12">
                                <label class="form-label">{{ __('lang.status') }}</label>
                                <div class="mt-2">
                                    <span class="badge {{ $user->status->color() }}">
                                        <i class="{{ $user->status->icon() }} font-size-16 align-middle"></i> 
                                        {{ $user->status->lang() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    {{-- Right Side --}}
                    <div class="col-sm-12 col-md-8">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('lang.id_number') }}</label>
                                <p class="border form-control">{{$user->id_number ?? '--'}}</p>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('lang.nationality') }}</label>
                                <p class="border form-control">{{$user->nationality?->name ?? '--'}}</p>
                            </div>
                    
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('lang.phone1') }}</label>
                                <p class="border form-control">{{$user->phone1 ?? '--'}}</p>
                            </div>
                    
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('lang.phone2') }}</label>
                                <p class="border form-control">{{$user->phone2 ?? '--'}}</p>
                            </div>
                    
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('lang.address') }}</label>
                                <p class="border form-control">{{$user->address ?? '--'}}</p>
                            </div>
                    
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('lang.payment_number') }}</label>
                                <p class="border form-control">{{$user->payment_number ?? '--'}}</p>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label class="form-label">{{ __('lang.notes') }}</label>
                                <p class="border form-control">{{$user->notes ?? '--'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

            {{-- ID Image --}}
            <div class="tab-pane fade" id="v-pills-idImage" role="tabpanel" aria-labelledby="v-pills-idImage-tab">
                
                @if ($user->id_image != null)
                    <div class="text-center">
                        <img src="{{ asset($user->id_image) }}" class="id_image_pic">
                    </div>
                @else
                    <div class="alert alert-danger text-center" role="alert">
                        {{ __('messages.user_id_image_not_defined') }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>
{{-- MODIFICATIONS TO HERE --}}

<hr class="text-muted">

<div class="form-group float-end">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('lang.close') }}</button>
</div>