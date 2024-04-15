<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;




class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(4);
        // dd($projects);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project =  new Project;
        $types =  Type::all();
        $technologies = Technology::all();
        $project_technologies_id = $project->technologies->pluck('id')->toArray(); 
        return view('admin.projects.create', compact('project', 'types', 'technologies', 'project_technologies_id')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $data = $this->validation($request->all());
        // dd($data);
        // dd($data['image']);
        
        $img_path = Storage::put('uploads/projects', $data['image']);

        $project = new Project;

        $project->fill($data);

        $project->image = $img_path;

        if (Arr::exists($data, 'image')) {
            $img_path = Storage::put('uploads/projects', $data['image']);
            $project->image = $img_path;
        }

        $project->save();

        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {   
        $types =  Type::all();
        $technologies = Technology::all();
        //tutti gli id delle tecnologie associate a questo progetto. Trasformo in un array e nel form uso il metodo in_array()
        $project_technologies_id = $project->technologies->pluck('id')->toArray(); 
        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'project_technologies_id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // $data = $request->all();
        $data = $this->validation($request->all());
		$project->update($data);

        //se arriva una nuova immagine
        if(Arr::exists($data,'image')) {
            //se ce n'era una prima
            if(!empty($project->image)) {
                //la elimino
                Storage::delete($project->image);
            }
            //salva la nuova img
            $img_path = Storage::put('uploads/projects', $data['image']);
            $project->image = $img_path;
        }
        
        $project->save();

        // dd($project);

        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

		return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();
        $project->delete();
		return redirect()->route('admin.projects.index');
    }

    private function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
              //... regole di validazione
              'title' => 'required|string|max:150',
              'type_id' => 'required',
              'content' => 'required|max:300',
              'link' => 'required',
              'technologies' => 'required|exists:technologies,id',
              'image' => 'nullable|image'
            ],
            [
              //... messaggi di errore
              'title.required' => 'Il titolo è obbligatorio',
              'title.string' => 'Il titolo deve essere una stringa',
              'title.max' => 'Il titolo deve essere lungo max 150 caratteri',

              'type_id.required' => 'Devi selezionare una categoria',
              
              'content.required' => 'La descrizione è obbligatoria',
              'content.max' => 'Il titolo deve essere lungo max 300 caratteri',
              
              'link.required' => 'Il link è obbligatorio',
              
              'technologies.required' => 'Seleziona almeno una categoria',
              ]
          )->validate();

          return $validator;
    }
}
