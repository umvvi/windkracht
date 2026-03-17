

<?php $__env->startSection('title', 'Reservering Aanvragen - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 50rem; margin: 0 auto; margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Reservering Aanvragen</h1>
    </div>

    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
        <form action="<?php echo e(route('customer.make-reservation.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div style="margin-bottom: 1.5rem;">
                <label for="package_id" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Selecteer Pakket</label>
                <select id="package_id" name="package_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-size: 1rem;" required onchange="updatePackageInfo()">
                    <option value="">-- Kies een pakket --</option>
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($package->id); ?>" data-type="<?php echo e($package->type); ?>" data-price="<?php echo e($package->price_per_person); ?>" data-sessions="<?php echo e($package->num_sessions); ?>">
                            <?php echo e($package->name); ?> - €<?php echo e($package->price_per_person); ?><?php echo e($package->type === 'duo' ? ' per persoon' : ''); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['package_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="location_id" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Selecteer Locatie</label>
                <select id="location_id" name="location_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-size: 1rem;" required>
                    <option value="">-- Kies een locatie --</option>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?> - <?php echo e($location->city); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['location_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div id="session-dates" style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Selecteer Les Data</label>
                <small style="color: #666; display: block; margin-bottom: 0.5rem;">Selecteer je voorkeur lesdatum(s)</small>
                <?php $__errorArgs = ['session_dates'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 1.5rem; background: #f9fafb; padding: 1.25rem; border-radius: 0.3rem; border-left: 4px solid #0369a1;">
                <p style="color: #003d7a; margin: 0 0 0.5rem 0;"><strong>Totale Kosten:</strong> €<span id="total-cost">0</span></p>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">Factuur wordt verstuurd naar je email na boeking</p>
            </div>

            <button type="submit" style="width: 100%; background: #ff6b35; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; font-weight: 700; font-size: 1rem; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#ff5520'" onmouseout="this.style.background='#ff6b35'">
                Doorgaan naar Betaling
            </button>
        </form>
    </div>
</div>

<script>
function updatePackageInfo() {
    const select = document.getElementById('package_id');
    const option = select.options[select.selectedIndex];
    const price = parseFloat(option.dataset.price) || 0;
    const type = option.dataset.type;
    const sessions = parseInt(option.dataset.sessions) || 1;
    
    const multiplier = type === 'duo' ? 2 : 1;
    const totalCost = price * multiplier;
    
    document.getElementById('total-cost').textContent = (totalCost).toFixed(2);
    
    const sessionDatesContainer = document.getElementById('session-dates');
    let html = '<label style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Selecteer Les Data (' + sessions + ' sessies)</label>';
    
    for (let i = 1; i <= sessions; i++) {
        html += `
            <div style="margin-bottom: 0.75rem;">
                <label style="color: #666; font-size: 0.9rem; display: block; margin-bottom: 0.25rem;">Sessie ${i} Datum & Tijd</label>
                <input type="datetime-local" name="session_dates[${i}]" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" required>
            </div>
        `;
    }
    
    sessionDatesContainer.innerHTML = html;
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/customer/make-reservation.blade.php ENDPATH**/ ?>