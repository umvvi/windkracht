

<?php $__env->startSection('title', 'Nieuwe Lesdatum Kiezen - Windkracht-12'); ?>

<!-- Add Flatpickr CSS for better date picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
/* Flatpickr styling */
.flatpickr-input {
    width: 100% !important;
}

.flatpickr-calendar {
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    border-radius: 0.5rem !important;
}

.flatpickr-day.selected {
    background: #0369a1 !important;
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

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 3rem;">
    <!-- Header Section with Gradient -->
    <div style="background: linear-gradient(135deg, #003d7a 0%, #0369a1 100%); border-radius: 0.5rem; padding: 2.5rem 2rem; margin-bottom: 3rem; color: white;">
        <p style="margin: 0 0 0.5rem 0; font-size: 0.9rem; opacity: 0.9;">LESDATUM WIJZIGEN</p>
        <h1 style="font-size: 2.2rem; font-weight: 800; margin: 0;">Kies je Nieuwe Lesdatum</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.95; font-size: 0.95rem;">Je annulering is geaccepteerd. Vind nu een nieuw moment dat beter voor je uitkomt.</p>
    </div>

    <div style="max-width: 900px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <!-- Left: Current Lesson Details -->
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); overflow: hidden; border-left: 4px solid #dc2626;">
                <div style="background: #fef2f2; padding: 1.5rem; border-bottom: 1px solid #fee2e2;">
                    <p style="color: #7f1d1d; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">Geannuleerde Les</p>
                    <p style="font-size: 1.3rem; font-weight: 800; color: #dc2626; margin: 0;"><?php echo e($lesson->start_time->format('d-m-Y')); ?></p>
                    <p style="font-size: 2rem; font-weight: 800; color: #dc2626; margin: 0.25rem 0 0 0;"><?php echo e($lesson->start_time->format('H:i')); ?></p>
                </div>
                <div style="padding: 1.5rem;">
                    <div style="margin-bottom: 1rem;">
                        <p style="color: #9ca3af; font-size: 0.8rem; font-weight: 600; margin: 0 0 0.5rem 0;">PAKKET</p>
                        <p style="color: #1f2937; font-weight: 600; margin: 0; font-size: 1rem;"><?php echo e($reservation->package->name); ?></p>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <p style="color: #9ca3af; font-size: 0.8rem; font-weight: 600; margin: 0 0 0.5rem 0;">LOCATIE</p>
                        <p style="color: #1f2937; font-weight: 600; margin: 0; font-size: 1rem;">📍 <?php echo e($reservation->location->name); ?></p>
                    </div>
                    <div>
                        <p style="color: #9ca3af; font-size: 0.8rem; font-weight: 600; margin: 0 0 0.5rem 0;">RESTERENDE LESSEN</p>
                        <p style="color: #10b981; font-weight: 800; margin: 0; font-size: 1.2rem;"><?php echo e($remainingSessions); ?> <?php echo e($remainingSessions === 1 ? 'les' : 'lessen'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Right: New Lesson Booking -->
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); overflow: hidden; border-left: 4px solid #10b981;">
                <div style="background: #f0fdf4; padding: 1.5rem; border-bottom: 1px solid #dcfce7;">
                    <p style="color: #15803d; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">Nieuwe Datum</p>
                    <p style="font-size: 1.1rem; color: #15803d; margin: 0; font-weight: 600;">Selecteer hieronder</p>
                </div>
                <div style="padding: 1.5rem;">
                    <form action="<?php echo e(route('customer.reschedule-lesson.store', $lesson->id)); ?>" method="POST" id="rescheduleForm">
                        <?php echo csrf_field(); ?>

                        <div style="margin-bottom: 1.5rem;">
                            <label for="new_date" style="display: block; color: #1f2937; font-weight: 700; margin-bottom: 0.75rem; font-size: 0.95rem;">Datum & Tijd</label>
                            <input 
                                type="text" 
                                id="new_date" 
                                name="new_date" 
                                style="width: 100%; padding: 0.9rem 1rem; border: 2px solid #e5e7eb; border-radius: 0.4rem; font-size: 1rem; box-sizing: border-box; font-weight: 500;"
                                placeholder="Klik hier om datum en tijd te selecteren"
                                required
                                autocomplete="off"
                            >
                            <?php $__errorArgs = ['new_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span style="color: #dc2626; font-size: 0.85rem; margin-top: 0.5rem; display: block; font-weight: 500;"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 0.4rem; padding: 0.75rem 1rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #78350f;">
                            <p style="margin: 0; font-weight: 600;">✓ Instructeur wordt automatisch toegewezen</p>
                        </div>

                        <div style="display: flex; gap: 1rem;">
                            <a href="<?php echo e(route('customer.reservations')); ?>" style="flex: 1; padding: 0.85rem 1rem; border: 2px solid #e5e7eb; border-radius: 0.4rem; background: white; color: #1f2937; font-weight: 600; text-decoration: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s; text-align: center;" onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#d1d5db'" onmouseout="this.style.background='white'; this.style.borderColor='#e5e7eb'">
                                ← Terug
                            </a>
                            <button 
                                type="submit" 
                                style="flex: 1; padding: 0.85rem 1rem; border: none; border-radius: 0.4rem; background: linear-gradient(135deg, #0369a1 0%, #003d7a 100%); color: white; font-weight: 700; cursor: pointer; transition: all 0.3s; font-size: 0.95rem;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(3, 105, 161, 0.3)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'"
                            >
                                Bevestigen →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Cards Section -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Tip 1 -->
            <div style="background: linear-gradient(135deg, #f0f8ff 0%, #e0f2fe 100%); border-radius: 0.5rem; padding: 1.5rem; border-left: 4px solid #0369a1;">
                <p style="color: #003d7a; font-weight: 700; margin: 0 0 0.5rem 0; font-size: 1.1rem;">24-uur Regel</p>
                <p style="color: #666; margin: 0; font-size: 0.9rem;">Lessen moeten minstens 24 uur van tevoren geboekt worden.</p>
            </div>

            <!-- Tip 2 -->
            <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 0.5rem; padding: 1.5rem; border-left: 4px solid #10b981;">
                <p style="color: #15803d; font-weight: 700; margin: 0 0 0.5rem 0; font-size: 1.1rem;">Gekwalificeerde Instructeur</p>
                <p style="color: #666; margin: 0; font-size: 0.9rem;">Een ervaren instructeur van ons team zal je begeleiden.</p>
            </div>

            <!-- Tip 3 -->
            <div style="background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%); border-radius: 0.5rem; padding: 1.5rem; border-left: 4px solid #ec4899;">
                <p style="color: #be185d; font-weight: 700; margin: 0 0 0.5rem 0; font-size: 1.1rem;">Bevestigingsmail</p>
                <p style="color: #666; margin: 0; font-size: 0.9rem;">Je ontvangt een mail met alle details van je nieuwe les.</p>
            </div>
        </div>

        <!-- Progress Section -->
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem;">
            <p style="color: #6b7280; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin: 0 0 1.5rem 0;">Proces</p>
            <div style="display: grid; grid-template-columns: 1fr auto 1fr auto 1fr; gap: 1rem; align-items: center;">
                <!-- Step 1 -->
                <div style="text-align: center;">
                    <div style="background: #d1fae5; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; font-weight: 800; color: #10b981; border: 3px solid #10b981;">✓</div>
                    <p style="margin: 0; font-size: 0.85rem; font-weight: 600; color: #1f2937;">Les Afgemeld</p>
                </div>

                <!-- Arrow -->
                <div style="text-align: center; color: #d1d5db; font-size: 1.5rem;">→</div>

                <!-- Step 2 -->
                <div style="text-align: center;">
                    <div style="background: #dbeafe; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; font-weight: 800; color: #0369a1;">2</div>
                    <p style="margin: 0; font-size: 0.85rem; font-weight: 600; color: #1f2937;">Nieuwe Datum</p>
                </div>

                <!-- Arrow -->
                <div style="text-align: center; color: #d1d5db; font-size: 1.5rem;">→</div>

                <!-- Step 3 -->
                <div style="text-align: center;">
                    <div style="background: #fef3c7; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; font-weight: 800; color: #f59e0b;">3</div>
                    <p style="margin: 0; font-size: 0.85rem; font-weight: 600; color: #1f2937;">Bevestigd</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Flatpickr for date picker
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
const minDate = tomorrow.toISOString().split('T')[0];

// Create hidden input for form submission if needed
const newDateInput = document.getElementById('new_date');

const pickerInstance = flatpickr('#new_date', {
    enableTime: true,
    dateFormat: "Y-m-d\\TH:i",
    minDate: minDate,
    minTime: "08:00",
    maxTime: "18:00",
    time_24hr: true,
    minuteIncrement: 15,
    onChange: function(selectedDates, dateStr, instance) {
        // Ensure the field has the correct value
        newDateInput.value = dateStr;
    },
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

// Prevent multiple form submissions
let formSubmitting = false;
document.getElementById('rescheduleForm').addEventListener('submit', function(e) {
    if (formSubmitting) {
        e.preventDefault();
        return false;
    }
    
    // Validate that a date was selected
    const dateValue = newDateInput.value.trim();
    if (!dateValue) {
        e.preventDefault();
        alert('Selecteer alstublieft een datum en tijd');
        return false;
    }
    
    formSubmitting = true;
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/customer/reschedule-lesson.blade.php ENDPATH**/ ?>