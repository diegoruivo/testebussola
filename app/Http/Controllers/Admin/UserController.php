<?php

namespace TesteBussola\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TesteBussola\Group;
use TesteBussola\Http\Controllers\Controller;
use TesteBussola\System;
use TesteBussola\User;
use TesteBussola\Http\Requests\Admin\Users as UserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('student', 1)->get();
        $system = System::where('id', 1)->first();

        return view('admin.users.index', [
            'users' => $users,
            'system' => $system
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        $users = User::where('admin', 1)->get();
        $system = System::where('id', 1)->first();

        return view('admin.users.team', [
            'users' => $users,
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
        $groups = Group::all();
        $system = System::where('id', 1)->first();

        return view('admin.users.create', [
            'groups' => $groups,
            'system' => $system
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
            try {
                $userCreate = new User();
                $userCreate->name = $request->name;
                $userCreate->genre = $request->genre;
                $userCreate->date_of_birth = $request->date_of_birth;
                $userCreate->cell = $request->cell;
                $userCreate->email = $request->email;
                $userCreate->setAdminAttribute($request->admin);
                $userCreate->setStudentAttribute($request->student);
                if (!empty($request->file('cover'))) {$userCreate->cover = $request->file('cover')->store('users');}
                $userCreate->group = $request->group;
                $userCreate->save();
            } catch (QueryException $exception)
            {
                return redirect()->route('admin.users.create', [
                    'message' => 'Ooops'
                ])->with(['color' => 'red', 'message' => 'O e-mail já está cadastrado!']);
            }

        return redirect()->route('admin.users.edit', [
            'user' => $userCreate->id
        ])->with(['color' => 'green', 'message' => 'Aluno cadastrado com sucesso!']);

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
        $user = User::where('id', $id)->first();
        $groups = Group::all();
        $system = System::where('id', 1)->first();

        if (!empty($request->group)) {
            $group = Group::where('id', $request->group)->first();
        }

        return view('admin.users.edit', [
            'user' => $user,
            'groups' => $groups,
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
    public function update(UserRequest $request, $id)
    {
        $userUpdate = User::where('id', $id)->first();

        // Upload de Imagem
        if (!empty($request->file('cover'))) {
            Storage::delete($userUpdate->cover);
            $userUpdate->cover = '';
        }

        $userUpdate->setAdminAttribute($request->admin);
        $userUpdate->setStudentAttribute($request->student);

        $userUpdate->fill($request->all());

        if (!empty($request->file('cover'))) {
            $userUpdate->cover = $request->file('cover')->store('users');
            $userUpdate->save();
        }

        if (!$userUpdate->save()) {
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.users.edit', [
            'user' => $userUpdate->id
        ])->with(['color' => 'green', 'message' => 'Aluno atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $destroyUser = User::destroy($user->id);

        return redirect()->route('admin.users.index', [
            'user' => $user->id
        ])->with(['color' => 'green', 'message' => 'Aluno excluído com sucesso!']);
    }
}