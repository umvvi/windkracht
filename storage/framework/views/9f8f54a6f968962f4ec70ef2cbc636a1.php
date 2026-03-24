

<?php $__env->startSection('title', 'Account Activeren - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height: calc(100vh - 70px); display: flex; align-items: center; justify-content: center; padding: 2rem;">
    <div style="width: 100%; max-width: 420px;">
        <!-- Card -->
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #003d7a 0%, #0369a1 100%); padding: 2.5rem 2rem; text-align: center; color: white;">
                <h1 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem;">Windkracht-12</h1>
                <p style="font-size: 0.95rem; opacity: 0.9;">Kies je Wachtwoord</p>
            </div>

            <!-- Success Banner -->
            <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 1rem; color: #065f46; font-size: 0.9rem; margin: 0;">
                <p style="margin: 0;"><strong>✓ E-mailadres Geverifieerd!</strong></p>
                <p style="margin: 0.25rem 0 0 0; font-size: 0.85rem;">Stel nu je wachtwoord in.</p>
            </div>

            <!-- Form -->
            <div style="padding: 2.5rem 2rem;">
                <form action="<?php echo e(route('activation.activate', ['token' => $token])); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Password Field -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Wachtwoord</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.3rem; transition: all 0.3s; font-size: 0.95rem;"
                            onfocus="this.style.borderColor='#0369a1'; this.style.boxShadow='0 0 0 3px rgba(3, 105, 161, 0.1)'"
                            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'"
                            placeholder="Minimaal 12 karakters"
                            required
                            autofocus
                        >
                        <div style="margin-top: 0.75rem; background: #f9fafb; padding: 1rem; border-radius: 0.3rem; font-size: 0.8rem; color: #666; border: 1px solid #e5e7eb;">
                            <p style="font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Wachtwoordvereisten:</p>
                            <ul style="list-style: none; padding: 0;">
                                <li id="req-length" style="margin-bottom: 0.35rem; color: #999;">✓ Minimaal 12 karakters</li>
                                <li id="req-upper" style="margin-bottom: 0.35rem; color: #999;">✓ Minstens 1 hoofdletter</li>
                                <li id="req-number" style="margin-bottom: 0.35rem; color: #999;">✓ Minstens 1 getal</li>
                                <li id="req-special" style="color: #999;">✓ Minstens 1 speciaal teken (@, #, $, %)</li>
                            </ul>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span style="color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem; display: block;"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Confirm Password Field -->
                    <div style="margin-bottom: 2rem;">
                        <label for="password_confirmation" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Bevestig Wachtwoord</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.3rem; transition: all 0.3s; font-size: 0.95rem;"
                            onfocus="this.style.borderColor='#0369a1'; this.style.boxShadow='0 0 0 3px rgba(3, 105, 161, 0.1)'"
                            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'"
                            placeholder="Herhaal je wachtwoord"
                            required
                        >
                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span style="color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem; display: block;"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        id="submitBtn"
                        style="width: 100%; background: #ccc; color: white; font-weight: 700; padding: 0.9rem; border-radius: 0.3rem; border: none; cursor: not-allowed; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;"
                        disabled
                    >
                        Account Activeren
                    </button>
                </form>

                <!-- Info Text -->
                <p style="text-align: center; color: #999; font-size: 0.85rem; margin-top: 1.5rem;">
                    Na activering word je automatisch ingelogd.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const submitBtn = document.getElementById('submitBtn');

    function validatePassword() {
        const pwd = passwordInput.value;
        const minLength = pwd.length >= 12;
        const hasUpper = /[A-Z]/.test(pwd);
        const hasNumber = /[0-9]/.test(pwd);
        const hasSpecial = /[@#$%^&*]/.test(pwd);

        // Update requirement indicators
        document.getElementById('req-length').style.color = minLength ? '#10b981' : '#999';
        document.getElementById('req-upper').style.color = hasUpper ? '#10b981' : '#999';
        document.getElementById('req-number').style.color = hasNumber ? '#10b981' : '#999';
        document.getElementById('req-special').style.color = hasSpecial ? '#10b981' : '#999';

        // Check if all requirements met
        const allMet = minLength && hasUpper && hasNumber && hasSpecial;
        const confirmed = pwd === confirmInput.value && pwd.length > 0;

        // Enable submit button if all requirements met and passwords match
        if (allMet && confirmed && confirmInput.value.length > 0) {
            submitBtn.disabled = false;
            submitBtn.style.background = '#ff6b35';
            submitBtn.style.cursor = 'pointer';
        } else {
            submitBtn.disabled = true;
            submitBtn.style.background = '#ccc';
            submitBtn.style.cursor = 'not-allowed';
        }
    }

    passwordInput.addEventListener('input', validatePassword);
    confirmInput.addEventListener('input', validatePassword);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/auth/activate.blade.php ENDPATH**/ ?>