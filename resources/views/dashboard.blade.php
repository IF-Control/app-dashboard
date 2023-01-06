@include('/components/header')
@include('/components/navbar')
<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">Olá {{ session('firstName') }}!</h1>
        </div>
        <div class="w-100">
            <div class="row">
            @if(!empty($cards))
                @foreach ($cards as $card)
                    <div class="col-12 col-sm-12 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body card-responsive">
                                <div class="row">
                                    <div class="col-9 col-sm-9 col-md-9 col-xl-9 p-0">
                                        <h5 class="card-title">{!! $card['titulo_principal'] !!} </h5>
                                    </div>
                                    <div class="col-3 col-sm-3 col-md-3 col-xl-3 p-0">
                                        <div class="avatar float-end">
                                            <div class="avatar-title rounded-circle bg-primary-light">
                                                <i class="fa-solid fa-lg {!! $card['icon'] !!}"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="display-5 mt-1 mb-3">{!! $card['valor_principal'] !!}</h1>
                                <div class="mb-0">
                                    <span class="text-danger">{!! $card['valor_secundario'] !!}</span> {!! $card['titulo_secundario'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                             <h5 class="card-title">Total de usuários contaminados agrupados pelos meses do ano atual</h5>
                            <div id="dash-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $('#sb-home').addClass('active-item');

    $.ajax({
        method: "POST",
        url: "//{!! Request::server ('HTTP_HOST') !!}/get_series_dashboard_chart",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(casesPerMonth){
        var options = {
            series: [{
                name: 'Casos confirmados',
                data: casesPerMonth
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            colors: ['#2F9E41'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ["Jan", "Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        };

        var dash_chart = new ApexCharts(document.querySelector("#dash-chart"), options);
        dash_chart.render();
    });
</script>

@include('/components/footer')
