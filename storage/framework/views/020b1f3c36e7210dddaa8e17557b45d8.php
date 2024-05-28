<?php echo e(Form::open(array('route' => array('store.language')))); ?>

<div class="modal-body">
    <div class="form-group">
        <?php echo e(Form::label('code', __('Language Code'),['class' => 'col-form-label'])); ?>

        <?php echo e(Form::text('code', '', array('class' => 'form-control','required'=>'required'))); ?>

        <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-code" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php echo e(Form::label('fullName', __('Language Name'),['class' => 'col-form-label'])); ?>

        <?php echo e(Form::text('fullName', '', array('class' => 'form-control','required'=>'required'))); ?>

    </div>
</div>

<div class="modal-footer pr-0">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn  btn-primary'))); ?>

</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/lang/create.blade.php ENDPATH**/ ?>