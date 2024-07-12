<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\alternatif;
use App\Models\Kriteria;
use App\Models\data;

use Illuminate\Http\Request;

class dataController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = data::all();

        return view('penilaian.index', compact('alternatifs', 'kriterias', 'penilaians'));
    }

    public function create()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        return view('penilaian.create', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $alternativeId = $request->input('alternative_id');

        DB::beginTransaction();
        try {
            foreach ($data as $key => $value) {
                if ($key != 'alternative_id') {
                    data::updateOrCreate(
                        ['alternatif_id' => $alternativeId, 'kriteria_id' => $key],
                        ['nilai' => $value]
                    );
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat menyimpan data!');
        }

        return redirect()->route('penilaian.index')->with('toast_success', 'Penilaian alternatif diperbarui!');
    }

    public function getForms(Request $request)
    {
        $id = $request->id;
        $forms = data::with(['alternatif', 'kriteria'])
            ->where('alternatif_id', $id)
            ->get();

        $alternatif = Alternatif::find($id);
        $kriterias = Kriteria::all();

        return view('penilaian.edit', compact('forms', 'alternatif', 'kriterias'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'alternative_id']);
        $alternativeId = $request->only('alternative_id')['alternative_id'];
        $alternative = Alternatif::find($alternativeId);

        DB::beginTransaction();
        try {
            foreach ($data as $key => $value) {
                DB::table('penilaians')
                    ->where('id', '=', $key)
                    ->update(['nilai' => $value]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengupdate data!');
        }

        return redirect()->route('penilaian.index')->with('toast_success', 'Penilaian alternatif ' . $alternative->nama . ' diperbarui!');
    }
}
