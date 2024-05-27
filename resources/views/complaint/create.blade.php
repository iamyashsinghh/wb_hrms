@php
    $plan = Utility::getChatGPTSettings();
@endphp

{{ Form::open(['url' => 'complaint', 'method' => 'post']) }}
<div class="modal-body">

    @if ($plan->enable_chatgpt == 'on')
    <div class="card-footer text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true" data-url="{{ route('generate', ['complaint']) }}"
            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Generate') }}"
            data-title="{{ __('Generate Content With AI') }}">
            <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
        </a>
    </div>
    @endif

    <div class="row">
        @if (\Auth::user()->type != 'employee')
            <div class="form-group col-md-6 col-lg-6 ">
                {{ Form::label('complaint_from', __('Complaint From'), ['class' => 'col-form-label']) }}
                {{ Form::select('complaint_from', $employees, null, ['class' => 'form-control  select2' ,'required' => 'required']) }}
            </div>
        @endif
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('complaint_against', __('Complaint Against'), ['class' => 'col-form-label']) }}
            {{ Form::select('complaint_against', $employees, null, ['class' => 'form-control select2' ,'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('title', __('Title'), ['class' => 'col-form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control','placeholder' =>'Enter Complaint Title' ,'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('complaint_date', __('Complaint Date'), ['class' => 'col-form-label']) }}
            {{ Form::text('complaint_date', null, ['class' => 'form-control d_week current_date','autocomplete'=>'off' ,'required' => 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'col-form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description') ,'rows' => '3' ,'required' => 'required']) }}
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