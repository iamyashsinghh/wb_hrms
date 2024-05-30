<?php

    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::GetLogo();
    $users = \Auth::user();
    $profile = \App\Models\Utility::get_file('uploads/avatar/');
    $currantLang = $users->currentLanguage();
    $emailTemplate = App\Models\EmailTemplate::getemailTemplate();
    $lang = Auth::user()->lang;
?>

<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
    <?php else: ?>
        <nav class="dash-sidebar light-sidebar">
<?php endif; ?>



<div class="navbar-wrapper">
    <div class="m-header main-logo">
        <a href="<?php echo e(route('home')); ?>" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo . '?' . time() : 'logo-dark.png' . '?' . time())); ?>"
                alt="<?php echo e(config('app.name', 'HRMGo')); ?>" class="logo logo-lg" style="height: 40px;">
        </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">

            <!-- dashboard-->
            <?php if(\Auth::user()->type != 'company'): ?>
                <li class="dash-item">
                    <a href="<?php echo e(route('home')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                </li>
            <?php endif; ?>
            <?php if(\Auth::user()->type == 'company'): ?>
                <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'null' ? 'active dash-trigger' : ''); ?>">
                    <a href="#" class="dash-link"><span class="dash-micon"><i class="ti ti-home"></i></span><span
                            class="dash-mtext"><?php echo e(__('Dashboard')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu ">
                        <li
                            class="dash-item <?php echo e(Request::segment(1) == null || Request::segment(1) == 'report' ? ' active dash-trigger' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('home')); ?>"><?php echo e(__('Overview')); ?></a>
                        </li>

                        <?php if(Gate::check('Manage Report')): ?>
                            <li class="dash-item dash-hasmenu">
                                <a href="#!" class="dash-link"><span class=""><i
                                            class=""></i></span><span
                                        class="dash-mtext"><?php echo e(__('Report')); ?></span><span class="dash-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Report')): ?>
                                        <li class="dash-item">
                                            <a class="dash-link"
                                                href="<?php echo e(route('report.monthly.attendance')); ?>"><?php echo e(__('Monthly Attendance')); ?></a>
                                        </li>
                                        <li class="dash-item">
                                            <a class="dash-link"
                                                href="<?php echo e(route('report.leave')); ?>"><?php echo e(__('Leave')); ?></a>
                                        </li>
                                        <li class="dash-item">
                                            <a class="dash-link"
                                                href="<?php echo e(route('report.payroll')); ?>"><?php echo e(__('Payroll')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>


                    </ul>
                </li>
            <?php endif; ?>
            <!--dashboard-->

            <!-- user-->
            <?php if(\Auth::user()->type == 'super admin'): ?>
                <li class="dash-item">
                    <a href="<?php echo e(route('user.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-user"></i></span><span class="dash-mtext"><?php echo e(__('Companies')); ?></span></a>
                </li>
            <?php else: ?>
                <?php if(Gate::check('Manage User') ||
                        Gate::check('Manage Role') ||
                        Gate::check('Manage Employee Profile') ||
                        Gate::check('Manage Employee Last Login')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'user' || Request::segment(1) == 'roles' || Request::segment(1) == 'lastlogin'
                            ? ' active dash-trigger'
                            : ''); ?> ">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-users"></i></span><span
                                class="dash-mtext"><?php echo e(__('Staff')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul
                            class="dash-submenu <?php echo e(Request::route()->getName() == 'user.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'user.edit' || Request::route()->getName() == 'lastlogin' ? ' active' : ''); ?> ">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                                <li class="dash-item <?php echo e(Request::segment(1) == 'lastlogin' ? 'active' : ''); ?> ">
                                    <a class="dash-link" href="<?php echo e(route('user.index')); ?>"><?php echo e(__('User')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Role')): ?>
                                <li class="dash-item">
                                    <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Employee Profile')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('employee.profile')); ?>"><?php echo e(__('Employee Profile')); ?></a>
                                </li>
                            <?php endif; ?>
                            

                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <!-- user-->

            <!-- employee-->
            <?php if(Gate::check('Manage Employee')): ?>
                <?php if(\Auth::user()->type == 'employee'): ?>
                    <?php
                        $employee = App\Models\Employee::where('user_id', \Auth::user()->id)->first();
                    ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'employee' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"
                            class="dash-link"><span class="dash-micon"><i class="ti ti-user"></i></span><span
                                class="dash-mtext"><?php echo e(__('Employee')); ?></span></a>
                    </li>
                <?php else: ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'employee' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('employee.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-user"></i></span><span
                                class="dash-mtext"><?php echo e(__('Employee')); ?></span></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <!-- employee-->

            <!-- payroll-->
            <?php if(Gate::check('Manage Set Salary') || Gate::check('Manage Pay Slip')): ?>
                <li
                    class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'setsalary' ? 'dash-trigger active' : ''); ?>">
                    <a href="#!" class="dash-link">
                        <span class="dash-micon">
                            <i class="ti ti-receipt">
                            </i>
                        </span>
                        <span class="dash-mtext">
                            <?php echo e(__('Payroll')); ?>

                        </span>
                        <span class="dash-arrow"><i data-feather="chevron-right">
                            </i>
                        </span>
                    </a>
                    <ul class="dash-submenu ">
                        <li class="dash-item <?php echo e(Request::segment(1) == 'setsalary' ? 'active' : '-'); ?>">
                            <a class="dash-link" href="<?php echo e(route('setsalary.index')); ?>"><?php echo e(__('Set Salary')); ?></a>
                        </li>
                        <li class="dash-item">
                            <a class="dash-link" href="<?php echo e(route('payslip.index')); ?>"><?php echo e(__('Payslip')); ?></a>
                        </li>

                    </ul>
                </li>
            <?php endif; ?>
            <!-- payroll-->

            <?php if(\Auth::user()->type == 'employee'): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'setsalary' ? 'dash-trigger active' : ''); ?>">
                    <a href="#!" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-receipt"></i></span><span
                            class="dash-mtext"><?php echo e(__('Payroll')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <li class="dash-item <?php echo e(Request::segment(1) == 'setsalary' ? 'active' : '-'); ?>">
                            <a class="dash-link"
                                href="<?php echo e(route('setsalary.show', \Illuminate\Support\Facades\Crypt::encrypt(\Auth::user()->id))); ?>"><?php echo e(__('Salary')); ?></a>
                        </li>
                        <li class="dash-item">
                            <a class="dash-link" href="<?php echo e(route('payslip.index')); ?>"><?php echo e(__('Payslip')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <!-- timesheet-->
            <?php if(Gate::check('Manage Attendance') || Gate::check('Manage Leave') || Gate::check('Manage TimeSheet')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'calender' && Request::segment(2) == 'leave' ? 'dash-trigger active' : ''); ?>">
                    <a href="#!" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-clock"></i></span><span
                            class="dash-mtext"><?php echo e(__('Timesheet')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Leave')): ?>

                            <li class="dash-item <?php echo e(Request::segment(1) == 'calender' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('leave.index')); ?>"><?php echo e(__('Manage Leave')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Attendance')): ?>
                            <li class="dash-item dash-hasmenu">
                                <a href="#!" class="dash-link"><span
                                        class="dash-mtext"><?php echo e(__('Attendance')); ?></span><span class="dash-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu">
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="<?php echo e(route('attendanceemployee.index')); ?>"><?php echo e(__('Marked Attendance')); ?></a>
                                    </li>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Attendance')): ?>
                                        <li class="dash-item">
                                            <a class="dash-link"
                                                href="<?php echo e(route('attendanceemployee.bulkattendance')); ?>"><?php echo e(__('Bulk Attendance')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="<?php echo e(route('report.monthly.attendance')); ?>"><?php echo e(__('Monthly Attendance')); ?></a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!--timesheet-->

            <!--trainning-->
            <?php if(Gate::check('Manage Trainer') || Gate::check('Manage Training')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'training' ? 'dash-trigger active' : ''); ?>">
                    <a href="#!" class="dash-link "><span class="dash-micon"><i
                                class="ti ti-school"></i></span><span
                            class="dash-mtext"><?php echo e(__('Training')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Training')): ?>
                            <li class="dash-item <?php echo e(Request::segment(1) == 'training' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('training.index')); ?>"><?php echo e(__('Training List')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Trainer')): ?>
                            <li class="dash-item ">
                                <a class="dash-link" href="<?php echo e(route('trainer.index')); ?>"><?php echo e(__('Trainer')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- tranning-->


            <!-- HR-->
            <?php if(Gate::check('Manage Awards') ||
                    Gate::check('Manage Transfer') ||
                    Gate::check('Manage Resignation') ||
                    Gate::check('Manage Travels') ||
                    Gate::check('Manage Promotion') ||
                    Gate::check('Manage Complaint') ||
                    Gate::check('Manage Warning') ||
                    Gate::check('Manage Termination') ||
                    Gate::check('Manage Announcement') ||
                    Gate::check('Manage Holiday')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'holiday' ? 'dash-trigger active' : ''); ?>">
                    <a href="#!" class="dash-link">
                        <span class="dash-micon">
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="dash-mtext"><?php echo e(__('HR Admin Setup')); ?></span>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item">
                            <a class="dash-link"
                                href="<?php echo e(route('resignation.index')); ?>"><?php echo e(__('Resignation')); ?></a>
                        </li>
                        <li class="dash-item">
                            <a class="dash-link" href="<?php echo e(route('promotion.index')); ?>"><?php echo e(__('Promotion')); ?></a>
                        </li>
                        <li class="dash-item">
                            <a class="dash-link" href="<?php echo e(route('complaint.index')); ?>"><?php echo e(__('Complaints')); ?></a>
                        </li>
                        <li class="dash-item">
                            <a class="dash-link" href="<?php echo e(route('warning.index')); ?>"><?php echo e(__('Warning')); ?></a>
                        </li>
                        <li class="dash-item">
                            <a class="dash-link"
                                href="<?php echo e(route('termination.index')); ?>"><?php echo e(__('Termination')); ?></a>
                        </li>
                        <li class="dash-item">
                            <a class="dash-link"
                                href="<?php echo e(route('announcement.index')); ?>"><?php echo e(__('Announcement')); ?></a>
                        </li>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'holiday' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('holiday.index')); ?>"><?php echo e(__('Holidays')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- HR-->

            <!-- recruitment-->
            <?php if(Gate::check('Manage Job') ||
                    Gate::check('Manage Job Application') ||
                    Gate::check('Manage Job OnBoard') ||
                    Gate::check('Manage Custom Question') ||
                    Gate::check('Manage Interview Schedule') ||
                    Gate::check('Manage Career')): ?>
                <li
                    class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'job' || Request::segment(1) == 'job-application' ? 'dash-trigger active' : ''); ?> ">
                    <a href="#!" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-license"></i></span><span
                            class="dash-mtext"><?php echo e(__('Recruitment')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job')): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'job.index' ? 'active' : 'dash-hasmenu'); ?>">
                                <a class="dash-link" href="<?php echo e(route('job.index')); ?>"><?php echo e(__('Jobs')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job')): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'job.create' ? 'active' : 'dash-hasmenu'); ?>">
                                <a class="dash-link" href="<?php echo e(route('job.create')); ?>"><?php echo e(__('Job Create ')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Application')): ?>
                            <li class="dash-item <?php echo e(request()->is('job-application*') ? 'active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('job-application.index')); ?>"><?php echo e(__('Job Application')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Application')): ?>

                            <li class="dash-item <?php echo e(request()->is('candidates-job-applications') ? 'active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('job.application.candidate')); ?>"><?php echo e(__('Job Candidate')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job OnBoard')): ?>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('job.on.board')); ?>"><?php echo e(__('Job On-Boarding')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Custom Question')): ?>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('custom-question.index')); ?>"><?php echo e(__('Custom Question')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Interview Schedule')): ?>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('interview-schedule.index')); ?>"><?php echo e(__('Interview Schedule')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Career')): ?>
                            <li class="dash-item">
                                <a class="dash-link" href="<?php echo e(route('career', [\Auth::user()->creatorId(), $lang])); ?>"
                                    target="_blank"><?php echo e(__('Career')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- recruitment-->

            <!--contract-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Contract')): ?>
                <li
                    class="dash-item <?php echo e(Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('contract.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-device-floppy"></i></span><span
                            class="dash-mtext"><?php echo e(__('Contracts')); ?></span></a>
                </li>
            <?php endif; ?>
            <!--end-->

            <!-- Event-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Event')): ?>
                <li class="dash-item">
                    <a href="<?php echo e(route('event.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-calendar-event"></i></span><span
                            class="dash-mtext"><?php echo e(__('Event')); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <!--meeting-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Meeting')): ?>
                <li
                    class="dash-item <?php echo e(Request::segment(1) == 'meeting' || Request::segment(2) == 'meeting' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('meeting.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-calendar-time"></i></span><span
                            class="dash-mtext"><?php echo e(__('Meeting')); ?></span></a>
                </li>
            <?php endif; ?>

            <!-- assets-->
            <?php if(Gate::check('Manage Assets')): ?>
                <li class="dash-item">
                    <a href="<?php echo e(route('account-assets.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-medical-cross"></i></span><span
                            class="dash-mtext"><?php echo e(__('Assets')); ?></span></a>
                </li>
            <?php endif; ?>

            <!-- document-->
            <?php if(Gate::check('Manage Document')): ?>
                <li class="dash-item">
                    <a href="<?php echo e(route('document-upload.index')); ?>" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-file"></i></span><span
                            class="dash-mtext"><?php echo e(__('Document')); ?></span></a>
                </li>
            <?php endif; ?>
            <!--company policy-->

            <?php if(Gate::check('Manage Company Policy')): ?>
                <li class="dash-item">
                    <a href="<?php echo e(route('company-policy.index')); ?>" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-pray"></i></span><span
                            class="dash-mtext"><?php echo e(__('Company Policy')); ?></span></a>
                </li>
            <?php endif; ?>

            <?php if(\Auth::user()->type == 'company'): ?>
                <li
                    class="dash-item <?php echo e(Request::route()->getName() == 'notification-templates.update' || Request::segment(1) == 'notification-templates' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('notification-templates.index')); ?>" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-bell"></i></span><span
                            class="dash-mtext"><?php echo e(__('Notification Template')); ?></span></a>
                </li>

                <li
                    class="dash-item <?php echo e(Request::route()->getName() == 'email_template.show' || Request::segment(1) == 'email_template_lang' || Request::route()->getName() == 'manageemail.lang' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('manage.email.language', [$emailTemplate->id, \Auth::user()->lang])); ?>"
                        class="dash-link"><span class="dash-micon"><i
                                class="ti ti-template"></i></span><span
                            class="dash-mtext"><?php echo e(__('Email Templates')); ?></span></a>
                </li>
            <?php endif; ?>
            <!--constant-->
            <?php if(Gate::check('Manage Department') ||
                    Gate::check('Manage Designation') ||
                    Gate::check('Manage Document Type') ||
                    Gate::check('Manage Branch') ||
                    Gate::check('Manage Award Type') ||
                    Gate::check('Manage Termination Types') ||
                    Gate::check('Manage Payslip Type') ||
                    Gate::check('Manage Allowance Option') ||
                    Gate::check('Manage Loan Options') ||
                    Gate::check('Manage Deduction Options') ||
                    Gate::check('Manage Expense Type') ||
                    Gate::check('Manage Income Type') ||
                    Gate::check('Manage Payment Type') ||
                    Gate::check('Manage Leave Type') ||
                    Gate::check('Manage Training Type') ||
                    Gate::check('Manage Job Category') ||
                    Gate::check('Manage Job Stage')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'branch.index' ||Request::route()->getName() == 'department.index' ||Request::route()->getName() == 'designation.index' ||Request::route()->getName() == 'leavetype.index' ||Request::route()->getName() == 'document.index' ||Request::route()->getName() == 'paysliptype.index' ||Request::route()->getName() == 'allowanceoption.index' ||Request::route()->getName() == 'loanoption.index' ||Request::route()->getName() == 'deductionoption.index' ||Request::route()->getName() == 'goaltype.index' ||Request::route()->getName() == 'trainingtype.index' ||Request::route()->getName() == 'awardtype.index' ||Request::route()->getName() == 'terminationtype.index' ||Request::route()->getName() == 'job-category.index' ||Request::route()->getName() == 'job-stage.index' ||Request::route()->getName() == 'performanceType.index' ||Request::route()->getName() == 'competencies.index' ||Request::route()->getName() == 'expensetype.index' ||Request::route()->getName() == 'incometype.index' ||Request::route()->getName() == 'paymenttype.index' ||Request::route()->getName() == 'contract_type.index'? ' active': ''); ?>">
                    <a href="<?php echo e(route('branch.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-table"></i></span><span
                            class="dash-mtext"><?php echo e(__('HRM System Setup')); ?></span></a>
                </li>
            <?php endif; ?>
            <!--constant-->


            <?php if(Gate::check('Manage System Settings')): ?>
                <li class="dash-item ">
                    <a href="<?php echo e(route('settings.index')); ?>" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-settings"></i></span><span
                            class="dash-mtext"><?php echo e(__('Settings')); ?></span></a>
                </li>
            <?php endif; ?>
            <!--------------------- Start System Setup ----------------------------------->

            <?php if(\Auth::user()->type != 'super admin'): ?>

                <?php if(Gate::check('Manage Plan') || Gate::check('Manage Order') || Gate::check('Manage Company Settings')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span><span
                                class="dash-mtext"><?php echo e(__('System Setup')); ?></span><span
                                class="dash-arrow">
                                <i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu">
                            <?php if(Gate::check('Manage Company Settings')): ?>
                                <li
                                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'company-setting' ? ' active' : ''); ?>">
                                    <a href="<?php echo e(route('settings.index')); ?>"
                                        class="dash-link"><?php echo e(__('System Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!--------------------- End System Setup ----------------------------------->
</ul>

</div>
</div>
</nav>
<?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/partial/Admin/menu.blade.php ENDPATH**/ ?>