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
                            <small><i class="fa fa-user-cog"></i></small>
                            Usuários
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Usuários</li>
                            <a href="{{ route('admin.admins.create') }}">
                                <button type="button" class="btn bg-gradient-primary ml-3"><i class="fa fa-plus"></i> Cadastrar Usuário</button>
                            </a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">



            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Usuários</h3>
                </div>


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


            <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
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
                                    <a href="{{ route('admin.admins.edit', ['user' => $user->id]) }}">
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