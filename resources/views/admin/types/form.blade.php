@extends('layouts.app')

@section('title', $type->id ? 'Modifica la tipologia' : 'Crea nuova tipologia')

@section('actions')
<div class="my-4">
    <a href="{{ route('admin.types.index') }}" class="btn btn-primary">
        Torna alle tipologie
    </a>

    {{--
    @if ($type->id)
        <a href="{{ route('admin.types.show', $type) }}" class="btn btn-primary ms-3">
            Mostra tipologia
        </a>   
    @endif--}}
</div>
@endsection

@section('content')

@include('layouts.partials.errors')

<section class="card">
    <div class="card-body">

    @if ($type->id)
        <form method="POST" action="{{ route('admin.types.update', $type) }}" class="row" enctype="multipart/form-data">
        @method('put')
    @else
        <form method="POST" action="{{ route('admin.types.store') }}" class="row" enctype="multipart/form-data">
    @endif        
        @csrf
        
        <div class="col">
            <label for="label" class="form-label">Label</label>
            <input type="text" name="label" id="label" class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $type->label) }}" />
            @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-1">
            <label for="color" class="form-label">Label</label>
            <input type="color" name="color" id="color" class="form-control @error('label') is-invalid @enderror" value="{{ old('color', $type->color) }}" />
            @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col">
                <input class="btn btn-primary mt-3" type="submit" value="salva"/>
            </div>
        </div>

        </form>
    </div>
</section>
@endsection
