<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select(['id', 'type_id', 'title', 'content', 'image'])
        ->orderBy('id', 'DESC')
        ->with(['type:id,label,color', 'technologies'])
        ->paginate(4);

        foreach ($projects as $project) {
            $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : null;
        }
        return response()->json($projects);
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $project = Project::select(['id', 'type_id', 'title', 'content', 'image'])
        ->where('id', $id)
        ->with(['type:id,label,color', 'technologies:id,label,color'])
         ->first();
        $project->image = !empty($project->image) ? asset('/storage/' . $project->image) : null;
        
        return response()->json($project);
    }

    
}
