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
        .button { background: #ff6b35; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; margin: 20px 0; font-weight: bold; }
        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px 0; border-top: 1px solid #ddd; }
        .info-box { background: #f0f8ff; padding: 15px; border-radius: 4px; margin: 15px 0; border-left: 4px solid #0369a1; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Windkracht-12 Kitesurfschool</h1>
            <p>Welkom!</p>
        </div>

        <div class="content">
            <p>Hallo!</p>

            <p>Dank je wel voor je registratie bij Windkracht-12 Kitesurfschool. We zijn enthousiast om je aan boord te hebben!</p>

            <div class="section">
                <h2>Activeer je Account</h2>
                <p>Dit is je welkomstbericht. Klik op de knop hieronder om je account te activeren en je wachtwoord in te stellen.</p>
                
                <center>
                    <a href="{{ $activationLink }}" class="button">Account Activeren</a>
                </center>

                <p style="color: #999; font-size: 12px;">Of kopieer deze link in je browser:</p>
                <p style="color: #0369a1; word-break: break-all; font-size: 12px;">{{ $activationLink }}</p>
            </div>

            <div class="info-box">
                <p style="margin: 0;"><strong>Wat Nou?</strong></p>
                <ol style="margin: 8px 0 0 0; padding-left: 20px;">
                    <li>Klik op de activatielink</li>
                    <li>Stel je wachtwoord in (minimaal 12 karakters)</li>
                    <li>Je bent automatisch ingelogd!</li>
                    <li>Vul je persoongegevens in</li>
                    <li>Maak je eerste reservering</li>
                </ol>
            </div>

            <div class="section">
                <h2>Wachtwoordvereisten</h2>
                <p>Wanneer je je wachtwoord instelt, zorg ervoor dat het:</p>
                <ul style="color: #666;">
                    <li>Minimaal 12 karakters lang is</li>
                    <li>Minstens één hoofdletter bevat</li>
                    <li>Minstens één getal bevat</li>
                    <li>Minstens één speciaal teken bevat (@, #, $, %, ^, &, *)</li>
                </ul>
            </div>

            <p>Als je vragen hebt, neem dan contact met ons op!</p>

            <p>Tot ziens,<br>
            <strong>Het Windkracht-12 Team</strong></p>
        </div>

        <div class="footer">
            <p>© 2026 Windkracht-12 Kitesurfschool. Alle rechten voorbehouden.</p>
            <p>Dit is een automatisch gegenereerde e-mail. Antwoord niet op dit e-mailbericht.</p>
        </div>
    </div>
</body>
</html>
