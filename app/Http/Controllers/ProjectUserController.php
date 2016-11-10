<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Session;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        // die(dump(ProjectUser::where('project_id','=', $project->id)->get()));
        return view('project_user.index')
            ->with('project', $project)
            ->with('projectUsers', ProjectUser::where('project_id','=', $project->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('project_user.create')
            ->with('project', $project)
            ->with('users', User::all('id', 'name')->pluck('name', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Project $project
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, Request $request)
    {
        $rules = [
            'project_id' => 'required',
            'user_id' => Rule::unique('users')->where(function ($query) use ($project) {
                $query->where('project_id', $project->id);
            })
        ];

        $validator = Validator::make($request->all() + ['project_id' => $project->id], $rules);

        if ($validator->fails()) {
            return redirect('project/' . $project->id . '/users/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $projectUser = new ProjectUser();
            $projectUser->user()->associate(User::find($request->request->get('user_id')));
            $projectUser->project()->associate($project);
            $projectUser->save();

            Session::flash('message', 'User successfully added to project!');

            return redirect('/project/' . $project->id . '/users');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
