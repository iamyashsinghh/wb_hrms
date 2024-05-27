<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="<?php echo e(route('send.message')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <label><span class="fas fa-paperclip"></span><input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".<?php echo e(implode(', .',config('chatify.attachments.allowed_images'))); ?>, .<?php echo e(implode(', .',config('chatify.attachments.allowed_files'))); ?>" /></label>
        <textarea readonly='readonly' name="message" class="m-send app-scroll" placeholder="Type a message.."></textarea>
        <button disabled='disabled'><span class="fas fa-paper-plane"></span></button>
    </form>
</div>
<?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/vendor/Chatify/layouts/sendForm.blade.php ENDPATH**/ ?>