<div class="card p-8 bg-base-200 container mx-auto my-8">
        <form wire:submit.prevent="save">
            <x-form.input-instansi field="instansi.nama" label="Nama Instansi"></x-form>
            <x-form.input-instansi field="instansi.nama_singkatan" label="Singkatan Instansi"></x-form>

            <div class="form-control mb-4">
                <label class="label">
                <span class="label-text">Tipe Instansi</span>
                </label>
                <select class="select select-bordered select-info w-full" wire:model="instansi.tipe">
                    <option value="Kementerian">Kementerian</option>
                    <option value="Lembaga">Lembaga</option>
                    <option value="Pemerintah Daerah">Pemerintah Daerah</option>
                </select>
            </div>
            <x-form.input-instansi field="instansi.laman" label="Laman Web Instansi"></x-form>
            <x-form.input-instansi field="instansi.alamat" label="Alamat Kantor Pusat"></x-form>
            <x-form.input-instansi field="instansi.kota" label="Kota/Kab Kantor Pusat"></x-form>
            <x-form.input-instansi field="instansi.prov" label="Provinsi Kantor Pusat"></x-form>
            <x-form.input-instansi field="instansi.jumlah_kantor" label="Jumlah Kantor Vertikal"></x-form>
            {{-- <x-form.input-instansi field="instansi.gb_sebaran_kantor" label="Gambaran Sebaran Kantor Vertikal"></x-form> --}}
            {{-- <label for="">Gambar Sebaran Kantor</label> --}}
            <input type="file" wire:model="photo">
            <x-form.input-instansi field="instansi.gb_sekitar_kantor" label="Screen Shot Maps Sekitar Kantor"></x-form>
            <x-form.input-instansi field="instansi.kuota_demand" label="Permintaan Anak Manset (KLPFest)"></x-form>
            <x-form.input-instansi field="instansi.kuota_mou" label="Kouta Anak Manset (Sesuai MOU)"></x-form>
            <x-form.input-instansi field="instansi.jabatan" label="Jabatan Anak Manset"></x-form>
            <x-form.input-instansi field="instansi.gaji" label="Besaran Gaji"></x-form>
            <x-form.input-instansi field="instansi.umr" label="Besaran UMR Daerah (Pemda)"></x-form>
            <x-form.input-instansi field="instansi.jarak_bandara" label="Jarak Dari Kantor ke Bandara"></x-form>
            <x-form.input-instansi field="instansi.tubel" label="Kesempatan Tugas Belajar"></x-form>
            <x-form.input-instansi field="instansi.ibel" label="Kesempatan Izin Belajar"></x-form>
            {{-- <div class="form-control mb-4">
                <label class="label">
                <span class="label-text">Militer/Semi Militer/Non Militer</span>
                </label>
                <select class="select select-bordered select-info w-full" wire:model="instansi.militer">
                    <option value="Militer">Militer</option>
                    <option value="Semi militer">Semi militer</option>
                    <option value="Non militer">Non militer</option>
                </select>
            </div>
            @error('instansi.militer')
                {{$message}}
            @enderror --}}
            <x-form.input-instansi field="instansi.militer" label="Jarak Dari Kantor ke Ibu Kota Provinsi"></x-form>
            <x-form.input-instansi field="instansi.jarak_ibukota_provinsi" label="Jarak Dari Kantor ke Ibu Kota Provinsi"></x-form>
            <x-form.input-instansi field="instansi.ppt" label="PPT Instansi Dari KLPFest"></x-form>
            <x-form.input-instansi field="instansi.yt" label="Link Youtobe Profile Instansi"></x-form>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

</div>
