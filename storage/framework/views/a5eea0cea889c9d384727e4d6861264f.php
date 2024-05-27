<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>


<?php
    $admin_payment_setting = App\Models\Utility::getAdminPaymentSetting();
?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xxl-6">

        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="card" style="height: 226px">
                    <div class="card-body">
                        <div class="theme-avtar bg-primary">
                            <i class="ti ti-users"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Users')); ?> : <?php echo e($user->total_user); ?></p>
                        <h6 class="mb-3"><?php echo e(__('Paid Users')); ?></h6>
                        <h3 class="mb-0"><?php echo e($user['total_paid_user']); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="card" style="height: 226px">
                    <div class="card-body">
                        <div class="theme-avtar bg-info">
                            <i class="ti ti-shopping-cart"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Orders')); ?>:<?php echo e($user->total_orders); ?></p>
                        <h6 class="mb-3"><?php echo e(__('Total Order Amount')); ?></h6>
                        <h3 class="mb-0"><?php echo e((!empty($admin_payment_setting['currency_symbol']) ? $admin_payment_setting['currency_symbol'] : '$') . $user['total_orders_price']); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="card" style="height: 226px">
                    <div class="card-body">
                        <div class="theme-avtar bg-warning">
                            <i class="ti ti-trophy"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Plan')); ?>: <?php echo e($user['total_plan']); ?></p>
                        <h6 class="mb-3"><?php echo e(__('Most Purchase Plan')); ?></h6>
                        <h3 class="mb-0"><?php echo e($user['most_purchese_plan']); ?></h3>
                    </div>
                </div>
            </div>

        </div>
   </div>
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Recent Order')); ?></h5>
            </div>
            <div class="card-body">
                <div id="chart-sales" height="200" class="p-3"></canvas>
            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <script>
         (function () {
        var chartBarOptions = {
            series: [
                {
                    name: '<?php echo e(__("Order")); ?>',
                    data:  <?php echo json_encode($chartData['data']); ?>,

                },
            ],

            chart: {
                height: 300,
                type: 'area',
                // type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            title: {
                text: '',
                align: 'left'
            },
            xaxis: {
                categories: <?php echo json_encode($chartData['label']); ?>,
                title: {
                    text: ''
                }
            },
            colors: ['#6fd944', '#6fd944'],

            grid: {
                strokeDashArray: 4,
            },
            legend: {
                show: false,
            },
            // markers: {
            //     size: 4,
            //     colors: ['#ffa21d', '#FF3A6E'],
            //     opacity: 0.9,
            //     strokeWidth: 2,
            //     hover: {
            //         size: 7,
            //     }
            // },
            yaxis: {
                title: {
                    text: ''
                },

            }

        };
        var arChart = new ApexCharts(document.querySelector("#chart-sales"), chartBarOptions);
        arChart.render();
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/dashboard/super_admin.blade.php ENDPATH**/ ?>