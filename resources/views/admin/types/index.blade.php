@extends("layouts.app")

@section('title', 'Tipologie')

@section('actions')
<div>
    <a href="{{ route('admin.types.create') }}" class="btn btn-primary my-2">
        Crea nuovo tipologia
    </a>
</div>
@endsection

@section('content')
    {{--@dump($projects)--}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Tipologia</th>
                <th scope="col">Codice colore</th>
                <th scope="col">Pill</th>
                <th scope="col">
                    Creazione
                    <a href="created_at"></a>
                </th>
                <th scope="col">
                    Ultima modifica
                    <a href="updated_at"></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($types as $type)
            <tr>
                <th scope="row">{{ $type->id }}</th>
                <td>{{ $type->label }}</td>
                <td>
                    <span class="color-preview">
                        {{ $type->color }}
                    </span>
                </td>
                <td>
                    <span class="badge rounded-pill" style="background-color: {{ $type->color }}">
                        {{ $type->label }}
                    </span>
                </td>
                <td>{{ $type->created_at }}</td>
                <td>{{ $type->updated_at }}</td>
                <td>
                    {{--
                    <a href="{{ route('admin.typets.show', $type) }}">
                        <i class="bi bi-eye"></i>
                    </a>--}}
                    <a href="{{ route('admin.types.edit', $type) }}">
                        <i class="bi bi-pencil mx-2"></i>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete-type-modal-{{ $type->id }}"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="custom-tooltip"
                        data-bs-title="This is a top tooltip.">
                        <i class="bi bi-trash mx-2 text-danger"></i>
                    </a>
                </td>
            </tr>
            
            @empty
            
            @endforelse
        </tbody>
    </table> 
    {{ $types->links() }}
@endsection

@section('modals')
@foreach ($types as $type)
    
    <div class="modal fade" id="delete-type-modal-{{ $type->id }}" tabindex="-1" 
        aria-labelledby="delete-type-modal-{{ $type->id }}-label" aria-hidden= "true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete-type-modal-{{ $type->id }}-label">
                        Stai eliminando questa tipologia!
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare "{{ $type->title }}"?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form method="POST" action="{{ route('admin.types.destroy', $type) }}">
                        @method('delete')
                        @csrf

                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endforeach
@endsection