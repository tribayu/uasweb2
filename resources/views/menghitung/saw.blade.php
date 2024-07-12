@extends('layouts.admin')

@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Perhitungan Simple Additive Weighting (SAW)') }}</h1>

<!-- Langkah 1: Menentukan Min/Max -->
<div class="card shadow mb-4">
    <div class="card-header">Menentukan Min/Max</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @foreach ($kriterias as $kriteria)
                        <th>{{ $kriteria->nama_kriteria }} (Min/Max)</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($kriterias as $kriteria)
                        <td>{{ $minMax[$kriteria->id]['min'] }} / {{ $minMax[$kriteria->id]['max'] }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Langkah 2: Normalisasi -->
<div class="card shadow mb-4">
    <div class="card-header">Normalisasi</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                        <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        @foreach ($kriterias as $kriteria)
                        <td>{{ $normalizedValues[$alternatif->id][$kriteria->id] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Langkah 3: Menghitung Vektor V -->
<div class="card shadow mb-4">
    <div class="card-header">Menghitung Vektor V</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        <th>Vektor V</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vektorV as $altId => $nilaiV)
                    <tr>
                        <td>{{ $alternatifs->find($altId)->nama_alternatif }}</td>
                        <td>{{ $nilaiV }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Langkah 4: Perankingan -->
<div class="card shadow mb-4">
    <div class="card-header">Peringkat</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        <th>Vektor V</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rank = 1; @endphp
                    @foreach ($vektorV as $altId => $nilaiV)
                    <tr>
                        <td>{{ $alternatifs->find($altId)->nama_alternatif }}</td>
                        <td>{{ $nilaiV }}</td>
                        <td>{{ $rank++ }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection