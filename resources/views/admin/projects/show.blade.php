@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-danger">{{ $project->titolo}}</h1>
                <div class="mt-3">      
                    <div class="my-3">
                        <img src="{{ asset('storage/' .$project->post_image)}}">
                    </div>  
                    <h5>Descrizione</h5>
                    <p>{{ $project->descrizione}}</p>
                    <h5>Tipo</h5>
                    <p>{{ $project->type ? $project->type->name : 'Nessuna tipologia' }}</p>
                    <h5>Tech</h5>
                    <ul class="list-unstyled">
                        @forelse ($project->technologies as $technology)
                        <li>{{ $technology->name_tech }}</li>
                        @empty
                        <p>Nessun contenuto</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection