<?php
    $plan = new stdClass();
    $plan->enable_chatgpt = "on";
?>

<?php echo e(Form::open(['url' => 'overtime', 'method' => 'post'])); ?>

<?php echo e(Form::hidden('employee_id', $employee->id, [])); ?>

<div class="modal-body">

    <?php if($plan->enable_chatgpt == 'on'): ?>
    <div class="card-footer text-end">
        <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
            data-url="<?php echo e(route('generate', ['overtime'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate Content With AI')); ?>">
            <i class="fas fa-robot"></i><?php echo e(__(' Generate With AI')); ?>

        </a>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('title', __('Overtime Title*'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('title', null, ['class' => 'form-control ', 'required' => 'required','placeholder'=>'Enter Title'])); ?>

        </div>
        <div class="form-group col-md-4">
            <?php echo e(Form::label('number_of_days', __('Number of days'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('number_of_days', null, ['class' => 'form-control ','required' => 'required','step' => '0.01'])); ?>

        </div>
        <div class="form-group col-md-4">
            <?php echo e(Form::label('hours', __('Hours'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('hours', null, ['class' => 'form-control ', 'required' => 'required', 'step' => '0.01'])); ?>

        </div>
        <div class="form-group col-md-4">
            <?php echo e(Form::label('rate', __('Rate'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('rate', null, ['class' => 'form-control ', 'required' => 'required', 'step' => '0.01'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">

    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/overtime/create.blade.php ENDPATH**/ ?>