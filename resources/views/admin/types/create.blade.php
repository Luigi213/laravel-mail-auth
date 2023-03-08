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
            <form method="POST" action="{{route('admin.types.store')}}">
                @csrf 

                <div class="form-group my-2">
                    <label class="fs-2 fw-semibold" for="nome">Titolo</label>
                    <input type="text" class="form-control" name="name" id="nome" placeholder="Inserire Titolo">
                    @error('name')
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