@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 mt-1">
                <div class="panel meditar-panel">
                    <a href="{{ route('meditations.index') }}">
                        <h2>Meditar</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-6 mt-1">
                <div class="panel afirmaciones-panel">
                    <a href="{{ route('affirmations.index') }}">
                        <h2>Afirmaciones</h2>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
