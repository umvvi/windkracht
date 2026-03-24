<?php $__env->startComponent('mail::message'); ?>
# Annulering Goedgekeurd

Hallo <?php echo e($customerName); ?>,

Goed nieuws! Je aanvraag om de les van **<?php echo e($lessonDate); ?>** te annuleren is goedgekeurd.

Je kunt nu een nieuwe lesdatum kiezen. Log in op je account en ga naar je reserveringen om een nieuw moment te selecteren.

Dank je voor je vertrouwen in Windkracht-12!

<?php $__env->startComponent('mail::button', ['url' => route('customer.dashboard')]); ?>
Ga naar je Dashboard
<?php echo $__env->renderComponent(); ?>

Met vriendelijke groeten,  
**Windkracht-12 Kitesurfschool**
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/emails/cancellation-approved.blade.php ENDPATH**/ ?>