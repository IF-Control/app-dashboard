<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\HealthTipsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MovementController;

//Login
Route::post('/login', [LoginController::class, 'handle'])->name('enter');
Route::get('/login', function () {
    return (!session('id') ? view('login') : redirect('/'));
});

//Logout
Route::get('/logout', [LogoutController::class, 'handle']);

//PG Dashboard
Route::get('/', [DashboardController::class, 'getDashboardPage']);
Route::get('/dashboard', function () {
    return (redirect('/'));
});
    //Retorna o obj com os dados para o gráfico geral da Dashbard
    Route::post('/get_series_dashboard_chart', [DashboardController::class, 'getSeriesForTotalCasesOfYearChart']);

//PG Ambiente
Route::get('/environments', [EnvironmentController::class, 'getEnvironmentPage']);
/* PREDIOS */
    //C Cria prédios
    Route::post('/add_building', [EnvironmentController::class, 'addBuilding']);
    //R Carrega prédios
    Route::post('/getBuildings', [EnvironmentController::class, 'getBuildings']);
    //U Edita prédios
    Route::patch('/edit_building', [EnvironmentController::class, 'editBuilding'])->name('edit_building');
/* SALAS */
    //C Cria salas
    Route::post('/add_room', [EnvironmentController::class, 'addRoom'])->name('add_room');
    //U Editar salas
    Route::patch('/edit_room', [EnvironmentController::class, 'editRoom'])->name('edit_room');
    //D Deleta sala
    Route::delete('/delete_room', [EnvironmentController::class, 'deleteRoom']);

//PG Relatórios
Route::get('/charts', [ChartController::class, 'getChartPage']);
Route::get('/get_series_for_cases_by_month', [ChartController::class, 'getSeriesForCasesByMonthChart']);
Route::get('/get_series_for_cases_by_year', [ChartController::class, 'getSeriesForCasesByYearChart']);
Route::get('/get_series_for_cases_by_course', [ChartController::class, 'getSeriesForCasesByCourseChart']);
Route::get('/get_percentage_of_vaccine', [ChartController::class, 'getPercentageOfVaccineChart']);
Route::get('/get_percentage_of_risk_group', [ChartController::class, 'getPercentageOfRiskGroupChart']);

//PG Dicas de Saúde
Route::get('/health_tips', [HealthTipsController::class, 'getHealthTipsPage']);
    //R Carrega dicas de saúde
    Route::post('/get_health_tips', [HealthTipsController::class, 'getHealthTips'])->name('get_health_tips');
    //D Deleta dica
    Route::delete('/delete_tip', [HealthTipsController::class, 'deleteTip']);

//PG Administradores
Route::get('/administrator', [AdministratorController::class, 'getAdministratorPage']);
    //C Cria Administrador
    Route::post('/add_adm', [AdministratorController::class, 'addAdm']);
    //R Carrega Administradores
    Route::get('/get_adms', [AdministratorController::class, 'getAdms']);
    //U Editar AdministradorES
    Route::patch('/update_adm', [AdministratorController::class, 'updateAdm'])->name('update_adm');
    //D Deleta Administradores
    Route::delete('/delete_adm', [AdministratorController::class, 'deleteAdm'])->name('delete_adm');

// PG Minha Conta
Route::get('/my_account', [AdministratorController::class, 'getMyAccountPage']);
    //U Editar Dados da conta do adm logado
    Route::patch('/update_account', [AdministratorController::class, 'updateAccount']);

// PG Movimentações de usuários contaminados (Alertas)
Route::get('/movement', [MovementController::class, 'getMovementPage']);
    //R Carrega movimentações
    // Route::get('/get_movements', [MovementController::class, 'updateAccount']);

// PG Baixar app
    // R Link para o app
    Route::get('/download', [AppController::class, 'getAppPage']);
