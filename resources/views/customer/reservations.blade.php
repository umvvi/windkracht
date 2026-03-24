@extends('layouts.app')

@section('title', 'Mijn Reserveringen - Windkracht-12')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Mijn Reserveringen</h1>
    </div>

    @if ($reservations->count() > 0)
        <div style="display: grid; gap: 1.5rem;">
            @foreach ($reservations as $reservation)
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 2rem; border-left: 4px solid #0369a1;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">PAKKET</p>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $reservation->package->name }}</p>
                    </div>
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">LOCATIE</p>
                        <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $reservation->location->name }}</p>
                    </div>
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">STATUS</p>
                        <p style="margin: 0;">
                            @if (!$reservation->payment_received)
                                <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: #fef3c7; color: #92400e;">Wachtend op Betaling</span>
                            @else
                                <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: #d1fae5; color: #065f46;">Bevestigd</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">BETALING</p>
                        <p style="margin: 0;">
                            <span style="padding: 0.4rem 0.8rem; border-radius: 0.3rem; font-size: 0.85rem; font-weight: 600; background: {{ $reservation->payment_received ? '#d1fae5' : '#fee2e2' }}; color: {{ $reservation->payment_received ? '#065f46' : '#7f1d1d' }};">{{ $reservation->payment_received ? 'Betaald' : 'Openstaand' }}</span>
                        </p>
                    </div>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem; margin-bottom: 1.5rem;">
                    <p style="color: #1f2937; margin: 0 0 1rem 0;"><strong>Totale Prijs:</strong> €{{ $reservation->total_price }}</p>

                    @if (!$reservation->payment_received)
                    <div style="background: #fef3c7; border: 1px solid #fcd34d; color: #78350f; padding: 1rem; border-radius: 0.3rem; margin-bottom: 1rem;">
                        <p style="font-weight: 700; margin: 0 0 0.5rem 0;">Betaling Vereist</p>
                        <p style="margin: 0 0 0.5rem 0;">Maak een overschrijving van €{{ $reservation->total_price }} naar onze bankrekening.</p>
                        <p style="margin: 0; font-size: 0.9rem;">De eigenaar zal uw betaling bevestigen zodra deze is ontvangen.</p>
                    </div>
                    @endif
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                    <h3 style="font-weight: 700; margin: 0 0 1rem 0; color: #003d7a;">Geplande Lessen</h3>
                    @if ($reservation->lessons->count() > 0)
                        <div style="display: grid; gap: 0.75rem;">
                            @foreach ($reservation->lessons as $lesson)
                            <div style="background: #f9fafb; padding: 1rem; border-radius: 0.3rem; display: flex; justify-content: space-between; align-items: center;">
                                <div style="flex: 1;">
                                    <p style="font-weight: 700; color: #003d7a; margin: 0 0 0.25rem 0;">{{ $lesson->start_time->format('d-m-Y H:i') }}</p>
                                    <p style="font-size: 0.9rem; color: #666; margin: 0;">Instructeur: {{ $lesson->instructor->personalInformation?->full_name ?? 'Unknown' }}</p>
                                    <span style="display: inline-block; margin-top: 0.5rem; padding: 0.2rem 0.6rem; border-radius: 0.3rem; background: {{ $lesson->status === 'scheduled' ? '#dbeafe' : '#fee2e2' }}; color: {{ $lesson->status === 'scheduled' ? '#0c4a6e' : '#7f1d1d' }}; font-size: 0.8rem; font-weight: 600;">{{ $lesson->status === 'scheduled' ? 'Ingepland' : ($lesson->status === 'cancelled' ? 'Afgebroken' : ucfirst($lesson->status)) }}</span>
                                    @if ($lesson->status === 'cancelled' && $lesson->cancellation_status === 'pending')
                                    <span style="display: inline-block; margin-left: 0.5rem; padding: 0.2rem 0.6rem; border-radius: 0.3rem; background: #fef3c7; color: #78350f; font-size: 0.8rem; font-weight: 600; margin-top: 0.5rem;">Wacht op Goedkeuring</span>
                                    @endif
                                </div>
                                @if ($lesson->status === 'scheduled')
                                <button 
                                    type="button" 
                                    onclick="openCancelModal({{ $lesson->id }}, '{{ $reservation->id }}')"
                                    style="color: #dc2626; background: none; border: none; cursor: pointer; text-decoration: underline; font-size: 0.9rem; font-weight: 600;">
                                    Les Afzeggen
                                </button>
                                @elseif ($lesson->status === 'cancelled')
                                <a href="{{ route('customer.reschedule-lesson', $lesson->id) }}" style="color: #0369a1; background: none; border: none; cursor: pointer; text-decoration: underline; font-size: 0.9rem; font-weight: 600;">
                                    Nieuwe Datum Kiezen
                                </a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #666;">Nog geen lessen ingepland</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 3rem 2rem; text-align: center;">
            <p style="color: #666; margin-bottom: 1.5rem;">Nog geen reserveringen</p>
            <a href="{{ route('customer.make-reservation') }}" style="background: #ff6b35; color: white; padding: 0.75rem 1.5rem; border-radius: 0.3rem; text-decoration: none; font-weight: 700; display: inline-block;" onmouseover="this.style.background='#ff5520'" onmouseout="this.style.background='#ff6b35'">
                Maak je Eerste Reservering
            </a>
        </div>
    @endif
</div>

<!-- Cancel Lesson Modal -->
<div id="cancelModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15); max-width: 500px; width: 90%; padding: 2rem;">
        <h2 style="font-size: 1.3rem; font-weight: 700; color: #003d7a; margin: 0 0 1rem 0;">Les Afzeggen</h2>
        <p style="color: #666; margin-bottom: 1.5rem;">Voer de reden in waarom je deze les wilt afzeggen. De eigenaar van Windkracht-12 zal je aanvraag beoordelen en je via e-mail laten weten of deze is goedgekeurd.</p>
        
        <form id="cancelForm" method="POST" style="display: none;">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label for="cancelReason" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Reden voor Annulering</label>
                <textarea 
                    id="cancelReason" 
                    name="reason" 
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-family: inherit; font-size: 0.95rem; min-height: 100px;"
                    placeholder="Bijv. onverwachte werkverplichtingen, gezondheid, etc."
                    required
                ></textarea>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button 
                    type="button" 
                    onclick="closeCancelModal()"
                    style="padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; border-radius: 0.3rem; background: white; color: #1f2937; font-weight: 600; cursor: pointer;"
                >
                    Annuleren
                </button>
                <button 
                    type="submit" 
                    style="padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; background: #dc2626; color: white; font-weight: 600; cursor: pointer;"
                >
                    Bevestigen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCancelModal(lessonId, reservationId) {
        const modal = document.getElementById('cancelModal');
        const form = document.getElementById('cancelForm');
        form.action = `{{ route('customer.cancel-lesson', ':id') }}`.replace(':id', lessonId);
        form.style.display = 'block';
        modal.style.display = 'flex';
    }

    function closeCancelModal() {
        document.getElementById('cancelModal').style.display = 'none';
        document.getElementById('cancelForm').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('cancelModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeCancelModal();
    });
</script>
@endsection
