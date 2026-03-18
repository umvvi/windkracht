

<?php $__env->startSection('title', 'Mijn Reserveringen - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Mijn Reserveringen</h1>
    </div>

    <?php if($reservations->count() > 0): ?>
        <div style="display: grid; gap: 1.5rem;">
            <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; border-left: 4px solid #0369a1;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">PAKKET</p>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;"><?php echo e($reservation->package->name); ?></p>
                    </div>
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">LOCATIE</p>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;"><?php echo e($reservation->location->name); ?></p>
                    </div>
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">STATUS</p>
                        <p style="margin: 0;">
                            <?php if(!$reservation->payment_received): ?>
                                <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: #fef3c7; color: #92400e;">Wachtend op Betaling</span>
                            <?php else: ?>
                                <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: #d1fae5; color: #065f46;">Bevestigd</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">BETALING</p>
                        <p style="margin: 0;">
                            <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: <?php echo e($reservation->payment_received ? '#d1fae5' : '#fee2e2'); ?>; color: <?php echo e($reservation->payment_received ? '#065f46' : '#7f1d1d'); ?>;"><?php echo e($reservation->payment_received ? 'Betaald' : 'Openstaand'); ?></span>
                        </p>
                    </div>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem; margin-bottom: 1.5rem;">
                    <p style="color: #1f2937; margin: 0 0 1rem 0;"><strong>Totale Prijs:</strong> €<?php echo e($reservation->total_price); ?></p>

                    <?php if(!$reservation->payment_received): ?>
                    <div style="background: #fef3c7; border: 1px solid #fcd34d; color: #78350f; padding: 1rem; border-radius: 0.3rem; margin-bottom: 1rem;">
                        <p style="font-weight: 700; margin: 0 0 0.5rem 0;">Betaling Vereist</p>
                        <p style="margin: 0 0 0.5rem 0;">Maak een overschrijving van €<?php echo e($reservation->total_price); ?> naar onze bankrekening.</p>
                        <p style="margin: 0; font-size: 0.9rem;">De eigenaar zal uw betaling bevestigen zodra deze is ontvangen.</p>
                    </div>
                    <?php endif; ?>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                    <h3 style="font-weight: 700; margin: 0 0 1rem 0; color: #003d7a;">Geplande Lessen</h3>
                    <?php if($reservation->lessons->count() > 0): ?>
                        <div style="display: grid; gap: 0.75rem;">
                            <?php $__currentLoopData = $reservation->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="background: #f9fafb; padding: 1rem; border-radius: 0.3rem; display: flex; justify-content: space-between; align-items: center;">
                                <div style="flex: 1;">
                                    <p style="font-weight: 700; color: #003d7a; margin: 0 0 0.25rem 0;"><?php echo e($lesson->start_time->format('d-m-Y H:i')); ?></p>
                                    <p style="font-size: 0.9rem; color: #666; margin: 0;">Instructeur: <?php echo e($lesson->instructor->personalInformation?->full_name ?? 'Unknown'); ?></p>
                                    <span style="display: inline-block; margin-top: 0.5rem; padding: 0.2rem 0.6rem; border-radius: 0.3rem; background: <?php echo e($lesson->status === 'scheduled' ? '#dbeafe' : '#fee2e2'); ?>; color: <?php echo e($lesson->status === 'scheduled' ? '#0c4a6e' : '#7f1d1d'); ?>; font-size: 0.8rem; font-weight: 600;"><?php echo e(ucfirst($lesson->status)); ?></span>
                                </div>
                                <?php if($lesson->status === 'scheduled'): ?>
                                <form action="<?php echo e(route('customer.cancel-lesson', $lesson->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="reason" value="Cancelled by customer">
                                    <button type="submit" style="color: #dc2626; background: none; border: none; cursor: pointer; text-decoration: underline; font-size: 0.9rem; font-weight: 600;" onclick="return confirm('Weet je zeker dat je deze les wilt afzeggen?')">
                                        Les Afzeggen
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p style="color: #666;">Nog geen lessen ingepland</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666; margin-bottom: 1.5rem;">Nog geen reserveringen</p>
            <a href="<?php echo e(route('customer.make-reservation')); ?>" style="background: #ff6b35; color: white; padding: 0.75rem 1.5rem; border-radius: 0.3rem; text-decoration: none; font-weight: 700; display: inline-block;" onmouseover="this.style.background='#ff5520'" onmouseout="this.style.background='#ff6b35'">
                Maak je Eerste Reservering
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/customer/reservations.blade.php ENDPATH**/ ?>