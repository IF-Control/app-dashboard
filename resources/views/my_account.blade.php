@include('/components/header')
@include('/components/navbar')

<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">Minha Conta</h1>
            <p class="header-subtitle">Editar informações pessoais.</p>
        </div>
        <div class="w-100">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="p-1 text-center">Editar perfil</h5>
                            <div class="card-body">
                                <form>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="erroReq" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div id="sucessoForm" style="display:none;">
                                                <span>Informações atualizadas com sucesso!</span>
                                                <div class="close_button" onClick="closeAlert();">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-4">
                                            <label class="mb-1">Nome</label>
                                            <input type="text" class="form-control" id="nome" placeholder="Nome" value="{!! $me['name'] !!}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="mb-1">Senha</label>
                                            <input type="password" class="form-control" id="senha" placeholder="Altere sua senha">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="mb-1">Confirmar senha</label>
                                            <input type="password" class="form-control" id="confirma_senha" placeholder="Confirmar senha">
                                        </div>
                                    </div>
                                    <button onclick="atualizaDados()" type="button" class="btn btn-pill btn-primary align-center mt-5">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function closeAatualizaDadoslert(){
        $("#sucessoForm").css('display','none');
    }

    function atualizaDados(){
        var token = "<?php echo session()->get('token'); ?>";
        var id = "<?php echo session()->get('id'); ?>";
        var nome = $('#nome').val();
        var senha = $('#senha').val();
        var confirma_senha = $('#confirma_senha').val();

        if(senha != confirma_senha){
            $('#sucessoForm').hide();
            $('.erroReq').show();
            $('.erroReq').html('As senhas precisam ser iguais');
            $("#senha").addClass('inputError');
            $("#confirma_senha").addClass('inputError');
        }else{
            $.ajax({
                method: "PATCH",
                url: "//{!! Request::server ('HTTP_HOST') !!}/update_account",
                data: {
                    id: id,
                    nome: nome,
                    senha: senha
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(data){
                if(data.error){
                    $('.erroReq').show();
                    $('.erroReq').html(data.error);
                }else{
                    $('.erroReq').hide();
                    $("#senha").removeClass('inputError');
                    $("#confirma_senha").removeClass('inputError');
                    $('#sucessoForm').show();
                }
            });
        }
    };
 </script>
@include('/components/footer')
