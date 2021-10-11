<div class="p-8">
    <div class="card shadow-xl p-8 bg-base-200">
        <a href="{{ route('instansi.edit', 0) }}" class="btn btn-primary">Tambah</a>
        <div class=" overflow-x-auto">
            <table class="table table-compact table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Instansi</th>
                        <th>nama_singkatan</th>
                        <th>tipe</th>
                        <th>laman</th>
                        <th>alamat</th>
                        <th>kota</th>
                        <th>prov</th>
                        <th>jumlah_kantor</th>
                        <th>gb_sebaran_kantor</th>
                        <th>kouta_demand</th>
                        <th>kouta_mou</th>
                        <th>jabatan</th>
                        <th>gaji</th>
                        <th>umr</th>
                        <th>jarak_bandara</th>
                        <th>tubel</th>
                        <th>ibel</th>
                        <th>militer</th>
                        <th>jarak_ibukota_provinsi</th>
                        <th>gb_sebaran_kantor</th>
                        <th>ppt</th>
                        <th>yt</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($instansis as $instansi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $instansi->nama }}</td>
                            <td>{{ $instansi->nama_singkatan }}</td>
                            <td>{{ $instansi->tipe }}</td>
                            <td>{{ $instansi->laman }}</td>
                            <td>{{ $instansi->alamat }}</td>
                            <td>{{ $instansi->kota }}</td>
                            <td>{{ $instansi->prov }}</td>
                            <td>{{ $instansi->jumlah_kantor }}</td>
                            <td>{{ $instansi->gb_sebaran_kantor }}</td>
                            <td>{{ $instansi->kouta_demand }}</td>
                            <td>{{ $instansi->kouta_mou }}</td>
                            <td>{{ $instansi->jabatan }}</td>
                            <td>{{ $instansi->gaji }}</td>
                            <td>{{ $instansi->umr }}</td>
                            <td>{{ $instansi->jarak_bandara }}</td>
                            <td>{{ $instansi->tubel }}</td>
                            <td>{{ $instansi->ibel }}</td>
                            <td>{{ $instansi->militer }}</td>
                            <td>{{ $instansi->jarak_ibukota_provinsi }}</td>
                            <td>{{ $instansi->gb_sebaran_kantor }}</td>
                            <td>{{ $instansi->ppt }}</td>
                            <td>{{ $instansi->yt }}</td>
                            <td>
                                <a href="{{ route('instansi.edit', $instansi->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                No data available
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex items-center mt-16 space-x-4">
            <input type="checkbox" checked="checked" class="toggle toggle-primary" wire:model="update.is_active" wire:change="update">
            <span>Izinkan pengguna untuk mengupdate data</span>
        </div>
    </div>

</div>
