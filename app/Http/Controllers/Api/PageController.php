<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('technologies', 'type')->paginate(4);

        return response()->json($projects);
    }

    //funzione creata per visualizzare progetto nel dettaglio.
    public function getProjectBySlug($slug){

        $project = Project::with('technologies', 'type')->where('slug', $slug)->first();

        return response()->json($project);
    }
}
