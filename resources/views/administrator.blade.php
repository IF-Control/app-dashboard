@include('/components/header')
@include('/components/navbar')

<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">Administradores</h1>
            <p class="header-subtitle">Controle os usuários administradores do sistema.</p>
        </div>
        <div class="w-100">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="p-1 text-center">Cadastrar administrador</h5>
                            <div class="card-body">
                                <form>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="erroInputsVazios" style="display:none;">Por favor, preencha todos os campos.</div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div id="sucessoForm" style="display:none;">
                                                <span>Usuário cadastrado com sucesso!</span>
                                                <div class="close_button" onClick="closeAlert();">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="form-group col-md-4">
                                            <label class="mb-1">Nome</label>
                                            <input type="text" class="form-control" id="nome" placeholder="Nome do administrador">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="mb-1">E-mail</label>
                                            <input type="email" class="form-control" id="email" placeholder="email@exemplo.com">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="mb-1">Senha</label>
                                            <input type="password" class="form-control" id="senha" placeholder="********">
                                        </div>
                                    </div>
                                    <button onclick="cadastraAdm()" type="button" class="btn btn-pill btn-primary align-center mt-5">Cadastrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:40%;">Nome</th>
                                        <th style="width:25%">E-mail</th>
                                        <th class="d-none d-md-table-cell" style="width:25%">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($administrators))
                                        @foreach ($administrators as $adm)
                                            @if($adm['id'] != session('id'))
                                                <?php
                                                    $status = $adm['active'] ? 'Ativo' : 'Inativo';
                                                ?>
                                                <tr id="adm-{!!$adm['id']!!}">
                                                    <td class="td_name">{!! $adm['name']!!}</td>
                                                    <td>{!! $adm['email']!!}</td>
                                                    <td class="td_status">{!! $status !!}</td>
                                                    <td class="table-action">
                                                        <div class="d-inline-block dropdown float-end">
                                                            <a href="#" class="pl-1" data-toggle="dropdown" data-display="static" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item btnEditAdm" data-toggle="modal" data-target="#modalEditAdm-{!! $adm['id']!!}">Editar</a>
                                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalDeleteAdm-{!! $adm['id']!!}">Excluir</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="modalEditAdm-{!! $adm['id'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Editar usuário</h5>
                                                                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                                </button>
                                                            </div>
                                                            <form>
                                                                <div class="modal-body m-3">
                                                                    <div class="row mb-2">
                                                                    <div class="erroReq" style="display:none;">Não foi possível processar esta solicitação, por favor tente novamente mais tarde.</div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Nome</label>
                                                                            <input type="text" data-id="{!! $adm['id'] !!}" class="form-control inputName" value="{!! $adm['name'] !!}" required>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Status</label>
                                                                            <select class="form-control inputStatus" data-id="{!! $adm['id'] !!}" data-status="{!! $status !!}">
                                                                                <option value="1">Ativo</option>
                                                                                <option value="0">Inativo</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button onClick="editaAdm(this);" data-id="{!! $adm['id'] !!}" type="button" class="btn btn-primary">Editar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="modalDeleteAdm-{!! $adm['id'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Excluir administrador</h5>
                                                                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body m-3">
                                                                <div class="modalExcluir">
                                                                    <div class="erroExcluir" style="display:none;">Desculpe, não foi possível excluir o usuário, tente novamente.</div>
                                                                    <p class="mb-0">Tem certeza que deseja excluir {!! $adm['name'] !!}?</p>
                                                                    <div class="align-center mt-2">
                                                                        <button type="button" data-id="{!! $adm['id'] !!}" class="btn btn-pill btn-danger" onClick="excluiAdm(this)">Sim</button>
                                                                        <button type="button" class="btn btn-pill btn-primary ml-1 closeModal" data-dismiss="modal">Não</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $('#sb-adm').addClass('active-item');

    function closeAlert(){
        $("#sucessoForm").css('display','none');
    }

    function validaEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function cadastraAdm(){
        var token = "<?php echo session()->get('token'); ?>";
        var nome = $('#nome').val();
        var email = $('#email').val();
        var senha = $('#senha').val();

        if(nome == '' || email == '' || senha == ''){
            $('#sucessoForm').hide();
            $('.erroInputsVazios').show();
            $('.erroInputsVazios').html('Por favor, preencha todos os campos.');

            if(nome == '') $("#nome").addClass('inputError'); else $("#nome").removeClass('inputError');
            if(email == '') $("#email").addClass('inputError'); else $("#email").removeClass('inputError');
            if(senha == '') $("#senha").addClass('inputError'); else $("#senha").removeClass('inputError');
        }else if(!validaEmail(email)){
            $("#email").addClass('inputError');
            $('.erroInputsVazios').show();
            $('.erroInputsVazios').html('Por favor digite um e-mail válido, ex: email@exemplo.com');
        }else{
            $("#nome").removeClass('inputError');
            $("#email").removeClass('inputError');
            $("#senha").removeClass('inputError');

            $.ajax({
                method: "POST",
                url: "//{!! Request::server ('HTTP_HOST') !!}/add_adm",
                data: {
                    nome: nome,
                    email: email,
                    senha: senha
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(data){
                if(data.error){
                    $("#senha").removeClass('inputError');
                    $("#email").removeClass('inputError');
                    var erro = "Não foi possível cadastrar novo administrador. Por favor tente novamente mais tarde."
                    if(data.error == 'Senha fraca: Ela precisar ter letras maiúsculas e minúsculas, números e caracteres especiais e no mínimo 6 caracteres de tamanho.'){
                        $("#senha").addClass('inputError');
                        erro = "Senha fraca: Ela precisar ter letras maiúsculas e minúsculas, números e caracteres especiais e no mínimo 6 caracteres de tamanho.";
                    }else if(data.error == 'Usuário já é existente no sistema.'){
                        $("#email").addClass('inputError');
                        erro = "O e-mail já está cadastrado no sistema. Para cadastrar um novo administrador, insira um e-mail não cadastrado.";
                    }
                    $('.erroInputsVazios').show();
                    $('.erroInputsVazios').html(erro);
                }else{
                    $('.erroInputsVazios').hide();
                    $("#senha").removeClass('inputError');

                    $('#sucessoForm').show();
                    $("#nome").val('');
                    $("#email").val('');
                    $("#senha").val('');

                    criaNovaLinha(JSON.parse(data));

                    $('html, body').animate({
                        scrollTop: $(".table").offset().top
                    }, 500);
                }
            });
        }
    };

    function criaNovaLinha(data){
        var linha = '<tr id="adm-'+data.id+'"><td class="td_name">'+data.name+'</td><td>'+data.email+'</td><td class="td_status">Ativo</td><td class="table-action"><div class="d-inline-block dropdown float-end"><a href="#" class="pl-1" data-toggle="dropdown" data-display="static" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a><div class="dropdown-menu dropdown-menu-end"><a href="#" class="dropdown-item btnEditAdm" data-toggle="modal" data-target="#modalEditAdm-'+data.id+'">Editar</a><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalDeleteAdm-'+data.id+'">Excluir</a></div></div></td></tr>';

        var modal_edit = '<div class="modal fade" id="modalEditAdm-'+data.id+'" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Editar usuário</h5><button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span></button></div><form><div class="modal-body m-3"><div class="row mb-2"><div class="erroReq" style="display:none;">Não foi possível processar esta solicitação, por favor tente novamente mais tarde.</div><div class="form-group col-md-6"><label>Nome</label><input type="text" data-id="'+data.id+'" class="form-control inputName" value="'+data.name+'" required></div><div class="form-group col-md-6"><label>Status</label><select class="form-control inputStatus" data-id="'+data.id+'" data-status="Ativo"><option value="1">Ativo</option><option value="0">Inativo</option></select></div></div></div><div class="modal-footer"><button onClick="editaAdm(this);" data-id="'+data.id+'" type="button" class="btn btn-primary">Editar</button></div></form></div></div></div>';

        var modal_deletar = '<div class="modal fade" id="modalDeleteAdm-'+data.id+'" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Excluir administrador</h5><button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span></button></div><div class="modal-body m-3"><div class="modalExcluir"><div class="erroExcluir" style="display:none;">Desculpe, não foi possível excluir o usuário, tente novamente.</div><p class="mb-0">Tem certeza que deseja excluir '+data.name+'?</p><div class="align-center mt-2"><button type="button" data-id="'+data.id+'" class="btn btn-pill btn-danger" onClick="excluiAdm(this)">Sim</button><button type="button" class="btn btn-pill btn-primary ml-1 closeModal" data-dismiss="modal">Não</button></div></div></div></div></div></div>';

        $('.table').find('tbody').append(linha);
        $('.table').find('tbody').append(modal_edit);
        $('.table').find('tbody').append(modal_deletar);
    };

    function editaAdm(item){
        var id = item.getAttribute("data-id");
        var name = $(".inputName[data-id='"+id+"']").val();
        var status = $(".inputStatus[data-id='"+id+"']").val();

        $.ajax({
            method: "PATCH",
            url: "//{!! Request::server ('HTTP_HOST') !!}/update_adm",
            data: {
                id: id,
                name: name,
                status: status
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data){
            if(data.error){
                $(".erroReq").show();
            }else{
                $(".erroReq").hide();
                $(".closeModal").trigger("click");
                $("#adm-"+id).find(".td_name").html(data.name);
                var status = data.active == 0 ? 'Inativo' : 'Ativo';
                var status_value = status == 'Inativo' ? 0 : 1;
                $("#adm-"+id).find(".td_status").html(status);
                $('#modalEditAdm-'+id).find(".inputStatus").attr('data-status', status);
                var modal = $('#modalEditAdm-'+id);
            }
        });
    }

    $(".btnEditAdm").click(function(){
        var data_target = $(this).attr("data-target");
        var modal = $(data_target);
        var id = modal.find(".inputStatus").data('id');
        var status = $(".inputStatus[data-id="+id+"]").attr('data-status');
        status = status == 'Inativo' ? 0 : 1;
        modal.find(".inputStatus").val(status).change();
    });

    function excluiAdm(item){
        var id = item.getAttribute("data-id");

        $.ajax({
            method: "DELETE",
            url: "//{!! Request::server ('HTTP_HOST') !!}/delete_adm",
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data){
            if(data){
                $(".erroExcluir").hide();
                $(".closeModal").trigger('click');
                $("#adm-"+id).hide();
            }else{
                $(".erroExcluir").show();
            }
        });
    }
 </script>
@include('/components/footer')
