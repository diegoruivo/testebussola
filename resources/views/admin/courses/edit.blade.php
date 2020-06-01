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
                            <small><i class="fa fa-chalkboard-teacher"></i></small>
                            Editar Curso
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Painel de Controle</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Cursos</a></li>
                            <li class="breadcrumb-item active">Editar Curso</li>
                            <a href="{{ route('admin.courses.create') }}">
                                <button type="button" class="btn btn-xs bg-gradient-primary ml-3"><i
                                            class="fa fa-plus"></i> Cadastrar Curso
                                </button>
                            </a>
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

            <form role="form"
                  action="{{ route('admin.courses.update', ['course' => $course->id]) }}"
                  method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Default box -->
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Dados do Curso</h3>

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

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>*Nome do Curso</label>
                                        <input type="text" name="title" class="form-control"
                                               placeholder="Nome do Curso"
                                               value="{{ old('title') ?? $course->title }}"/>
                                    </div>
                                </div>

                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->


                        <!-- /.card-body -->
                        <div class="card-footer">

                            Última atualização: {{ date('d/m/Y', strtotime($course->updated_at)) }}

                            <button type="submit" class="btn btn-lg bg-gradient-primary" style="float:right;"><i
                                        class="fa fa-long-arrow-alt-right"></i> Atualizar
                            </button>

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

            </form>


                <form action="{{ route('admin.courses.destroy', ['course' => $course->id]) }}" method="post"
                      class="app_form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-xs bg-gradient-danger"
                            style="margin-bottom:20px;"
                            onclick="return confirm('Tem certeza que deseja excluir o curso: {{ $course->title }}?')"><i
                                class="fa fa-trash"></i> Excluir Curso
                    </button>
                </form>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection