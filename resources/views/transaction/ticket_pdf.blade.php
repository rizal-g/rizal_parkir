<div style="text-align: center; font-family: sans-serif; border: 1px solid #000; padding: 20px; width: 300px; margin: auto; color: #000000;">
    <h4>SIJA PARKING</h4>
    <p style="font-size: 10px;">Jl. Raya Karadenan No.7, Karadenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16111</p>
    <hr>
    <h2 style="margin: 10px 0;">TIKET PARKIR</h2>
    <p><strong>{{ $tx->lokasi->location_name }}</strong></p>
    <p>{{ $tx->jenisKendaraan->jenis }}</p>
    <hr>
    <p style="font-size: 12px;">No Tiket: {{ $tx->no_tiket }}</p>
    <p style="font-size: 12px;">Tanggal: {{ $tx->masuk }}</p>
    <hr>
    <p style="font-size: 9px; font-style: italic;">Mohon jangan meninggalkan tiket dan barang berharga anda di dalam kendaraan</p>
</div>