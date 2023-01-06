@include('/components/header')
@include('/components/navbar')

<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">Dicas de saúde</h1>
            <p class="header-subtitle">Cadastre dicas de saúde para informar e orientar os usuários do Câmpus sobre a COVID-19 e outros assuntos relacionados.</p>
        </div>
        <div class="w-100">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="card">
                        <h5 class="p-1 text-center">Cadastrar dicas de saúde</h5>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div id="errosForm" class="erroInputsVazios" style="display:none;"></div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div id="sucessoForm" style="display:none;">
                                            <span>Dica de saúde cadastrada com sucesso!</span>
                                            <div class="close_button" onclick="closeAlert();">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-6">
                                        <label class="mb-1">Título</label>
                                        <input type="text" class="form-control" id="nome" placeholder="Título da dica de saúde" maxlength="32">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="mb-1">Imagem</label>
                                        <input name="image" id="file" class="form-control" type="file" accept="image/*" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="mb-1">Descrição </label>
                                        <textarea class="form-control" id="description" placeholder="Descrição da dica de saúde" rows="5" maxlength="230"></textarea>
                                    </div>
                                </div>
                                <button onclick="cadastraDica()" type="button" class="btn btn-pill btn-primary align-center mt-5">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row div-cards">
                @if(!empty($health_tips))
                    @foreach ($health_tips as $tip)
                        <div class="col-12 col-sm-6 col-md-4 col-xl-4 card-tip" data-id="{!! $tip['id'] !!}">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-10 col-sm-10 col-md-10 col-xl-10">
                                            <h5 class="card-title mb-3">{!! $tip['name'] !!}</h5>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-xl-2">
                                            <div class="d-inline-block dropdown float-end">
                                                <a href="#" class="pl-1" data-toggle="dropdown" data-display="static" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalDeleteTip-{!! $tip['id'] !!}">Excluir dica</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="card-image" src="https://ifsp-control.herokuapp.com/files/{!! $tip['image'] !!}">
                                    <div class="card-body card-scroll">
                                        <p class="card-text">{!! $tip['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Modal Excluir dicas -->
                         <div class="modal fade" id="modalDeleteTip-{!! $tip['id'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Excluir dica</h5>
                                        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body m-3">
                                        <div class="modalExcluir">
                                            <div class="erroExcluir" style="display:none;">Desculpe, não foi possível excluir a dica, tente novamente.</div>
                                            <p class="mb-0">Tem certeza que deseja excluir a dica "{!! $tip['name'] !!}"?</p>
                                            <div class="align-center mt-2">
                                                <button type="button" data-id="{!! $tip['id'] !!}" class="btn btn-pill btn-danger" onClick="excluiDica(this)">Sim</button>
                                                <button type="button" class="btn btn-pill btn-primary ml-1 closeModal" data-dismiss="modal">Não</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</main>

<script>
    $('#sb-tips').addClass('active-item');

    function closeAlert(){
        $("#sucessoForm").css('display','none');
    }

    function cadastraDica(){
        var token = "<?php echo session()->get('token'); ?>";

        var nome = $('#nome').val();
        var desc = $('#description').val();
        var file = document.getElementById('file').files[0];
        var tiposValidos = ["image/png", "image/jpg", "image/jpeg"];

        if(nome != '' && desc != '' && document.getElementById('file').files.length > 0){
            $("#nome").removeClass('inputError');
            $("#description").removeClass('inputError');
            $("#file").removeClass('inputError');

            if(file.size > 400000){
                $('#sucessoForm').hide();
                $('#errosForm').show();
                $('#errosForm').html('Não foi possível cadastrar a dica, só é possível enviar imagens menores que 400Kb.');
            }
            if(!tiposValidos.includes(file.type)){
                $('#sucessoForm').hide();
                $('#errosForm').show();
                $('#errosForm').html('Não foi possível enviar o arquivo, por favor insira uma imagem .png, .jpg ou .jpeg');
            }

            if(file.size < 400000 && tiposValidos.includes(file.type)){
                var formData = new FormData();
                formData.append('name', nome);
                formData.append('description', desc);
                formData.append("file",  file);

                $.ajax({
                    url: "https://ifsp-control.herokuapp.com/health_tip",
                    type: 'POST',
                    data: formData,
                    success: function(dica) {
                        $('html, body').animate({
                            scrollTop: $(".div-cards").offset().top
                        }, 500);

                        $('#errosForm').hide();
                        $('#sucessoForm').show();

                        $("#nome").val('');
                        $("#description").val('');
                        $("#file").val('');

                        criaNovoCard(dica);
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'Authorization': 'Bearer: ' + token
                    }
                });
            }
        }else{
            $('#sucessoForm').hide();
            $('#errosForm').show();
            $('#errosForm').html('Por favor, preencha todos os campos para cadastrar uma dica de saúde.');

            if(nome == '') $("#nome").addClass('inputError'); else $("#nome").removeClass('inputError');
            if(desc == '') $("#description").addClass('inputError'); else $("#description").removeClass('inputError');
            if(document.getElementById('file').files.length <= 0) $("#file").addClass('inputError'); else $("#file").removeClass('inputError');
        }
    };

    function criaNovoCard(data){
        var novo_card = '<div class="col-12 col-sm-6 col-md-4 col-xl-4 card-tip" data-id="'+data.id+'"><div class="card"><div class="card-header"><div class="row"><div class="col-10 col-sm-10 col-md-10 col-xl-10"><h5 class="card-title mb-3 mb-0">'+data.name+'</h5></div><div class="col-2 col-sm-2 col-md-2 col-xl-2"><div class="d-inline-block dropdown float-end"><a href="#" class="pl-1" data-toggle="dropdown" data-display="static" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a><div class="dropdown-menu"><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalDeleteTip-'+data.id+'">Excluir dica</a></div></div></div></div><img class="card-image" src="https://ifsp-control.herokuapp.com/files/'+data.image+'"><div class="card-body card-scroll"><p class="card-text">'+data.description+'</p></div></div></div></div>';

        var modal = '<div class="modal fade" id="modalDeleteTip-'+data.id+'" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Excluir dica</h5><button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span></button></div><div class="modal-body m-3"><div class="modalExcluir"><div class="erroExcluir" style="display:none;">Desculpe, não foi possível excluir a dica, tente novamente.</div><p class="mb-0">Tem certeza que deseja excluir a dica "'+data.name+'"?</p><div class="align-center mt-2"><button type="button" data-id="'+data.id+'" class="btn btn-pill btn-danger" onClick="excluiDica(this)">Sim</button><button type="button" class="btn btn-pill btn-primary ml-1 closeModal" data-dismiss="modal">Não</button></div></div></div></div></div></div>';

        $('.div-cards').prepend(novo_card);
        $('.div-cards').prepend(modal);
    };

    function excluiDica(item){
        var id = item.getAttribute("data-id");

        $.ajax({
            method: "DELETE",
            url: "//{!! Request::server ('HTTP_HOST') !!}/delete_tip",
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
                $(".card-tip[data-id="+id+"]").css('display', 'none');
            }else{
                $(".erroExcluir").show();
            }
        });
    }
 </script>
@include('/components/footer')

