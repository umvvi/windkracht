

<?php $__env->startSection('title', 'Eigenaar Dashboard - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Eigenaar Dashboard</h1>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #0369a1;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="color: #6b7280; font-size: 0.85rem; font-weight: 700; margin: 0 0 0.8rem 0; text-transform: uppercase; letter-spacing: 0.05em;">Totaal Reserveringen</h3>
            <p style="font-size: 2.5rem; font-weight: 800; color: #0369a1; margin: 0;"><?php echo e($totalReservations); ?></p>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #ff6b35;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="color: #6b7280; font-size: 0.85rem; font-weight: 700; margin: 0 0 0.8rem 0; text-transform: uppercase; letter-spacing: 0.05em;">Onbetaalde Reserveringen</h3>
            <p style="font-size: 2.5rem; font-weight: 800; color: #ff6b35; margin: 0;"><?php echo e($unpaidReservations->count()); ?></p>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #0ea5e9;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="color: #6b7280; font-size: 0.85rem; font-weight: 700; margin: 0 0 0.8rem 0; text-transform: uppercase; letter-spacing: 0.05em;">Totale Inkomsten</h3>
            <p style="font-size: 2.5rem; font-weight: 800; color: #0369a1; margin: 0;">€<?php echo e($totalRevenue); ?></p>
        </div>
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
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Klanten Beheren</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Bekijk en beheer alle klanten</p>
            <a href="<?php echo e(route('owner.customers')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Klanten Bekijken →</a>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #ff6b35;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Instructeurs Beheren</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Beheer het instructeur team</p>
            <a href="<?php echo e(route('owner.instructors')); ?>" style="color: #ff6b35; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Instructeurs Bekijken →</a>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #0ea5e9;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Mijn Profiel</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Bekijk en bewerk je gegevens</p>
            <a href="<?php echo e(route('owner.personal-info')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Bewerk Profiel →</a>
        </div>
    </div>

    <!-- Unpaid Reservations Table -->
    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
        <h2 style="font-size: 1.6rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Onbetaalde Reserveringen</h2>
        
        <?php if($unpaidReservations->count() > 0): ?>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Klant</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Pakket</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Bedrag</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Actie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $unpaidReservations->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($reservation->customer->email); ?></td>
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($reservation->package->name); ?></td>
                            <td style="padding: 1rem; color: #1f2937; font-weight: 600;">€<?php echo e($reservation->total_price); ?></td>
                            <td style="padding: 1rem;">
                                <form action="<?php echo e(route('owner.confirm-payment', $reservation->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" style="background: #d1fae5; color: #065f46; border: none; padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; cursor: pointer;">Betaling Bevestigen</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div style="background: #f9fafb; padding: 2rem; text-align: center; border-radius: 0.3rem;">
                <p style="color: #666;">Geen onbetaalde reserveringen</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/owner/dashboard.blade.php ENDPATH**/ ?>