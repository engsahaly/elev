@extends('dashboard.master')
@section('title', __('lang.add_new_role'))
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('lang.add_new_role') }}</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="post" id="add_form" enctype="multipart/form-data">
                @csrf
            
                <div id="loading" class="mt-2">
                    @include('dashboard.modals.spinner')
                </div>

                <div id="add_form_messages"></div>
            
                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">
            
                    <div class="form-group col-md-10">
                        <label class="form-label">{{ __('lang.name') }}</label>
                        <input type="text" class="border form-control" name="name" placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}...">
                    </div>
                    <div class="form-group col-md-2 mt-4">
                        <label class="form-check-label text-primary mt-2">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                            @lang('lang.selectAll')
                        </label>
                    </div>

                    <div class="form-group col-12 mt-2">
                        <div class="row">
                            @if (count($groups) > 0)
                                @foreach ($groups as $group)
                                    <div class="col-md-6 mt-2 pb-2">
                                        <label class="form-label">{{ __("lang.$group->value") }}</label>
                                        @foreach ($group->permissions as $permission)
                                            <div class="form-check form-check-primary mt-1">
                                                <input class="form-check-input" type="checkbox" name="permissionArray[{{ $permission->name }}]" id="formCheckcolor{{$permission->id}}">
                                                <label class="form-check-label" for="formCheckcolor{{$permission->id}}">{{ __("lang.$permission->name") }}</label>
                                                {{ permission_description($permission) }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- CASE PERMISSIONS TABLE --}}
                    @if (isset($caseCategories))
                        <div class="form-group col-12 mt-4">
                            <label class="form-label">{{ __('lang.case_permissions') }}</label>
                            <div class="table-responsive mt-2">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="20%">{{ __('lang.case') }}</th>
                                            <th class="text-center">{{ __('lang.list_case') }}</th>
                                            <th class="text-center">{{ __('lang.archive_case') }}</th>
                                            <th class="text-center">{{ __('lang.new_case') }}</th>
                                            <th class="text-center">{{ __('lang.edit_case') }}</th>
                                            <th class="text-center">{{ __('lang.delete_case') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caseCategories as $category)
                                            <tr>
                                                <th class="bg-light">{{ $category->name }}</th>

                                                @if (count($category->permissions) > 0)
                                                    @foreach ($category->permissions as $permission)
                                                        <td class="text-center">
                                                            <input class="form-check-input" type="checkbox" name="permissionArray[{{ $permission->name }}]" id="formCheckcolor{{$permission->id}}">
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
            
                </div>
                {{-- MODIFICATIONS TO HERE --}}
            
                <div class="form-group mt-3">
                    <button type="button" class="btn btn-primary" id="submit_add_form">{{ __('lang.submit') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")