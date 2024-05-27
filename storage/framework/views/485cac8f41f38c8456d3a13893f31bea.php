<?php
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
?>
<?php if($settings['menubar_status'] == 'on'): ?>
    <?php if(is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page']))): ?>
        <?php $__currentLoopData = json_decode($settings['menubar_page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if((isset($value->login) && $value->login == "on") && (isset($value->template_name) && $value->template_name == 'page_content')): ?>
                <li class="nav-item">
                    <a class="nav-link"
                       href="<?php echo e(route('custom.page', $value->page_slug)); ?>"><?php echo e($value->menubar_page_name); ?></a>
                </li>
            <?php elseif( (isset($value->login) && $value->login == "on") && (isset($value->template_name) && $value->template_name == 'page_url')): ?>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="<?php echo e($value->page_url); ?>"><?php echo e($value->menubar_page_name); ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/Modules/LandingPage/Resources/views/layouts/buttons.blade.php ENDPATH**/ ?>