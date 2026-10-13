<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckinController extends Controller
{
    /**
     * Form check-in (input kode booking + virtual keyboard).
     */
    public function index(Request $request): View
    {
        return view('kiosk.checkin', [
            'kode' => (string) $request->query('kode', ''),
        ]);
    }

    /**
     * Terima kode booking. TODO: hubungkan ke endpoint check-in TERA
     * bila sudah tersedia (saat ini hanya menampilkan konfirmasi).
     */
    public function store(Request $request): View
    {
        $data = $request->validate([
            'kode_booking' => ['required', 'string', 'max:50'],
        ], [
            'kode_booking.required' => 'Kode booking wajib diisi.',
        ]);

        /** @var string $kode */
        $kode = trim($data['kode_booking']);

        return view('kiosk.checkin-hasil', ['kode' => $kode]);
    }
}
