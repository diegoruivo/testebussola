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
                            Turmas
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Painel de Controle</a></li>
                            <li class="breadcrumb-item active">Turmas</li>
                            <a href="{{ route('admin.groups.create') }}">
                                <button type="button" class="btn bg-gradient-primary ml-3"><i class="fa fa-plus"></i> Cadastrar Turma</button>
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


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Turmas</h3>
                </div>

            <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="10">ID</th>
                            <th>Nome da Turma</th>
                            <th>Série</th>
                            <th>Curso</th>
                            <th width="110">Ação</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td>{{ $group->title }}</td>
                                <td>{{ $group->serie()->first()->title }}</td>
                                <td>{{ $group->course()->first()->title }}</td>
                                <td>
                                    <a href="{{ route('admin.groups.edit', ['group' => $group->id]) }}">
                                        <button type="button" class="btn bg-gradient-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>
                                    </a>

                                    <a href="{{ route('admin.groups.list', ['group' => $group->id]) }}">
                                        <button type="button" class="btn bg-gradient-success btn-xs"><i class="fa fa-list-ul"></i> Listar</button>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->




        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('js')

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection