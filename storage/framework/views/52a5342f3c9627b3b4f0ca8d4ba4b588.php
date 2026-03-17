

<?php $__env->startSection('title', 'Lespakketten - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 0.5rem 0;">LESPAKKETTEN</h1>
        <div style="height: 2px; width: 50px; background: #ff6b35;"></div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="
            background: white;
            border-radius: 0.3rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: all 0.3s;
        " onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
            <div style="padding: 2rem;">
                <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1rem 0;"><?php echo e($package->name); ?></h2>
                <p style="color: #666; margin-bottom: 1.5rem; font-size: 0.95rem; line-height: 1.5;"><?php echo e($package->description); ?></p>
                
                <div style="background: #f9fafb; padding: 1rem; border-radius: 0.3rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
                    <div style="margin-bottom: 0.5rem;"><span style="color: #6b7280;">Duur:</span> <strong style="color: #003d7a;"><?php echo e($package->formatted_duration); ?> per les</strong></div>
                    <div style="margin-bottom: 0.5rem;"><span style="color: #6b7280;">Aantal:</span> <strong style="color: #003d7a;"><?php echo e($package->num_sessions); ?> lessen</strong></div>
                    <div><span style="color: #6b7280;">Type:</span> <strong style="color: #003d7a;"><?php echo e(ucfirst($package->type)); ?></strong></div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <p style="font-size: 1.8rem; font-weight: 800; color: #ff6b35; margin: 0;">€<?php echo e($package->price_per_person); ?></p>
                    <p style="font-size: 0.85rem; color: #999; margin: 0.25rem 0 0 0;">Totaal: €<?php echo e($package->total_price); ?></p>
                </div>

                <p style="color: #666; font-size: 0.9rem; margin-bottom: 1.5rem;">Alle apparatuur inbegrepen (vlieger, board, neopreen)</p>

                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('customer.make-reservation')); ?>" style="
                        display: block;
                        background: #ff6b35;
                        color: white;
                        padding: 0.85rem;
                        border-radius: 0.3rem;
                        text-align: center;
                        text-decoration: none;
                        font-weight: 600;
                        transition: all 0.3s;
                    " onmouseover="this.style.background='#ff5520'" onmouseout="this.style.background='#ff6b35'">Nu Boeken</a>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" style="
                        display: block;
                        background: #ff6b35;
                        color: white;
                        padding: 0.85rem;
                        border-radius: 0.3rem;
                        text-align: center;
                        text-decoration: none;
                        font-weight: 600;
                        transition: all 0.3s;
                    " onmouseover="this.style.background='#ff5520'" onmouseout="this.style.background='#ff6b35'">Registreren om te Boeken</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/packages.blade.php ENDPATH**/ ?>