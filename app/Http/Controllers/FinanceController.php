<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;

class FinanceController extends Controller
{
    public function index()
    {
        $data = Finance::all();

        $pemasukan = Finance::sum('pemasukan');
        $pengeluaran = Finance::sum('pengeluaran');

        $saldo = $pemasukan - $pengeluaran;

        return view('finance', compact('data','pemasukan','pengeluaran','saldo'));
    }

    public function store(Request $request)
    {
        Finance::create([
            'keterangan' => $request->keterangan,
            'pemasukan' => $request->pemasukan,
            'pengeluaran' => $request->pengeluaran
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        $data = Finance::findOrFail($id);
        $data->update($request->only(['keterangan','pemasukan','pengeluaran']));
        return redirect('/finance');
    }

    public function destroy($id){
        Finance::destroy($id);
        return redirect('/finance');
    }
}