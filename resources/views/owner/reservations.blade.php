@extends('layouts.app')

@section('title', 'Reserveringen Beheren - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Onbetaalde Reserveringen</h1>
    </div>

    @if($reservations->count() > 0)
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Klant</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Pakket</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Locatie</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Bedrag</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Datum</th>
                        <th style="padding: 1rem; text-align: left; color: #6b7280; font-weight: 600; font-size: 0.9rem;">Actie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 1rem; color: #1f2937;">{{ $reservation->customer->email }}</td>
                        <td style="padding: 1rem; color: #1f2937;">{{ $reservation->package->name }}</td>
                        <td style="padding: 1rem; color: #1f2937;">{{ $reservation->location->name }}</td>
                        <td style="padding: 1rem; color: #1f2937; font-weight: 600;">€{{ $reservation->total_price }}</td>
                        <td style="padding: 1rem; color: #1f2937;">{{ $reservation->created_at->format('d-m-Y') }}</td>
                        <td style="padding: 1rem;">
                            <form action="{{ route('owner.confirm-payment', $reservation->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: #d1fae5; color: #065f46; border: none; padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; cursor: pointer;">Betaling Bevestigen</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666;">Alle reserveringen zijn betaald!</p>
        </div>
    @endif
</div>
@endsection
