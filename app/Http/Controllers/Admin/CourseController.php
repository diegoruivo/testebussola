<?php

namespace TesteBussola\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TesteBussola\Course;
use TesteBussola\Http\Controllers\Controller;
use TesteBussola\System;
use TesteBussola\Http\Requests\Admin\Course as CourseRequest;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $system = System::where('id', 1)->first();

        return view('admin.courses.index', [
            'courses' => $courses,
            'system' => $system
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $system = System::where('id', 1)->first();

        return view('admin.courses.create', [
            'system' => $system
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $createCourse = Course::create($request->all());

        if (!$createCourse->save()) {
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.courses.edit', [
            'course' => $createCourse->id
        ])->with(['color' => 'green', 'message' => 'Curso cadastrado com sucesso!']);
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
        $course = Course::where('id', $id)->first();
        $system = System::where('id', 1)->first();

        return view('admin.courses.edit', [
            'course' => $course,
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
    public function update(CourseRequest $request, $id)
    {
        $updateCourse = Course::where('id', $id)->first();
        $updateCourse->fill($request->all());
        $updateCourse->save();

        if (!$updateCourse->save()) {
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.courses.edit', [
            'course' => $updateCourse->id
        ])->with(['color' => 'green', 'message' => 'Curso atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $destroyCourse = Course::destroy($course->id);

        return redirect()->route('admin.courses.index', [
            'course' => $course->id
        ])->with(['color' => 'green', 'message' => 'Curso excluído com sucesso!']);
    }
}
