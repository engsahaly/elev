<div class="accordion card">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-light text-dark fw-medium collapsed font-size-14" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            {{ __('lang.filteration') }}
            </button>
        </h2>
  
        <div id="collapseOne" 
            class="accordion-collapse collapse" 
            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            
            <div class="accordion-body">

                <form action="{{ url(Request::url()) }}" method="get">
                    <div class="row">
                        {{-- Left Side --}}
                        <div class="col-sm-12 col-md-3 border-end h-100 rounded">
                            <div>
                                <label class="label-filter">{{ __('lang.order') }}</label><br>
                                <select class="form-control select2" name="order" style="width: 100%">
                                    <option value="" selected>{{ __('lang.default_date') }}</option>
                                    @if($modelName != 'Spatie\Permission\Models\Role')
                                        @foreach ($modelName::ORDER as $item)
                                            <option value="{{$item}}" @selected(request()->input('order') == $item)>{{ __("lang.$item") }}</option>
                                        @endforeach
                                    @else
                                        <option value="name" @selected(request()->input('order') == 'name')>{{ __("lang.name") }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="label-filter">{{ __('lang.sort') }}</label><br>
                                    <select class="form-control" name="sort">
                                        @foreach (config('app.sort') as $item)
                                            <option value="{{$item}}" @selected(request()->input('sort') == $item)>{{ __("lang.$item") }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-filter">{{ __('lang.perpage') }}</label><br>
                                    <select class="form-control" name="perpage">
                                        <option value="">{{ __('lang.default') }}</option>
                                        @foreach (config('app.perpage') as $item)
                                            <option value="{{$item}}" @selected(request()->input('perpage') == $item)>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
            
                        {{-- Right Side --}}
                        <div class="col-sm-12 col-md-9">
                            {{-- content --}}
                            {{$slot}}

                            {{-- Button --}}
                            <div class="row mt-2">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('lang.filter') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>