@extends('admin.master.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <small><i class="fa fa-users"></i></small>
                            Listar Turma
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Painel de Controle</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}">Turmas</a></li>
                            <li class="breadcrumb-item active">Listar Turma</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            @if($errors->all())
                @foreach($errors->all() as $error)
                    @message(['color' => 'orange'])
                    {{ $error }}
                    @endmessage
                @endforeach
            @endif

            @if(session()->exists('message'))
                @message(['color' => session()->get('color')])
                {{ session()->get('message') }}
                @endmessage
            @endif



                <!-- Default box -->
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Dados da Turma</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-4">
                                    <label>Turma</label>
                                    <h4>{{ $group->title }}</h4>
                                </div>

                                <div class="col-sm-4">
                                    <label>Série</label>
                                    <h5>{{ $group->serie()->first()->title }}</h5>
                                </div>

                                <div class="col-sm-4">
                                    <label>Curso</label>
                                    <h5>{{ $group->course()->first()->title }}</h5>
                                </div>

                                <div class="col-sm-12" style="margin-top:40px;">
                                    <label>Alunos Inscritos</label>

                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th width="10">ID</th>
                                                        <th width="50">Foto</th>
                                                        <th>Nome Completo</th>
                                                        <th>Sexo</th>
                                                        <th>Nascimento</th>
                                                        <th width="45">Ação</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $user)
                                                        @php
                                                            if($user->genre == 'male'){$genre = 'Masculino';}
                                                            if($user->genre == 'female'){$genre = 'Feminino';}
                                                            if($user->genre == 'other'){$genre = 'Outros';}
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $user->id }}</td>
                                                            <td><img src="{{ $user->url_cover }}" class="img-size-50 img-circle mr-3"></td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $genre }}</td>
                                                            <td>{{ $user->date_of_birth }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">
                                                                    <button type="button" class="btn bg-gradient-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                </div>







                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->



                    </div>
                    <!-- /.card -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection