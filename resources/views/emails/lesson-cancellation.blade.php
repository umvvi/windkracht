<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; }
        .header { background: #003d7a; color: white; padding: 20px; text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .alert-banner { background: #fee2e2; border-left: 4px solid #dc2626; padding: 15px; margin-bottom: 20px; color: #7f1d1d; }
        .alert-banner h2 { margin: 0 0 8px 0; font-size: 18px; }
        .content { background: white; padding: 20px; border-radius: 4px; }
        .section { margin-bottom: 20px; }
        .section h2 { color: #003d7a; font-size: 16px; border-bottom: 2px solid #ff6b35; padding-bottom: 8px; }
        .lesson-info { background: #fff7ed; padding: 15px; border-radius: 4px; margin: 15px 0; }
        .reason-box { background: #fef3c7; padding: 12px; margin: 12px 0; border-left: 4px solid #f59e0b; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px 0; border-top: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Windkracht-12 Kitesurfschool</h1>
            <p>Les Geannuleerd</p>
        </div>

        <div class="alert-banner">
            <h2>⚠️ Les Geannuleerd</h2>
            <p>Jouw geplande les kan helaas niet doorgaan.</p>
        </div>

        <div class="content">
            <p>Beste {{ $lesson->reservation->customer->personalInformation->first_name ?? 'Klant' }},</p>

            <p>Helaas moet je geplande les worden geannuleerd. Hieronder vind je de details:</p>

            <div class="lesson-info">
                <h3 style="margin-top: 0; color: #003d7a;">Geannuleerde Les</h3>
                <p><strong>Datum & Tijd:</strong> {{ $lesson->start_time->format('d-m-Y') }} van {{ $lesson->start_time->format('H:i') }} tot {{ $lesson->end_time->format('H:i') }}</p>
                <p><strong>Locatie:</strong> {{ $lesson->location->name }}</p>
                <p><strong>Instructeur:</strong> {{ $instructorName }}</p>
            </div>

            <div class="section">
                <h2>Reden van Annulering</h2>
                <div class="reason-box">
                    @if ($cancellationType === 'instructor_illness')
                        <p><strong>Reden:</strong> Ziekte van je instructeur</p>
                        <p>Jammer genoeg is je instructeur ziek en kan de les niet geven. We zullen contact met je opnemen voor herboeking.</p>
                    @elseif ($cancellationType === 'bad_weather')
                        <p><strong>Reden:</strong> Slechte weersomstandigheden</p>
                        <p>Door onveilige weersomstandigheden kan de les helaas niet doorgaan. Dit is voor jouw veiligheid. We zullen een ander moment ingepland.</p>
                    @else
                        <p><strong>Reden:</strong> {{ ucfirst($cancellationType) }}</p>
                    @endif
                    @if ($cancellationReason)
                        <p><strong>Aanvullende informatie:</strong> {{ $cancellationReason }}</p>
                    @endif
                </div>
            </div>

            <div class="section">
                <h2>Wat Nu?</h2>
                <ul>
                    <li><strong>We nemen binnenkort contact met je op</strong> om een nieuw moment in te plannen</li>
                    <li>Als je al betaald hebt, krijg je volledige terugbetaling of herboeking</li>
                    <li>Heb je vragen? Neem gerust contact met ons op</li>
                </ul>
            </div>

            <div class="section">
                <h2>Contactgegevens</h2>
                <p>
                    <strong>Email:</strong> info@windkracht12.nl<br>
                    <strong>Telefoon:</strong> +31 6 12345678
                </p>
            </div>

            <p>We hopen je binnenkort in een ander moment te zien!<br>
            <strong>Team Windkracht-12</strong></p>
        </div>

        <div class="footer">
            <p>&copy; 2026 Windkracht-12 Kitesurfschool. Alle rechten voorbehouden.</p>
        </div>
    </div>
</body>
</html>
