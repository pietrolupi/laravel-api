<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;
use App\Functions\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    public function typeProject(){

        $types = Type::all();

        return view('admin.projects.types-projects', compact('types'));
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
        $exists = Type::where('name', $request->name)->first();

        if ($exists) {
            return redirect()->route('admin.types.index')->with('error', 'La tipologia inserita è già presente');
        }else{

            $new_type = new Type();
            $new_type->name = $request->name;
            $new_type->slug = Str::slug($request->name, '-');
            $new_type->save();
            return redirect()->route('admin.types.index')->with('success', 'Nuova tipologia inserita correttamente');
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
    public function update(Request $request, Type $type)
    {
        $val_data = $request->validate([
            'name' =>'required|max:30|min:3',
        ],
        [
            'name.required' => 'Il nome della tipologia è obbligatorio',
            'name.max' => 'Il nome della tipologia deve essere massimo 30 caratteri',
            'name.min' => 'Il nome della tipologia deve essere minimo 3 caratteri',
        ]);

           //controllo SLUG------------------
           $exists = Type::where('name', $request->name)->first();
           if($exists){
               return redirect()->route('admin.types.index')->with('error', 'Il nome della tipologia inserita è già presente');
           }
           $val_data['slug'] = Helper::generateSlug($request->name, Type::class);
           //--controllo SLUG----------------

           $type->update($val_data);
           return redirect()->route('admin.types.index')->with('success', 'Tipologia aggiornata correttamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Tipologia eliminata correttamente');
    }
}
