@include('/components/header')
@include('/components/navbar')
<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">Ambientes</h1>
            <p class="header-subtitle">Controle de prédios, salas, ambientes e movimentação dos usuários no Câmpus.</p>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-6">
                <div class="card">
                    <h5 class="p-1 text-center">Ambientes</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist" id="nav-env">
                            @if(!empty($environments))
                                @foreach ($environments as $environment)
                                    <li class="nav-item"><a class="nav-link" href="#tab-{!! $environment['name'] !!}" data-toggle="tab" role="tab" >{!! $environment['name'] !!}</a></li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="tab-content" id="tab-content-env">
                            @if(!empty($environments))
                                @foreach ($environments as $env)
                                    <div class="tab-pane" id="tab-{!! $env['name'] !!}" role="tabpanel">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-md-8 col-xl-8"></div>
                                            <div class="col-6 col-sm-6 col-md-4 col-xl-4">
                                                <div class="editaPredio" class="dropdown-item" data-toggle="modal"
                                                data-target="#modalEditEnvironment-{!! $env['name'] !!}">Editar prédio {!! $env['name'] !!}</div>
                                            </div>
                                        </div>

                                        <!-- Modal para editar PRÉDIOS DO AMBIENTE-->
                                        <div class="modal fade" id="modalEditEnvironment-{!! $env['name'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar prédio</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('edit_building') }}">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="modal-body m-3">
                                                            <div class="form-group">
                                                                <label for="sala">Nome do prédio</label>
                                                                <input type="text" class="form-control" name="nome" value="{!! $env['name'] !!}" required>
                                                                <input type="hidden" name="id" value="{!! $env['id'] !!}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach ($env['rooms'] as $room)
                                            <?php 
                                            $percent_env = count($room['movements']) > 0 && $room['capacity'] > 0 ? round((count($room['movements']) / $room['capacity']) * 100) : 0;

                                            if($room['status'] == 'Manutenção'){
                                                $icon = 'text-warning fa-triangle-exclamation';
                                            }else if($room['status'] == 'Interditada'){
                                                $icon = 'text-danger fa-ban';
                                            }else if($room['status'] == 'Em Limpeza'){
                                                $icon = 'text-secondary fa-broom';
                                            }else if($room['status'] == 'Contaminada'){
                                                $icon = 'text-success fa-virus-covid';
                                            }else{
                                                $icon = '';
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-6 col-xl-10">
                                                    <div class="d-flex">
                                                        <h5>{!! $room['type'] !!} {!! $room['name'] !!}</h5>
                                                        @if($room['status'] != 'Disponível')
                                                            <div class="tooltip_status" title="{!! $room['status'] !!}">
                                                                <i class="ml-1 fa-solid {!! $icon !!}"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-6 col-sm-6 col-md-6 col-xl-2 text-end">
                                                    <div class="d-inline-block dropdown">
                                                        <a href="#" class="pl-1" data-toggle="dropdown" data-display="static" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>

                                                        <!-- Ações para as salas pertencentes a AMBIENTES-->
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item btnEditRoomEnv" data-toggle="modal" data-target="#modalEditRoomEnv-{!! $room['id'] !!}">Editar sala</a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalDeleteRoomEnv-{!! $room['id'] !!}">Excluir sala</a>
                                                            <a href="#" class="dropdown-item btnQRCode" data-target="#modalQRCode-{!! $room['id'] !!}" data-name="{!! $room['name'] !!}">Gerar QR Code</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal QR Code -->
                                                <div class="modal fade" id="modalQRCode-{!! $room['id'] !!}">
                                                   <div id="qrcode-{!! $room['id'] !!}"></div>
                                                </div>

                                                <!-- Modal Editar salas dos ambientes -->
                                                <div class="modal fade" id="modalEditRoomEnv-{!! $room['id'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Editar sala</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ route('edit_room') }}">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="modal-body m-3">
                                                                    <div class="row mb-2">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="sala">Nome da sala</label>
                                                                            <input type="text" class="form-control" name="nome" value="{!! $room['name'] !!}">
                                                                            <input type="hidden" name="id" value="{!! $room['id'] !!}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Capacidade</label>
                                                                            <input type="number" class="form-control" name="capacidade" min="1" value="{!! $room['capacity'] !!}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="form-group col-md-6">
                                                                            <label">Tipo</label>
                                                                            <select name="tipo" class="form-control selectTipoAmbiente" data-type="{!! $room['type'] !!}">
                                                                                <option value="Laboratório">Laboratório</option>
                                                                                <option value="Sala de Aula">Sala de Aula</option>
                                                                                <option value="Espaço Comum">Espaço Comum</option>
                                                                                <option value="Orientação">Orientação</option>
                                                                                <option value="Auditório">Auditório</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Status</label>
                                                                            <select name="status" class="form-control selectStatusAmbiente" data-status="{!! $room['status'] !!}">
                                                                                <option value="Disponível">Disponível</option>
                                                                                <option value="Manutenção">Manutenção</option>
                                                                                <option value="Interditada">Interditada</option>
                                                                                <option value="Em Limpeza">Em Limpeza</option>
                                                                                <option value="Contaminada">Contaminada</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Editar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Excluir salas dos ambientes -->
                                                <div class="modal fade" id="modalDeleteRoomEnv-{!! $room['id'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Excluir sala</h5>
                                                                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body m-3">
                                                                <div class="modalExcluir">
                                                                    <div class="erroExcluir" style="display:none;">Desculpe, não foi possível excluir a sala, tente novamente.</div>
                                                                    <p class="mb-0">Tem certeza que deseja excluir {!! $room['name'] !!}?</p>
                                                                    <div class="align-center mt-2">
                                                                        <button type="button" data-id="{!! $room['id'] !!}" class="btn btn-pill btn-danger excluiSala">Sim</button>
                                                                        <button type="button" class="btn btn-pill btn-primary ml-1 closeModal" data-dismiss="modal">Não</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-9 col-sm-10 col-md-10 col-xl-10">
                                                    <div class="percent mb-3">
                                                        <div class="percent-bar" style="width:<?php echo $percent_env ?>%"></div>
                                                        <span class="percent-value">{!! $percent_env !!}%</span>
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2 col-md-2 col-xl-2 text-end">
                                                    <h5>{!! count($room['movements']) !!} / {!! $room['capacity'] !!}</h5>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-xl-6">
                <div class="card">
                    <h5 class="p-1 text-center">Prédios</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist" id="nav-room">
                            @if(!empty($rooms))
                                @foreach ($rooms as $room)
                                    <li class="nav-item"><a class="nav-link" href="#tab-{!! $room['name'] !!}" data-toggle="tab" role="tab" >{!! $room['name'] !!}</a></li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="tab-content" id="tab-content-room">
                            @if(!empty($rooms))
                                @foreach ($rooms as $rm)
                                <div class="tab-pane" id="tab-{!! $rm['name'] !!}" role="tabpanel">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-8 col-xl-8"></div>
                                        <div class="col-6 col-sm-6 col-md-4 col-xl-4">
                                            <div class="editaPredio" class="dropdown-item" data-toggle="modal"
                                            data-target="#modalEditBuilding-{!! $rm['name'] !!}">Editar prédio {!! $rm['name'] !!}</div>
                                        </div>
                                    </div>

                                    <!-- Modal para editar prédios-->
                                    <div class="modal fade" id="modalEditBuilding-{!! $rm['name'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar prédio</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                    </button>
                                                </div>
                                                    <form method="POST" action="{{ route('edit_building') }}">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="modal-body m-3">
                                                            <div class="form-group">
                                                                <label for="sala">Nome do prédio</label>
                                                                <input type="text" class="form-control" name="nome" value="{!! $rm['name'] !!}" required>
                                                                <input type="hidden" name="id" value="{!! $rm['id'] !!}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Editar</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($rm['rooms'] as $room)
                                    <?php 
                                        $percent_rm = count($room['movements']) > 0 && $room['capacity'] > 0 ? round((count($room['movements']) / $room['capacity']) * 100) : 0;
                                        if($room['status'] == 'Manutenção'){
                                            $icon = 'text-warning fa-triangle-exclamation';
                                        }else if($room['status'] == 'Interditada'){
                                            $icon = 'text-danger fa-ban';
                                        }else if($room['status'] == 'Em Limpeza'){
                                            $icon = 'text-secondary fa-broom';
                                        }else if($room['status'] == 'Contaminada'){
                                            $icon = 'text-success fa-virus-covid';
                                        }else{
                                            $icon = '';
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-6 col-xl-10">
                                            <div class="d-flex">
                                                <h5>{!! $room['type'] !!} {!! $room['name'] !!}</h5>
                                                @if($room['status'] != 'Disponível')
                                                    <div class="tooltip_status" title="{!! $room['status'] !!}">
                                                        <i class="ml-1 fa-solid {!! $icon !!}"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-6 col-md-6 col-xl-2 text-end">
                                            <div class="d-inline-block dropdown">
                                                <a class="pl-1" href="#" data-toggle="dropdown" data-display="static" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>

                                                <!-- Ações para as salas pertencentes a PREDIOS-->
                                                <div class="dropdown-menu dropdown-menu-end">
                                                     <a href="#" class="dropdown-item btnEditRoomBldng" data-toggle="modal" data-target="#modalEditRoomBldng-{!! $room['id'] !!}">Editar sala</a>
                                                     <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalDeleteRoomBldng-{!! $room['id'] !!}">Excluir sala</a>
                                                     <a href="#" class="dropdown-item btnQRCode" data-target="#modalQRCode-{!! $room['id'] !!}" data-name="{!! $room['name'] !!}">Gerar QR Code</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal QR Code -->
                                        <div class="modal fade" id="modalQRCode-{!! $room['id'] !!}">
                                            <div id="qrcode-{!! $room['id'] !!}"></div>
                                        </div>
                                        <!-- Modal Editar salas dos prédios -->
                                        <div class="modal fade" id="modalEditRoomBldng-{!! $room['id'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar sala</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('edit_room') }}">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="modal-body m-3">
                                                            <div class="row mb-2">
                                                                <div class="form-group col-md-6">
                                                                    <label for="sala">Nome da sala</label>
                                                                    <input type="text" class="form-control" name="nome" value="{!! $room['name'] !!}">
                                                                    <input type="hidden" name="id" value="{!! $room['id'] !!}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Capacidade</label>
                                                                    <input type="number" class="form-control" name="capacidade" min="1" value="{!! $room['capacity'] !!}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="form-group col-md-6">
                                                                    <label">Tipo</label>
                                                                    <select name="tipo" class="form-control selectTipoPredio" data-type="{!! $room['type'] !!}">
                                                                        <option value="Laboratório">Laboratório</option>
                                                                        <option value="Sala de Aula">Sala de Aula</option>
                                                                        <option value="Espaço Comum">Espaço Comum</option>
                                                                        <option value="Orientação">Orientação</option>
                                                                        <option value="Auditório">Auditório</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Status</label>
                                                                    <select name="status" class="form-control selectStatusPredio" data-status="{!! $room['status'] !!}">
                                                                        <option value="Disponível">Disponível</option>
                                                                        <option value="Manutenção">Manutenção</option>
                                                                        <option value="Interditada">Interditada</option>
                                                                        <option value="Em Limpeza">Em Limpeza</option>
                                                                        <option value="Contaminada">Contaminada</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Excluir salas dos ambientes -->
                                        <div class="modal fade" id="modalDeleteRoomBldng-{!! $room['id'] !!}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Excluir sala</h5>
                                                        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <div class="modalExcluir">
                                                            <div class="erroExcluir" style="display:none;">Desculpe, não foi possível excluir a sala, tente novamente.</div>
                                                            <p class="mb-0">Tem certeza que deseja excluir {!! $room['name'] !!}?</p>
                                                            <div class="align-center mt-2">
                                                                <button type="button" data-id="{!! $room['id'] !!}" class="btn btn-pill btn-danger excluiSala">Sim</button>
                                                                <button type="button" class="btn btn-pill btn-primary ml-1 closeModal" data-dismiss="modal">Não</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-9 col-sm-10 col-md-10 col-xl-10">
                                            <div class="percent mb-3">
                                                <div class="percent-bar" style="width:<?php echo $percent_rm ?>%"></div>
                                                <span class="percent-value">{!! $percent_rm !!}%</span>
                                            </div>
                                        </div>
                                        <div class="col-3 col-sm-2 col-md-2 col-xl-2 text-end">
                                            <h5>{!! count($room['movements']) !!} / {!! $room['capacity'] !!}</h5>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                <div class="card">
                    <h5 class="p-1 text-center">Cadastrar novo espaço</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('add_room') }}" id="formSalas">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="erroInputsVazios" style="display:none;">Por favor, preencha todos os campos para cadastrar a sala ou ambiente.</div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="form-group col-md-4">
                                    <label for="sala">Nome da sala</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Nome" id="nomeSala" required>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Capacidade</label>
                                    <input type="number" class="form-control" name="capacidade" min="1" placeholder="Qtd. máxima permitida" id="capacidadeSala" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label">Tipo</label>
                                    <select name="tipo" class="form-control" required>
                                        <option value="Laboratório">Laboratório</option>
                                        <option value="Sala de Aula">Sala de Aula</option>
                                        <option value="Espaço Comum">Espaço Comum</option>
                                        <option value="Orientação">Orientação</option>
                                        <option value="Auditório">Auditório</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="Disponível">Disponível</option>
                                        <option value="Manutenção">Manutenção</option>
                                        <option value="Interditada">Interditada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="form-group col-md-4">
                                    <label>Prédio</label>
                                    <select id="selectPredio" name="predio" class="form-control" required>
                                    </select>
                                    <span class="text-danger erroSelectPredio" style="display:none;">Termine de cadastrar um novo prédio ou selecione um já existente para poder cadastrar a sala.</span>
                                </div>
                                <div class="form-group col-md-3 form_add_predio" style="display:none;">
                                    <label>Digite o nome do novo prédio</label>
                                    <input type="text" class="form-control" id="nome_predio" placeholder="F,G ...">
                                    <span class="text-danger erroNomeVazio" style="display:none;">Não é possível cadastrar um prédio sem nome.</span>
                                    <span class="text-danger erroPredioExiste" style="display:none;">Não foi possível cadastrar, pois já existe um prédio com esse nome.</span>
                                </div>
                                <div class="form-group col-md-3 form_add_predio" style="display:none;">
                                    <button type="button" class="btn btn-pill btn-primary mt-2" id="addPredio">Cadastrar prédio</button>
                                </div>
                            </div>
                            <button type="button" id="cadastraSala" class="btn btn-pill btn-primary align-center mt-2">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    //Ativa classes do CSS
    $('#sb-rooms').addClass('active-item');
    $('#tab-content-env div').first().addClass('active');
    $('#nav-env li a').first().addClass('active');
    $('#tab-content-room div').first().addClass('active');
    $('#nav-room li a').first().addClass('active');

    //Cerrega prédios para o select de predio do form adicionar espaço
    function carregaPredios(){
        $.ajax({
            method: "POST",
            url: "//{!! Request::server ('HTTP_HOST') !!}/getBuildings",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(predios){
            $.each(predios, function (i, predio) {
                $("#selectPredio").append($('<option>', {
                    value: predio.id,
                    text : predio.name
                }));
            });
            $("#selectPredio").append($('<option>', {
                value: "novo_predio",
                text: "Criar novo prédio"
            }));
        });
    }

    //On Change event para monitorar o valor do select (manipular o Criar novo prédio)
    function onChangeSelectPredio(){
        $("#selectPredio").change(function(){
            if($(this).val() == "novo_predio"){
                $(".form_add_predio").css("display","");
            }else{
                $(".form_add_predio").css("display","none");
            }
        });
    }

    //Chamada das funções para select de prédios
    carregaPredios();
    onChangeSelectPredio();

    //Função para manter a criação dos prédios com nome maiusculo
    $(function(){
        $('#nome_predio').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });

    //Botão de criar espaço, validações para previnir erros no form
    $("#cadastraSala").click(function(){
        if($("#selectPredio").val() == 'novo_predio'){
            $(".erroSelectPredio").show();
        }else{
            $(".erroSelectPredio").hide();
            var input_nome = $("#nomeSala").val();
            var input_capacidade = $("#capacidadeSala").val();

            if(input_nome == '' && input_capacidade == ''){
                $(".erroInputsVazios").show();
                $("#nomeSala").addClass('inputError');
                $("#capacidadeSala").addClass('inputError');
            }else if(input_nome == ''){
                $(".erroInputsVazios").show();
                $("#nomeSala").addClass('inputError');
                $("#capacidadeSala").removeClass('inputError');
            }else if(input_capacidade == ''){
                $(".erroInputsVazios").show();
                $("#capacidadeSala").addClass('inputError');
                $("#nomeSala").removeClass('inputError');
            }else{
                //success
                $('form#formSalas').submit();
                $(".erroInputsVazios").hide();
                $("#capacidadeSala").removeClass('inputError');
                $("#nomeSala").removeClass('inputError');
            }
        }
    });

    //Botão para cadastrar prédio dentro do form de cadastro de espaço
    $("#addPredio").click(function(){
        var nome_predio = $("#nome_predio").val();
        var exists = false;

        $("#selectPredio option").each(function(){
            if(this.text == nome_predio) {
                exists = true;
            }
        });

        if(nome_predio != "" && !exists){
            $(".erroNomeVazio").hide();
            $(".erroPredioExiste").hide();
            $.ajax({
                method: "POST",
                url: "//{!! Request::server ('HTTP_HOST') !!}/add_building",
                data: {
                    nome: nome_predio
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(data){
                $("#selectPredio").empty();
                carregaPredios();

                setTimeout(() => {
                    var nova_option = $("#selectPredio option").filter(function(){
                        return $(this).html() == nome_predio;
                    }).val();
                    $("#selectPredio").val(nova_option).change();
                }, "1000");
                onChangeSelectPredio();

            });
        }else if(exists){
            $(".erroPredioExiste").show();
            $(".erroNomeVazio").hide();
        }else{
            $(".erroNomeVazio").show();
            $(".erroPredioExiste").hide();
        }
    });

    //Botão para Editar sala do AMBIENTE, seleciona a option equivalente ao valor atual do tipo e status
    $(".btnEditRoomEnv").click(function(){
        var data_target = $(this).attr("data-target");
        var modal = $(data_target);
        var type = modal.find(".selectTipoAmbiente").data('type');
        var status = modal.find(".selectStatusAmbiente").data('status');
        modal.find(".selectTipoAmbiente").val(type).change();
        modal.find(".selectStatusAmbiente").val(status).change();
    });

    //Botão para Editar sala do PRÉDIO, seleciona a option equivalente ao valor atual do tipo e status
    $(".btnEditRoomBldng").click(function(){
        var data_target = $(this).attr("data-target");
        var modal = $(data_target);
        var type = modal.find(".selectTipoPredio").data('type');
        var status = modal.find(".selectStatusPredio").data('status');
        modal.find(".selectTipoPredio").val(type).change();
        modal.find(".selectStatusPredio").val(status).change();
    });

    //Botão para excluir salas de prédios e ambientes
    $(".excluiSala").click(function(){
        var id = $(this).attr("data-id");
        $.ajax({
            method: "DELETE",
            url: "//{!! Request::server ('HTTP_HOST') !!}/delete_room",
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data){
            if(data){
                location.reload();
                $(".erroExcluir").hide();
            }else{
                $(".erroExcluir").show();
            }
        });
    });

    //Fechar modal e suspender erros
    $(".closeModal").click(function(){
        $(".erroExcluir").hide();
    });

    // Botão para Gerar QR CODE
    $(".btnQRCode").click(function(){
        var id = $(this).attr("data-target").replace('#modalQRCode-', '');
        var name = $(this).attr("data-name");
        $("#qrcode-" + id).empty();
        var qrcode = new QRCode("qrcode-" + id);
        qrcode.makeCode(id);

        setTimeout(() => {
            imprimePDF("#qrcode-" + id, name);
        }, "1000");
    });

    //Função para imprimir pdf com nome e pdf da sala
    function imprimePDF(qrcode, name){
        var img = $(qrcode).find('img').attr('src');
        var doc = new jsPDF();
        doc.setFontSize(35);
        doc.text(name, 105, 40, null, null, "center");
        doc.addImage(img, "JPEG", 25, 70, 160, 160);
        doc.save(name + ".pdf");
    };
</script>

@include('/components/footer')
