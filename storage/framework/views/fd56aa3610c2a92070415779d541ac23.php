

<?php $__env->startSection('title', 'Mijn Klanten - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Mijn Klanten</h1>
    </div>

    <?php if(count($customers) > 0): ?>
        <div style="display: grid; gap: 1.5rem;">
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #0369a1; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;"><?php echo e($customer->personalInformation?->full_name ?? $customer->email); ?></p>
                    <p style="color: #666; margin: 0.25rem 0;">Email: <?php echo e($customer->email); ?></p>
                    <p style="color: #666; margin: 0;">Telefoon: <?php echo e($customer->personalInformation?->phone_mobile ?? 'N/A'); ?></p>
                </div>
                <a href="<?php echo e(route('instructor.manage-customer', $customer->id)); ?>" style="background: #0369a1; color: white; padding: 0.75rem 1.5rem; border-radius: 0.3rem; text-decoration: none; font-weight: 700;" onmouseover="this.style.background='#003d7a'" onmouseout="this.style.background='#0369a1'">
                    Details Bekijken
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Nog geen klanten</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/instructor/customers.blade.php ENDPATH**/ ?>