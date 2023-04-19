@extends("layouts.app")

@section('title', $type->label)

@section('actions')
    <div class="my-4">
        <a class="btn btn-primary me-2" href="{{ route('admin.types.index') }}">Torna ai tipologia</a>
        <a class="btn btn-primary" href="{{ route('admin.types.edit', $type) }}">Modifica tipologia</a>
    </div>
@endsection

@section('content')

    <section class="card">
        <div class="card-body ">
            <p>
                <strong>Tipologia: </strong>
                <span class="badge rounded-pill" style="background-color: {{ $project->type?->color }}">
                    {{ $type->color }}   
                </span>
                {{ $type->label }} 
            </p>
        </div>
    </section> 

@endsection