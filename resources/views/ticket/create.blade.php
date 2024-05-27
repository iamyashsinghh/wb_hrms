@php
    $plan = Utility::getChatGPTSettings();
@endphp

{{ Form::open(['url' => 'ticket', 'method' => 'post']) }}
<div class="modal-body">

    @if ($plan->enable_chatgpt == 'on')
        <div class="text-end">
            <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
                data-url="{{ route('generate', ['ticket']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ __('Generate') }}" data-title="{{ __('Generate Content With AI') }}">
                <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
            </a>
        </div>
    @endif

    <div class="row">
        <div class="form-group">
            {{ Form::label('title', __('Subject'), ['class' => 'col-form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Ticket Subject')]) }}
        </div>
        @if (\Auth::user()->type != 'employee')
            <div class="form-group">
                {{ Form::label('employee_id', __('Ticket for Employee'), ['class' => 'col-form-label']) }}
                {{ Form::select('employee_id', $employees, null, ['class' => 'form-control select2 employee_id', 'placeholder' => __('Select Employee')]) }}
            </div>
        @else
            {!! Form::hidden('employee_id', !empty($employees) ? $employees->id : 0, ['id' => 'employee_id']) !!}
        @endif

        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6">
                <div class="form-group">
                    {{ Form::label('priority', __('Priority'), ['class' => 'col-form-label']) }}
                    <select name="priority" class="form-control select2" id="choices-multiple">
                        <option value="low">{{ __('Low') }}</option>
                        <option value="medium">{{ __('Medium') }}</option>
                        <option value="high">{{ __('High') }}</option>
                        <option value="critical">{{ __('critical') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6">
                <div class="form-group">
                    {{ Form::label('end_date', __('End Date'), ['class' => 'col-form-label']) }}
                    {{ Form::text('end_date', null, ['class' => 'form-control d_week current_date', 'autocomplete' => 'off']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('description', __('Description'), ['class' => 'col-form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Ticket Description'), 'rows' => '3']) }}
        </div>

        <div class="form-group">
            {{ Form::label('status', __('Status'), ['class' => 'col-form-label']) }}
            <select name="status" class="form-control  select2" id="status">
                <option value="close">{{ __('Close') }}</option>
                <option value="open">{{ __('Open') }}</option>
                <option value="onhold">{{ __('On Hold') }}</option>
            </select>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
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
