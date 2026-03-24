@extends('layouts.app')

@section('title', 'Windkracht-12 - Premium Kitesurfschool')

@section('content')
<!-- Full Width Hero Section -->
<div style="
    position: relative;
    height: 700px;
    background: linear-gradient(rgba(3, 105, 161, 0.4), rgba(14, 165, 233, 0.4)),
                url('{{ asset('images/hero.png') }}') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin: 0 0 3rem 0;
    overflow: hidden;
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
">
    <!-- IMAGE PLACEHOLDER: Replace URL with your hero image -->
    <div style="
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        text-align: center;
        position: relative;
        z-index: 2;
    ">
        <h1 style="
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        ">
            BEHEERS DE <span style="color: #ff6b35;">WIND</span> & GOLVEN
        </h1>
        <p style="
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.98;
        ">
            Professionele kitesurfles voor alle niveaus op de mooiste Nederlands plekken
        </p>
        <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
            @guest
                <a href="{{ route('register') }}" style="
                    background: #ff6b35;
                    color: white;
                    padding: 1rem 2.5rem;
                    border-radius: 0.3rem;
                    font-weight: 700;
                    text-decoration: none;
                    display: inline-block;
                    transition: all 0.3s;
                    cursor: pointer;
                    font-size: 1rem;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                " onmouseover="this.style.background='#ff5520'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#ff6b35'; this.style.transform='translateY(0)'">
                    Nu Registreren
                </a>
                <a href="{{ route('login') }}" style="
                    background: transparent;
                    color: white;
                    border: 2px solid white;
                    padding: 0.85rem 2.5rem;
                    border-radius: 0.3rem;
                    font-weight: 700;
                    text-decoration: none;
                    display: inline-block;
                    transition: all 0.3s;
                    cursor: pointer;
                    font-size: 1rem;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                " onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='transparent'; this.style.transform='translateY(0)'">
                    Inloggen
                </a>
            @else
                <a href="{{ route('customer.make-reservation') }}" style="
                    background: #ff6b35;
                    color: white;
                    padding: 1rem 2.5rem;
                    border-radius: 0.3rem;
                    font-weight: 700;
                    text-decoration: none;
                    display: inline-block;
                    transition: all 0.3s;
                    font-size: 1rem;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                " onmouseover="this.style.background='#ff5520'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#ff6b35'; this.style.transform='translateY(0)'">
                    Nu Boeken
                </a>
            @endguest
        </div>
    </div>
</div>

<!-- Programs Section -->
<div style="margin-bottom: 4rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h2 style="font-size: 2.5rem; font-weight: 800; color: #003d7a; margin: 0 0 0.5rem 0;">ONZE LESPAKKETTEN</h2>
        <div style="height: 2px; width: 50px; background: #ff6b35; margin: 0.5rem auto 0;"></div>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; max-width: 900px; margin: 0 auto;">
        <!-- Program Card 1: BEGINNER -->
        <div style="
            background: white;
            border-radius: 0.3rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
            border: 1px solid #e5e7eb;
        " onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
            <img src="{{ asset('images/beginner.png') }}" alt="Beginner Kitesurfing" style="width: 100%; height: 180px; object-fit: cover; display: block;">
            <div style="padding: 1.5rem;">
                <span style="
                    display: inline-block;
                    background: #f3f4f6;
                    color: #003d7a;
                    padding: 0.4rem 0.8rem;
                    border-radius: 0.2rem;
                    font-size: 0.75rem;
                    font-weight: 700;
                    margin-bottom: 1rem;
                    text-transform: uppercase;
                ">BEGINNER</span>
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Ontdekkingscursus</h3>
                <p style="color: #666; margin-bottom: 1rem; font-size: 0.9rem; line-height: 1.5;">
                    Leer de basisvaardigheden van kitesurfen in veilige, ondiepe wateren.
                </p>
                <p style="color: #ff6b35; font-weight: 700; margin-bottom: 1rem;">Vanaf €120</p>
                <a href="{{ route('packages') }}" style="
                    display: block;
                    text-align: center;
                    border: 1px solid #d1d5db;
                    color: #003d7a;
                    padding: 0.7rem;
                    border-radius: 0.3rem;
                    font-weight: 600;
                    text-decoration: none;
                    transition: all 0.3s;
                    font-size: 0.9rem;
                " onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#003d7a'" onmouseout="this.style.background='transparent'; this.style.borderColor='#d1d5db'">
                    Details
                </a>
            </div>
        </div>

        <!-- Program Card 2: ADVANCED -->
        <div style="
            background: white;
            border-radius: 0.3rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
            border: 1px solid #e5e7eb;
        " onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
            <img src="{{ asset('images/advanced.png') }}" alt="Advanced Kitesurfing" style="width: 100%; height: 180px; object-fit: cover; display: block;">
            <div style="padding: 1.5rem;">
                <span style="
                    display: inline-block;
                    background: #fef3e8;
                    color: #ff6b35;
                    padding: 0.4rem 0.8rem;
                    border-radius: 0.2rem;
                    font-size: 0.75rem;
                    font-weight: 700;
                    margin-bottom: 1rem;
                    text-transform: uppercase;
                ">ADVANCED</span>
                <h3 style="font-size: 1.2rem; font-weight: 700; color: #003d7a; margin: 0 0 0.5rem 0;">Pro Training</h3>
                <p style="color: #666; margin-bottom: 1rem; font-size: 0.9rem; line-height: 1.5;">
                    Master tricks en technische manoeuvres met onze gecertificeerde instructeurs.
                </p>
                <p style="color: #ff6b35; font-weight: 700; margin-bottom: 1rem;">Vanaf €180</p>
                <a href="{{ route('packages') }}" style="
                    display: block;
                    text-align: center;
                    border: 1px solid #d1d5db;
                    color: #003d7a;
                    padding: 0.7rem;
                    border-radius: 0.3rem;
                    font-weight: 600;
                    text-decoration: none;
                    transition: all 0.3s;
                    font-size: 0.9rem;
                " onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#003d7a'" onmouseout="this.style.background='transparent'; this.style.borderColor='#d1d5db'">
                    Details
                </a>
            </div>
        </div>
    </div>

    </div>
</div>

<!-- CTA Section -->
<div style="
    background: linear-gradient(135deg, #003d7a 0%, #0369a1 100%);
    border-radius: 0.3rem;
    padding: 3rem 2rem;
    text-align: center;
    color: white;
">
    <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 0.5rem;">KLAAR OM TE BEGINNEN?</h2>
    <p style="font-size: 1rem; margin-bottom: 2rem; opacity: 0.95;">
        Maak vandaag je reservering. Plaatsen zijn beperkt!
    </p>
    @guest
        <a href="{{ route('register') }}" style="
            display: inline-block;
            background: #ff6b35;
            color: white;
            padding: 0.9rem 2.5rem;
            border-radius: 0.3rem;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            font-size: 0.95rem;
        " onmouseover="this.style.background='#ff5520'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#ff6b35'; this.style.transform='translateY(0)'">
            Account Aanmaken
        </a>
    @else
        <a href="{{ route('customer.make-reservation') }}" style="
            display: inline-block;
            background: #ff6b35;
            color: white;
            padding: 0.9rem 2.5rem;
            border-radius: 0.3rem;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
            transition: all 0.3s;
        " onmouseover="this.style.background='#ff5520'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#ff6b35'; this.style.transform='translateY(0)'">
            Reservering Maken
        </a>
    @endguest
</div>
@endsection

