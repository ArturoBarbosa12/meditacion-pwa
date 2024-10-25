@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <section id="header"></section>
    <div class="mt-8 overflow-hidden sm:rounded-lg">
        <div class="hero-header">
            <div class="hero-content">
                <h1>Encuentra tu paz interior con nuestra app de meditación.</h1>
                <p>Relájate con sonidos de la naturaleza por el tiempo que tu decidas y
                    encuentra diferentes afirmaciones positivas cada
                    dia.</p>
                <button class="hero-button">
                    <a href="/login">Entrar</a>
                </button>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="features-section">
            <div class="features-header">
                <h2 style="color: #714c4c">Características de nuestra App</h2>
            </div>
            <div class="features-list">
                <div class="feature-item">
                    <h3>Sonidos de la Naturaleza</h3>
                    <p>Escucha diferentes sonidos para relajarte y reducir el estrés.</p>
                </div>
                <div class="feature-item">
                    <h3>Afirmaciones Positivas</h3>
                    <p>Recibe nuevas afirmaciones cada día para mejorar tu bienestar emocional.</p>
                </div>
                <div class="feature-item">
                    <h3>Temporizadores Ajustables</h3>
                    <p>Configura sesiones de meditación por el tiempo que desees.</p>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer id="footer" class="footer-section">
            <p>&copy; 2024 Mindfulness. Todos los derechos reservados.</p>
        </footer>



    </div>
@endsection
