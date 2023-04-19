<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $types = Type::all();
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'image' => 'nullable|image',
                'text' => 'required|string',
                'published' => 'boolean',
                'type_id' => 'nullable|exists:types,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo deve essere una stringa',
                'title.max' => 'Il titolo non può avere più 100 caratteri',
                'image.image' => 'L\'immagine deve essere un\'immagine',
                'text.required' => 'La descrizione è obbligatoria',
                'text.string' => 'La descrizione deve essere una stringa',
                'type_id.exists' => 'L\'id del tipo non è valido',
            ]
        );

        $data = $request->all();

        if (Arr::exists($data, 'image')) {
            $path = Storage::put('uploads/projects', $data['image']);
            //$data['image'] = $path;
        }

        $project = new Project;
        $project->fill($data);
        $project->slug = Project::generateSlug($project->title);
        $project->image = $path;
        $project->save();

        return to_route('admin.projects.show', $project)
            ->with('message', 'Progetto creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'image' => 'nullable|image',
                'text' => 'required|string',
                'published' => 'boolean',
                'type_id' => 'nullable|exists:types,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo deve essere una stringa',
                'title.max' => 'Il titolo non può avere più 100 caratteri',
                'image.image' => 'L\'immagine deve essere un\'immagine',
                'text.required' => 'La descrizione è obbligatoria',
                'text.string' => 'La descrizione deve essere una stringa',
                'type_id.exists' => 'L\'id del tipo non è valido',
            ]
        );

        $data = $request->all();
        $data['slug'] = Project::generateSlug($data['title']);
        $data['published'] = $request->has('published') ? 1 : 0;

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $path = Storage::put('uploads/projects', $data['image']);
            $data['image'] = $path;
        }

        $project->update($data);

        return to_route('admin.projects.show', $project)
            ->with('message', 'Progetto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $id_project = $project->id;
        //if ($project->image) Storage::delete($project->image);
        $project->delete();

        return to_route('admin.projects.index')
            ->with('message_type', 'danger')
            ->with('message', "Progetto $id_project è stato spostato nel cestino");
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('admin.projects.trash', compact('projects'));
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(int $id)
    {
        $project = Project::where('id', $id)->onlyTrashed()->first();
        //$id_project = $project->id;

        if ($project->image) Storage::delete($project->image);
        $project->forceDelete();

        return to_route('admin.projects.trash')
            ->with('message_type', 'danger')
            ->with('message', "Progetto $id eliminito!");
    }
    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $project = Project::where('id', $id)->onlyTrashed()->first();
        //$id_project = $project->id;

        $project->restore();

        return to_route('admin.projects.index')
            ->with('message', "Progetto $id ripristinato correttamente");
    }
}
