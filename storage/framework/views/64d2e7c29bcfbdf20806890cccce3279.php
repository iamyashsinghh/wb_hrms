<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Monthly Attendance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Manage Monthly Attendance Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>"
        data-original-title="<?php echo e(__('Download')); ?>">
        <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
    </a>

    <?php
        $emp = isset($_GET['employee_id']) && !empty($_GET['employee_id']) ? $_GET['employee_id'] : [];
        $employees = implode(', ', $emp);
    ?>

    <a href="<?php echo e(route('report.attendance', [isset($_GET['month']) ? $_GET['month'] : date('Y-m'), isset($_GET['branch_id']) && !empty($_GET['branch_id']) ? $_GET['branch_id'] : 0, isset($_GET['department']) && !empty($_GET['department']) ? $_GET['department'] : 0, !empty($employees) ? $employees : 0])); ?>"
        class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="" data-bs-original-title="Export">
        <span class="btn-inner--icon"><i class="ti ti-file-export "></i></span>
    </a>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 4,
                    dpi: 72,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A2'
                }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['report.monthly.attendance'], 'method' => 'get', 'id' => 'report_monthly_attendance'])); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('month', __(' Month'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::month('month', isset($_GET['month']) ? $_GET['month'] : '', ['class' => 'month-btn form-control current_date', 'autocomplete' => 'off', 'placeholder' => 'Select month'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('branch', __('Branch'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::select('branch_id', $branch, isset($_GET['branch']) ? $_GET['branch'] : '', ['class' => 'form-control select branch_id', 'id' => 'branch-select branch_id'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box" id="department_div">
                                            <?php echo e(Form::label('department', __('Department'), ['class' => 'form-label'])); ?>

                                            <select class="form-control select department_id" name="department"
                                                id="department_id" placeholder="Select Department">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box" id="employee_div">
                                            <?php echo e(Form::label('employee', __('Employee'), ['class' => 'form-label'])); ?>

                                            <select class="form-control select" name="employee_id[]" id="employee_id"
                                                placeholder="Select Employee">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary"
                                            onclick="document.getElementById('report_monthly_attendance').submit(); return false;"
                                            data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                            data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('report.monthly.attendance')); ?>" class="btn btn-sm btn-danger "
                                            data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>"
                                            data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i
                                                    class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-report"></i>
                                </div>
                                <div class="ms-3">
                                    <input type="hidden"
                                        value="<?php echo e($data['branch'] . ' ' . __('Branch') . ' ' . $data['curMonth'] . ' ' . __('Attendance Report of') . ' ' . $data['department'] . ' ' . 'Department'); ?>"
                                        id="filename">
                                    <h5 class="mb-0"><?php echo e(__('Report')); ?></h5>
                                    <div>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Attendance Summary')); ?></p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($data['branch'] != 'All'): ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-secondary">
                                        <i class="ti ti-sitemap"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo e(__('Branch')); ?></h5>
                                        <p class="text-muted text-sm mb-0">
                                            <?php echo e($data['branch']); ?> </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($data['department'] != 'All'): ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-template"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo e(__('Department')); ?></h5>
                                        <p class="text-muted text-sm mb-0"><?php echo e($data['department']); ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-secondary">
                                    <i class="ti ti-sum"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Duration')); ?></h5>
                                    <p class="text-muted text-sm mb-0"><?php echo e($data['curMonth']); ?>

                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card mon-card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-file-report"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Attendance')); ?></h5>
                                    <div>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Total present')); ?>:
                                            <?php echo e($data['totalPresent']); ?></p>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Total leave')); ?>:
                                            <?php echo e($data['totalLeave']); ?></p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card mon-card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-secondary">
                                    <i class="ti ti-clock"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Overtime')); ?></h5>
                                    <p class="text-muted text-sm mb-0">
                                        <?php echo e(__('Total overtime in hours')); ?> :
                                        <?php echo e(number_format($data['totalOvertime'], 2)); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card mon-card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-info-circle"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Early leave')); ?></h5>
                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Total early leave in hours')); ?>:
                                        <?php echo e(number_format($data['totalEarlyLeave'], 2)); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card mon-card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-secondary">
                                    <i class="ti ti-alarm"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Employee late')); ?></h5>
                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Total late in hours')); ?> :
                                        <?php echo e(number_format($data['totalLate'], 2)); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive py-4 attendance-table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="active"><?php echo e(__('Name')); ?></th>
                                    <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($date); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $employeesAttendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($attendance['name']); ?></td>
                                        <?php $__currentLoopData = $attendance['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <?php if($status == 'P'): ?>
                                                    <i class="badge bg-success p-2  rounded"><?php echo e(__('P')); ?></i>
                                                <?php elseif($status == 'A'): ?>
                                                    <i class="badge bg-danger p-2  rounded"><?php echo e(__('A')); ?></i>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function() {
            var b_id = $('#branch_id').val();
            // getDepartment(b_id);
        });
        $(document).on('change', 'select[name=branch_id]', function() {
            var branch_id = $(this).val();

            getDepartment(branch_id);
        });

        function getDepartment(bid) {

            $.ajax({
                url: '<?php echo e(route('monthly.getdepartment')); ?>',
                type: 'POST',
                data: {
                    "branch_id": bid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {

                    $('.department_id').empty();
                    var emp_selct = `<select class="department_id form-control multi-select" id="choices-multiple" multiple="" required="required" name="department_id[]">
                </select>`;
                    $('.department_div').html(emp_selct);

                    $('.department_id').append('<option value=""> <?php echo e(__('Select Department')); ?> </option>');
                    $.each(data, function(key, value) {
                        $('.department_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    new Choices('#choices-multiple', {
                        removeItemButton: true,
                    });
                }
            });
        }

        $(document).on('change', '.department_id', function() {
            var department_id = $(this).val();
            getEmployee(department_id);
        });

        function getEmployee(did) {

            $.ajax({
                url: '<?php echo e(route('monthly.getemployee')); ?>',
                type: 'POST',
                data: {
                    "department_id": did,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {

                    $('#employee_id').empty();

                    $("#employee_div").html('');
                    // $('#employee_div').append('<select class="form-control" id="employee_id" name="employee_id[]"  multiple></select>');
                    $('#employee_div').append(
                        '<label for="employee" class="form-label"><?php echo e(__('Employee')); ?></label><select class="form-control" id="employee_id" name="employee_id[]"  multiple></select>'
                    );

                    $('#employee_id').append('<option value=""><?php echo e(__('Select Employee')); ?></option>');

                    $.each(data, function(key, value) {
                        $('#employee_id').append('<option value="' + key + '">' + value + '</option>');
                    });

                    var multipleCancelButton = new Choices('#employee_id', {
                        removeItemButton: true,
                    });
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            var now = new Date();
            var month = (now.getMonth() + 1);
            if (month < 10) month = "0" + month;
            var today = now.getFullYear() + '-' + month;
            $('.current_date').val(today);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/report/monthlyAttendance.blade.php ENDPATH**/ ?>