@php
    $plan = Utility::getChatGPTSettings();
@endphp

{{ Form::model($transfer, ['route' => ['transfer.update', $transfer->id], 'method' => 'PUT']) }}
<div class="modal-body">

    @if ($plan->enable_chatgpt == 'on')
    <div class="card-footer text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
            data-url="{{ route('generate', ['transfer']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
            title="{{ __('Generate') }}" data-title="{{ __('Generate Content With AI') }}">
            <i class="fas fa-robot"></i>{{ __(' Generate With AI') }}
        </a>
    </div>
    @endif

    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
            {{ Form::label('branch_id', __('Branch'), ['class' => 'col-form-label']) }}
            {{ Form::select('branch_id', $branches, null, ['class' => 'form-control select2', 'required' => 'required', 'id' => 'branch_id']) }}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{ Form::label('department_id', __('Department'), ['class' => 'col-form-label']) }}
            {{ Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'required' => 'required', 'id' => 'department_id']) }}
        </div>
        <div class="form-group col-lg-6 col-md-6 ">
            {{ Form::label('employee_id', __('Employee'), ['class' => 'col-form-label']) }}
            <div class="employee_div">
                {{ Form::select('employee_id', $employees, null, ['class' => 'form-control select2 employee_id', 'required' => 'required']) }}
            </div>
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{ Form::label('transfer_date', __('Transfer Date'), ['class' => 'col-form-label']) }}
            {{ Form::text('transfer_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off', 'required' => 'required']) }}
        </div>
        <div class="form-group col-lg-12">
            {{ Form::label('description', __('Description'), ['class' => 'col-form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'rows' => '3', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn btn-primary">
</div>

{{ Form::close() }}

<script type="text/javascript">
    function getDesignation(did) {

        $.ajax({
            url: '{{ route('monthly.getemployee') }}',
            type: 'POST',
            data: {
                "department_id": did,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                $('.employee_id').empty();
                var emp_selct = ` <select class="form-control  designation_id select2" name="designation_id" id="choices-multiple"
                                        placeholder="Select Designation" >
                                        </select>`;
                $('.employee_div').html(emp_selct);
                $('.employee_id').append('<option value="">{{ __('Select Employee') }}</option>');
                $.each(data, function(key, value) {
                    var select = '';
                    if (key == '{{ $transfer->employee_id }}') {
                        select = 'selected';
                    }

                    $('.employee_id').append('<option value="' + key + '"  ' + select + '>' +
                        value + '</option>');
                });
                new Choices('#choices-multiple', {
                    removeItemButton: true,
                });
            }
        });
    }

    function getdepartment(bid) {

        $.ajax({
            url: '{{ route('employee.getdepartment') }}',
            type: 'POST',
            data: {
                "branch_id": bid,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                $('#department_id').empty();
                var emp_selct = ` <select class="form-control department_id select2" name="department_id" id="choices-multiple"
                                        placeholder="Select Department" >
                                        </select>`;
                $('.department_div').html(emp_selct);
                $('.department_id').append('<option value="">{{ __('Select Department') }}</option>');
                $.each(data, function(key, value) {
                    var select = '';
                    if (key == '{{ $transfer->department_id }}') {
                        select = 'selected';
                    }

                    $('.department_id').append('<option value="' + key + '"  ' + select + '>' +
                        value + '</option>');
                });
                new Choices('#choices-multiple', {
                    removeItemButton: true,
                });
            }
        });
    }

    $(document).ready(function() {
        var d_id = $('#department_id').val();
        var designation_id = '{{ $transfer->employee_id }}';
        getDesignation(d_id);
    });

    $(document).on('change', 'select[name=department_id]', function() {
        var department_id = $(this).val();
        getDesignation(department_id);
    });

    $(document).ready(function() {
        var b_id = $('#branch_id').val();
        var department_id = '{{ $transfer->department_id }}';
        getdepartment(b_id);
    });

    $(document).on('change', 'select[name=branch_id]', function() {
        var branch_id = $(this).val();
        getdepartment(branch_id);
    });
</script>
