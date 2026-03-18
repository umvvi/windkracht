

<?php $__env->startSection('title', 'Reservering Aanvragen - Windkracht-12'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 0.5rem 0;">Nieuwe Reservering</h1>
        <p style="color: #666; font-size: 1.05rem; margin: 0;">Kies je pakket, locatie en lesdatum(s)</p>
    </div>

    <form action="<?php echo e(route('customer.make-reservation.store')); ?>" method="POST" id="reservationForm">
        <?php echo csrf_field(); ?>

        <!-- STEP 1: PACKAGE SELECTION -->
        <div style="margin-bottom: 3rem;">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Stap 1: Kies je Pakket</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="package-card" style="
                    background: white;
                    border-radius: 0.3rem;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                    padding: 2rem;
                    border: 2px solid #e5e7eb;
                    cursor: pointer;
                    transition: all 0.3s;
                " data-package-id="<?php echo e($package->id); ?>" data-price="<?php echo e($package->price_per_person); ?>" data-sessions="<?php echo e($package->num_sessions); ?>" data-type="<?php echo e($package->type); ?>">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                        <div>
                            <h3 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0;"><?php echo e($package->name); ?></h3>
                            <p style="color: #ff6b35; font-weight: 600; margin: 0.25rem 0 0 0;"><?php echo e(ucfirst($package->type)); ?> Pakket</p>
                        </div>
                    </div>
                    
                    <div style="display: grid; gap: 0.75rem; margin-bottom: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="color: #0369a1; font-weight: 600;">📚</span>
                            <span style="color: #666;"><?php echo e($package->num_sessions); ?> sessie(s) <?php echo e($package->type === 'duo' ? '(2 personen)' : ''); ?></span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="color: #0369a1; font-weight: 600;">⏱️</span>
                            <span style="color: #666;"><?php echo e($package->duration_per_session ?? '2 uur'); ?> per sessie</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="color: #0369a1; font-weight: 600;">👥</span>
                            <span style="color: #666;"><?php echo e($package->type === 'private' ? 'Privé les' : ($package->type === 'group' ? 'Groepsles' : 'Duo les')); ?></span>
                        </div>
                    </div>

                    <div style="border-top: 1px solid #e5e7eb; padding-top: 1rem;">
                        <p style="color: #666; font-size: 0.9rem; margin: 0 0 1rem 0;"><?php echo e($package->description ?? 'Professionele kitesurfles voor ' . strtolower($package->name)); ?></p>
                        <div style="display: flex; align-items: baseline; gap: 0.25rem;">
                            <span style="font-size: 2rem; font-weight: 800; color: #ff6b35;">€<?php echo e($package->price_per_person); ?></span>
                            <span style="color: #666; font-size: 0.9rem;"><?php echo e($package->type === 'duo' ? 'per persoon' : 'totaal'); ?></span>
                        </div>
                    </div>

                    <input type="radio" name="package_id" value="<?php echo e($package->id); ?>" style="display: none;" required>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php $__errorArgs = ['package_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: #dc2626; margin-top: 1rem; padding: 0.75rem; background: #fee2e2; border-radius: 0.3rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- STEP 2: LOCATION SELECTION -->
        <div style="margin-bottom: 3rem;">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Stap 2: Kies je Locatie</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="location-card" style="
                    background: white;
                    border-radius: 0.3rem;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                    overflow: hidden;
                    border: 2px solid #e5e7eb;
                    cursor: pointer;
                    transition: all 0.3s;
                " data-location-id="<?php echo e($location->id); ?>">
                    <div style="
                        height: 200px;
                        background-size: cover;
                        background-position: center;
                        background-image: url('<?php echo e(asset('images/locations/' . strtolower(str_replace(' ', '-', $location->name)) . '.png')); ?>');
                    "></div>
                    
                    <div style="padding: 1.5rem;">
                        <h3 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;"><?php echo e($location->name); ?></h3>
                        <p style="color: #ff6b35; font-weight: 600; margin: 0 0 1rem 0; font-size: 0.9rem;">📍 <?php echo e($location->city); ?></p>
                        <p style="color: #666; line-height: 1.5; font-size: 0.95rem; margin: 0;"><?php echo e($location->description ?? 'Geweldige plek voor kitesurfen!'); ?></p>
                    </div>

                    <input type="radio" name="location_id" value="<?php echo e($location->id); ?>" style="display: none;" required>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php $__errorArgs = ['location_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: #dc2626; margin-top: 1rem; padding: 0.75rem; background: #fee2e2; border-radius: 0.3rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- STEP 3: DATE SELECTION -->
        <div style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #003d7a; margin: 0 0 1.5rem 0;">Stap 3: Kies je Lesdatum(s)</h2>
            
            <div id="session-dates-container" style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
                <p style="color: #666; text-align: center;">Selecteer eerst een pakket om je lesdatum(s) in te plannen</p>
            </div>

            <?php $__errorArgs = ['session_dates'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: #dc2626; margin-top: 1rem; padding: 0.75rem; background: #fee2e2; border-radius: 0.3rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- COST SUMMARY -->
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 2rem; border-left: 4px solid #ff6b35;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: #666; margin: 0 0 0.5rem 0;">Totaal aan te betalen</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #003d7a; margin: 0;">€<span id="total-cost">0.00</span></p>
                    <p style="color: #6b7280; font-size: 0.85rem; margin: 0.5rem 0 0 0;">Factuur verstuurd naar je e-mail</p>
                </div>
                <button type="submit" id="submitBtn" style="background: #ff6b35; color: white; padding: 1rem 2rem; border: none; border-radius: 0.3rem; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ff5520'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#ff6b35'; this.style.transform='translateY(0)'">
                    Reservering Plaatsen
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Add Flatpickr CSS for better date picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
.package-card:hover,
.location-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.package-card.selected,
.location-card.selected {
    border-color: #ff6b35;
    border-width: 2px;
    background: #fffbf8;
}

.package-card.selected::before,
.location-card.selected::before {
    content: '✓';
    position: absolute;
    top: -10px;
    right: 20px;
    background: #ff6b35;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
}

/* Flatpickr styling */
.flatpickr-input {
    width: 100% !important;
}

.flatpickr-calendar {
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    border-radius: 0.5rem !important;
}

.flatpickr-day.selected {
    background: #ff6b35 !important;
    color: white !important;
}

.flatpickr-day.today {
    border-color: #0369a1 !important;
}

.flatpickr-months .flatpickr-month {
    background: white !important;
}

.flatpickr-current-month input.cur-year {
    color: #003d7a !important;
    font-weight: 700 !important;
}
</style>

<script>
// Package selection
document.querySelectorAll('.package-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.package-card').forEach(c => {
            c.classList.remove('selected');
            c.style.borderColor = '#e5e7eb';
            c.style.background = 'white';
        });
        
        this.classList.add('selected');
        this.style.borderColor = '#ff6b35';
        this.style.background = '#fffbf8';
        this.querySelector('input[type="radio"]').checked = true;
        
        updateDateInputs();
        updateTotalCost();
    });
});

