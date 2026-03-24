@extends('layouts.app')

@section('title', 'Annuleringsaanvragen - Windkracht-12 Beheer')

@section('content')
<div style="margin-bottom: 3rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0;">Annuleringsaanvragen</h1>
        <p style="color: #666; margin: 0.5rem 0 0 0;">Beheer klantaanvragen voor lesannuleringen</p>
    </div>

    <!-- Pending Cancellations -->
    <div style="margin-bottom: 3rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #ff6b35; margin: 0 0 1.5rem 0;">
            ⏳ In Afwachting van Goedkeuring
            <span style="font-size: 0.9rem; background: #fff3cd; padding: 0.25rem 0.75rem; border-radius: 0.3rem; color: #856404; margin-left: 1rem;">{{ $pendingCancellations->count() }}</span>
        </h2>

        @if ($pendingCancellations->count() > 0)
            <div style="display: grid; gap: 1.5rem;">
                @foreach ($pendingCancellations as $lesson)
                <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; border-left: 4px solid #ff6b35;">
                    <div style="padding: 2rem;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                            <div>
                                <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">KLANT</p>
                                <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $lesson->reservation->customer->personalInformation?->full_name ?? 'Onbekend' }}</p>
                            </div>
                            <div>
                                <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">LES DATUM</p>
                                <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $lesson->start_time->format('d-m-Y H:i') }}</p>
                            </div>
                            <div>
                                <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">PAKKET</p>
                                <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $lesson->reservation->package->name }}</p>
                            </div>
                            <div>
                                <p style="color: #6b7280; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0 0 0.5rem 0;">INSTRUCTEUR</p>
                                <p style="font-size: 1.1rem; font-weight: 700; color: #003d7a; margin: 0;">{{ $lesson->instructor->personalInformation?->full_name ?? 'Onbekend' }}</p>
                            </div>
                        </div>

                        <div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 0.3rem; padding: 1rem; margin-bottom: 1.5rem;">
                            <p style="color: #78350f; font-weight: 700; margin: 0 0 0.5rem 0;">Reden voor Annulering:</p>
                            <p style="color: #666; margin: 0; font-style: italic;">{{ $lesson->cancellation_reason }}</p>
                        </div>

                        <div style="display: flex; gap: 1rem;">
                            <form action="{{ route('owner.approve-cancellation', $lesson->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                <button type="submit" style="width: 100%; padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; background: #10b981; color: white; font-weight: 700; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">
                                    ✓ Goedkeuren
                                </button>
                            </form>
                            
                            <button type="button" onclick="openRejectModal({{ $lesson->id }})" style="flex: 1; padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; background: #dc2626; color: white; font-weight: 700; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                                ✗ Afwijzen
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Reject Modal (for each lesson) -->
                <div id="rejectModal{{ $lesson->id }}" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
                    <div style="background: white; border-radius: 0.3rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15); max-width: 500px; width: 90%; padding: 2rem;">
                        <h3 style="font-size: 1.2rem; font-weight: 700; color: #003d7a; margin: 0 0 1rem 0;">Reden voor Afwijzing</h3>
                        <p style="color: #666; margin-bottom: 1rem;">Voer de reden in waarom je deze annulering afwijst. Dit zal naar de klant worden gestuurd.</p>
                        
                        <form action="{{ route('owner.reject-cancellation', $lesson->id) }}" method="POST">
                            @csrf
                            <textarea 
                                name="rejection_reason" 
                                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.3rem; font-family: inherit; font-size: 0.95rem; min-height: 100px; box-sizing: border-box;"
                                placeholder="Bijv. Les kan niet worden geannuleerd vanwege beleid, of andere redenen..."
                                required
                            ></textarea>

                            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1rem;">
                                <button 
                                    type="button" 
                                    onclick="closeRejectModal({{ $lesson->id }})"
                                    style="padding: 0.75rem 1.5rem; border: 1px solid #d1d5db; border-radius: 0.3rem; background: white; color: #1f2937; font-weight: 600; cursor: pointer;"
                                >
                                    Annuleren
                                </button>
                                <button 
                                    type="submit" 
                                    style="padding: 0.75rem 1.5rem; border: none; border-radius: 0.3rem; background: #dc2626; color: white; font-weight: 600; cursor: pointer;"
                                >
                                    Afwijzen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div style="background: white; border-radius: 0.3rem; padding: 2rem; text-align: center; color: #666;">
                <p style="margin: 0;">Geen annuleringen in afwachting</p>
            </div>
        @endif
    </div>

    <!-- Approved Cancellations -->
    @if ($approvedCancellations->count() > 0)
    <div style="margin-bottom: 3rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #10b981; margin: 0 0 1.5rem 0;">✓ Goedgekeurd ({{ $approvedCancellations->count() }})</h2>
        <div style="display: grid; gap: 1rem;">
            @foreach ($approvedCancellations as $lesson)
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #10b981; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-weight: 700; color: #003d7a; margin: 0;">{{ $lesson->reservation->customer->personalInformation?->full_name }} - {{ $lesson->start_time->format('d-m-Y H:i') }}</p>
                    <p style="color: #666; font-size: 0.9rem; margin: 0.25rem 0 0 0;">{{ $lesson->reservation->package->name }}</p>
                </div>
                <span style="padding: 0.25rem 0.75rem; border-radius: 0.3rem; background: #d1fae5; color: #065f46; font-size: 0.85rem; font-weight: 600;">Goedgekeurd</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Rejected Cancellations -->
    @if ($rejectedCancellations->count() > 0)
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #dc2626; margin: 0 0 1.5rem 0;">✗ Afgewezen ({{ $rejectedCancellations->count() }})</h2>
        <div style="display: grid; gap: 1rem;">
            @foreach ($rejectedCancellations as $lesson)
            <div style="background: white; border-radius: 0.3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; border-left: 4px solid #dc2626; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-weight: 700; color: #003d7a; margin: 0;">{{ $lesson->reservation->customer->personalInformation?->full_name }} - {{ $lesson->start_time->format('d-m-Y H:i') }}</p>
                    <p style="color: #666; font-size: 0.9rem; margin: 0.25rem 0 0 0;">{{ $lesson->reservation->package->name }}</p>
                </div>
                <span style="padding: 0.25rem 0.75rem; border-radius: 0.3rem; background: #fee2e2; color: #7f1d1d; font-size: 0.85rem; font-weight: 600;">Afgewezen</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
    function openRejectModal(lessonId) {
        document.getElementById('rejectModal' + lessonId).style.display = 'flex';
    }

    function closeRejectModal(lessonId) {
        document.getElementById('rejectModal' + lessonId).style.display = 'none';
    }

    // Close modals when clicking outside
    document.querySelectorAll('[id^="rejectModal"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                const lessonId = this.id.replace('rejectModal', '');
                closeRejectModal(lessonId);
            }
        });
    });
</script>
@endsection
