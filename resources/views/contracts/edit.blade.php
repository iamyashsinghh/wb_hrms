@php
    $plan = Utility::getChatGPTSettings();
@endphp

{{ Form::model($contract, ['route' => ['contract.update', $contract->id], 'method' => 'PUT']) }}
<div class="modal-body">

    @if ($plan->enable_chatgpt == 'on')
    <div class="text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
            data-url="{{ route('generate', ['contract']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
            title="{{ __('Generate') }}" data-title="{{ __('Generate Content With AI') }}">
            <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
        </a>
    </div>
    @endif

    <div class="row">

        <div class="col-md-6 form-group">
            {{ Form::label('employee_name', __('Employee Name'), ['class' => 'col-form-label']) }}
            {{ Form::select('employee_name', $employee, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('subject', __('Subject'), ['class' => 'col-form-label']) }}
            {{ Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('value', __('Value'), ['class' => 'col-form-label']) }}
            {{ Form::number('value', null, ['class' => 'form-control', 'required' => 'required', 'min' => '1']) }}
        </div>
        <div class="col-md-6 form-group">
            {{ Form::label('type', __('Type'), ['class' => 'col-form-label']) }}
            {{ Form::select('type', $contractType, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('end_date', __('End Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('end_date', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-md-12 form-group">
            {{ Form::label('description', __('Description'), ['class' => 'col-form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <button type="submit" class="btn  btn-primary">{{ __('Update') }}</button>

</div>

{{ Form::close() }}
