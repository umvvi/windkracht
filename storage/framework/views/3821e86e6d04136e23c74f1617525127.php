

<?php $__env->startSection('title', $instructor->personalInformation?->full_name . ' Schema - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 1rem 0;"><?php echo e($instructor->personalInformation?->full_name ?? $instructor->email); ?> - Schema</h1>
        
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="<?php echo e(route('owner.instructor-schedule', ['id' => $instructor->id, 'view' => 'day'])); ?>" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: <?php echo e(request('view', 'week') === 'day' ? '#0369a1' : '#e5e7eb'); ?>; color: <?php echo e(request('view', 'week') === 'day' ? 'white' : '#3f4146'); ?>; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Dag</a>
            <a href="<?php echo e(route('owner.instructor-schedule', ['id' => $instructor->id, 'view' => 'week'])); ?>" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: <?php echo e(request('view', 'week') === 'week' ? '#0369a1' : '#e5e7eb'); ?>; color: <?php echo e(request('view', 'week') === 'week' ? 'white' : '#3f4146'); ?>; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Week</a>
            <a href="<?php echo e(route('owner.instructor-schedule', ['id' => $instructor->id, 'view' => 'month'])); ?>" style="padding: 0.5rem 1rem; border-radius: 0.3rem; background: <?php echo e(request('view', 'week') === 'month' ? '#0369a1' : '#e5e7eb'); ?>; color: <?php echo e(request('view', 'week') === 'month' ? 'white' : '#3f4146'); ?>; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">Maand</a>
        </div>
    </div>

    <?php if($lessons->count() > 0): ?>
        <div style="display: grid; gap: 1rem;">
            <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #0369a1;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;"><?php echo e($lesson->start_time->format('d-m-Y H:i')); ?> - <?php echo e($lesson->end_time->format('H:i')); ?></p>
                        <p style="color: #666; margin: 0.25rem 0;">Locatie: <?php echo e($lesson->location->name); ?></p>
                        <p style="color: #666; margin: 0.25rem 0;">Klant: <?php echo e($lesson->reservation->customer->personalInformation?->full_name ?? 'Unknown'); ?></p>
                        <p style="color: #666; margin: 0;">Pakket: <?php echo e($lesson->reservation->package->name); ?></p>
                    </div>
                    <div>
                        <span style="padding: 0.4rem 0.8rem; background: #f3f4f6; color: #4b5563; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600;"><?php echo e($lesson->status === 'scheduled' ? 'Ingepland' : ($lesson->status === 'cancelled' ? 'Afgebroken' : ucfirst($lesson->status))); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Geen lessen ingepland voor deze periode</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/owner/instructor-schedule.blade.php ENDPATH**/ ?>