<?php

namespace TesteBussola\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TesteBussola\Course;
use TesteBussola\Group;
use TesteBussola\Http\Controllers\Controller;
use TesteBussola\Serie;
use TesteBussola\System;
use TesteBussola\Http\Requests\Admin\Group as GroupRequest;
use TesteBussola\User;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        $system = System::where('id', 1)->first();

        return view('admin.groups.index', [
            'groups' => $groups,
            'system' => $system
        ]);
    }

    public function list($id)
    {
        $group = Group::where('id', $id)->first();
        $users = User::where('group', $group->id)->get();
        $system = System::where('id', 1)->first();

        return view('admin.groups.list', [
            'group' => $group,
            'users' => $users,
            'system' => $system
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $series = Serie::orderBy('title')->get();
        $courses = Course::orderBy('title')->get();
        $system = System::where('id', 1)->first();

        if (!empty($request->series)) {
            $serie = Serie::where('id', $request->serie)->first();
        }

        if (!empty($request->courses)) {
            $course = Course::where('id', $request->course)->first();
        }

        return view('admin.groups.create', [
            'series' => $series,
            'courses' => $courses,
            'system' => $system
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $createGroup = Group::create($request->all());

        return redirect()->route('admin.groups.edit', [
            'group' => $createGroup->id
        ])->with(['color' => 'green', 'message' => 'Turma cadastrada com sucesso!']);
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
    public function edit(Request $request, $id)
    {
        $group = Group::where('id', $id)->first();
        $series = Serie::orderBy('title')->get();
        $courses = Course::orderBy('title')->get();
        $system = System::where('id', 1)->first();

        if (!empty($request->serie)) {
            $serie = Serie::where('id', $request->serie)->first();
        }

        if (!empty($request->courses)) {
            $course = Course::where('id', $request->course)->first();
        }

        return view('admin.groups.edit', [
            'group' => $group,
            'series' => $series,
            'courses' => $courses,
            'system' => $system
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        $updateGroup= Group::where('id', $id)->first();
        $updateGroup->fill($request->all());
        $updateGroup->save();

        return redirect()->route('admin.groups.edit', [
            'group' => $updateGroup->id
        ])->with(['color' => 'green', 'message' => 'Turma atualizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        $destroyGroup = Group::destroy($group->id);

        return redirect()->route('admin.groups.index', [
            'group' => $group->id
        ])->with(['color' => 'green', 'message' => 'Turma excluída com sucesso!']);
    }
}
