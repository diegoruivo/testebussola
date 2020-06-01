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
                            Cadastrar Turma
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}">Turmas</a></li>
                            <li class="breadcrumb-item active">Cadastrar Turma</li>
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

            <form class="app_form"
                  action="{{ route('admin.groups.store') }}"
                  method="post" enctype="multipart/form-data">

            @csrf

            <!-- Default box -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Dados da Turma</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>*Nome da Turma</label>
                                    <input type="text" name="title" class="form-control"
                                           placeholder="Nome da Turma"
                                           value="{{ old('title')}}"/>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>*Série</label>
                                    <select name="serie" class="custom-select">
                                        <option value=""  {{ (old('serie') == '' ? 'selected' : '') }}>Selecione a Série</option>
                                        @foreach($series as $serie)
                                            @if (!empty($selected_serie))
                                                <option value="{{ $serie->id }}" {{ ($serie->id === $selected_serie->id ? 'selected' : '') }}>{{ $serie->title }}</option>
                                            @else
                                                <option value="{{ $serie->id }}">{{ $serie->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>*Curso</label>
                                    <select name="course" class="custom-select">
                                        <option value=""  {{ (old('course') == '' ? 'selected' : '') }}>Selecione o Curso</option>
                                        @foreach($courses as $course)
                                            @if (!empty($selected_course))
                                                <option value="{{ $course->id }}" {{ ($course->id === $selected_course->id ? 'selected' : '') }}>{{ $course->title }}</option>
                                            @else
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->


                    <!-- /.card-body -->
                    <div class="card-footer">

                        <button type="submit" class="btn btn-lg bg-gradient-primary" style="float:right;"><i
                                    class="fa fa-long-arrow-alt-right"></i> Cadastrar
                        </button>

                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection