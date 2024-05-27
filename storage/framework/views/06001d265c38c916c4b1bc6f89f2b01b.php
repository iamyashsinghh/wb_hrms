<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php
    $setting = App\Models\Utility::settings();
    
?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>


        <?php if(\Auth::user()->type == 'employee'): ?>
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5><?php echo e(__('Calendar')); ?></h5>
                                <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">
                            </div>
                            <div class="col-lg-6">
                                
                                <label for=""></label>
                                <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                    <select class="form-control" name="calender_type" id="calender_type"
                                        style="float: right;width: 155px;" onchange="get_data()">
                                        <option value="google_calender"><?php echo e(__('Google Calendar')); ?></option>
                                        <option value="local_calender" selected="true">
                                            <?php echo e(__('Local Calendar')); ?></option>
                                    </select>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='event_calendar' class='calendar'></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6">
                <div class="card" style="height: 230px;">
                    <div class="card-header">
                        <h5><?php echo e(__('Mark Attandance')); ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted pb-0-5">
                            <?php echo e(__('My Office Time: ' . $officeTime['startTime'] . ' to ' . $officeTime['endTime'])); ?></p>
                        <div class="row">
                            <div class="col-md-6 float-right border-right">
                                <?php echo e(Form::open(['url' => 'attendanceemployee/attendance', 'method' => 'post'])); ?>

                                <?php if(empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00'): ?>
                                    <button type="submit" value="0" name="in" id="clock_in"
                                        class="btn btn-primary"><?php echo e(__('CLOCK IN')); ?></button>
                                <?php else: ?>
                                    <button type="submit" value="0" name="in" id="clock_in"
                                        class="btn btn-primary disabled" disabled><?php echo e(__('CLOCK IN')); ?></button>
                                <?php endif; ?>
                                <?php echo e(Form::close()); ?>

                            </div>
                            <div class="col-md-6 float-left">
                                <?php if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00'): ?>
                                    <?php echo e(Form::model($employeeAttendance, ['route' => ['attendanceemployee.update', $employeeAttendance->id], 'method' => 'PUT'])); ?>

                                    <button type="submit" value="1" name="out" id="clock_out"
                                        class="btn btn-danger"><?php echo e(__('CLOCK OUT')); ?></button>
                                <?php else: ?>
                                    <button type="submit" value="1" name="out" id="clock_out"
                                        class="btn btn-danger disabled" disabled><?php echo e(__('CLOCK OUT')); ?></button>
                                <?php endif; ?>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="height: 402px;">
                    <div class="card-header card-body table-border-style">
                        <h5><?php echo e(__('Meeting schedule')); ?></h5>
                    </div>
                    <div class="card-body" style="height: 320px">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Meeting title')); ?></th>
                                        <th><?php echo e(__('Meeting Date')); ?></th>
                                        <th><?php echo e(__('Meeting Time')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($meeting->title); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                            <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-body table-border-style">
                        <h5><?php echo e(__('Announcement List')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Start Date')); ?></th>
                                        <th><?php echo e(__('End Date')); ?></th>
                                        <th><?php echo e(__('Description')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($announcement->title); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                            <td><?php echo e($announcement->description); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xxl-12">

                
                <div class="row">

                    <div class="col-lg-4 col-md-6">

                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Staff')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($countUser + $countEmployee); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">

                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-info">
                                                <i class="ti ti-ticket"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Ticket')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-info"> <?php echo e($countTicket); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">

                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-warning">
                                                <i class="ti ti-wallet"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Account Balance')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-warning"><?php echo e(\Auth::user()->priceFormat($accountBalance)); ?>

                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-cast"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                        <h6 class="m-0"><?php echo e(__('Jobs')); ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end">
                                <h4 class="m-0 text-primary"><?php echo e($activeJob + $inActiveJOb); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-cast"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                        <h6 class="m-0"><?php echo e(__('Active Jobs')); ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end">
                                <h4 class="m-0 text-info"> <?php echo e($activeJob); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-cast"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                        <h6 class="m-0"><?php echo e(__('Inactive Jobs')); ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end">
                                <h4 class="m-0 text-warning"><?php echo e($inActiveJOb); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            
            <div class="col-xxl-12">
                <div class="row">
                    <div class="col-xl-5">

                        <?php if(\Auth::user()->type == 'company'): ?>
                            <div class="card">
                                <div class="card-header card-body table-border-style">
                                    <h5><?php echo e(__('Storage Status')); ?> <small>(<?php echo e($users->storage_limit . 'MB'); ?> /
                                            <?php echo e($plan->storage_limit . 'MB'); ?>)</small></h5>
                                </div>
                                <div class="card-body" style="height: 324px; overflow:auto">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body border rounded  p-3">
                                            <div id="device-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header card-body table-border-style">
                                <h5><?php echo e(__('Meeting schedule')); ?></h5>
                            </div>
                            <div class="card-body" style="height: 324px; overflow:auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Title')); ?></th>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Time')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($meeting->title); ?></td>
                                                    <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                                    <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header card-body table-border-style">
                                <h5><?php echo e(__("Today's Not Clock In")); ?></h5>
                            </div>
                            <div class="card-body" style="height: 324px; overflow:auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Name')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php $__currentLoopData = $notClockIns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notClockIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($notClockIn->name); ?></td>
                                                    <td><span class="absent-btn"><?php echo e(__('Absent')); ?></span></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5><?php echo e(__('Calendar')); ?></h5>
                                        <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        
                                        <label for=""></label>
                                        <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                            <select class="form-control" name="calender_type" id="calender_type"
                                                style="float: right;width: 155px;" onchange="get_data()">
                                                <option value="google_calender"><?php echo e(__('Google Calendar')); ?></option>
                                                <option value="local_calender" selected="true">
                                                    <?php echo e(__('Local Calendar')); ?></option>
                                            </select>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card-635 ">
                                <div id='calendar' class='calendar'></div>
                            </div>
                        </div>

                        <?php if(\Auth::user()->type == 'company'): ?>
                            <div class="card">
                                <div class="card-header card-body table-border-style">
                                    <h5><?php echo e(__('Announcement List')); ?></h5>
                                </div>
                                <div class="card-body" style="height: 324px; overflow:auto">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Title')); ?></th>
                                                    <th><?php echo e(__('Start Date')); ?></th>
                                                    <th><?php echo e(__('End Date')); ?></th>
                                                    <th><?php echo e(__('Description')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($announcement->title); ?></td>
                                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                                        <td><?php echo e($announcement->description); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <?php if(\Auth::user()->type != 'company'): ?>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-body table-border-style">
                            <h5><?php echo e(__('Announcement List')); ?></h5>
                        </div>
                        <div class="card-body" style="height: 270px; overflow:auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Start Date')); ?></th>
                                            <th><?php echo e(__('End Date')); ?></th>
                                            <th><?php echo e(__('Description')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($announcement->title); ?></td>
                                                <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                                <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                                <td><?php echo e($announcement->description); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>

    <?php if(Auth::user()->type == 'company' || Auth::user()->type == 'hr'): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                get_data();
            });

            function get_data() {
                var calender_type = $('#calender_type :selected').val();

                $('#calendar').removeClass('local_calender');
                $('#calendar').removeClass('google_calender');
                if (calender_type == undefined) {
                    calender_type = 'local_calender';
                }
                $('#calendar').addClass(calender_type);

                $.ajax({
                    url: $("#path_admin").val() + "/event/get_event_data",
                    method: "POST",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        'calender_type': calender_type
                    },
                    success: function(data) {

                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            buttonText: {
                                timeGridDay: "<?php echo e(__('Day')); ?>",
                                timeGridWeek: "<?php echo e(__('Week')); ?>",
                                dayGridMonth: "<?php echo e(__('Month')); ?>"
                            },
                            // slotLabelFormat: {
                            //     hour: '2-digit',
                            //     minute: '2-digit',
                            //     hour12: false,
                            // },
                            themeSystem: 'bootstrap',
                            slotDuration: '00:10:00',
                            allDaySlot: true,
                            navLinks: true,
                            droppable: true,
                            selectable: true,
                            selectMirror: true,
                            editable: true,
                            dayMaxEvents: true,
                            handleWindowResize: true,
                            events: data,
                            // height: 'auto',
                            // timeFormat: 'H(:mm)',
                        });
                        calendar.render();
                    }
                });
            };
        </script>
    <?php else: ?>
        <script>
            $(document).ready(function() {
                get_data();
            });

            function get_data() {
                var calender_type = $('#calender_type :selected').val();

                $('#event_calendar').removeClass('local_calender');
                $('#event_calendar').removeClass('google_calender');
                if (calender_type == undefined) {
                    calender_type = 'local_calender';
                }
                $('#event_calendar').addClass(calender_type);

                $.ajax({
                    url: $("#path_admin").val() + "/event/get_event_data",
                    method: "POST",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        'calender_type': calender_type
                    },
                    success: function(data) {
                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('event_calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            buttonText: {
                                timeGridDay: "<?php echo e(__('Day')); ?>",
                                timeGridWeek: "<?php echo e(__('Week')); ?>",
                                dayGridMonth: "<?php echo e(__('Month')); ?>"
                            },
                            // slotLabelFormat: {
                            //     hour: '2-digit',
                            //     minute: '2-digit',
                            //     hour12: false,
                            // },
                            themeSystem: 'bootstrap',
                            slotDuration: '00:10:00',
                            allDaySlot: true,
                            navLinks: true,
                            droppable: true,
                            selectable: true,
                            selectMirror: true,
                            editable: true,
                            dayMaxEvents: true,
                            handleWindowResize: true,
                            events: data,
                            // height: 'auto',
                            // timeFormat: 'H(:mm)',

                        });

                        calendar.render();
                    }
                });
            };
        </script>
    <?php endif; ?>

    <?php if(\Auth::user()->type == 'company'): ?>
        <script>
            (function() {
                var options = {
                    series: [<?php echo e(round($storage_limit,2)); ?>],
                    chart: {
                        height: 350,
                        type: 'radialBar',
                        offsetY: -20,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            track: {
                                background: "#e7e7e7",
                                strokeWidth: '97%',
                                margin: 5, // margin is in pixels
                            },
                            dataLabels: {
                                name: {
                                    show: true
                                },
                                value: {
                                    offsetY: -50,
                                    fontSize: '20px'
                                }
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -10
                        }
                    },
                    colors: ["#6FD943"],
                    labels: ['Used'],
                };
                var chart = new ApexCharts(document.querySelector("#device-chart"), options);
                chart.render();
            })();
        </script>
    <?php endif; ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>