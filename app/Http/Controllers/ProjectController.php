<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Validator;
use Session;

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

        return view('project.index')
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create')
            ->with('project', new Project());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:name',
            'owner' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('project/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $project = new Project();
            $project->name = $request->request->get('name');
            $project->owner = $request->request->get('owner');
            $project->description = $request->request->get('description');
            $project->has_booking = $request->request->get('has_booking', 0);
            $project->save();

            Session::flash('message', 'Project successfully added');

            return redirect('project');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        return view('project.show')
            ->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        return view('project.edit')
            ->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:name',
            'owner' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('project/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $project = Project::find($id);
            $project->name = $request->request->get('name');
            $project->owner = $request->request->get('owner');
            $project->description = $request->request->get('description');
            $project->has_booking = $request->request->get('has_booking', 0);
            $project->save();

            Session::flash('message', 'Project successfully updated!');

            return redirect('project');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        Session::flash('message', 'Project successfully deleted!');

        return redirect('project');
    }
}
