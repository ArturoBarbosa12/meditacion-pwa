@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>Panel de Administración</h1>
        <div class="row mt-4">
            <div class="col-md-6 mt-1">
                <div class="panel meditar-panel">
                    <a href="{{ route('admin.meditations') }}">
                        <h2>Gestionar Meditaciones</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-6 mt-1">
                <div class="panel afirmaciones-panel">
                    <a href="{{ route('admin.affirmations') }}">
                        <h2>Gestionar Afirmaciones</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
