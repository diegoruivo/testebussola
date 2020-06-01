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
                            Editar Usuário
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">Usuários</a></li>
                            <li class="breadcrumb-item active">Editar Usuário</li>
                            <a href="{{ route('admin.admins.create') }}">
                                <button type="button" class="btn btn-xs bg-gradient-primary ml-3"><i
                                            class="fa fa-plus"></i> Cadastrar Usuário
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
                  action="{{ route('admin.users.update', ['user' => $user->id]) }}"
                  method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Default box -->
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Dados do Usuário</h3>

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
                                        <label>*Nome</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Nome completo"
                                               value="{{ old('name') ?? $user->name }}"/>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Sexo*</label>
                                        <select name="genre" class="custom-select">
                                            <option value="" {{ (old('genre') == '' ? 'selected' : ($user->genre == '' ? 'selected' : '')) }}>
                                                Escolha o Genero
                                            </option>
                                            <option value="male" {{ (old('genre') == 'male' ? 'selected' : ($user->genre == 'male' ? 'selected' : '')) }}>
                                                Masculino
                                            </option>
                                            <option value="female" {{ (old('genre') == 'female' ? 'selected' : ($user->genre == 'female' ? 'selected' : '')) }}>
                                                Feminino
                                            </option>
                                            <option value="other" {{ (old('genre') == 'other' ? 'selected' : ($user->genre == 'other' ? 'selected' : '')) }}>
                                                Outros
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nascimento*</label>
                                        <input type="text" class="form-control"
                                               name="date_of_birth" placeholder="Data de Nascimento"
                                               data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask
                                               value="{{ old('date_of_birth') ?? $user->date_of_birth }}"/>
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Telefone Móvel</label>
                                        <input type="tel" name="cell" class="form-control" class="cell"
                                               data-inputmask="'mask': ['(99) 99999-9999']" data-mask
                                               placeholder="Telefone Móvel"
                                               value="{{ old('cell') ?? $user->cell }}"/>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                               placeholder="E-mail"
                                               value="{{ old('email')?? $user->email }}"/>
                                    </div>
                                </div>



                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Foto do Usuário</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                       name="cover">
                                                <label class="custom-file-label" for="exampleInputFile">Escolher
                                                    Arquivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <img src="{{ $user->url_cover }}" class="profile-user-img img-fluid img-circle">
                                </div>







                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->


                        <!-- /.card-body -->
                        <div class="card-footer">

                            Última atualização: {{ date('d/m/Y', strtotime($user->updated_at)) }}

                            <button type="submit" class="btn btn-lg bg-gradient-primary" style="float:right;"><i
                                        class="fa fa-long-arrow-alt-right"></i> Atualizar
                            </button>

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

            </form>


                <form action="{{ route('admin.admins.destroy', ['user' => $user->id]) }}" method="post"
                      class="app_form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-xs bg-gradient-danger"
                            style="margin-bottom:20px;"
                            onclick="return confirm('Tem certeza que deseja excluir o usuário: {{ $user->name }}?')"><i
                                class="fa fa-trash"></i> Excluir Usuário
                    </button>
                </form>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('js')

    <!-- Page script -->
    <script>
        $(function () {

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
            $('[data-mask]').inputmask()

        })
    </script>

@endsection