<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Functions\Helper;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use App\Models\Technology;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = Project::orderBy('id', 'desc')->paginate(5);

        return view('admin.projects.index', compact('projects'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);


        //se esiste image la salvo nel file systame e nel database
        if(array_key_exists('image', $form_data)){
            //prima di salvare l'image prendo il nome del file per salvarlo nel database
            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
            //salvo il file nello storage, rinominandolo
            $form_data['image'] = Storage::put('uploads', $form_data['image']);
        }

        $new_project = Project::create($form_data);

        if(array_key_exists('technologies', $form_data)){
            $new_project->technologies()->attach($form_data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project)->with('success', 'Il nuovo progetto è stato creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {

    $form_data = $request->all();

    if ($project->title === $form_data['title']) {
        $form_data['slug'] = $project->slug;
    } else {
        $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);
    }

    //verifico se esiste l'immagine che vado a mettere esiste già, in quel caso ELIMINO la vecchia
    if(array_key_exists('image', $form_data)){
        if ($project->image) {
            Storage::disk('public')->delete( $project->image);
        }
        //prima di salvare l'image prendo il nome del file per salvarlo nel database
        $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
        //salvo il file nello storage, rinominandolo
        $form_data['image'] = Storage::put('uploads/', $form_data['image']);
    }

    if(array_key_exists('technologies', $form_data)){
        $project->technologies()->sync($form_data['technologies']);
    }else{
        $project->technologies()->detach();
    }

    $project->update($form_data);

    return redirect()->route('admin.projects.show', $project)->with('success', 'Progetto aggiornato con successo');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //se il progetto ha una immagine la cancello dalla cartella
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        //passaggi standard
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo');

    }
}
