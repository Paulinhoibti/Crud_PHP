@extends("layout.user")

@section("container")

    <div class="panel panel-primary">
        <div class="panel-heading">
            Dados Completos
        </div>
        <div class="form-group">
        </div>
        <div class="panel-body">
            <div class="pull-right">
                <a href="<?php echo url('usuarios') ?>" class="btn btn-default">Voltar</a>
            </div>
            <div class="form-group">
                <strong>Name: </strong> <?php echo $user->nome ?>
            </div>

            <div class="form-group">
                <strong>Telefone: </strong> <?php echo $user->telefone ?>
            </div>

            <div class="form-group">
                <strong>Data
                    Nascimento: </strong> <?php $user->dataNascimento = implode('/', array_reverse(explode('-', $user->dataNascimento))); echo $user->dataNascimento?>
            </div>

            <div class="form-group">
                <strong>E-mail: </strong> <?php echo $user->email ?>
            </div>

            <div class="form-group">
                <strong>Cidade: </strong> <?php echo $user->cidade ?>
            </div>

            <div class="form-group">
                <strong>Bairro: </strong> <?php echo $user->bairro ?>
            </div>

            <div class="form-group">
                <strong>Endereço: </strong> <?php echo $user->street ?>
            </div>

            <div class="form-group">
                <strong>Estado: </strong> <?php echo $user->uf ?>
            </div>

            <div class="form-group">
                <strong>Endereco: </strong> <?php echo $user->endereco ?>
            </div>

            <div class="form-group">
                <strong>Documento: </strong> <a href="<?php echo url("download/$user->id") ?>"
                                                title="Download">{{ $user->documento }}</a>
            </div>
            Criado em {{$user->created_at}}
            {{--Criado em{{$data = date("d/m/Y")}}--}}
        </div>
    </div>
@endsection


