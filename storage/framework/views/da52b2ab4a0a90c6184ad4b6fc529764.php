<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; }
        .header { background: #003d7a; color: white; padding: 20px; text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { background: white; padding: 20px; border-radius: 4px; }
        .section { margin-bottom: 20px; }
        .section h2 { color: #003d7a; font-size: 16px; border-bottom: 2px solid #ff6b35; padding-bottom: 8px; }
        .lesson-item { background: #f0f8ff; padding: 12px; margin: 8px 0; border-left: 4px solid #0369a1; }
        .bank-details { background: #fff3e0; padding: 15px; border-radius: 4px; margin: 15px 0; }
        .bank-details strong { color: #ff6b35; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px 0; border-top: 1px solid #ddd; }
        .total { font-size: 18px; color: #ff6b35; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Windkracht-12 Kitesurfschool</h1>
            <p>Reservering Bevestiging</p>
        </div>

        <div class="content">
            <p>Beste <?php echo e($reservation->customer->personalInformation->first_name ?? 'Klant'); ?>,</p>

            <p>Dank je wel voor je reservering bij Windkracht-12! Hier zijn de details van jouw boeking:</p>

            <div class="section">
                <h2>Reserveringsgegevens</h2>
                <p><strong>Reserveringsnummer:</strong> #<?php echo e($reservation->id); ?></p>
                <p><strong>Pakket:</strong> <?php echo e($reservation->package->name); ?></p>
                <p><strong>Locatie:</strong> <?php echo e($reservation->location->name); ?></p>
                <p><strong>Aantal lessen:</strong> <?php echo e($reservation->package->num_sessions); ?></p>
            </div>

            <div class="section">
                <h2>Geplande Lessen</h2>
                <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lesson-item">
                    <p style="margin: 0;"><strong><?php echo e($lesson->start_time->format('d-m-Y H:i')); ?></strong> - <?php echo e($lesson->end_time->format('H:i')); ?></p>
                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #666;">Instructeur: <?php echo e($lesson->instructor->personalInformation->first_name ?? 'TBA'); ?> <?php echo e($lesson->instructor->personalInformation->last_name ?? ''); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="section">
                <h2>Totaalbedrag</h2>
                <p>Bedrag te betalen: <span class="total">€<?php echo e(number_format($reservation->total_price, 2, ',', '.')); ?></span></p>
                <p style="color: #ff6b35; font-weight: bold;">Status: Wachtend op Betaling</p>
            </div>

            <div class="bank-details">
                <h3 style="margin-top: 0; color: #003d7a;">Betaalgegevens</h3>
                <p><strong>Begunstigde:</strong> Windkracht-12 Kitesurfschool</p>
                <p><strong>IBAN:</strong> NL91 ABNA 0417 1643 00</p>
                <p><strong>BIC:</strong> ABNANL2A</p>
                <p><strong>Referentie:</strong> Reservering #<?php echo e($reservation->id); ?></p>
                <p style="margin-bottom: 0;">Maak de betaling over binnen 7 dagen om je boeking definitief te maken.</p>
            </div>

            <div class="section">
                <h2>Volgende Stappen</h2>
                <ol>
                    <li>Maak de betaling over met referentienummer #<?php echo e($reservation->id); ?></li>
                    <li>Je zult een bevestiging ontvangen nadat we de betaling hebben verwerkt</li>
                    <li>Zorg dat je minimaal 30 minuten van tevoren ter plaatse bent</li>
                    <li>Breng zwemkleding en een handdoek mee</li>
                </ol>
            </div>

            <p>Bij vragen kun je contact opnemen via <strong>info@windkracht12.nl</strong> of <strong>+31 6 12345678</strong></p>

            <p>Tot ziens op het water!<br>
            <strong>Team Windkracht-12</strong></p>
        </div>

        <div class="footer">
            <p>&copy; 2026 Windkracht-12 Kitesurfschool. Alle rechten voorbehouden.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Comunicación\Desktop\school\resources\views/emails/reservation-confirmation.blade.php ENDPATH**/ ?>