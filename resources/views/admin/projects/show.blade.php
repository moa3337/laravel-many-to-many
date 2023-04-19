@extends("layouts.app")

@section('title', $project->title)

@section('actions')
    <div class="my-4">
        <a class="btn btn-primary me-2" href="{{ route('admin.projects.index') }}">Torna ai progetti</a>
        <a class="btn btn-primary" href="{{ route('admin.projects.edit', $project) }}">Modifica progetto</a>
    </div>
@endsection

@section('content')

    <section class="card">
        <div class="card-body ">
            <h3></h3>
            <p>
                <strong>Categoria: </strong>
                <span class="badge rounded-pill" style="background-color: {{ $project->type?->color }}">
                    {{ $project->type?->label }}   
                </span>
            </p>
            <figure class="float-end">
                <img src="{{ $project->getImageUri() }}" class="w-50" alt="{{ $project->slug }}">
                <figcaption>
                    <p class="text-muted">{{ $project->title }}</p>
                </figcaption>
            </figure>
            <p>{{ $project->text }}</p>
        </div>
    </section> 

@endsection