<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkirTransaction;
use App\Models\ParkirLocation;
use App\Models\ParkirVehicleType;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $locations = ParkirLocation::all();
        $vehicleTypes = ParkirVehicleType::all();
        
        $selectedVehicle = $request->get('vehicle_id', $vehicleTypes->first()->id ?? 1);
        $tickets = ParkirTransaction::with(['lokasi', 'jenisKendaraan'])->orderBy('id', 'desc')->get();
        
        return view('transaction.index', compact('locations', 'vehicleTypes', 'tickets', 'selectedVehicle'));
    }

    public function storeEnter(Request $request)
    {
        $request->validate([
            'id_lokasi' => 'required',
            'id_jenis' => 'required',
        ]);

        $location = ParkirLocation::find($request->id_lokasi);
        $vt = ParkirVehicleType::find($request->id_jenis);

        if ($location->getSisaSlot($vt->id) <= 0) {
            return back()->with('error', 'Maaf, kapasitas parkir untuk tipe kendaraan ini sudah penuh!');
        }

        $no_tiket = 'PRK-' . date('YmdHis');

        $ticket = ParkirTransaction::create([
            'id_lokasi' => $request->id_lokasi,
            'id_jenis' => $request->id_jenis,
            'no_tiket' => $no_tiket,
            'no_polisi' => '-', 
            'masuk' => Carbon::now(),
        ]);

        $tx = ParkirTransaction::with(['lokasi', 'jenisKendaraan'])->find($ticket->id);

        $pdf = Pdf::loadView('transaction.ticket_pdf', compact('tx'));

        $folderPath = storage_path('public/storage/tickets');

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $pdf->save($folderPath . '/' . $no_tiket . '.pdf');

        return back()->with('masuk_success', $ticket->id);
    }

    public function processExit(Request $request)
    {
        $request->validate([
            'no_tiket' => 'required',
            'no_polisi' => 'required', 
        ]);

        $transaction = ParkirTransaction::where('no_tiket', $request->no_tiket)
                                        ->whereNull('keluar')
                                        ->first();

        if (!$transaction) {
            return back()->with('error', 'Nomor tiket tidak ditemukan atau sudah keluar!');
        }

        $tarif = ParkirVehicleType::find($transaction->id_jenis);
        $waktuMasuk = Carbon::parse($transaction->masuk);
        $waktuKeluar = Carbon::now();

        $totalDurasiDetik = $waktuMasuk->diffInSeconds($waktuKeluar);
        $total_jam_simulasi = ceil($totalDurasiDetik / 60); 
        
        if ($total_jam_simulasi <= 0) {
            $total_jam_simulasi = 1;
        }

        if ($total_jam_simulasi == 1) {
            $total_bayar = $tarif->perjam_pertama;
        } else {
            $total_bayar = $tarif->perjam_pertama + (($total_jam_simulasi - 1) * $tarif->perjam_berikutnya);
        }

        if ($total_bayar > $tarif->max_perhari) {
            $total_bayar = $tarif->max_perhari;
        }

        $transaction->update([
            'no_polisi' => strtoupper(trim($request->no_polisi)), 
            'keluar' => $waktuKeluar,
            'perjam_pertama' => $tarif->perjam_pertama,
            'perjam_berikutnya' => $tarif->perjam_berikutnya,
            'max_perhari' => $tarif->max_perhari,
            'total_jam' => $total_jam_simulasi, 
            'total_bayar' => $total_bayar
        ]);

        return back()->with('keluar_success', $transaction);
    }

    public function downloadTicket($id)
    {
        $tx = ParkirTransaction::with(['lokasi', 'jenisKendaraan'])->findOrFail($id);
        $pdf = Pdf::loadView('transaction.ticket_pdf', compact('tx'));
        return $pdf->stream('tiket-'.$tx->no_tiket.'.pdf');
    }
}