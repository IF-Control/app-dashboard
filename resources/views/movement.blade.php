@include('/components/header')
@include('/components/navbar')

<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">Alertas de movimentações</h1>
            <p class="header-subtitle">Movimentações de usuários contaminados nos últimos 3 meses.</p>
        </div>
        <div class="w-100">  
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="accordion" id="accordionUsers">
                    @if(!empty($users))
                        @foreach ($users as $user)
                            <?php $prontuario = $user['user']['enrollment'] ? $user['user']['enrollment'] : 'Visitante: '.$user['user']['email'] ?>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <a href="#" data-toggle="collapse" data-target="#card-{!! $user['user']['id'] !!}" class="collapsed">
                                        <div class="row">
                                            <div class="col-10 col-sm-10 col-md-10 col-xl-10">
                                                <h5 class="card-title my-2 text-primary">{!! $prontuario !!}</h5>
                                            </div>
                                            <div class="col-2 col-sm-2 col-md-2 col-xl-2 text-end">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="card-{!! $user['user']['id'] !!}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionUsers">
                                    <div class="card-body card-scroll">
                                        <p><i class="fa-solid fa-syringe text-danger"></i> Este usuário registrou {!! $user['user']['vaccine_doses'] !!} doses de vacina contra a COVID-19.</p>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Horário</th>
                                                    <th>Sala</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user['user']['movements'] as $movement)
                                                    <tr>
                                                        <td>{!! explode(' ', $movement['checkin_date'])[0] !!}</td>
                                                        <td>{!! explode(' ', $movement['checkin_date'])[1] !!}</td>
                                                        <td>{!! $movement['room']['name'] !!}</td>
                                                    </tr>
                                                @endforeach
                                                @if(empty($user['user']['movements']))
                                                <tr>
                                                    <td colspan="3" class="text-center">Este usuário não tem movimentações nos últimos 3 meses.</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>  
        </div>
    </div>  
</main>

<script>
    $('#sb-alerts').addClass('active-item');
</script>
@include('/components/footer')