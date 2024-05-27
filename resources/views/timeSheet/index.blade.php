@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Timesheet') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Timesheet') }}</li>
@endsection

@section('action-button')
    <!-- <a class="btn btn-sm btn-primary collapsed" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button"
                                                        aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="{{ __('Filter') }}">
                                                        <i class="ti ti-filter"></i>
                                                    </a> -->

    <a href="{{ route('timesheet.export') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
        data-bs-original-title="{{ __('Export') }}">
        <i class="ti ti-file-export"></i>
    </a>

    <a href="#" data-url="{{ route('timesheet.file.import') }}" data-ajax-popup="true"
        data-title="{{ __('Import Timesheet CSV file') }}" data-bs-toggle="tooltip" title=""
        class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Import') }}">
        <i class="ti ti-file-import"></i>
    </a>


    @can('Create TimeSheet')
        <a href="#" data-url="{{ route('timesheet.create') }}" data-ajax-popup="true" data-size="md"
            data-title="{{ __('Create New Timesheet') }}" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection

@section('content')
    {{-- <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
            <div class=" mt-2 " id="multiCollapseExample1" style="">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => ['timesheet.index'], 'method' => 'get', 'id' => 'timesheet_filter']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control  current_date', 'autocomplete' => 'off', 'id' => 'current_date']) }}
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control current_date', 'autocomplete' => 'off', 'id' => 'current_date']) }}
                                </div>
                            </div>
                            @if (\Auth::user()->type == 'employee')
                                {!! Form::hidden('employee', !empty($employeesList) ? $employeesList->id : 0, ['id' => 'employee_id']) !!}
                            @else
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                    <div class="btn-box">
                                        {{ Form::label('employee', __('Employee'), ['class' => 'form-label']) }}
                                        {{ Form::select('employee', $employeesList, isset($_GET['employee']) ? $_GET['employee'] : '', ['class' => 'form-control select ', 'id' => 'employee_id']) }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('timesheet_filter').submit(); return false;"
                                    data-bs-toggle="tooltip" title="" data-bs-original-title="apply">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('timesheet.index') }}" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Reset">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                </a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => ['timesheet.index'], 'method' => 'get', 'id' => 'timesheet_filter']) }}
                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box"></div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                            {{ Form::date('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control current_date', 'autocomplete' => 'off', 'id' => 'current_date']) }}
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                            {{ Form::date('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control current_date', 'autocomplete' => 'off', 'id' => 'current_date']) }}
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            @if (\Auth::user()->type == 'employee')
                                                {!! Form::hidden('employee', !empty($employeesList) ? $employeesList->id : 0, ['id' => 'employee_id']) !!}
                                            @else
                                                {{ Form::label('employee', __('Employee'), ['class' => 'form-label']) }}
                                                {{ Form::select('employee', $employeesList, isset($_GET['employee']) ? $_GET['employee'] : '', ['class' => 'form-control select ', 'id' => 'employee_id']) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary"
                                            onclick="document.getElementById('timesheet_filter').submit(); return false;"
                                            data-bs-toggle="tooltip" title="" data-bs-original-title="apply">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="{{ route('timesheet.index') }}" class="btn btn-sm btn-danger"
                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Reset">
                                            <span class="btn-inner--icon"><i
                                                    class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                {{-- <h5> </h5> --}}
                <div class="card-body py-0">

                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    @if (\Auth::user()->type != 'employee')
                                        <th>{{ __('Employee') }}</th>
                                    @endif
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Hours') }}</th>
                                    <th>{{ __('Remark') }}</th>
                                    <th width="200ox">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($timeSheets as $timeSheet)
                                    <tr>
                                        @if (\Auth::user()->type != 'employee')
                                            <td>{{ !empty($timeSheet->employee) ? $timeSheet->employee->name : '' }}
                                            </td>
                                        @endif
                                        <td>{{ \Auth::user()->dateFormat($timeSheet->date) }}</td>
                                        <td>{{ $timeSheet->hours }}</td>
                                        <td>{{ $timeSheet->remark }}</td>
                                        <td class="Action">

                                            <span>
                                                @can('Edit TimeSheet')
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                            data-url="{{ route('timesheet.edit', $timeSheet->id) }}"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="{{ __('Edit Timesheet') }}"
                                                            data-bs-original-title="{{ __('Edit') }}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan

                                                @can('Delete TimeSheet')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['timesheet.destroy', $timeSheet->id],
                                                            'id' => 'delete-form-' . $timeSheet->id,
                                                        ]) !!}
                                                        <a href="#"
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title=""
                                                            data-bs-original-title="Delete" aria-label="Delete"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                        </form>
                                                    </div>
                                                @endcan
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
    <script>
        $(document).ready(function() {
            var now = new Date();
            var month = (now.getMonth() + 1);
            var day = now.getDate();
            if (month < 10) month = "0" + month;
            if (day < 10) day = "0" + day;
            var today = now.getFullYear() + '-' + month + '-' + day;
            $('.current_date').val(today);
        });
    </script>
@endpush
