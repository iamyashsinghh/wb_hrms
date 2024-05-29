<?php $__env->startPush('css-page'); ?>
    <?php echo $__env->make('Chatify::layouts.headLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        .cards {
            /* background-color: #fff;
                    padding: 25px 25px; */
        }

        .card-body {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }


        .dropdown-menu {
            padding: 15px 0;
            box-shadow: 0 4px 24px 0 rgb(62 57 107 / 18%);
            border: none;
        }

        .dropdown-menu {
            z-index: 1000;
            min-width: 12rem;
            margin: 0;
            font-size: 0.875rem;
            color: #293240;
            text-align: left;
            background-clip: padding-box;
            border-radius: 10px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php
    // $profile=\App\Models\Utility::get_file('/'.config('chatify.user_avatar.folder'));
    $profile = \App\Models\Utility::get_file('uploads/avatar/');
    $setting = App\Models\Utility::colorset();
    $color = !empty($setting['theme_color']) ? $setting['theme_color'] : 'theme-3';
    $setting = \App\Models\Utility::colorset();

?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Messenger')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Messenger')); ?></li>
<?php $__env->stopSection(); ?>

<?php if($setting['cust_darklayout'] == 'on'): ?>
    <style>
        .cards {
            background-color: #272727;
            padding: 25px 25px;
        }
    </style>
