<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\alternatif;
use App\Models\data;
use App\Models\Kriteria;


use Illuminate\Http\Request;

class menghitungController extends Controller
{
    public function saw()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = data::all();

        // Langkah 1: Menentukan Min/Max
        $minMax = [];
        foreach ($kriterias as $kriteria) {
            $nilaiKriteria = $penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai');
            $minMax[$kriteria->id]['min'] = $nilaiKriteria->min();
            $minMax[$kriteria->id]['max'] = $nilaiKriteria->max();
        }

        // Langkah 2: Normalisasi
        $normalizedValues = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                $nilai = $penilaian ? floatval($penilaian->nilai) : 1.0;
                $min = $minMax[$kriteria->id]['min'];
                $max = $minMax[$kriteria->id]['max'];
                $normalized = $kriteria->jenis_kriteria == 'Cost' ? $min / $nilai : $nilai / $max;
                $normalizedValues[$alternatif->id][$kriteria->id] = $normalized;
            }
        }

        // Langkah 3: Menghitung Vektor V
        $vektorV = [];
        foreach ($alternatifs as $alternatif) {
            $vektorVAlt = 0.0;
            foreach ($kriterias as $kriteria) {
                $normalized = $normalizedValues[$alternatif->id][$kriteria->id];
                $bobotNormalized = floatval($kriteria->bobot / $kriterias->sum('bobot'));
                $vektorVAlt += $normalized * $bobotNormalized;
            }
            $vektorV[$alternatif->id] = $vektorVAlt;
        }

        // Langkah 4: Perankingan
        arsort($vektorV);

        return view('perhitungan.saw', compact('alternatifs', 'kriterias', 'penilaians', 'normalizedValues', 'vektorV', 'minMax'));
    }
}
