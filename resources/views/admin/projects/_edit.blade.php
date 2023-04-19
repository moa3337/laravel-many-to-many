@extends('layouts.app')

@section('title', 'modifica il progetto' . $project->name)

@section('actions')
<div>
    <a href="{{ route('admin.projects.index') }}">
        Torna ai progetti
    </a>
</div>
@endsection

@section('content')

@include('layouts.partials.errors')

<section class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="row">
            @method('PUT')
            @csrf
            
            <div class="col">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $project->title }}">
    
                <label for="image" class="form-label">Image</label>
                <input type="text" name="image" id="image" class="form-control" value="{{ old('image') ?? $project->image }}">
            </div>

            <div class="col">
                <label for="text" class="form-label">Text</label>
                <textarea type="text" name="text" id="text" class="form-control" rows="4">{{ old('text') ?? $project->text }}"</textarea>
            </div>

            <input class="mt-3" type="submit" class="" value="salva"/>

        </form>
    </div>
</section>
@endsection