@extends('dashboard.master')
@section('title', __('lang.users'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('lang.users') }}</h4>

                @if (permission(['add_users']))
                <div class="page-title-right">
                    <a href="{{ route('admin.users.create') }}" data-title="{{ __('lang.add_new_user') }}" id="add_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mainModal">
                        {{ __('lang.add_new') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Filteration --}}
    @includeIf("$directory.filter")

    {{-- Table --}}
    <div class="card" id="mainCont">
        <div class="card-body">

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table align-middle table-nowrap font-size-14">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>{{ __('lang.name') }}</th>
                            <th>{{ __('lang.email') }}</th>
                            <th>{{ __('lang.id_number') }}</th>
                            <th>{{ __('lang.phone1') }}</th>
                            <th>{{ __('lang.contracts') }}</th>
                            <th>{{ __('lang.amount_required') }}</th>
                            <th width="15%">{{ __('lang.status') }}</th>
                            <th width="10%">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if( count($data['data']) > 0 )
                            @foreach ($data['data'] as $key => $item)
                                <tr>
                                    <td>{{ $data['data']->firstItem()+$loop->index }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email ?? '' }}</td>
                                    <td>
                                        <span class="badge badge-soft-primary p-2">
                                            {{ $item->id_number ?? '' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->phone1 ?? '' }}</td>
                                    <td>
                                        <span class="badge bg-success p-2">
                                            {{ $item->contracts->count() }}
                                        </span>
                                    </td>
                                    <td>{{ $item->amountRequired() }}</td>
                                    <td>
                                        <span class="badge {{ $item->status->color() }}">
                                            <i class="{{ $item->status->icon() }} font-size-16 align-middle"></i> 
                                            {{ $item->status->lang() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('lang.actions') }} <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                @if (permission(['show_users']))
                                                <a href="{{ route('admin.users.show', ['user' => $item]) }}" class="dropdown-item displayClass" data-title="{{ __('lang.show_user') }}" data-bs-toggle="modal" data-bs-target="#mainModal">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ __('lang.show') }}
                                                </a>
                                                @endif
                                                
                                                @if (permission(['edit_users']))
                                                <a href="{{ route('admin.users.edit', ['user' => $item]) }}" class="dropdown-item editClass" data-title="{{ __('lang.edit_user') }}" data-bs-toggle="modal" data-bs-target="#mainModal">
                                                    <span class="bx bx-edit-alt"></span>
                                                    {{ __('lang.edit') }}
                                                </a>
                                                @endif

                                                @if (permission(['delete_users']))
                                                <a class="dropdown-item deleteClass" href="{{ route('admin.users.destroy', ['user' => $item]) }}" data-title="{{ __('lang.delete_user') }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <span class="bx bx-trash-alt"></span>
                                                    {{ __('lang.delete') }}
                                                </a>
                                                @endif

                                                @if (permission(['show_users_cases']))
                                                <a href="{{ route('admin.clientCases.index', ['user' => $item->id]) }}" class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ __('lang.clientCases') }}
                                                </a>
                                                @endif

                                                @if (permission(['show_users_notes']))
                                                <a href="{{ route('admin.clientNotes.index', ['user' => $item->id]) }}" class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ __('lang.clientNotes') }}
                                                </a>
                                                @endif

                                                @if (permission(['show_users_contracts']))
                                                <a href="{{ route('admin.contracts.index', ['user' => $item->id]) }}" class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ __('lang.contracts') }}
                                                </a>
                                                @endif

                                                @if (permission(['show_users_installments']))
                                                <a href="{{ route('admin.installments.index', ['user' => $item->id]) }}" class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ __('lang.installments') }}
                                                </a>
                                                @endif

                                                @if (permission(['show_users_payments']))
                                                <a href="{{ route('admin.payments.index', ['user' => $item->id]) }}" class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ __('lang.payments') }}
                                                </a>
                                                @endif

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif
                    </tbody>
                </table>
            </div>
        
            {{ $data['data']->appends(request()->query())->render("pagination::bootstrap-4") }}
        
        </div>
    </div>
@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")