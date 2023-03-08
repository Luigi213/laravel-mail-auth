@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach                        
                    </ul>
                @endif
                <form method="POST" action="{{route('admin.projects.update', $project->titolo)}}" enctype="multipart/form-data">
                    @csrf  

                    @method('PUT')
                    <div class="form-group my-2">
                        <label class="fs-2 fw-semibold" for="title">Titolo</label>
                        <input type="text" class="form-control" name="titolo" id="title" value="{{old('titolo') ?? $project->titolo}}" placeholder="Inserire Titolo">
                        @error('titolo')
                            <div class="mt-2 alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label class="fs-2 fw-semibold form-label" for="immagine">Immagini</label>
                        <div class="my-3">
                            <img src="{{ asset('storage/' .$project->post_image)}}">
                        </div>
                        <input type="file" class="form-control" name="post_image" id="immagine">
                        @error('post_image')
                            <div class="mt-2 alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label class="fs-2 fw-semibold" for="tipo">Tipo</label>
                        <select class="d-block" name="type_id" id="tipo">
                            <option value="">Seleziona tipo</option>
                            @foreach ($types as $type)                                
                            <option value="{{$type->id}}" {{ $type->id == old('type_id', $project->type_id) ? 'selected' : ''}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-2">
                        @foreach ($technologies as $technology)
                        <div class="form-check @error('technologies')
                            is-invalid
                        @enderror">
                            @if ($errors->any())                    
                            <input class="form-check-input" type="checkbox" value="{{ $technology->id }}" name='technologies[]' {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                {{ $technology->name_tech }}
                            </label>
                            @else
                            <input class="form-check-input" type="checkbox" value="{{ $technology->id }}" name='technologies[]' {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                {{ $technology->name_tech }}
                            </label>
                            @endif
                        </div>                        
                        @endforeach
                    </div>
                    <div class="form-group my-2">
                        <label class="fs-2 fw-semibold" for="description">Descrizione</label>
                        <textarea type="password" class="form-control" name="descrizione" id="description" value="{!!nl2br( old('descrizione') ?? $project->descrizione )!!}" placeholder="Inserire Descrizione">{{old('descrizione') ?? $project->descrizione}}</textarea>
                        @error('descrizione')
                            <div class="mt-2 alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection