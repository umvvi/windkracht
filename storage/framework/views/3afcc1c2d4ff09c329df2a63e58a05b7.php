

<?php $__env->startSection('title', 'Klanten Beheren - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Klanten Beheren</h1>
    </div>

    <?php if($customers->count() > 0): ?>
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
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 1rem; color: #1f2937;"><?php echo e($customer->personalInformation?->full_name ?? 'N/A'); ?></td>
                        <td style="padding: 1rem; color: #1f2937;"><?php echo e($customer->email); ?></td>
                        <td style="padding: 1rem; color: #1f2937;"><?php echo e($customer->personalInformation?->phone_mobile ?? 'N/A'); ?></td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: <?php echo e($customer->is_active ? '#d1fae5' : '#fee2e2'); ?>; color: <?php echo e($customer->is_active ? '#065f46' : '#7f1d1d'); ?>;"><?php echo e($customer->is_active ? 'Actief' : 'Geblokkeerd'); ?></span>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
                                <a href="<?php echo e(route('owner.manage-customer', $customer->id)); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Bekijken</a>
                                <form action="<?php echo e(route('owner.toggle-status', $customer->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" style="color: #ff6b35; background: none; border: none; cursor: pointer; text-decoration: none; font-weight: 600; font-size: 0.9rem;"><?php echo e($customer->is_active ? 'Blokkeren' : 'Activeren'); ?></button>
                                </form>
                                <?php
                                    $profileComplete = $customer->personalInformation && 
                                                     !empty($customer->personalInformation->first_name) &&
                                                     !empty($customer->personalInformation->last_name) &&
                                                     !empty($customer->personalInformation->street_address) &&
                                                     !empty($customer->personalInformation->city) &&
                                                     !empty($customer->personalInformation->phone_mobile) &&
                                                     !empty($customer->personalInformation->bsn);
                                ?>
                                <?php if($profileComplete): ?>
                                <form action="<?php echo e(route('owner.change-role', $customer->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="role" value="instructor">
                                    <button type="submit" style="color: #22c55e; background: none; border: none; cursor: pointer; text-decoration: none; font-weight: 600; font-size: 0.9rem;" onclick="return confirm('Deze klant als instructeur instellen?')">→ Instructeur</button>
                                </form>
                                <?php else: ?>
                                <span style="color: #9ca3af; font-weight: 600; font-size: 0.9rem; cursor: not-allowed;" title="Profiel onvolledig - zorg dat BSN is ingevuld">→ Instructeur</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Geen klanten gevonden</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/owner/customers.blade.php ENDPATH**/ ?>