@extends('dashboard.master')
@section('title', __('lang.roles'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('lang.roles') }}</h4>

                <div class="page-title-right">
                    @if (permission(['add_roles']))
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                        {{ __('lang.add_new') }}
                    </a>
                    @endif
                </div>
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
                            <th width="10%">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if( count($data['data']) > 0 )
                            @foreach ($data['data'] as $key => $item)
                                <tr>
                                    <td>{{ $data['data']->firstItem()+$loop->index }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('lang.actions') }} <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                @if (permission(['show_roles']))
                                                <a href="{{ route('admin.roles.show', ['role' => $item]) }}" class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ __('lang.show') }}
                                                </a>
                                                @endif
                                                
                                                @if (permission(['edit_roles']))
                                                <a href="{{ route('admin.roles.edit', ['role' => $item]) }}" class="dropdown-item">
                                                    <span class="bx bx-edit-alt"></span>
                                                    {{ __('lang.edit') }}
                                                </a>
                                                @endif

                                                @if (permission(['delete_roles']))
                                                <a class="dropdown-item deleteClass" href="{{ route('admin.roles.destroy', ['role' => $item]) }}" data-title="{{ __('lang.delete_role') }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <span class="bx bx-trash-alt"></span>
                                                    {{ __('lang.delete') }}
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