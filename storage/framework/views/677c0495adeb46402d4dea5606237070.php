<?php
  $setting = \App\Models\Utility::colorset();
?>

<title><?php echo e(config('chatify.name')); ?></title>


<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="id" content="<?php echo e($id); ?>">
<meta name="type" content="<?php echo e($route); ?>">
<meta name="messenger-color" content="<?php echo e($messengerColor); ?>">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="url" content="<?php echo e(url('') . '/' . config('chatify.routes.prefix')); ?>" data-user="<?php echo e(Auth::user()->id); ?>">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo e(asset('js/chatify/font.awesome.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/chatify/autosize.js')); ?>"></script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>


<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
<link href="<?php echo e(asset('css/chatify/style.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/chatify/' . $dark_mode . '.mode.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />

<?php if($setting['cust_darklayout'] == 'on'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/chatify/dark.mode.css')); ?>">
<?php else: ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/chatify/light.mode.css')); ?>" id="main-style-link">
<?php endif; ?>


<?php echo $__env->make('Chatify::layouts.messengerColor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/vendor/Chatify/layouts/headLinks.blade.php ENDPATH**/ ?>