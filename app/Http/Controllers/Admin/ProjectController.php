<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Models\Lead;
use App\Mail\ConfirmProject;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

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
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        
        $newProject = new Project();

        if($request->has('post_image')){
            $path = Storage::disk('public')->put('images_upload',  $request->post_image);

            $newProject['post_image'] = $path;
        }
        
        $newProject->fill($data);

        $newProject->save();;

        $new_lead = new Lead();
        $new_lead->titolo = $data['titolo'];
        $new_lead->descrizione = $data['descrizione'];

        $new_lead->save();

        Mail::to('ciao@mail.com')->send(new ConfirmProject($new_lead));

        if($request->has('technologies')){
            $newProject->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('message', 'Nuovo progetto creato');
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

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if($request->has('post_image')){            
            if($project->post_image){
                Storage::delete($project->post_image); 
            }
    
            $path = Storage::disk('public')->put('images_upload', $request->post_image);
    
            $project['post_image'] = $path;
        }
        
        $project->fill($data);

        $project->update();

        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('message', 'Modidicato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);

        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', 'Cancellazione con successo');
    }
}
