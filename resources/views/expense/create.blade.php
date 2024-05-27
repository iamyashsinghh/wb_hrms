@php
    $plan = Utility::getChatGPTSettings();
@endphp

{{ Form::open(['url' => 'expense', 'method' => 'post']) }}
<div class="modal-body">

    @if ($plan->enable_chatgpt == 'on')
    <div class="card-footer text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
            data-url="{{ route('generate', ['expense']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
            title="{{ __('Generate') }}" data-title="{{ __('Generate Content With AI') }}">
            <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
        </a>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('account_id', __('Account'), ['class' => 'col-form-label']) }}
                {{ Form::select('account_id', $accounts, null, ['class' => 'form-control select2', 'placeholder' => __('Choose Account')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('amount', __('Amount'), ['class' => 'col-form-label']) }}
                {{ Form::number('amount', null, ['class' => 'form-control', 'placeholder' => __('Amount')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('date', __('Date'), ['class' => 'col-form-label']) }}
                {{ Form::text('date', null, ['class' => 'form-control d_week current_date', 'autocomplete' => 'off']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('expense_category_id', __('Category'), ['class' => 'col-form-label']) }}
                {{ Form::select('expense_category_id', $expenseCategory, null, ['class' => 'form-control select2', 'placeholder' => __('Choose a* Category')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('payee_id', __('Payee'), ['class' => 'col-form-label']) }}
                {{ Form::select('payee_id', $payees, null, ['class' => 'form-control select2']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('payment_type_id', __('Payment Method'), ['class' => 'col-form-label']) }}
                {{ Form::select('payment_type_id', $paymentTypes, null, ['class' => 'form-control select2', 'placeholder' => __('Choose Payment Method')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('referal_id', __('Ref#'), ['class' => 'col-form-label']) }}
                {{ Form::text('referal_id', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description', __('Description'), ['class' => 'col-form-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Description'), 'rows' => '3']) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
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
