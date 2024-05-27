@php
    $chatgpt_key = Utility::getValByName('chatgpt_key');
    $chatgpt_enable = !empty($chatgpt_key);
@endphp

{{ Form::model($coupon, ['route' => ['coupons.update', $coupon->id], 'method' => 'PUT']) }}
<div class="modal-body">

    @if ($chatgpt_enable)
        <div class="text-end">
            <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
                data-url="{{ route('generate', ['coupon']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ __('Generate') }}" data-title="{{ __('Generate Content With AI') }}">
                <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
            </a>
        </div>
    @endif

    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control font-style', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('discount', __('Discount'), ['class' => 'col-form-label']) }}
            {{ Form::number('discount', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
            <span class="small">{{ __('Note: Discount in Percentage') }}</span>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('limit', __('Limit'), ['class' => 'col-form-label']) }}
            {{ Form::number('limit', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        {{-- <div class="form-group">
            {{ Form::label('code', __('Code'), ['class' => 'col-form-label']) }}
            {{ Form::text('code', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div> --}}

        <div class="form-group">
            {{ Form::label('code', __('Code'), ['class' => 'col-form-label']) }}
            <div class="input-group">
                {{ Form::text('code', null, ['class' => 'form-control', 'id' => 'auto-code', 'required' => 'required']) }}
                <button class="btn btn-outline-primary" type="button" id="code-generate"><i
                        class="fa fa-history pr-1"></i>{{ __(' Generate') }}</button>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">

</div>
{{ Form::close() }}
