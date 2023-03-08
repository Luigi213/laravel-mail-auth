@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($type->projects as $project)
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card ">
                <img src="https://picsum.photos/seed/picsum/150/100" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->titolo }}-{{ $project->id}}</h5>
                    <p class="card-text">{{ $project->descrizione}}</p>
                </div>
            </div>  
        </div>
        @endforeach
    </div>
</div>
@endsection