@extends("layouts.app")

@section('title', 'Trash Projects')

@section('actions')
<div>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary my-2">
        Torna ai progetti
    </a>
</div>
@endsection

@section('content')
    {{--@dump($projects)--}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">
                    Creazione
                    <a href="created_at"></a>
                </th>
                <th scope="col">
                    Ultima modifica
                    <a href="{{'updated_at' != 'DESC'}}"></a>
                </th>
                <th scope="col">
                    Data cancellazione
                    <a href="deleted_at"></a>
                </th>
                <th scope="col">
                    Elimina
                    <a href="created_at"></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
            <tr>
                <th scope="row">{{ $project->id }}</th>
                <td>{{ $project->title }}</td>
                <td>{{ $project->getAbstract() }}</td>
                <td>{{ $project->creted_at }}</td>
                <td>{{ $project->updated_at }}</td>
                <td>{{ $project->deleted_at }}</td>
                <td>
                    {{--
                    <a href="{{ route('admin.projects.show', $project) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                    --}}
                    
                    <a href="#" data-bs-toggle="modal" data-bs-target="#restore-post-modal-{{ $project->id }}"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="custom-tooltip"
                        data-bs-title="This is a top tooltip.">
                        <i class="bi bi-pencil mx-2 text-primary"></i>
                    </a>

                     <a href="#" data-bs-toggle="modal" data-bs-target="#delete-post-modal-{{ $project->id }}"
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
    {{--{{ $projects->links() }}--}}
@endsection

@section('modals')
@foreach ($projects as $project)
    
    <div class="modal fade" id="delete-post-modal-{{ $project->id }}" tabindex="-1" 
        aria-labelledby="delete-post-modal-{{ $project->id }}-label" aria-hidden= "true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete-post-modal-{{ $project->id }}-label">
                        Stai eliminando questo progetto!
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare "{{ $project->title }}"?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form method="POST" action="{{ route('admin.projects.force-delete', $project) }}">
                        @method('delete')
                        @csrf

                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restore-post-modal-{{ $project->id }}" tabindex="-1" 
        aria-labelledby="restore-post-modal-{{ $project->id }}-label" aria-hidden= "true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="restore-post-modal-{{ $project->id }}-label">
                        Stai ripristinando questo progetto!
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler ripristinare "{{ $project->title }}"?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form method="POST" action="{{ route('admin.projects.restore', $project) }}">
                        @method('put')
                        @csrf

                        <button type="submit" class="btn btn-primary">Ripristina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endforeach
@endsection