

<?php $__env->startSection('title', 'Klant Dashboard - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Mijn Dashboard</h1>
    </div>

    <!-- Quick Action Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #0369a1;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Mijn Profiel</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Bekijk en bewerk je persoonlijke informatie</p>
            <a href="<?php echo e(route('customer.personal-info')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Bewerk Profiel →</a>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #ff6b35;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Nieuwe Reservering</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Boek je kitesurfles nu</p>
            <a href="<?php echo e(route('customer.make-reservation')); ?>" style="color: #ff6b35; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Reserveer →</a>
        </div>

        <div style="
            background: white;
            padding: 2rem;
            border-radius: 0.3rem;
            border-left: 4px solid #0ea5e9;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Mijn Reserveringen</h3>
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.95rem;">Bekijk al je boekingen</p>
            <a href="<?php echo e(route('customer.reservations')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Alle Reserveringen →</a>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
        <h2 style="font-size: 1.6rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Recente Reserveringen</h2>
        
        <?php if($reservations->count() > 0): ?>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Pakket</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Locatie</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">STATÚS</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Betaling</th>
                            <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Actie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $reservations->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($reservation->package->name); ?></td>
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($reservation->location->name); ?></td>
                            <td style="padding: 1rem;">
                                <span style="
                                    display: inline-block;
                                    padding: 0.4rem 0.8rem;
                                    border-radius: 0.3rem;
                                    font-size: 0.85rem;
                                    font-weight: 600;
                                    background: <?php echo e(!$reservation->payment_received ? '#fef3c7' : '#d1fae5'); ?>;
                                    color: <?php echo e(!$reservation->payment_received ? '#92400e' : '#065f46'); ?>;
                                ">
                                    <?php echo e(!$reservation->payment_received ? 'Wachtend op Betaling' : 'Bevestigd'); ?>

                                </span>
                            </td>
                            <td style="padding: 1rem; color: #1f2937;"><?php echo e($reservation->payment_received ? 'Betaald' : 'Openstaand'); ?></td>
                            <td style="padding: 1rem;">
                                <a href="<?php echo e(route('customer.reservations')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Bekijk</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div style="background: #f9fafb; padding: 2rem; text-align: center; border-radius: 0.3rem;">
                <p style="color: #666; margin-bottom: 1rem;">Je hebt nog geen reserveringen.</p>
                <a href="<?php echo e(route('customer.make-reservation')); ?>" style="color: #ff6b35; text-decoration: none; font-weight: 600;">Maak nu je eerste reservering</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>