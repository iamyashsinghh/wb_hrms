<?php
$profile=\App\Models\Utility::get_file('/'.config('chatify.user_avatar.folder'));   
?>

<?php if(!empty($user->avatar)): ?>

<div class="avatar av-l "style="background-image: url('<?php echo e($profile.'/'. $user->avatar); ?>');" ></div>
<?php else: ?>
<div class="avatar av-l" style="background-image: url('<?php echo e($profile.'/avatar.png'); ?>');">
</div>
<?php endif; ?>
<p class="info-name"><?php echo e(config('chatify.name')); ?></p>
<div class="messenger-infoView-btns">
    
    <a href="#" class="danger delete-conversation"><i class="fas fa-trash-alt"></i> Delete Conversation</a>
</div>

<div class="messenger-infoView-shared">
    <p class="messenger-title">shared photos</p>
    <div class="shared-photos-list"></div>
</div>
<?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/vendor/Chatify/layouts/info.blade.php ENDPATH**/ ?>