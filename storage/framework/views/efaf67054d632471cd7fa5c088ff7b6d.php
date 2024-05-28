<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plan Order')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan Order')); ?></li>
<?php $__env->stopSection(); ?>

<?php
    $file = \App\Models\Utility::get_file('uploads/order/');
    $admin_payment_setting = App\Models\Utility::getAdminPaymentSetting();
?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Order Id')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Plan Name')); ?></th>
                                    <th><?php echo e(__('Price')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Coupon')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Invoice')); ?></th>
                                    <?php if(\Auth::user()->type == 'super admin'): ?>
                                        <th><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($order->order_id); ?></td>
                                        <td><?php echo e($order->user_name); ?></td>
                                        <td><?php echo e($order->plan_name); ?></td>
                                        <td><?php echo e((!empty($admin_payment_setting['currency_symbol']) ? $admin_payment_setting['currency_symbol'] : '$') . $order->price); ?>

                                        </td>
                                        <td>
                                            <?php if($order->payment_status == 'succeeded'): ?>
                                                <i class="mdi mdi-circle text-success"></i>
                                                <?php echo e(ucfirst($order->payment_status)); ?>

                                            <?php else: ?>
                                                <i class="mdi mdi-circle text-danger"></i>
                                                <?php echo e(ucfirst($order->payment_status)); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                                        <td><?php echo e(!empty($order->total_coupon_used) ? (!empty($order->total_coupon_used->coupon_detail) ? $order->total_coupon_used->coupon_detail->code : '-') : '-'); ?>

                                        </td>
                                        <td><?php echo e($order->payment_type); ?></td>
                                        <td class="Id text-center">
                                            <?php if(!empty($order->receipt && !empty($order->payment_type == 'STRIPE'))): ?>
                                                <a href="<?php echo e($order->receipt); ?>" class="btn  btn-outline-primary"
                                                    target="_blank"><i class="fas fa-file-invoice"></i></a>
                                            <?php elseif(!empty($order->receipt && !empty($order->payment_type == 'Bank Transfer'))): ?>
                                                <a href="<?php echo e($file . '' . $order->receipt); ?>"
                                                    class="btn btn-outline-primary" target="_blank"><i
                                                        class="fas fa-file-invoice"></i></a>
                                            <?php else: ?>
                                                <p>-</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                                <?php if($order->payment_status == 'Pending' && $order->payment_type == 'Bank Transfer'): ?>
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                            data-size="lg"
                                                            data-url="<?php echo e(URL::to('order/' . $order->id . '/action')); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="<?php echo e(__('Order Action')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Manage Order')); ?>">
                                                            <i class="ti ti-caret-right text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php elseif(\Auth::user()->type == 'company' && $order->payment_type == 'Bank Transfer'): ?>
                                                <div class="action-btn bg-success ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                        data-size="lg"
                                                        data-url="<?php echo e(URL::to('order/' . $order->id . '/action')); ?>"
                                                        data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                        title="" data-title="<?php echo e(__('Manage Order')); ?>"
                                                        data-bs-original-title="<?php echo e(__('Manage Order')); ?>">
                                                        <i class="ti ti-caret-right text-white"></i>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                            <?php endif; ?>

                                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['order.destroy', $order->id],
                                                        'id' => 'delete-form-' . $order->id,
                                                    ]); ?>

                                                    <a href="#"
                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                        data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="Delete" aria-label="Delete"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/order/index.blade.php ENDPATH**/ ?>