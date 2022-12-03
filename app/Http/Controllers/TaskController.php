<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getTasks = Task::all();
        return $getTasks;
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
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'project_id' => 'required',
            'user_id' => 'required',
        ]);

        //Autogenerate ID for the UUID
        $request['id'] = Str::uuid();
        $newTask = Task::create($request->all());

        if ($newTask) {
            return response()->json([
                'message' => 'Success',
                'taskData' => $newTask,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
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
        $getTasks = Task::find($id);
        return $getTasks;
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
        $updateTask = Task::where('id', $id)->update($request->all());

        if ($updateTask) {
            return response()->json([
                'message' => 'Success',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteTask = Task::where('id', $id)->delete();
        if ($deleteTask) {
            return response()->json([
                'message' => 'Success',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }
}
