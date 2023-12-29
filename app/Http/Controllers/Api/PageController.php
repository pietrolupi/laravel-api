<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    //funzione per visualizzare tutti i progetti ()
    public function index(){

       $projects = Project::with('technologies', 'type')->orderBy('id', 'desc')->paginate(4);

       foreach ($projects as $project){
           $project->image ? $project->image = asset('storage/' . $project->image) : $project->image = asset('storage/placeholder.jpg');
        }

    return response()->json($projects);
    }


    //funzione creata per visualizzare progetto nel dettaglio.
    public function getProjectBySlug($slug){

       $project = Project::with('technologies', 'type')->where('slug', $slug)->first();
       $project->image ? $project->image = asset('storage/'.$project->image) : $project->image = asset('storage/placeholder.jpg');
       $success = true;
       if(!$project){
        $success = false;
       }
       return response()->json(compact('project', 'success'));
    }
    }



