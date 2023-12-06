<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use Illuminate\Support\Str;
use App\Functions\Helper;
use App\Models\Project;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function projectsTechnologies( Technology $technology){

        $projects = $technology->projects;

        return view('admin.technologies.projectTechnologies', compact('projects', 'technology'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $exists = Technology::where('name', $request->name)->first();

        if ($exists) {
            return redirect()->route('admin.technologies.index')->with('error', 'La tecnologia inserita è già presente');
        }else{

            $new_technology = new Technology();
            $new_technology->name = $request->name;
            $new_technology->slug = Str::slug($request->name, '-');
            $new_technology->save();
            return redirect()->route('admin.technologies.index')->with('success', 'Nuova tecnologia inserita correttamente');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $val_data = $request->validate([
            'name' =>'required|max:30|min:3',
        ],
        [
            'name.required' => 'Il nome della tecnologia è obbligatorio',
            'name.max' => 'Il nome della tecnologia deve essere massimo 30 caratteri',
            'name.min' => 'Il nome della tecnologia deve essere minimo 3 caratteri',
        ]);

        //controllo SLUG------------------
        $exists = Technology::where('name', $request->name)->first();
        if($exists){
            return redirect()->route('admin.technologies.index')->with('error', 'Il nome della tecnologia inserita è già presente');
        }
        $val_data['slug'] = Helper::generateSlug($request->name, Technology::class);
        //--controllo SLUG----------------

        $technology->update($val_data);
        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia aggiornata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {

        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia eliminata correttamente');
    }
}
