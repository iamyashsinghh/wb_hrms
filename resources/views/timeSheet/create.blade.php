@php
    $plan = Utility::getChatGPTSettings();
@endphp

{{ Form::open(['route' => ['timesheet.store']]) }}
<div class="modal-body">

    @if ($plan->enable_chatgpt == 'on')
    <div class="card-footer text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
            data-url="{{ route('generate', ['timesheet']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
            title="{{ __('Generate') }}" data-title="{{ __('Generate Content With AI') }}">
            <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
        </a>
    </div>
    @endif

    <div class="row">

        @if (\Auth::user()->type != 'employee')
            <div class="form-group col-md-12">
                {{ Form::label('employee_id', __('Employee'), ['class' => 'col-form-label']) }}
                {!! Form::select('employee_id', $employees, null, [
                    'class' => 'form-control  select2',
                    'id' => 'choices-multiple',
                    'required' => 'required',
                    'placeholder' => 'Select employee',
                ]) !!}
            </div>
        @endif
        <div class="form-group col-md-6">
            {{ Form::label('date', __('Date'), ['class' => 'col-form-label']) }}
            {{ Form::text('date', '', ['class' => 'form-control d_week current_date', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Select date']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('hours', __('Hours'), ['class' => 'col-form-label']) }}
            {{ Form::number('hours', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'step' => '0.01', 'placeholder' => 'Enter hours']) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('remark', __('Remark'), ['class' => 'col-form-label']) }}
            {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter remark']) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}

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
