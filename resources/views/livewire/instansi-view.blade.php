<link rel="stylesheet" href="{{ asset('sortable.min.css') }}">
<script src="{{ asset('sortable.min.js') }}"></script>


<div class="p-8 space-y-8">
    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-block">Dashboard</a>
    <div class="card shadow-xl p-8 bg-base-200">
        <div class="overflow-x-auto">
            <table class="table table-compact table-zebra sortable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>nama singkatan</th>
                        <th>nama asli</th>
                        <th>K/L/P</th>
                        <th>laman web</th>
                        <th>sebaran penempatan</th>
                        <th>demand manset</th>
                        <th>jabatan manset</th>
                        <th>gaji</th>
                        <th>tubel</th>
                        <th>ibel</th>
                        <th>ppt</th>
                        <th>yt profile</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instansis as $instansi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $instansi->nama_singkatan }}</td>
                            <td>{{ $instansi->nama }}</td>
                            <td>{{ $instansi->tipe }}</td>
                            <td><a target="_blank" href="{{ $instansi->laman }}" class="btn btn-xs btn-info">Website</a></td>
                            <td><a target="_blank" href="{{ $instansi->gb_sebaran_kantor}}" class="btn btn-xs btn-info">Foto</a></td>
                            <td>{{ $instansi->kuota_demand }}</td>
                            <td>{{ $instansi->jabatan }}</td>
                            <td>{{ $instansi->gaji }}</td>
                            <td>{{ $instansi->tubel }}</td>
                            <td>{{ $instansi->ibel }}</td>
                            <td><a class="btn btn-xs btn-info" target="_blank" href="{{ $instansi->ppt }}">PPT</a></td>
                            <td><a class="btn btn-xs btn-info" target="_blank" href="{{ $instansi->yt }}">Youtube</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