<?php else: ?>
    <style>
        .cards {
            background-color: #fff;
            padding: 25px 25px;
        }
    </style>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <div class="cards rounded-12 mt-4 p-0">
        <div class="card-body">
            <div class="messenger rounded min-h-750 overflow-hidden">
                
                <div class="messenger-listView">
                    
                    <div class="m-header">
                        <nav>
                            <nav class="m-header-right">
                                <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                            </nav>
                        </nav>
                        
                        <input type="text" class="messenger-search" placeholder="<?php echo e(__('Search')); ?>" />
                        
                        <?php if(\Auth::user()->type == 'super admin'): ?>
                        <?php endif; ?>
                        <div class="messenger-listView-tabs">
                            <a href="#" <?php if($route == 'user'): ?> class="active-tab" <?php endif; ?> data-view="users">
                                <span class="fas fa-clock" title="<?php echo e(__('Recent')); ?>"></span>
                            </a>
                            <a href="#" <?php if($route == 'group'): ?> class="active-tab" <?php endif; ?>
                                data-view="groups">
                                <span class="fas fa-users" title="<?php echo e(__('Members')); ?>"></span></a>
                        </div>
                    </div>
                    
                    <div class="m-body">
                        
                        
                        <div class="<?php if($route == 'user'): ?> show <?php endif; ?> messenger-tab app-scroll"
                            data-view="users">

                            
                            <p class="messenger-title">Favorites</p>
                            <div class="messenger-favorites app-scroll-thin"></div>

                            
                            <?php echo view('Chatify::layouts.listItem', ['get' => 'saved', 'id' => $id])->render(); ?>


                            
                            <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;">
                            </div>
                        </div>

                        
                        <div class="all_members <?php if($route == 'group'): ?> show <?php endif; ?> messenger-tab app-scroll"
                            data-view="groups">
                            <p style="text-align: center;color:grey;"><?php echo e(__('Soon will be available')); ?></p>
                        </div>

                        
                        <div class="messenger-tab app-scroll" data-view="search">
                            
                            <p class="messenger-title"><?php echo e(__('Search')); ?></p>
                            <div class="search-records">
                                <p class="message-hint center-el"><span><?php echo e(__('Type to search..')); ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="messenger-messagingView">
                    
                    <div class="m-header m-header-messaging">
                        <nav class="d-flex a;align-items-center justify-content-between">
                            
                            <div style="display: flex;">
                                <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i> </a>
                                <?php if(!empty($user->avatar)): ?>
                                    <div class="avatar av-s header-avatar"
                                        style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('<?php echo e(asset('/storage/avatars/' . $user->avatar)); ?>');">
                                    </div>
                                <?php else: ?>
                                    <div class="avatar av-s header-avatar"
                                        style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('<?php echo e(asset('/storage/avatars/avatar.png')); ?>');">
                                    </div>
                                <?php endif; ?>
                                <a href="#" class="user-name"><?php echo e(config('chatify.name')); ?></a>
                            </div>
                            
                            <nav class="m-header-right">
                                <a href="#" class="add-to-favorite my-lg-1 my-xl-1 mx-lg-1 mx-xl-1"><i
                                        class="fas fa-star"></i></a>
                                <a href="#" class="show-infoSide my-lg-1 my-xl-1 mx-lg-1 mx-xl-2"><i
                                        class="fas fa-info-circle"></i></a>
                            </nav>
                        </nav>
                    </div>
                    
                    <div class="internet-connection">
                        <span class="ic-connected"><?php echo e(__('Connected')); ?></span>
                        <span class="ic-connecting"><?php echo e(__('Connecting...')); ?></span>
                        <span class="ic-noInternet"><?php echo e(__('Please add pusher settings for using messenger.')); ?></span>
                    </div>
                    
                    <div class="m-body app-scroll">
                        <div class="messages">
                            <p class="message-hint" style="margin-top: calc(30% - 126.2px);">
                                <span><?php echo e(__('Please select a chat to start messaging')); ?></span>
                            </p>
                        </div>
                        
                        <div class="typing-indicator">
                            <div class="message-card typing">
                                <p>
                                    <span class="typing-dots">
                                        <span class="dot dot-1"></span>
                                        <span class="dot dot-2"></span>
                                        <span class="dot dot-3"></span>
                                    </span>
                                </p>
                            </div>
                        </div>
                        
                        <?php echo $__env->make('Chatify::layouts.sendForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                
                <div class="messenger-infoView app-scroll text-center">
                    
                    <nav class="text-center">
                        <a href="#"><i class="fas fa-times"></i></a>
                    </nav>
                    <?php echo view('Chatify::layouts.info')->render(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('Chatify::layouts.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php if($setting['SITE_RTL'] == 'on'): ?>
    <style type="text/css">
        body {

            text-align: right !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-1'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, #0CAF60 3.46%, #0CAF60 99.86%), #0CAF60 !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, #0CAF60 3.46%, #0CAF60 99.86%), #0CAF60 !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #0CAF60 !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, #0CAF60 3.46%, #0CAF60 99.86%), #0CAF60 !important;
        }

        .m-header svg {
            color: #0CAF60 !important;
        }

        .active-tab {
            border-bottom: 2px solid #0CAF60 !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, #0CAF60 3.46%, #0CAF60 99.86%), #0CAF60 !important;
        }

        .lastMessageIndicator {
            color: #0CAF60 !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #0CAF60 !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #0CAF60 !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-2'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, #9a0004 3.46%, #9a0004 99.86%), #9a0004 !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, #9a0004 3.46%, #9a0004 99.86%), #9a0004 !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #9a0004 !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, #9a0004 3.46%, #9a0004 99.86%), #9a0004 !important;
        }

        .m-header svg {
            color: #9a0004 !important;
        }

        .active-tab {
            border-bottom: 2px solid #9a0004 !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, #9a0004 3.46%, #9a0004 99.86%), #9a0004 !important;
        }

        .lastMessageIndicator {
            color: #9a0004 !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #9a0004 !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #9a0004 !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-3'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, #870808 3.46%, #870808 99.86%), #870808 !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, #870808 3.46%, #870808 99.86%), #870808 !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #870808 !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, #870808 3.46%, #870808 99.86%), #870808 !important;
        }

        .m-header svg {
            color: #870808 !important;
        }

        .active-tab {
            border-bottom: 2px solid #870808 !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, #870808 3.46%, #870808 99.86%), #870808 !important;
        }

        .lastMessageIndicator {
            color: #870808 !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #870808 !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #870808 !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-4'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, #145388 3.46%, #145388 99.86%), #145388 !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, #145388 3.46%, #145388 99.86%), #145388 !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #145388 !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, #145388 3.46%, #145388 99.86%), #145388 !important;
        }

        .m-header svg {
            color: #145388 !important;
        }

        .active-tab {
            border-bottom: 2px solid #145388 !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, #145388 3.46%, #145388 99.86%), #145388 !important;
        }

        .lastMessageIndicator {
            color: #145388 !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #145388 !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #145388 !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-5'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #B9406B 99.86%), #B9406B !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #B9406B 99.86%), #B9406B !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #B9406B !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #B9406B 99.86%), #B9406B !important;
        }

        .m-header svg {
            color: #B9406B !important;
        }

        .active-tab {
            border-bottom: 2px solid #B9406B !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #B9406B 99.86%), #B9406B !important;
        }

        .lastMessageIndicator {
            color: #B9406B !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #B9406B !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #B9406B !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-6'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #008ECC 99.86%), #008ECC !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #008ECC 99.86%), #008ECC !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #008ECC !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #008ECC 99.86%), #008ECC !important;
        }

        .m-header svg {
            color: #008ECC !important;
        }

        .active-tab {
            border-bottom: 2px solid #008ECC !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #008ECC 99.86%), #008ECC !important;
        }

        .lastMessageIndicator {
            color: #008ECC !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #008ECC !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #008ECC !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-7'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #922C88 99.86%), #922C88 !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #922C88 99.86%), #922C88 !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #922C88 !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #922C88 99.86%), #922C88 !important;
        }

        .m-header svg {
            color: #922C88 !important;
        }

        .active-tab {
            border-bottom: 2px solid #922C88 !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #922C88 99.86%), #922C88 !important;
        }

        .lastMessageIndicator {
            color: #922C88 !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #922C88 !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #922C88 !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-8'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #C0A145 99.86%), #C0A145 !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #C0A145 99.86%), #C0A145 !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #C0A145 !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #C0A145 99.86%), #C0A145 !important;
        }

        .m-header svg {
            color: #C0A145 !important;
        }

        .active-tab {
            border-bottom: 2px solid #C0A145 !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #C0A145 99.86%), #C0A145 !important;
        }

        .lastMessageIndicator {
            color: #C0A145 !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #C0A145 !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #C0A145 !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-9'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #48494B 99.86%), #48494B !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #48494B 99.86%), #48494B !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #48494B !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #48494B 99.86%), #48494B !important;
        }

        .m-header svg {
            color: #48494B !important;
        }

        .active-tab {
            border-bottom: 2px solid #48494B !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #48494B 99.86%), #48494B !important;
        }

        .lastMessageIndicator {
            color: #48494B !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #48494B !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #48494B !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-10'): ?>
    <style type="text/css">
        .m-list-active,
        .m-list-active:hover,
        .m-list-active:focus {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #0C7785 99.86%), #0C7785 !important;
        }

        .mc-sender p {
            background: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #0C7785 99.86%), #0C7785 !important;
        }

        .messenger-favorites div.avatar {
            box-shadow: 0px 0px 0px 2px #0C7785 !important;
        }

        .messenger-listView-tabs a,
        .messenger-listView-tabs a:hover,
        .messenger-listView-tabs a:focus {
            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #0C7785 99.86%), #0C7785 !important;
        }

        .m-header svg {
            color: #0C7785 !important;
        }

        .active-tab {
            border-bottom: 2px solid #0C7785 !important;
        }

        .messenger-infoView nav a {

            color: linear-gradient(141.55deg, rgba(104, 94, 229, 0) 3.46%, #0C7785 99.86%), #0C7785 !important;
        }

        .lastMessageIndicator {
            color: #0C7785 !important;
        }

        .messenger-list-item td span .lastMessageIndicator {

            color: #0C7785 !important;
            font-weight: bold;
        }

        .messenger-sendCard button svg {
            color: #0C7785 !important;
        }

        .messenger-list-item.m-list-active td span .lastMessageIndicator {
            color: #fff !important;
        }
    </style>
<?php endif; ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/vendor/Chatify/pages/app.blade.php ENDPATH**/ ?>