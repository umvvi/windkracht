

<?php $__env->startSection('title', 'Registreren - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height: calc(100vh - 70px); display: flex; align-items: center; justify-content: center; padding: 2rem;">
    <div style="width: 100%; max-width: 420px;">
        <!-- Card -->
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #003d7a 0%, #0369a1 100%); padding: 2.5rem 2rem; text-align: center; color: white;">
                <h1 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem;">Windkracht-12</h1>
                <p style="font-size: 0.95rem; opacity: 0.9;">Registreren</p>
            </div>

            <!-- Form -->
            <div style="padding: 2.5rem 2rem;">
                <form action="<?php echo e(route('register.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Email Field -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">E-mailadres</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="<?php echo e(old('email')); ?>"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.3rem; transition: all 0.3s; font-size: 0.95rem;"
                            onfocus="this.style.borderColor='#0369a1'; this.style.boxShadow='0 0 0 3px rgba(3, 105, 161, 0.1)'"
                            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'"
                            placeholder="jouw.email@example.com"
                            required
                        >
                        <?php $__errorArgs = ['email'];
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

                    <!-- Password Field -->
                    <div style="margin-bottom: 1rem;">
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
                        >
                        <div style="margin-top: 0.75rem; background: #f9fafb; padding: 1rem; border-radius: 0.3rem; font-size: 0.8rem; color: #666; border: 1px solid #e5e7eb;">
                            <p style="font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Wachtwoordvereisten:</p>
                            <ul style="list-style: none; padding: 0;">
                                <li>Minimaal 12 karakters</li>
                                <li>Minstens 1 hoofdletter</li>
                                <li>Minstens 1 nummer</li>
                                <li>Minstens 1 speciaal karakter (@, #, $, %)</li>
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
                        <label for="password_confirmation" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Wachtwoord bevestigen</label>
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
                        style="width: 100%; background: #ff6b35; color: white; font-weight: 700; padding: 0.9rem; border-radius: 0.3rem; border: none; cursor: pointer; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s;"
                        onmouseover="this.style.background='#ff5520'; this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='#ff6b35'; this.style.transform='translateY(0)'"
                    >
                        Account Aanmaken
                    </button>
                </form>

                <!-- Divider -->
                <div style="position: relative; margin: 1.5rem 0;">
                    <div style="border-top: 1px solid #e5e7eb;"></div>
                    <div style="position: absolute; top: -0.75rem; left: 50%; transform: translateX(-50%); background: white; padding: 0 0.75rem; color: #9ca3af; font-size: 0.85rem;">of</div>
                </div>

                <!-- Login Link -->
                <p style="text-align: center; color: #666; font-size: 0.9rem;">
                    Heb je al een account?
                    <a href="<?php echo e(route('login')); ?>" style="color: #0369a1; text-decoration: none; font-weight: 600;">
                        Inloggen
                    </a>
                </p>
            </div>
        </div>

        <!-- Info Box -->
        <div style="margin-top: 1.5rem; background: #f9fafb; border-radius: 0.3rem; padding: 1.25rem; font-size: 0.85rem; color: #666; border-left: 4px solid #0369a1;">
            <p style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Wat Krijg Je?</p>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 0.5rem;">Gratis Profiel & Dashboard</li>
                <li style="margin-bottom: 0.5rem;">Eenvoudig Reserveringen Maken</li>
                <li style="margin-bottom: 0.5rem;">Toegang tot Alle Locaties</li>
                <li>Online Betalingstracking</li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/auth/register.blade.php ENDPATH**/ ?>