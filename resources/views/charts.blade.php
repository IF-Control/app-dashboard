@include('/components/header')
@include('/components/navbar')

<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">Relatórios</h1>
            <p class="header-subtitle">Controle de prédios, salas, ambientes e movimentação dos usuários no Câmpus.</p>
        </div>
        <div class="w-100">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-8">
                    <div class="card">
                        <div class="card-body chart-card">
                            <h5 class="card-title chart-title">Total de usuários contaminados agrupados por ano</h5>
                            <div id="cases_by_year_chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-xl-4">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Aderência às doses de vacina contra a COVID-19</h5>
                                <div id="percentage_of_vaccinated_chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Usuários dentro do grupo de risco</h5>
                                <div id="risk_group_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total de usuários contaminados agrupados por curso</h5>
                            <div id="cases_by_course_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total de usuários contaminados agrupados pelos meses do ano atual</h5>
                            <div id="cases_by_month_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $('#sb-charts').addClass('active-item');

    var optionsForBarChart = {
        series: [{
            name: '',
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        colors: ['#126c33'],
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

    var optionsForPieChart = {
        series: [0],
        chart: {
            height: 220,
            type: 'pie'
        },
        colors: ['#0C250C', '#135413', '#02604F', '#238623', '#6EB36E'],
        plotOptions: {
          pie: {
            dataLabels: {
              offset: -10
            }
          }
        },
        dataLabels: {
            style: {
                fontSize: '12px'
            }
        },
        labels: [''],
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            fontWeight: 400
        }
    };

    var optionsForRadialChart = {
        series: [0],
        chart: {
            height: 210,
            type: 'radialBar'
        },
        fill: {
            colors: ['#2f9e6f']
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    margin: 0,
                    size: '60%',
                    background: '#fff',
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: 'front',
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                track: {
                    background: '#fff',
                    strokeWidth: '67%',
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35
                    }
                },
                dataLabels: {
                    show: true,
                    value: {
                        formatter: function(val) {
                            return Math.round(val) + '%';
                        },
                        fontSize: '24px',
                        fontWeight: '700',
                        offsetY: -8
                    }
                }
            }
        },
        stroke: {
            lineCap: 'round'
        },
        labels: ['']
    };

    //Total de casos confirmados por ano
    $.ajax({
        method: "GET",
        url: "//{!! Request::server ('HTTP_HOST') !!}/get_series_for_cases_by_year",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(casesByYear){
        var cases_by_year_chart = new ApexCharts(document.querySelector("#cases_by_year_chart"), optionsForBarChart);
        cases_by_year_chart.render();

        cases_by_year_chart.updateOptions({
            series: [{
                name: 'Usuários infectados',
                data: casesByYear.casos
            }],
            chart: {
                height: 400
            },
            colors: ['#6EB36E'],
            xaxis: {
                categories: casesByYear.anos
            },
        });
    });

    //Total de doses de vacina dentro do ano
    $.ajax({
        method: "GET",
        url: "//{!! Request::server ('HTTP_HOST') !!}/get_percentage_of_vaccine",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(vaccinated){
        var percentage_of_vaccinated_chart = new ApexCharts(document.querySelector("#percentage_of_vaccinated_chart"), optionsForPieChart);
        percentage_of_vaccinated_chart.render();

        percentage_of_vaccinated_chart.updateOptions({
            series: vaccinated,
            labels: ['Nenhuma dose', '1° Dose', '2° Dose', '3° Dose', '4° Dose'],
        });
    });

    //Total de usuários dentro do grupo de risco
    $.ajax({
        method: "GET",
        url: "//{!! Request::server ('HTTP_HOST') !!}/get_percentage_of_risk_group",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(risk_group){
        var risk_group_chart = new ApexCharts(document.querySelector("#risk_group_chart"), optionsForRadialChart);
        risk_group_chart.render();

        risk_group_chart.updateOptions({
            series: [risk_group]
        });
    });

    //Total de casos confirmados por curso
    $.ajax({
        method: "GET",
        url: "//{!! Request::server ('HTTP_HOST') !!}/get_series_for_cases_by_course",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(casesByYear){
        var cases_by_course_chart = new ApexCharts(document.querySelector("#cases_by_course_chart"), optionsForBarChart);
        cases_by_course_chart.render();

        cases_by_course_chart.updateOptions({
            series: [{
                name: 'Usuários infectados',
                data: casesByYear.casos
            }],
            colors: ['#02604F'],
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            xaxis: {
                labels: {
                    show: false
                    // formatter: function(val) {
                    //     return val.toFixed(0);
                    // }
                },
                categories: casesByYear.cursos
            },
        });
    });

    //Total de casos confirmados por mês
    $.ajax({
        method: "GET",
        url: "//{!! Request::server ('HTTP_HOST') !!}/get_series_for_cases_by_month",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(casesPerMonth){
        var cases_by_month_chart = new ApexCharts(document.querySelector("#cases_by_month_chart"), optionsForBarChart);
        cases_by_month_chart.render();

        cases_by_month_chart.updateOptions({
            series: [{
                name: 'Usuários contaminados',
                data: casesPerMonth
            }],
            colors: ['#2f9e6f'],
        });
    });
 </script>
@include('/components/footer')
