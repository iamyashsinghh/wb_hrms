<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Company Policy')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Company Policy')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Company Policy')): ?>
        <a href="#" data-url="<?php echo e(route('company-policy.create')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Create New Company Policy')); ?>" data-size="lg" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Branch')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Attachment')); ?></th>
                                <?php if(Gate::check('Edit Company Policy') || Gate::check('Delete Company Policy')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $companyPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               
                             <?php
                                $policyPath=\App\Models\Utility::get_file('uploads/companyPolicy');
                             ?>
                                <tr>
                                    <td><?php echo e(!empty($policy->branches) ? $policy->branches->name : '-'); ?></td>
                                    <td><?php echo e($policy->title); ?></td>
                                    <td><?php echo e($policy->description); ?></td>
                                    <td>
                                        <?php if(!empty($policy->attachment)): ?>
                                        <div class="action-btn bg-primary ms-2">

                                            <a  class="mx-3 btn btn-sm align-items-center" href="<?php echo e($policyPath . '/' . $policy->attachment); ?>" download="">
                                                <i class="ti ti-download text-white"></i>
                                            </a>
                                        </div>
                                            <div class="action-btn bg-secondary ms-2">
                                                <a class="mx-3 btn btn-sm align-items-center" href="<?php echo e($policyPath . '/' . $policy->attachment); ?>" target="_blank"  >
                                                    <i class="ti ti-crosshair text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Preview')); ?>"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <p>-</p>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('Edit Company Policy') || Gate::check('Delete Company Policy')): ?>
                                        <td class="Action">
                                            <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Company Policy')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-size="lg" class="mx-3 btn btn-sm  align-items-center"
                                                            data-url="<?php echo e(route('company-policy.edit', $policy->id)); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="<?php echo e(__('Edit Company Policy')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Company Policy')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['company-policy.destroy', $policy->id], 'id' => 'delete-form-' . $policy->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/companyPolicy/index.blade.php ENDPATH**/ ?>