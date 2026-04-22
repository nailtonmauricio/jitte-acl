@extends('templates.admin.index')
@section('content')
    <div class="mb-1 hstack gap-1">
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

    <div class="row">
        {{-- Usuários --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-4 border-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col me-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Usuários
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                150
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>

                    </div>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>

        {{-- Receita --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-4 border-success shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col me-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Receita
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                R$ 12.500
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>

                    </div>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>

        {{-- Tarefas --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-4 border-warning shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col me-2">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Tarefas
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                18 pendentes
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>

                    </div>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>

        {{-- Erros --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-4 border-danger shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col me-2">
                            <div class="text-xs fw-bold text-danger text-uppercase mb-1">
                                Erros
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                3 críticos
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>

                    </div>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Área de Gráficos A
                </div>
                <div class="card-body">
                    <canvas id="loginAttemptsChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Área de Gráficos B
                </div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Área de Gráficos A
                </div>
                <div class="card-body">
                    <canvas id="loginAttemptsChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        {{--<div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Área de Gráficos B
                </div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>--}}
    </div>
@endsection
@push('scripts')
    <script>
        const ctx = document.getElementById('loginAttemptsChart').getContext('2d');
        const loginAttempts = @json($loginAttempts);

        const labels = loginAttempts.map(attempt => attempt.date);
        const data = loginAttempts.map(attempt => attempt.attempts);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Failed Login Attempts',
                    data: data,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
