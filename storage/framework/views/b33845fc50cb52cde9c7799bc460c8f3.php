

<?php $__env->startSection('title', 'Instructeur Dashboard - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Instructeur Dashboard</h1>
    </div>

    <!-- Quick Action Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #0369a1;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Mijn Profiel</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Bekijk en bewerk je persoonlijke gegevens</p>
            <a href="<?php echo e(route('instructor.personal-info')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Bewerk Profiel →</a>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #ff6b35;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Mijn Schema</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Bekijk je lessen en schema</p>
            <a href="<?php echo e(route('instructor.schedule')); ?>" style="color: #ff6b35; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Schema Bekijken →</a>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #0ea5e9;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Mijn Klanten</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Beheer klantinformatie</p>
            <a href="<?php echo e(route('instructor.customers')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Klanten Bekijken →</a>
        </div>
    </div>

    <!-- Upcoming Lessons -->
    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
        <h2 style="font-size: 1.6rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Aankomende Lessen</h2>
        
        <?php if($upcomingLessons->count() > 0): ?>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Datum & Tijd</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Locatie</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Klant</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $upcomingLessons->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($lesson->start_time->format('d-m-Y H:i')); ?></td>
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($lesson->location->name); ?></td>
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($lesson->reservation->customer->email); ?></td>
                            <td style="padding: 1rem;"><span style="padding: 0.4rem 0.8rem; background: #d1fae5; color: #065f46; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600;"><?php echo e($lesson->status === 'scheduled' ? 'Ingepland' : ($lesson->status === 'cancelled' ? 'Afgebroken' : ucfirst($lesson->status))); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div style="background: #f9fafb; padding: 2rem; text-align: center; border-radius: 0.3rem;">
                <p style="color: #666;">Geen aankomende lessen</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/instructor/dashboard.blade.php ENDPATH**/ ?>