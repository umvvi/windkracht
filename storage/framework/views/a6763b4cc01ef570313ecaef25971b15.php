

<?php $__env->startSection('title', 'Persoonlijke Gegevens - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 50rem; margin: 0 auto; margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Persoonlijke Gegevens</h1>
    </div>

    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Bewerk Profiel</h2>
        <form action="<?php echo e(route('customer.personal-info.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label for="first_name" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Voornaam</label>
                    <input type="text" id="first_name" name="first_name" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="<?php echo e(old('first_name', $personalInfo?->first_name)); ?>" required>
                    <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="last_name" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Achternaam</label>
                    <input type="text" id="last_name" name="last_name" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="<?php echo e(old('last_name', $personalInfo?->last_name)); ?>" required>
                    <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="street_address" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Straatnaam</label>
                <input type="text" id="street_address" name="street_address" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="<?php echo e(old('street_address', $personalInfo?->street_address)); ?>" required>
                <?php $__errorArgs = ['street_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label for="city" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Plaats</label>
                    <input type="text" id="city" name="city" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="<?php echo e(old('city', $personalInfo?->city)); ?>" required>
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="postal_code" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Postcode</label>
                    <input type="text" id="postal_code" name="postal_code" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="<?php echo e(old('postal_code', $personalInfo?->postal_code)); ?>">
                    <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label for="date_of_birth" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Geboortedatum</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="<?php echo e(old('date_of_birth', $personalInfo?->date_of_birth)); ?>">
                    <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="phone_mobile" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Mobiel Telefoonnummer</label>
                    <input type="tel" id="phone_mobile" name="phone_mobile" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" value="<?php echo e(old('phone_mobile', $personalInfo?->phone_mobile)); ?>" required>
                    <?php $__errorArgs = ['phone_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <button type="submit" style="background: #0369a1; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; font-weight: 700; cursor: pointer;" onmouseover="this.style.background='#003d7a'" onmouseout="this.style.background='#0369a1'">
                Gegevens Opslaan
            </button>
        </form>
    </div>

    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
        <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Wachtwoord Wijzigen</h2>
        <form action="<?php echo e(route('change-password')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div style="margin-bottom: 1rem;">
                <label for="current_password" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Huiding Wachtwoord</label>
                <input type="password" id="current_password" name="current_password" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" required>
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="new_password" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Nieuw Wachtwoord</label>
                <input type="password" id="new_password" name="new_password" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" required>
                <small style="color: #666; font-size: 0.85rem; display: block; margin-top: 0.25rem;">Minimaal 12 tekens, minstens 1 hoofdletter, 1 getal en 1 speciaal teken</small>
                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="new_password_confirmation" style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 0.5rem;">Bevestig Nieuw Wachtwoord</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem;" required>
                <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #dc2626; font-size: 0.85rem;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" style="background: #ff6b35; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; font-weight: 700; cursor: pointer;" onmouseover="this.style.background='#ff5520'" onmouseout="this.style.background='#ff6b35'">
                Wachtwoord Wijzigen
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/customer/personal-info.blade.php ENDPATH**/ ?>