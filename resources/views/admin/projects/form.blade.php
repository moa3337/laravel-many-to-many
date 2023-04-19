@extends('layouts.app')

@section('title', $project->id ? 'Modifica il progetto' : 'Crea nuovo progetto')

@section('actions')
<div class="my-4">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">
        Torna ai progetti
    </a>

    @if ($project->id)
        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-primary ms-3">
            Mostra progetto
        </a>   
    @endif
</div>
@endsection

@section('content')

@include('layouts.partials.errors')

<section class="card">
    <div class="card-body">

    @if ($project->id)
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="row" enctype="multipart/form-data">
        @method('put')
    @else
        <form method="POST" action="{{ route('admin.projects.store') }}" class="row" enctype="multipart/form-data">
    @endif        
        @csrf
        <div class="row">
            <div class="col-12">
                <label for="published" class="form-label">Vuoi pubblicare il progetto?</label>
                <input class="form-check-input m- @error('published') is-invalid @enderror" 
                    type="checkbox" name="published" id="published" value="1"
                    @checked(old('published', $project->published))
                >
                @error('published')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <hr class="mt-2">
        
        <div class="col">
            <label for="type_id" class="form-label">Type</label>
            <select name="type_id" id="type_id" class="form-select @error ('type_id') is-invalid @enderror" >
                <option value="">Nessun tipo</option>
                @foreach ($types as $type)
                    <option @if(old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">{{ $type->label }}</option>  
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->title) }}" />
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
    
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" />
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="preview mt-2 w-50">
                <img src="{{ $project->getImageUri() }}" class="w-25" id="image-preview" alt="">
            </div>
        </div>

        <div class="col">
            <label for="text" class="form-label">Text</label>
            <textarea type="text" name="text" id="text" class="form-control @error('text') is-invalid @enderror" rows="4">
                {{ old('text', $project->text) }}
            </textarea>
            @error('text')
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

@section('scripts')
    <script>
        const imageInputEl = document.getElementById('image');
        const imagePreviewEl = document.getElementById('image-preview');
        const placehorder = imagePreviewEl.src;
        
        imageInputEl.addEventListener('change', () => {
            if (imageInputEl.files && imageInputEl.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInputEl.files[0]); 
                
                reader.onload = e => {
                    imagePreviewEl.src = e.target.result;
                }
            } else imagePreviewEl.src = placehorder;
        })
    </script>
@endsection