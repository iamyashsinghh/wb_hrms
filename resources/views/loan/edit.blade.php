@php
    $plan = Utility::getChatGPTSettings();
@endphp

{{ Form::model($loan, ['route' => ['loan.update', $loan->id], 'method' => 'PUT']) }}
<div class="modal-body">

    @if ($plan->enable_chatgpt == 'on')
    <div class="card-footer text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
            data-url="{{ route('generate', ['allowance']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
            title="{{ __('Generate') }}" data-title="{{ __('Generate Content With AI') }}">
            <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
        </a>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('title', __('Title'), ['class' => 'col-form-label']) }}
                {{ Form::text('title', null, ['class' => 'form-control ', 'required' => 'required','placeholder'=>'Enter Title']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('loan_option', __('Loan Options*'), ['class' => 'col-form-label']) }}
                {{ Form::select('loan_option', $loan_options, null, ['class' => 'form-control select2','required' => 'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('type', __('Type'), ['class' => 'col-form-label']) }}
                {{ Form::select('type', $loans, null, ['class' => 'form-control select2 amount_type','required' => 'required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('amount', __('Loan Amount'), ['class' => 'col-form-label amount_label']) }}
                {{ Form::number('amount', null, ['class' => 'form-control ', 'required' => 'required','placeholder'=>'Enter Amount']) }}
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('start_date', __('Start Date'), ['class' => 'col-form-label']) }}
                {{ Form::text('start_date', null, ['class' => 'form-control d_week','required' => 'required','autocomplete'=>'off']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('end_date', __('End Date'), ['class' => 'col-form-label']) }}
                {{ Form::text('end_date', null, ['class' => 'form-control d_week', 'required' => 'required','autocomplete'=>'off']) }}
            </div>
        </div> --}}
        <div class="form-group">
            {{ Form::label('reason', __('Reason'), ['class' => 'col-form-label']) }}
            {{ Form::textarea('reason', null, ['class' => 'form-control ', 'required' => 'required','rows' => 3]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn btn-primary">
</div>

{{ Form::close() }}
