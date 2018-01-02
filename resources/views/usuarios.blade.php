@extends('layout.template1')
@section('title', 'Usuários')
@section('container')

    <h2>Usuários</h2>
    <style>
        .top {
            display: none;
            position: fixed;
            right: 20px;
            bottom: 80px;
            height: 42px;
            width: 42px;
            z-index: 9999;
            line-height: 3em;
        }
    </style>

    @if(session('status1'))
        <div class="row" id="teste">
            <div class="alert alert-danger alert-dismissable fa in text-center col-md-6 col-md-offset-3">
                <button href="#" class="close" data-dismiss="alert" id="close">&times;</button>
                <h5><i class="icon fa fa-check"> {{session('status1')}}...</i></h5>

            </div>
        </div>
    @endif
    <a href="{{url("create")}}" class="btn btn-primary" id="novoUser"><span class="glyphicon glyphicon-plus"></span>
        Novo Usuário</a>
    {{--Incio Form Busca usuário--}}
    <form class="navbar-form navbar-right" method="get" action="{{url('search')}}">
        <div class="input-group">
            <input name="nome" class="form-control" id="search" type="text" placeholder="Pesquisar Itens">
            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
        </div>
    </form>
    {{--Fim Form Busca usuário--}}

    @if($users->isEmpty())
        <div class="alert alert-info text-center">Nenhum usuário cadastrado</div>
    @else
        <table id="datatable" class="table table-bordered table-hover table-condensed table-striped">
            <thead>
            <tr style="background-color: #00b0ff;color: white">
                <th data-toggle="tooltip" data-placement="top" title="clique para Ordenar" class="text-center">Id</th>
                <th data-toggle="tooltip" data-placement="top" title="clique para Ordenar" class="text-center">Nome</th>
                <th class="text-center">Telefone</th>
                <th class="text-center">Email</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Salario</th>
                <th class="text-center">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($users as $usuario) { ?>
            <!--    --><?php //echo '<pre>';
            //            var_dump($usuario);die();?>
            <tr>
                <td class="text-center"><?php echo $usuario['id']; ?></td>
                <td class="text-center"><?php echo $usuario->nome ?></td>
                <td class="text-center"><?php echo $usuario->telefone ?></td>
                <td class="text-center"><?php echo $usuario['email'] ?></td>
                <td class="text-center"><?php echo $usuario->uf ?></td>
                <td class="text-center"><?php echo number_format($usuario['salario'], 2, '.', ','); ?></td>
                <td class="text-center">
                    <a href="{{url('contato/user',['id'=>$usuario->id])}}"
                       class="btn btn-success editable-table-button btn-xs">Visualizar</a>
                    @can('autorizacao', $usuario)
                        {{--                            <a href="{{url("usuarios/editar",['id'=>$usuario->id])}}" class="btn btn-warning editable-table-button btn-xs">Editar</a>--}}
                        @include("modais.editar")
                        <a class="btn btn-warning editable-table-button btn-xs" data-toggle="modal"
                           data-target="#modal-delete_{{$usuario->id}}">Editar</a>
                        {{--                                <a href="{{url("usuarios/excluir/$usuario->id")}}" onclick="return confirm('Deseja Excluir {{$usuario->nome}}')" class="btn btn-danger editable-table-button btn-xs">Excluir</a>--}}
                        @include("modais.delete")
                        <a class="btn btn-danger editable-table-button btn-xs" data-toggle="modal"
                           data-target="#delete-modal_{{$usuario->id}}">Excluir</a>
                    @endcan
                </td>
            </tr>
            <?php }?>
            </tbody>
            <a href="#" class="btn btn btn-success"><span class="glyphicon glyphicon-file"></span> Gerar PDF</a>
        </table>
        {!! $users->render() !!}

        <div style='float:right;'>
            <p class="top" data-toggle="tooltip" data-html="true" title="Ir para o topo">
                <a href="#" class="btn btn btn-info"><span class="glyphicon glyphicon-chevron-up"></span></a>
            </p>
        </div>
    @endif

    {{--script Datatable--}}
    {{--<script src="/media/js/jquery.dataTables.js" type="text/javascript"></script>--}}
    <script src="/media/js/jquery.dataTables.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                "paging": true,
                "info": true,
                "aoColumnDefs": [
                    {
                        'bSortable': false, 'aTargets': [5, 6]
                    }
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $('.alert').slideUp('close');
            }, 5000);

            $('h2').animate({
                "margin-left": "+=480",
                "font-size": "3em"
            }, 1000, function () {
                $('h2').css("text-decoration", "underline");
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            toastr.options = {
                "closeButton": true, // true/false
                "debug": false, // true/false
                "newestOnTop": false, // true/false
                "progressBar": false, // true/false
                "positionClass": "toast-top-right", // toast-top-right / toast-top-left / toast-bottom-right / toast-bottom-left
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300", // in milliseconds
                "hideDuration": "1000", // in milliseconds
                "timeOut": "5000", // in milliseconds
                "extendedTimeOut": "1000", // in milliseconds
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
    </script>
    <script>
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.top').fadeIn();
            } else {
                $('.top').fadeOut();
            }
        });
        $('.top').click(function () {
            $('html, body').animate({scrollTop: 0}, 500);
            return false;
        });
    </script>
@endsection
