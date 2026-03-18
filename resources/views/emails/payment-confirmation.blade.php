<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; }
        .header { background: #003d7a; color: white; padding: 20px; text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .success-banner { background: #d1fae5; border-left: 4px solid #10b981; padding: 15px; margin-bottom: 20px; color: #065f46; }
        .success-banner h2 { margin: 0 0 8px 0; font-size: 18px; }
        .content { background: white; padding: 20px; border-radius: 4px; }
        .section { margin-bottom: 20px; }
        .section h2 { color: #003d7a; font-size: 16px; border-bottom: 2px solid #ff6b35; padding-bottom: 8px; }
        .lesson-item { background: #f0f8ff; padding: 12px; margin: 8px 0; border-left: 4px solid #0369a1; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px 0; border-top: 1px solid #ddd; }
        .total { font-size: 18px; color: #10b981; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Windkracht-12 Kitesurfschool</h1>
            <p>Betaling Ontvangen & Bevestigd</p>
        </div>

        <div class="success-banner">
            <h2>✓ Betaling Bevestigd!</h2>
            <p>Je reservering is nu definitief. We zien je binnenkort!</p>
        </div>

        <div class="content">
            <p>Beste {{ $reservation->customer->personalInformation->first_name ?? 'Klant' }},</p>

            <p>Ons dank je wel ontvangen. Je reservering staat nu geboekt en voorbereiding verschijnen jullie lessen:</p>

            <div class="section">
                <h2>Reserveringsgegevens</h2>
                <p><strong>Reserveringsnummer:</strong> #{{ $reservation->id }}</p>
                <p><strong>Pakket:</strong> {{ $reservation->package->name }}</p>
                <p><strong>Locatie:</strong> {{ $reservation->location->name }}</p>
                <p><strong>Aantal lessen:</strong> {{ $reservation->package->num_sessions }}</p>
                <p><strong>Bedrag betaald:</strong> <span class="total">€{{ number_format($reservation->total_price, 2, ',', '.') }}</span></p>
            </div>

            <div class="section">
                <h2>Bevestigde Lessen</h2>
                @foreach ($lessons as $lesson)
                <div class="lesson-item">
                    <p style="margin: 0;"><strong>{{ $lesson->start_time->format('d-m-Y H:i') }}</strong> - {{ $lesson->end_time->format('H:i') }}</p>
                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #666;">Instructeur: {{ $lesson->instructor->personalInformation->first_name ?? 'TBA' }} {{ $lesson->instructor->personalInformation->last_name ?? '' }}</p>
                    <p style="margin: 2px 0 0 0; font-size: 12px; color: #999;">{{ $lesson->location->name }}</p>
                </div>
                @endforeach
            </div>

            <div class="section">
                <h2>Belangrijke Informatie</h2>
                <ul>
                    <li><strong>Zorg dat je minimaal 30 minuten van tevoren ter plaatse bent</strong></li>
                    <li>Breng zwemkleding en een handdoek mee</li>
                    <li>Alle apparatuur (vlieger, board, neopreen) is inbegrepen</li>
                    <li>Bij slecht weer kan je les worden verplaatst naar een ander moment</li>
                    <li>Voor annuleringen moet je minimaal 24 uur vooraf afzeggen</li>
                </ul>
            </div>

            <div class="section">
                <h2>Contactgegevens</h2>
                <p>Bij vragen of problemen kun je ons bereiken via:</p>
                <p>
                    <strong>Email:</strong> info@windkracht12.nl<br>
                    <strong>Telefoon:</strong> +31 6 12345678<br>
                    <strong>Website:</strong> www.kitesurfschool-windkracht12.nl
                </p>
            </div>

            <p>We kijken uit naar je aankomst en veel sterkte met het leren!<br>
            <strong>Team Windkracht-12</strong></p>
        </div>

        <div class="footer">
            <p>&copy; 2026 Windkracht-12 Kitesurfschool. Alle rechten voorbehouden.</p>
        </div>
    </div>
</body>
</html>