// Location selection
document.querySelectorAll('.location-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.location-card').forEach(c => {
            c.classList.remove('selected');
            c.style.borderColor = '#e5e7eb';
            c.style.background = 'white';
        });
        
        this.classList.add('selected');
        this.style.borderColor = '#ff6b35';
        this.querySelector('input[type="radio"]').checked = true;
    });
});

function updateDateInputs() {
    const selectedPackage = document.querySelector('.package-card.selected');
    if (!selectedPackage) return;
    
    const sessions = parseInt(selectedPackage.dataset.sessions);
    let html = '<label style="display: block; color: #003d7a; font-weight: 700; margin-bottom: 1rem;">Selecteer ' + sessions + ' sessie(s)</label>';
    html += '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">';
    
    // Get minimum date (24 hours from now)
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const minDate = tomorrow.toISOString().split('T')[0];
    
    for (let i = 1; i <= sessions; i++) {
        const inputId = 'session-date-' + i;
        html += `
            <div>
                <label style="display: block; color: #666; font-weight: 600; margin-bottom: 0.5rem;">Sessie ${i} Datum & Tijd</label>
                <input type="datetime-local" id="${inputId}" name="session_dates[${i}]" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-size: 0.95rem; font-family: 'Inter', sans-serif;" required min="${minDate}T00:00">
            </div>
        `;
    }
    
    html += '</div>';
    document.getElementById('session-dates-container').innerHTML = html;
    
    // Initialize Flatpickr on new inputs
    for (let i = 1; i <= sessions; i++) {
        const inputId = 'session-date-' + i;
        flatpickr('#' + inputId, {
            enableTime: true,
            dateFormat: "Y-m-d\\TH:i",
            minDate: minDate,
            minTime: "08:00",
            maxTime: "18:00",
            time_24hr: true,
            minuteIncrement: 15,
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],
                    longhand: ['Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag']
                },
                months: {
                    shorthand: ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
                    longhand: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December']
                }
            }
        });
    }
}

function updateTotalCost() {
    const selectedPackage = document.querySelector('.package-card.selected');
    if (!selectedPackage) {
        document.getElementById('total-cost').textContent = '0.00';
        return;
    }
    
    const price = parseFloat(selectedPackage.dataset.price);
    const type = selectedPackage.dataset.type;
    
    let totalCost = price;
    if (type === 'duo') {
        totalCost = price * 2;
    }
    
    document.getElementById('total-cost').textContent = totalCost.toFixed(2);
}

// Prevent double submission
let isSubmitting = false;
document.getElementById('reservationForm').addEventListener('submit', function(e) {
    if (!document.querySelector('input[name="package_id"]:checked') ||
        !document.querySelector('input[name="location_id"]:checked')) {
        e.preventDefault();
        alert('Selecteer alstublieft een pakket en locatie.');
        return;
    }
    
    // Validate dates are at least 3 hours apart
    const dateInputs = Array.from(document.querySelectorAll('input[type="datetime-local"]'));
    const dates = dateInputs
        .map(input => input.value ? new Date(input.value) : null)
        .filter(date => date !== null);
    
    if (dates.length > 1) {
        for (let i = 0; i < dates.length; i++) {
            for (let j = i + 1; j < dates.length; j++) {
                const diffHours = Math.abs(dates[i] - dates[j]) / (1000 * 60 * 60);
                if (diffHours < 3) {
                    e.preventDefault();
                    alert('Lessen moeten minimaal 3 uur van elkaar verwijderd zijn.');
                    return;
                }
            }
        }
    }
    
    if (isSubmitting) {
        e.preventDefault();
        return;
    }
    
    // Disable button and show loading state
    isSubmitting = true;
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.style.opacity = '0.6';
    submitBtn.style.cursor = 'not-allowed';
    submitBtn.textContent = 'Bezig met plaatsen...';
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/customer/make-reservation.blade.php ENDPATH**/ ?>