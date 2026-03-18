

<?php $__env->startSection('title', 'Instructeurs Beheren - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Instructeurs Beheren</h1>
    </div>

    <?php if($instructors->count() > 0): ?>
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Naam</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Email</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Telefoon</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Status</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 1rem; color: #1f2937;"><?php echo e($instructor->personalInformation?->full_name ?? 'N/A'); ?></td>
                        <td style="padding: 1rem; color: #1f2937;"><?php echo e($instructor->email); ?></td>
                        <td style="padding: 1rem; color: #1f2937;"><?php echo e($instructor->personalInformation?->phone_mobile ?? 'N/A'); ?></td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: <?php echo e($instructor->is_active ? '#d1fae5' : '#fee2e2'); ?>; color: <?php echo e($instructor->is_active ? '#065f46' : '#7f1d1d'); ?>;"><?php echo e($instructor->is_active ? 'Actief' : 'Geblokkeerd'); ?></span>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="<?php echo e(route('owner.manage-instructor', $instructor->id)); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem; margin-right: 1rem;">Bekijken</a>
                            <a href="<?php echo e(route('owner.instructor-schedule', $instructor->id)); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem; margin-right: 1rem;">Schema</a>
                            <form action="<?php echo e(route('owner.toggle-status', $instructor->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" style="color: #ff6b35; background: none; border: none; cursor: pointer; text-decoration: none; font-weight: 600; font-size: 0.9rem;"><?php echo e($instructor->is_active ? 'Blokkeren' : 'Activeren'); ?></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Geen instructeurs gevonden</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/owner/instructors.blade.php ENDPATH**/ ?>