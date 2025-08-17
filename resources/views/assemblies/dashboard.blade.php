@extends('layouts.app')

@section('page-title', 'Dashboard Asambleas')

@push('styles')
<style>
.chart-container {
    position: relative;
    height: 600px;
}

.variable-box {
    min-width: 0;
    flex: 1 1 auto;
}

.variable-content {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

@media (max-width: 767px) {
    .variable-content {
        white-space: normal;
    }
}
</style>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Dashboard Asambleas</li>
@endsection

@section('content')
<!-- Cajas de Variables -->
<div class="d-flex flex-wrap gap-3 mb-4">
    <div class="variable-box">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="variable-content flex-grow-1">
                        <h6 class="card-title mb-1">Promedio de Asistentes</h6>
                        <h3 class="mb-0">{{ number_format($avgAttendees, 1) }}</h3>
                        <small>Todas las asambleas</small>
                    </div>
                    <div class="ms-2">
                        @if($avgVariation >= 0)
                            <span class="badge bg-success">+{{ number_format($avgVariation, 1) }}%</span>
                        @else
                            <span class="badge bg-danger">{{ number_format($avgVariation, 1) }}%</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="variable-box">
        <div class="card bg-info text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="variable-content flex-grow-1">
                        <h6 class="card-title mb-1">Última Asamblea</h6>
                        <h3 class="mb-0">{{ $lastAttendees }}</h3>
                        <small>Asistentes</small>
                    </div>
                    <div class="ms-2">
                        @if($lastVariation >= 0)
                            <span class="badge bg-success">+{{ number_format($lastVariation, 1) }}%</span>
                        @else
                            <span class="badge bg-danger">{{ number_format($lastVariation, 1) }}%</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico de Asistencia -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                        <h6 class="mb-0">Asistencia a Asambleas</h6>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <select class="form-select form-select-sm" id="periodFilter">
                                    <option value="3">Últimos 3 meses</option>
                                    <option value="6">Últimos 6 meses</option>
                                    <option value="12" selected>Último año</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select form-select-sm" id="typeFilter">
                                    <option value="">Todos los tipos</option>
                                    <option value="General">General</option>
                                    <option value="Extraordinaria">Extraordinaria</option>
                                    <option value="De Ciudadanos">De Ciudadanos</option>
                                    <option value="Informativa">Informativa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Próximas Asambleas y Últimas Resoluciones -->
<div class="row">
    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Próximas Asambleas</h6>
            </div>
            <div class="card-body">
                @if($upcomingAssemblies->count() > 0)
                    @foreach($upcomingAssemblies as $assembly)
                        <div class="row mb-3 pb-2 border-bottom">
                            <div class="col-12 col-sm-8 mb-2 mb-sm-0">
                                <h6 class="mb-1">{{ $assembly->correlative }}</h6>
                                <small class="text-muted d-block">{{ $assembly->type }} - {{ $assembly->scheduled_date->format('d/m/Y H:i') }}</small>
                                <p class="mb-0 small">{{ Str::limit($assembly->reason, 60) }}</p>
                            </div>
                            <div class="col-12 col-sm-4 text-sm-end">
                                <a href="{{ route('assemblies.show', $assembly) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No hay asambleas programadas</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Últimas Resoluciones</h6>
            </div>
            <div class="card-body">
                @if($recentResolutions->count() > 0)
                    @foreach($recentResolutions as $resolution)
                        <div class="mb-3 pb-2 border-bottom">
                            <h6 class="mb-1">{{ $resolution->title }}</h6>
                            <small class="text-muted d-block">{{ $resolution->created_at->format('d/m/Y') }} - {{ $resolution->assembly->correlative ?? 'Sin asamblea' }}</small>
                            <p class="mb-0 small">{{ Str::limit($resolution->description, 80) }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No hay resoluciones recientes</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const chartData = @json($chartData);
let attendanceChart;

function initChart(data) {
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    
    if (attendanceChart) {
        attendanceChart.destroy();
    }
    
    attendanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Asistentes',
                data: data.attendees,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }, {
                label: 'Promedio',
                data: data.average,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderDash: [5, 5],
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                x: {
                    display: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Initialize chart
initChart(chartData);

// Filter handlers
document.getElementById('periodFilter').addEventListener('change', updateChart);
document.getElementById('typeFilter').addEventListener('change', updateChart);

// Dynamic viewport responsiveness
window.addEventListener('resize', function() {
    if (attendanceChart) {
        attendanceChart.resize();
    }
});

// Handle orientation change on mobile
window.addEventListener('orientationchange', function() {
    setTimeout(function() {
        if (attendanceChart) {
            attendanceChart.resize();
        }
    }, 100);
});

function updateChart() {
    const period = document.getElementById('periodFilter').value;
    const type = document.getElementById('typeFilter').value;
    
    fetch(`{{ route('assemblies.dashboard') }}?period=${period}&type=${type}&ajax=1`)
        .then(response => response.json())
        .then(data => initChart(data.chartData));
}
</script>
@endsection