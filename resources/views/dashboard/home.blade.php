@extends('dashboard.master')

@section('title', __('lang.company_name'))

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('lang.dashboard') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- profile & tiny stats -->
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-12">
                    <div class="text-primary p-4">
                        <h5 class="text-primary">{{ __('lang.welcome_back') }} {{ Auth::guard('admin')->user()?->nameOnHeader() }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-sm-4 col-md-2 border">
                    <div class="avatar-md profile-user-wid mb-1">
                        <img src="{{ asset('assets') }}/logo/avatar.png" alt="" class="img-thumbnail rounded-circle">
                    </div>
                    <h5 class="font-size-15 text-truncate">{{ Auth::guard('admin')->user()?->nameOnHeader() }}</h5>
                </div>

                <div class="col-sm-8 col-md-10 border">
                    <div class="pt-4">
                        <div class="row">
                            <div class="col-2">
                                <a href="{{ route('admin.contracts.index') }}">
                                    <h5 class="font-size-15">{{ $contractsCount['ALL'] }}</h5>
                                    <p class="text-muted mb-0">{{ __('lang.all_contracts') }}</p>
                                </a>
                            </div>

                            @foreach($contractsStatus as $status)
                                <div class="col-2">
                                    <a href="{{ route('admin.contracts.index',['status'=>$status->value]) }}">
                                        <h5 class="font-size-15">{{ $contractsCount[$status->name] }}</h5>
                                        <p class="text-muted mb-0">{{ $status->lang() }}</p>
                                    </a>
                                </div>
                            @endforeach

                            <div class="col-2">
                                <a href="{{ route('admin.profile') }}" class="btn btn-primary waves-effect waves-light btn-sm">{{ __('lang.profile') }} <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- General stats -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">{{ __('lang.general_stats') }}</h4>

            <div class="row">
                <div class="col-12 col-md-4 border-primary border-end">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.all_contracts') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $contractsCount['ALL'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.approved_contracts_home') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $contractsCount['APPROVED'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.completed_contracts_home') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $contractsCount['COMPLETED'] }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-4 border-primary border-end">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.all_installments') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $installmentsStats['count'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.installments_paid_amount') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $installmentsStats['paid'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.installments_rest_amount') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $installmentsStats['rest'] }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.total_before_discount') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $installmentsTotal['before'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.total_after_discount') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $installmentsTotal['after'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75%">
                                        <p class="mb-0">{{ __('lang.total_payments') }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h6 class="mb-0">{{ $paymentsTotal }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- Latest Contracts -->
    @if (permission(['list_contracts']))
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ __('lang.latest_contracts') }}</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap font-size-14">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('lang.id') }}</th>
                                    <th>{{ __('lang.user') }}</th>
                                    <th>{{ __('lang.start_date') }}</th>
                                    <th>{{ __('lang.installments') }}</th>
                                    <th>{{ __('lang.before_discount') }}</th>
                                    <th>{{ __('lang.after_discount') }}</th>
                                    <th>{{ __('lang.discount') }}</th>
                                    <th>{{ __('lang.first_payment') }}</th>
                                    <th>{{ __('lang.credit_bank') }}</th>
                                    <th>{{ __('lang.debit_bank') }}</th>
                                    <th>{{ __('lang.status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($latestContracts) > 0)
                                    @foreach ($latestContracts as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <strong class="text-primary">
                                                    {{ $item->id??'--' }}
                                                </strong>
                                            </td>
                                            <td>{{ $item->user?->name }}</td>
                                            <td>{{ $item->startDate() }}</td>
                                            <td>{{ $item->installments }}</td>
                                            <td>{{ $item->contractDetails?->total_before }} {{currency($item)}}</td>
                                            <td>{{ $item->contractDetails?->total_after }} {{currency($item)}}</td>
                                            <td>{{ $item->discount() }} {{currency($item)}}</td>
                                            <td>{{ $item->contractDetails?->first_payment_amount_before }} {{currency($item)}}</td>
                                            <td>{{ $item->credit() }} {{currency($item)}}</td>
                                            <td>{{ $item->debit() }} {{currency($item)}}</td>
                                            <td>
                                                <span class="badge {{ $item->status->color() }}">
                                                    <i class="{{ $item->status->icon() }} font-size-16 align-middle"></i>
                                                    {{ $item->status->lang() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <x-empty-alert></x-empty-alert>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- latest installments -->
    @if (permission(['list_installments']))
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ __('lang.latest_installments') }}</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap font-size-14">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('lang.installment') }}</th>
                                    <th>{{ __('lang.contract') }}</th>
                                    <th>{{ __('lang.user') }}</th>
                                    <th>{{ __('lang.item') }}</th>
                                    <th>{{ __('lang.due_date') }}</th>
                                    <th>{{ __('lang.status') }}</th>
                                    <th>{{ __('lang.price') }}</th>
                                    <th>{{ __('lang.paid') }}</th>
                                    <th>{{ __('lang.rest') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($latestInstallments) > 0)
                                    @foreach ($latestInstallments as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <strong class="text-primary">
                                                    {{ $item->id??'--' }}
                                                </strong>
                                            </td>
                                            <td>
                                                <strong class="text-primary">
                                                    {{ $item->contract?->id??'--' }}
                                                </strong>
                                            </td>
                                            <td>
                                                {{ $item->contract->user?->name }}
                                                <div>
                                                    {{ __('lang.id_number') }} :
                                                    <span class="badge badge-soft-primary">
                                                        {{ $item->contract->user?->id_number }}
                                                    </span>
                                                    {{ __('lang.phone1') }} :
                                                    <span class="badge badge-soft-primary">
                                                    {{ $item->contract->user?->phone1 }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>{{ $item->contract?->item }}</td>
                                            <td>{{ $item->dueDate() }}</td>
                                            <td>
                                                <span class="badge {{ $item->status->color() }}">
                                                    <i class="{{ $item->status->icon() }} font-size-16 align-middle"></i>
                                                    {{ $item->status->lang() }}
                                                </span>
                                            </td>
                                            <td>{{ $item->installment_amount_before }} {{currency($item)}}</td>
                                            <td>{{ $item->paid }} {{currency($item)}}</td>
                                            <td>{{ $item->rest }} {{currency($item)}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <x-empty-alert></x-empty-alert>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- latest payments -->
    @if (permission(['list_payments']))
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ __('lang.latest_payments') }}</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap font-size-14">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('lang.id') }}</th>
                                    <th>{{ __('lang.user') }}</th>
                                    <th>{{ __('lang.date') }}</th>
                                    <th>{{ __('lang.amount') }}</th>
                                    <th>{{ __('lang.payment_method') }}</th>
                                    <th>{{ __('lang.payment_number') }}</th>
                                    <th>{{ __('lang.payment_type') }}</th>
                                    <th>{{ __('lang.contract') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($latestPayments) > 0)
                                    @foreach ($latestPayments as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <strong class="text-primary">
                                                    {{ $item->id??'--' }}
                                                </strong>
                                            </td>
                                            <td>{{ $item->user?->name }}</td>
                                            <td>{{ $item->date() }}</td>
                                            <td>{{ $item->amount }} {{currency($item)}}</td>
                                            <td>
                                                <span class="badge {{ $item->payment_method->color() }}">
                                                    <i class="{{ $item->payment_method->icon() }} font-size-16 align-middle"></i>
                                                    {{ $item->payment_method->lang() }}
                                                </span>
                                            </td>
                                            <td>{{ $item->payment_number }}</td>
                                            <td>
                                                <span class="badge {{ $item->payment_type->color() }}">
                                                    <i class="{{ $item->payment_type->icon() }} font-size-16 align-middle"></i>
                                                    {{ $item->payment_type->lang() }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong class="text-primary">
                                                    {{ $item->contract?->id }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <x-empty-alert></x-empty-alert>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/dashboard.init.js"></script>
@endpush
