

<?php $__env->startSection('title', 'Klant Beheren - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;"><?php echo e($customer->personalInformation?->full_name ?? $customer->email); ?></h1>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; border-left: 4px solid #0369a1;">
            <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1rem 0;">Persoonlijke Informatie</h2>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Naam:</strong> <?php echo e($customer->personalInformation?->full_name ?? 'N/A'); ?></p>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Email:</strong> <?php echo e($customer->email); ?></p>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Telefoon:</strong> <?php echo e($customer->personalInformation?->phone_mobile ?? 'N/A'); ?></p>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Plaats:</strong> <?php echo e($customer->personalInformation?->city ?? 'N/A'); ?></p>
            <p style="margin: 0.5rem 0; color: #4b5563;"><strong>Status:</strong> <span style="padding: 0.2rem 0.6rem; border-radius: 0.3rem; background: <?php echo e($customer->is_active ? '#d1fae5' : '#fee2e2'); ?>; color: <?php echo e($customer->is_active ? '#065f46' : '#7f1d1d'); ?>; font-size: 0.85rem; font-weight: 600;"><?php echo e($customer->is_active ? 'Actief' : 'Geblokkeerd'); ?></span></p>
            <p style="margin: 1rem 0 0 0; padding-top: 1rem; border-top: 1px solid #e5e7eb; color: #4b5563;"><strong>Gebruikersrol:</strong> <span style="padding: 0.2rem 0.6rem; border-radius: 0.3rem; background: <?php echo e($customer->role === 'instructor' ? '#dbeafe' : '#f3f4f6'); ?>; color: <?php echo e($customer->role === 'instructor' ? '#0c4a6e' : '#374151'); ?>; font-size: 0.85rem; font-weight: 600;"><?php echo e(ucfirst($customer->role)); ?></span></p>
        </div>

        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; border-left: 4px solid #ff6b35;">
            <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1rem 0;">Rol Wijzigen</h2>
            <p style="margin: 0 0 1rem 0; color: #666; font-size: 0.95rem;">Wijzig de gebruikersrol van deze persoon.</p>
            <?php
                $profileComplete = $customer->personalInformation && 
                                 !empty($customer->personalInformation->first_name) &&
                                 !empty($customer->personalInformation->last_name) &&
                                 !empty($customer->personalInformation->street_address) &&
                                 !empty($customer->personalInformation->city) &&
                                 !empty($customer->personalInformation->phone_mobile);
            ?>
            <form action="<?php echo e(route('owner.change-role', $customer->id)); ?>" method="POST" style="display: flex; gap: 1rem; align-items: flex-end;">
                <?php echo csrf_field(); ?>
                <div style="flex: 1;">
                    <label style="display: block; font-weight: 600; color: #003d7a; margin-bottom: 0.5rem; font-size: 0.9rem;">Nieuwe Rol</label>
                    <select name="role" style="width: 100%; padding: 0.6rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-size: 0.95rem; font-family: inherit;" required>
                        <option value="customer" <?php echo e($customer->role === 'customer' ? 'selected' : ''); ?>>Klant (Customer)</option>
                        <option value="instructor" <?php echo e($customer->role === 'instructor' ? 'selected' : ''); ?> <?php echo e(!$profileComplete && $customer->role !== 'instructor' ? 'disabled' : ''); ?>>
                            Instructeur (Instructor)<?php echo e(!$profileComplete && $customer->role !== 'instructor' ? ' - Profiel onvolledig' : ''); ?>

                        </option>
                        <option value="owner" <?php echo e($customer->role === 'owner' ? 'selected' : ''); ?>>Eigenaar (Owner)</option>
                    </select>
                    <?php if(!$profileComplete): ?>
                    <small style="color: #ff6b35; font-size: 0.8rem; display: block; margin-top: 0.25rem;">⚠️ Zorg dat naam, adres, plaats en telefoonnummer zijn ingevuld. BSN kan later toegevoegd worden.</small>
                    <?php endif; ?>
                </div>
                <button type="submit" style="background: #0369a1; color: white; border: none; padding: 0.6rem 1.25rem; border-radius: 0.3rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#0370a9'" onmouseout="this.style.background='#0369a1'">
                    Wijzigen
                </button>
            </form>
        </div>

        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; border-left: 4px solid #ff6b35; grid-column: 1 / -1;">
            <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Reserveringen & Lessen</h2>
            <?php if($customer->reservations->count() > 0): ?>
                <div style="display: grid; gap: 2rem;">
                    <?php $__currentLoopData = $customer->reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="background: #f9fafb; border-radius: 0.3rem; padding: 1.5rem; border: 1px solid #e5e7eb;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                            <div>
                                <h3 style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;"><?php echo e($reservation->package->name); ?></h3>
                                <p style="color: #666; margin: 0.25rem 0 0 0; font-size: 0.9rem;">📍 <?php echo e($reservation->location->name); ?> • Geboekt: <?php echo e($reservation->created_at->format('d-m-Y')); ?></p>
                            </div>
                            <div style="text-align: right;">
                                <span style="padding: 0.3rem 0.8rem; border-radius: 0.3rem; background: <?php echo e(!$reservation->payment_received ? '#fef3c7' : '#d1fae5'); ?>; color: <?php echo e(!$reservation->payment_received ? '#92400e' : '#065f46'); ?>; font-size: 0.85rem; font-weight: 600; display: inline-block;"><?php echo e(!$reservation->payment_received ? 'Wachtend op Betaling' : 'Bevestigd'); ?></span>
                                <span style="padding: 0.3rem 0.8rem; border-radius: 0.3rem; background: <?php echo e($reservation->payment_received ? '#d1fae5' : '#fee2e2'); ?>; color: <?php echo e($reservation->payment_received ? '#065f46' : '#7f1d1d'); ?>; font-size: 0.85rem; font-weight: 600; display: inline-block; margin-left: 0.5rem;"><?php echo e($reservation->payment_received ? 'Betaald' : 'Openstaand'); ?></span>
                            </div>
                        </div>

                        <div style="background: white; border-radius: 0.3rem; padding: 1rem;">
                            <h4 style="font-weight: 600; color: #003d7a; margin: 0 0 0.75rem 0; font-size: 0.95rem;">Geplande Lessen (<?php echo e($reservation->lessons->count()); ?>)</h4>
                            <?php if($reservation->lessons->count() > 0): ?>
                                <div style="display: grid; gap: 0.75rem;">
                                    <?php $__currentLoopData = $reservation->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.3rem; display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <p style="font-weight: 600; color: #003d7a; margin: 0; font-size: 0.95rem;">📅 <?php echo e($lesson->start_time->format('d-m-Y H:i')); ?></p>
                                            <p style="color: #666; margin: 0.25rem 0 0 0; font-size: 0.85rem;">👤 <?php echo e($lesson->instructor->personalInformation?->full_name ?? 'Unknown'); ?></p>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <span style="padding: 0.2rem 0.5rem; border-radius: 0.3rem; background: <?php echo e($lesson->status === 'scheduled' ? '#dbeafe' : '#fee2e2'); ?>; color: <?php echo e($lesson->status === 'scheduled' ? '#0c4a6e' : '#7f1d1d'); ?>; font-size: 0.8rem; font-weight: 600;"><?php echo e($lesson->status === 'scheduled' ? 'Ingepland' : ($lesson->status === 'cancelled' ? 'Afgebroken' : ucfirst($lesson->status))); ?></span>
                                            <?php if($lesson->status === 'scheduled'): ?>
                                            <form action="<?php echo e(route('owner.cancel-lesson', $lesson->id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" style="background: #dc2626; color: white; border: none; padding: 0.4rem 0.75rem; border-radius: 0.3rem; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'" onclick="return confirm('Weet je zeker dat je deze les wilt afzeggen?')">
                                                    Afzeggen
                                                </button>
                                            </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p style="color: #666; font-size: 0.9rem; margin: 0;">Nog geen lessen ingepland</p>
                            <?php endif; ?>
                        </div>

                        <?php if(!$reservation->payment_received): ?>
                        <form action="<?php echo e(route('owner.confirm-payment', $reservation->id)); ?>" method="POST" style="margin-top: 1rem;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background: #22c55e; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.3rem; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#16a34a'" onmouseout="this.style.background='#22c55e'">
                                ✓ Betaling Bevestigen
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p style="color: #666;">Geen reserveringen gevonden</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/owner/manage-customer.blade.php ENDPATH**/ ?>