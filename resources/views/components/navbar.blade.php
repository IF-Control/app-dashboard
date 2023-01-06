<div class="wrapper">
    <nav id="sidebar" class="sidebar">
        <a class="sidebar-brand" href="{{ url('') }}">
            <div class="sidebar-logo">
                <img src="img/logo.png" width="50" alt="Logo IF Control" />
                <h3>IF Control</h3>
            </div>
        </a>
        <div class="sidebar-content">
            <ul class="sidebar-nav">
                <li class="sidebar-item" id="sb-home">
                    <a class="sidebar-link" href="{{ url('dashboard') }}">
                        <i class="align-middle me-2 far fa-fw fas fa-fw fa-home"></i> <span class="align-middle">Página Inicial</span>
                    </a>
                </li>
                <li class="sidebar-item" id="sb-rooms">
                    <a class="sidebar-link" href="{{ url('environments') }}">
                        <i class="align-middle me-2 far fa-fw fas fa-fw fa-file"></i> <span class="align-middle">Ambientes</span>
                    </a>
                </li>
                <li class="sidebar-item" id="sb-alerts">
                    <a class="sidebar-link" href="{{ url('movement') }}">
                        <i class="align-middle me-2 move-icon fa-solid fa-person-walking"></i><span class="align-middle">Movimentações</span>
                    </a>
                </li>
                <li class="sidebar-item" id="sb-charts">
                    <a class="sidebar-link" href="{{ url('charts') }}">
                        <i class="align-middle me-2 fas fa-fw fa-chart-pie"></i> <span class="align-middle">Relatórios</span>
                    </a>
                </li>
                <li class="sidebar-item" id="sb-tips">
                    <a class="sidebar-link" href=" {{ url('health_tips') }}">
                        <i class="align-middle me-2 fas fa-fw fa-laptop-medical"></i><span class="align-middle">Dicas de Saúde</span>
                    </a>
                </li>
                <li class="sidebar-item" id="sb-adm">
                    <a class="sidebar-link" href="{{ url('administrator') }}">
                        <i class="align-middle me-2 fas fa-fw fa-user"></i><span class="align-middle">Administradores</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="main">
        <nav class="navbar navbar-expand navbar-theme">
            <a class="sidebar-toggle d-flex me-2">
                <i class="hamburger align-self-center"></i>
            </a>
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="align-middle fas fa-cog"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ url('my_account') }}"><i class="align-middle me-1 fas fa-fw fa-user"></i> Minha Conta</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('download') }}"><i class="align-middle me-1 fas fa-fw fa-mobile"></i> Baixar Aplicativo</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('logout') }}"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sair</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>







