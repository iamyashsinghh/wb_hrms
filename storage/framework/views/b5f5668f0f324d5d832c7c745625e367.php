<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Employee Set Salary')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(url('setsalary')); ?>"><?php echo e(__('Set Salary')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee Set Salary')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-12">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    
                                    <h5><?php echo e(__('Employee Salary')); ?></h5>

                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Set Salary')): ?>
                                    <div class="col-1 text-end">

                                        <a data-url="<?php echo e(route('employee.basic.salary', $employee->id)); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Set Basic Salary')); ?>" data-bs-toggle="tooltip" title=""
                                            class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Set Salary')); ?>">
                                            <i class="ti ti-plus"></i>
                                        </a>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-info d-flex text-sm">
                                <div class="project-info-inner mr-3 col-11">
                                    <b class="m-0"> <?php echo e(__('Payslip Type')); ?> </b>
                                    <div class="project-amnt pt-1"><?php echo e($employee->salary_type()); ?></div>
                                </div>
                                <div class="project-info-inner mr-3 col-1">
                                    <b class="m-0"> <?php echo e(__('Salary')); ?> </b>
                                    <div class="project-amnt pt-1"><?php echo e($employee->salary); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- allowance -->
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <h5><?php echo e(__('Allowance')); ?></h5>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Allowance')): ?>
                                    <div class="col-1 text-end">
                                        <a data-url="<?php echo e(route('allowances.create', $employee->id)); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create Allowance')); ?>" data-bs-toggle="tooltip" title=""
                                            class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=" card-body table-border-style" style=" overflow:auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Employee Name')); ?></th>
                                            <th><?php echo e(__('Allownace Option')); ?></th>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Type')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <?php if(\Auth::user()->type != 'employee'): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(!empty($allowance->employee()) ? $allowance->employee()->name : ''); ?>

                                                </td>
                                                <td><?php echo e(!empty($allowance->allowance_option()) ? $allowance->allowance_option()->name : ''); ?>

                                                </td>
                                                <td><?php echo e($allowance->title); ?></td>

                                                <td><?php echo e(ucfirst($allowance->type)); ?></td>
                                                <?php if($allowance->type == 'fixed'): ?>
                                                    <td><?php echo e(\Auth::user()->priceFormat($allowance->amount)); ?></td>
                                                <?php else: ?>
                                                    <td><?php echo e($allowance->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat($allowance->tota_allow)); ?>)
                                                    </td>
                                                <?php endif; ?>
                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Allowance')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="<?php echo e(URL::to('allowance/' . $allowance->id . '/edit')); ?>"
                                                                    data-ajax-popup="true" data-size="md"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="<?php echo e(__('Edit Allowance')); ?>"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Allowance')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['allowance.destroy', $allowance->id],
                                                                    'id' => 'delete-form-' . $allowance->id,
                                                                ]); ?>

                                                                <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commission -->
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <h5><?php echo e(__('Commission')); ?></h5>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Commission')): ?>
                                    <div class="col-1 text-end">
                                        <a data-url="<?php echo e(route('commissions.create', $employee->id)); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create Commission')); ?>" data-bs-toggle="tooltip" title=""
                                            class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
                                            <i class="ti ti-plus"></i>
                                        </a>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=" card-body table-border-style" style=" overflow:auto">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th><?php echo e(__('Employee Name')); ?></th>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Type')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <?php if(\Auth::user()->type != 'employee'): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(!empty($commission->employee()) ? $commission->employee()->name : ''); ?>

                                                </td>
                                                <td><?php echo e($commission->title); ?></td>

                                                <td><?php echo e(ucfirst($commission->type)); ?></td>
                                                <?php if($commission->type == 'fixed'): ?>
                                                    <td><?php echo e(\Auth::user()->priceFormat($commission->amount)); ?></td>
                                                <?php else: ?>
                                                    <td><?php echo e($commission->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat($commission->tota_allow)); ?>)
                                                    </td>
                                                <?php endif; ?>

                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Commission')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="<?php echo e(URL::to('commission/' . $commission->id . '/edit')); ?>"
                                                                    data-ajax-popup="true" data-size="md"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="<?php echo e(__('Edit Commission')); ?>"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Commission')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['commission.destroy', $commission->id],
                                                                    'id' => 'delete-form-' . $commission->id,
                                                                ]); ?>

                                                                <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- loan-->
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <h5><?php echo e(__('Loan')); ?></h5>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Loan')): ?>
                                    <div class="col-1 text-end">
                                        <a data-url="<?php echo e(route('loans.create', $employee->id)); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create Loan')); ?>" data-bs-toggle="tooltip" title=""
                                            data-size="lg" class="btn btn-sm btn-primary"
                                            data-bs-original-title="<?php echo e(__('Create')); ?>">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=" card-body table-border-style" style=" overflow:auto">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Employee')); ?></th>
                                            <th><?php echo e(__('Loan Options')); ?></th>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Type')); ?></th>
                                            <th><?php echo e(__('Loan Amount')); ?></th>
                                            
                                            <?php if(\Auth::user()->type != 'employee'): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(!empty($loan->employee()) ? $loan->employee()->name : ''); ?></td>
                                                <td><?php echo e(!empty($loan->loan_option()) ? $loan->loan_option()->name : ''); ?>

                                                </td>
                                                <td><?php echo e($loan->title); ?></td>
                                                <td><?php echo e(ucfirst($loan->type)); ?></td>
                                                <?php if($loan->type == 'fixed'): ?>
                                                    <td><?php echo e(\Auth::user()->priceFormat($loan->amount)); ?></td>
                                                <?php else: ?>
                                                    <td><?php echo e($loan->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat($loan->tota_allow)); ?>)
                                                    </td>
                                                <?php endif; ?>

                                                

                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Loan')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="<?php echo e(URL::to('loan/' . $loan->id . '/edit')); ?>"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="<?php echo e(__('Edit Loan')); ?>"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Loan')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['loan.destroy', $loan->id],
                                                                    'id' => 'delete-form-' . $loan->id,
                                                                ]); ?>

                                                                <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Saturation -->
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <h5><?php echo e(__('Saturation Deduction')); ?></h5>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Saturation Deduction')): ?>
                                    <div class="col-1 text-end">
                                        <a data-url="<?php echo e(route('saturationdeductions.create', $employee->id)); ?>"
                                            data-ajax-popup="true" data-size="lg"
                                            data-title="<?php echo e(__('Create Saturation Deduction')); ?>" data-bs-toggle="tooltip"
                                            title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="<?php echo e(__('Create')); ?>">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=" card-body table-border-style" style=" overflow:auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Employee Name')); ?></th>
                                            <th><?php echo e(__('Deduction Option')); ?></th>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Type')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <?php if(\Auth::user()->type != 'employee'): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $saturationdeductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saturationdeduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(!empty($saturationdeduction->employee()) ? $saturationdeduction->employee()->name : ''); ?>

                                                </td>
                                                <td><?php echo e(!empty($saturationdeduction->deduction_option()) ? $saturationdeduction->deduction_option()->name : ''); ?>

                                                </td>
                                                <td><?php echo e($saturationdeduction->title); ?></td>
                                                <td><?php echo e(ucfirst($saturationdeduction->type)); ?></td>
                                                <?php if($saturationdeduction->type == 'fixed'): ?>
                                                    <td><?php echo e(\Auth::user()->priceFormat($saturationdeduction->amount)); ?>

                                                    </td>
                                                <?php else: ?>
                                                    <td><?php echo e($saturationdeduction->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat($saturationdeduction->tota_allow)); ?>)
                                                    </td>
                                                <?php endif; ?>

                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Saturation Deduction')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="<?php echo e(URL::to('saturationdeduction/' . $saturationdeduction->id . '/edit')); ?>"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="<?php echo e(__('Edit Saturation Deduction')); ?>"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Saturation Deduction')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['saturationdeduction.destroy', $saturationdeduction->id],
                                                                    'id' => 'delete-form-' . $saturationdeduction->id,
                                                                ]); ?>

                                                                <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- other payment-->
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <h5><?php echo e(__('Other Payment')); ?></h5>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Other Payment')): ?>
                                    <div class="col-1 text-end">

                                        <a data-url="<?php echo e(route('otherpayments.create', $employee->id)); ?>"
                                            data-ajax-popup="true" data-title="<?php echo e(__('Create Other Payment')); ?>"
                                            data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="<?php echo e(__('Create')); ?>">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=" card-body table-border-style" style=" overflow:auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Employee')); ?></th>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Type')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <?php if(\Auth::user()->type != 'employee'): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $otherpayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherpayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(!empty($otherpayment->employee()) ? $otherpayment->employee()->name : ''); ?>

                                                </td>
                                                <td><?php echo e($otherpayment->title); ?></td>
                                                <td><?php echo e(ucfirst($otherpayment->type)); ?></td>
                                                <?php if($otherpayment->type == 'fixed'): ?>
                                                    <td><?php echo e(\Auth::user()->priceFormat($otherpayment->amount)); ?></td>
                                                <?php else: ?>
                                                    <td><?php echo e($otherpayment->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat($otherpayment->tota_allow)); ?>)
                                                    </td>
                                                <?php endif; ?>

                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Other Payment')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="<?php echo e(URL::to('otherpayment/' . $otherpayment->id . '/edit')); ?>"
                                                                    data-ajax-popup="true" data-size="md"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="<?php echo e(__('Edit Other Payment')); ?>"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Other Payment')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['otherpayment.destroy', $otherpayment->id],
                                                                    'id' => 'delete-form-' . $otherpayment->id,
                                                                ]); ?>

                                                                <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--overtime-->
                <div class="col-md-6">
                    <div class="card set-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <h5><?php echo e(__('Overtime')); ?></h5>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Overtime')): ?>
                                    <div class="col-1 text-end">
                                        <a data-url="<?php echo e(route('overtimes.create', $employee->id)); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create Overtime')); ?>" data-bs-toggle="tooltip"
                                            title="" class="btn btn-sm btn-primary"
                                            data-bs-original-title="<?php echo e(__('Create')); ?>">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=" card-body table-border-style" style=" overflow:auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Employee Name')); ?></th>
                                            <th><?php echo e(__('Overtime Title')); ?></th>
                                            <th><?php echo e(__('Number of days')); ?></th>
                                            <th><?php echo e(__('Hours')); ?></th>
                                            <th><?php echo e(__('Rate')); ?></th>
                                            <?php if(\Auth::user()->type != 'employee'): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(!empty($overtime->employee()) ? $overtime->employee()->name : ''); ?>

                                                </td>
                                                <td><?php echo e($overtime->title); ?></td>
                                                <td><?php echo e($overtime->number_of_days); ?></td>
                                                <td><?php echo e($overtime->hours); ?></td>
                                                <td><?php echo e(\Auth::user()->priceFormat($overtime->rate)); ?></td>
                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Overtime')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a class="mx-3 btn btn-sm  align-items-center"
                                                                    data-url="<?php echo e(URL::to('overtime/' . $overtime->id . '/edit')); ?>"
                                                                    data-ajax-popup="true" data-size="md"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-title="<?php echo e(__('Edit OverTime')); ?>"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Overtime')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['overtime.destroy', $overtime->id],
                                                                    'id' => 'delete-form-' . $overtime->id,
                                                                ]); ?>

                                                                <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript">
        $(document).on('change', '.amount_type', function() {

            var val = $(this).val();
            var label_text = 'Amount';
            if (val == 'percentage') {
                var label_text = 'Percentage';
            }
            $('.amount_label').html(label_text);
        });


        $(document).on('change', 'select[name=department_id]', function() {
            var department_id = $(this).val();
            getDesignation(department_id);
        });



        function getDesignation(did) {
            $.ajax({
                url: '<?php echo e(route('employee.json')); ?>',
                type: 'POST',
                data: {
                    "department_id": did,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    $('#designation_id').empty();
                    $('#designation_id').append(
                        '<option value=""><?php echo e(__('Select any Designation')); ?></option>');
                    $.each(data, function(key, value) {
                        var select = '';
                        if (key == '<?php echo e($employee->designation_id); ?>') {
                            select = 'selected';
                        }

                        $('#designation_id').append('<option value="' + key + '"  ' + select + '>' +
                            value + '</option>');
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/setsalary/employee_salary.blade.php ENDPATH**/ ?>