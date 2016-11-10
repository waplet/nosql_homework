<?php

namespace App\Http\Controllers\Api;

use App\Events\LogAdd;
use App\Models\Project;
use App\Models\Queue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;

class QueueController extends Controller
{
    public function add(Request $request)
    {
        $rules = [
            'creation_date' => 'required',
            'project_id' => 'required',
            'severity' => 'integer|min:0|max:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return new JsonResponse($validator->errors(), 400);
        } else {
            $queueItem = new Queue();
            $queueItem->creation_date = $request->request->get('creation_date');
            $queueItem->project_id = $request->request->get('project_id');
            $queueItem->severity = $request->request->get('severity', Queue::DEFAULT);
            $queueItem->data = array_merge($request->all(), ['severity' => $queueItem->severity]);
            $queueItem->is_logged = 0;

            $queueItem->save();

            // If severity higher than error, fire event
            if ($queueItem->severity > 4) {
                event(new LogAdd($queueItem));
            }
        }

        return new JsonResponse(true);
    }
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
