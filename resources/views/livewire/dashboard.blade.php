
<div class="grid grid-cols-12 p-8 text-base-content gap-x-4 gap-y-4 items-stretch" x-data>

    <livewire:component.alert class="col-span-12">
    <div class="col-span-12">
        <a href="{{ route('instansi.view') }}" class="btn btn-primary btn-block">Daftar Instansi</a>
    </div>

    <div class="col-span-12 md:col-span-6 md:row-span-4 card p-8 bg-base-200 flex flex-row items-center overflow-visible">
        <canvas id="myChart" ></canvas>
    </div>

    <div class="card col-span-8 md:col-span-4 bg-base-200 p-4 flex flex-col items-start overflow-visible">

        <div class="flex flex-row items-center space-x-2">
            {{-- Proporsi IPK --}}
            <div class="relative"  x-data="{
                show : false,
            }">
                <div class="btn btn-xs btn-outline btn-primary" @click="show = true" @click.outside="show = false">
                    {{ $proporsi_ipk * 100 }} % IPK
                </div>
                <div x-show="show" x-transition class="absolute z-50 top-10 card bg-primary text-base-content w-full text-center py-2">
                    <ul>
                        @for ($i = 0; $i <= 10; $i++)
                            <li class="hover:bg-opacity-25 hover:bg-neutral cursor-pointer" wire:click="proporsi_ipk({{ $i }})">{{ $i*10 }}%</li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="relative"  x-data="{
                show : false,
            }">
                <div class="btn btn-xs btn-outline btn-primary" @click="show = true" @click.outside="show = false">
                    {{ $proporsi_skd * 100 }} % SKD
                </div>
                <div x-show="show" x-transition class="absolute z-50 top-10 card bg-primary text-base-content w-full text-center py-2">
                    <ul>
                        @for ($i = 0; $i <= 10; $i++)
                            <li class="hover:bg-opacity-25 hover:bg-neutral cursor-pointer" wire:click="proporsi_skd({{ $i }})">{{ $i*10 }}%</li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="group cursor-pointer ralative" x-data="{show : false}" x-transition>
                <svg
                    @mouseover="show = true"
                    @mouseleave="show = false"
                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
                <div class="absolute top-16 left-0  z-50 w-full max-w-screen bg-primary p-2 card text-xs" x-show="show">
                    <ul class="list-disc list-inside">
                        <li>Disarankan menggunakan proporsi 60% IPK dan 40% SKD</li>
                        <li>Kabar baiknya, kamu bebas untuk bereksperimen menentukan proporsi</li>
                        <li>Isi proporsi 100% IPK dan 0% SKD jika kamu ingin mengunakan nilai IPK saja</li>
                    </ul>
                </div>
            </div>
        </div>
        <small>Proporisi gabungan</small>
    </div>
    <div class="card col-span-4 md:col-span-2 bg-base-200 p-4 flex flex-col items-start overflow-visible">
        <div class="flex flex-row items-center space-x-2">
            <div class="btn btn-xs btn-primary btn-outline" wire:click="ubah_anonim">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    @if ($user->is_anonim)
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    @else
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    @endif
                  </svg>
            </div>
            <div class="group cursor-pointer ralative" x-data="{show : false}" x-transition>
                <svg
                    @mouseover="show = true"
                    @mouseleave="show = false"
                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
                <div class="absolute top-16 right-0 z-50 w-full max-w-screen bg-primary p-2 card text-xs" x-show="show">
                    <ul class="list-disc list-inside">
                        <li>Aktifkan jika kamu bersedia namamu dilihat oleh orang lain sesuai pilihan instansimu</li>
                        <li>Nilaimu tidak akan terlihat oleh orang lain, baik dalam anonim maupun tidak</li>
                    </ul>
                </div>
            </div>
        </div>
        <small>{{ $user->is_anonim ? 'Anonim' : 'Terlihat'}}</small>
    </div>

    <x-pilihan
        judul="Pilihan 1"
        wire-model="pilihan_satu.instansi_id"
        wire-click="pilihan_satu"
        :instansis="$instansis"
        :pilihan-instansi="$pilihan_satu->instansi->nama ?? null"
        :jumlah-instansi="$jumlah_instansi_satu"
        pilihan="pilihan_satus"
        :jumlah-partisipan-kelas="$data['partisipan_pilihan_satu_kelas']"
    ></x-pilihan>

    <x-pilihan
        judul="Pilihan 2"
        wire-model="pilihan_dua.instansi_id"
        wire-click="pilihan_dua"
        :instansis="$instansis"
        :pilihan-instansi="$pilihan_dua->instansi->nama ?? null"
        :jumlah-instansi="$jumlah_instansi_dua"
        pilihan="pilihan_duas"
        :jumlah-partisipan-kelas="$data['partisipan_pilihan_dua_kelas']"
    ></x-pilihan>

    <x-pilihan
        judul="Pilihan 3"
        wire-model="pilihan_tiga.instansi_id"
        wire-click="pilihan_tiga"
        :instansis="$instansis"
        :pilihan-instansi="$pilihan_tiga->instansi->nama ?? null"
        :jumlah-instansi="$jumlah_instansi_tiga"
        pilihan="pilihan_tigas"
        :jumlah-partisipan-kelas="$data['partisipan_pilihan_tiga_kelas']"
    ></x-pilihan>

    {{-- GRAFIK INSTANSI --}}
    <div
        class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center bg-neutral bg-opacity-95 z-40 p-8"
        x-show="$wire.count_instansi"
        x-transition
        >
        <div class="bg-base-200 w-full h-full card p-4 flex flex-col border-primary border-2 gap-4 overflow-auto"
            @click.outside="$wire.close_instansi"
        >
            {{-- Button close --}}
            <div class="flex flex-row items-stretch gap-4 lg:hidden p-2">
                <div class="card py-2 px-4 font-bold text-primary bg-base-100 flex-grow">
                    {{ $prioritas_instansi }}
                </div>
                <div class="card bg-primary py-2 px-4 hover:bg-primary-focus cursor-pointer" wire:click="close_instansi">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="p-4 card bg-accent flex-shrink-0 sticky top-0 z-50" id="pesan_rank">
                Klik grafik dibawah untuk memperoleh informasi yang lebih lengkap!
            </div>
            <div class="flex flex-col lg:flex-row flex-grow gap-4">
                <div class="p-4 card bg-base-100 w-full lg:w-3/4 flex-shrink-0 lg:flex-shrink gap-x-2 grid grid-cols-custom-chart grid-rows-custom-chart items-center content-start" id="chart_instansi">
                </div>
                <div class="flex-1 flex flex-col gap-4">
                    <div class="flex-row items-stretch gap-4 hidden lg:flex">
                        <div class="card py-2 px-4 font-bold text-primary bg-base-100 flex-grow">
                            {{ $prioritas_instansi }}
                        </div>
                        <div class="card bg-primary py-2 px-4 hover:bg-primary-focus cursor-pointer" wire:click="close_instansi">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-shrink-0 gap-4 grid grid-cols-3 text-12 text-center">
                        <div class="card bg-base-100 p-2 col-span-1">
                            {{round($ipk_saya, 2)}} <br>
                            <small>IPK</small>
                        </div>
                        <div class="card bg-base-100 p-2 col-span-1">
                            {{$skd_saya}} <br>
                            <small>SKD</small>
                        </div>
                        <div class="card bg-base-100 p-2 col-span-1">
                            {{round($nilai_gabungan_saya, 2)}} <br>
                            <small>Gabungan</small>
                        </div>
                    </div>
                    <div class="p-4 card bg-base-100 flex-shrink-0" id="chart_ipk">
                    </div>
                    <div class="p-4 card bg-base-100 flex-1">
                        <ul id="nama_pemilih" class="overflow-auto">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4 md:col-span-3 sm:col-span-6 col-span-12 flex flex-row items-center justify-center space-x-2 bg-base-200">
        <span>IPK sekarang</span>
        <div class="rounded-2xl bg-secondary flex items-center justify-center font-bold text-l h-12 w-12 text-base-200">
            {{ round($ipk_saya, 2) }}
        </div>
    </div>
    <div class="card p-4 md:col-span-3 sm:col-span-6 col-span-12 flex flex-row items-center justify-center space-x-2 bg-base-200">
        <span>Peringkat IPK</span>
        <div class="rounded-2xl bg-secondary flex items-center justify-center font-bold text-l h-12 w-12 text-base-200">
            {{ $ipk_saya_rank }}
        </div>
    </div>
    <div class="card p-4 md:col-span-3 sm:col-span-6 col-span-12 flex flex-row items-center justify-center space-x-2 bg-base-200">
        <span>SKD sekarang</span>
        <div class="rounded-2xl bg-secondary flex items-center justify-center font-bold text-l h-12 w-12 text-base-200">
            {{ $skd_saya }}
        </div>
    </div>
    <div class="card p-4 md:col-span-3 sm:col-span-6 col-span-12 flex flex-row items-center justify-center space-x-2 bg-base-200">
        <span>Peringkat SKD</span>
        <div class="rounded-2xl bg-secondary flex items-center justify-center font-bold text-l h-12 w-12 text-base-200">
            {{ $skd_saya_rank }}
        </div>
    </div>

    <!-- Tabel IP -->
    <div class="col-span-12 card shadow-xl p-8 bg-base-200 overflow-auto">
        <table class="table table-zebra">
            <thead>
              <tr>
                <th>#</th>
                <th>IP / Nilai SKD</th>
                <th>Rata-rata angkatan</th>
                <th>Peringkat</th>
                <th>Pertisipan {{ $user_kelas }}</th>
                <th style="max-width: 200px" class="text-center">Seluruh Partisipan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <x-semester
                no="Semester 1"
                route="nilai-satu"
                :nilai="$data['nilai_sem_satu']"
                :rata="isset($data['nilai_sem_satu']) ? $data['rata_sem_satu']: null"
                :rank="isset($data['nilai_sem_satu']) ? $data['rank_sem_satu']: null"
                :partisipan="isset($data['nilai_sem_satu']) ? $data['partisipan_sem_satu'] : null"
                :partisipan-kelas="isset($data['nilai_sem_satu']) ? $data['partisipan_sem_satu_kelas'] : null"
              ></x-semester>
              <x-semester
                no="Semester 2"
                route="nilai-dua"
                :nilai="$data['nilai_sem_dua']"
                :rata="isset($data['nilai_sem_dua']) ? $data['rata_sem_dua']: null"
                :rank="isset($data['nilai_sem_dua']) ? $data['rank_sem_dua']: null"
                :partisipan="isset($data['nilai_sem_dua']) ? $data['partisipan_sem_dua'] : null"
                :partisipan-kelas="isset($data['nilai_sem_dua']) ? $data['partisipan_sem_dua_kelas'] : null"
              ></x-semester>
              <x-semester
                no="Semester 3"
                route="nilai-tiga"
                :nilai="$data['nilai_sem_tiga']"
                :rata="isset($data['nilai_sem_tiga']) ? $data['rata_sem_tiga']: null"
                :rank="isset($data['nilai_sem_tiga']) ? $data['rank_sem_tiga']: null"
                :partisipan="isset($data['nilai_sem_tiga']) ? $data['partisipan_sem_tiga'] : null"
                :partisipan-kelas="isset($data['nilai_sem_tiga']) ? $data['partisipan_sem_tiga_kelas'] : null"
              ></x-semester>
              <x-semester
                no="Semester 4"
                route="nilai-empat"
                :nilai="$data['nilai_sem_empat']"
                :rata="isset($data['nilai_sem_empat']) ? $data['rata_sem_empat'] : null"
                :rank="isset($data['nilai_sem_empat']) ? $data['rank_sem_empat'] : null"
                :partisipan="isset($data['nilai_sem_empat']) ? $data['partisipan_sem_empat'] : null"
                :partisipan-kelas="isset($data['nilai_sem_empat']) ? $data['partisipan_sem_empat_kelas'] : null"
              ></x-semester>
              <x-semester
                no="Semester 5"
                route="nilai-lima"
                :nilai="$data['nilai_sem_lima']"
                :rata="isset($data['nilai_sem_lima']) ? $data['rata_sem_lima'] : null"
                :rank="isset($data['nilai_sem_lima']) ? $data['rank_sem_lima'] : null"
                :partisipan="isset($data['nilai_sem_lima']) ? $data['partisipan_sem_lima'] : null"
                :partisipan-kelas="isset($data['nilai_sem_lima']) ? $data['partisipan_sem_lima_kelas'] : null"
              ></x-semester>
              <x-semester
                no="Semester 6"
                route="nilai-enam"
                :nilai="$data['nilai_sem_enam']"
                :rata="isset($data['nilai_sem_enam']) ? $data['rata_sem_enam'] : null"
                :rank="isset($data['nilai_sem_enam']) ? $data['rank_sem_enam'] : null"
                :partisipan="isset($data['nilai_sem_enam']) ? $data['partisipan_sem_enam'] : null"
                :partisipan-kelas="isset($data['nilai_sem_enam']) ? $data['partisipan_sem_enam_kelas'] : null"
              ></x-semester>
             <x-semester
                no="Nilai SKD"
                route="nilai-skd"
                :nilai="$data['nilai_skd']"
                :rata="isset($data['nilai_skd']) ? $data['rata_skd'] : null"
                :rank="isset($data['nilai_skd']) ? $data['rank_skd'] : null"
                :partisipan="isset($data['nilai_skd']) ? $data['partisipan_skd'] : null"
                :partisipan-kelas="isset($data['nilai_skd']) ? $data['partisipan_skd_kelas'] : null"
              ></x-semester>

            </tbody>
          </table>
    </div>
</div>



<script>
// Chart IP
const labels = [
  '1',
  '2',
  '3',
  '4',
  '5',
  '6',
];
const data = {
    labels: labels,
    datasets:
    [{
        label: 'IP saya',
        backgroundColor: '#a64ac9',
        borderColor: '#a64ac9',
        cubicInterpolationMode: 'monotone',
        data: [
            {{ $data['nilai_sem_satu'] }},
            {{ $data['nilai_sem_dua'] }},
            {{ $data['nilai_sem_tiga'] }},
            {{ $data['nilai_sem_empat'] }},
            {{ $data['nilai_sem_lima'] }},
            {{ $data['nilai_sem_enam'] }},

            ],
    },{
        label: 'Rata-rata IP partisipan',
        backgroundColor: '#2aa79b',
        borderColor: '#2aa79b',
        cubicInterpolationMode: 'monotone',
        data: [
            {{ $data['rata_sem_satu'] ?? 2.75 }},
            {{ $data['rata_sem_dua'] ?? 2.75}},
            {{ $data['rata_sem_tiga'] ?? 2.75}},
            {{ $data['rata_sem_empat'] ?? 2.75}},
            {{ $data['rata_sem_lima'] ?? 2.75}},
            {{ $data['rata_sem_enam'] ?? 2.75}},
        ],
    }]
};
const config = {
    type: 'line',
    data,
    options: {}
};
var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
// CHART INSTANSI
let pilihan_saya ;
let ipk_saya;
let data_pemilih = null
let ipk_pemilih = null
let chart_instansi = '';
let data_instansi = '';
window.addEventListener('count_instansi_update', event => {
    // Set data dari fetch
    this.data_pemilih = event.detail.data_pemilih;
    this.ipk_pemilih = event.detail.ipk_pemilih;
    this.ipk_saya = event.detail.ipk_saya;
    this.pilihan_saya = event.detail.pilihan_saya;
    this.data_instansi = event.detail.data;
    let target = document.getElementById('chart_instansi');
    // Hapus canvas jika telah ada
    while(target.firstChild){
      target.firstChild.remove();
    }
    // Siapkan grafik
    let grafik = ``;
    let instansi_peminat_terbanyak = this.data_instansi[0].jumlah;
    this.data_instansi.forEach((i, index)=>{
        pilihan_saya = ``
        if(this.pilihan_saya == i.nama){
            pilihan_saya = `text-primary`
        }
        grafik += `
                <div data-tip="${i.nama}" class="tooltip tooltip-primary tooltip-right z-40 cursor-pointer flex justify-end ">
                    <span onClick="showIpkInstansi(${index}, '${i.nama_singkatan}')" class="text-right instansi ${pilihan_saya}" data-index-instansi="${index}" data-nama-instansi="${i.nama_singkatan}">${i.nama_singkatan}</span>
                </div>
                <span>(${i.jumlah})</span>
                <progress onClick="showIpkInstansi(${index}, '${i.nama_singkatan}')" class="progress progress-primary cursor-pointer" value="${i.jumlah}" max="${instansi_peminat_terbanyak}"></progress>
        `
    })
    // Isi grafik
    target.innerHTML = grafik;
    let instansis = document.querySelectorAll(`.instansi`);
})
function showIpkInstansi(index_instansi, nama_instansi){

        // DATA PEMILIH
        const target = document.querySelector('#nama_pemilih');
        // Hapus data yang lama
        while(target.firstChild){
        target.firstChild.remove();
        }
        // Isi yang baru
        // Loop data pemilih index_instansi X
        this.data_pemilih[index_instansi].forEach((item)=>{
            const li = document.createElement('li');
            const text = document.createTextNode(item);
            // Style
            const li_class = document.createAttribute("class");
            li_class.value = "hover:bg-primary-content hover:bg-opacity-25";
            li.setAttributeNode(li_class);
            li.appendChild(text);

            target.appendChild(li);
        });


        // CANVAS IPK
        const data_ipk = {
            labels : this.ipk_pemilih[index_instansi].map((val, index) => {return index}),
            datasets: [{
                label: 'Nilai pemilih '+ nama_instansi,
                data: this.ipk_pemilih[index_instansi],
                backgroundColor: '#2aa79b',
                borderColor: '#2aa79b',
                borderWidth : 1,
            }]
        };
        const config_ipk = {
            type: 'line',
            data: data_ipk,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                    x: {
                        beginAtZero: true,
                    }
                },
                indexAxis : 'x',
                plugins: {
                    title : {
                        color : '#ffffff',
                    },
                    tooltip: {
                    }
                }
            },

        }
        // Get target canvas
        target_canvas = document.getElementById('chart_ipk');
        // Hapus canvas jika telah ada
        while(target_canvas.firstChild){
        target_canvas.firstChild.remove();
        }
        // Buat canvas baru
        const canvas_node = document.createElement('canvas');
        const canvas_id = document.createAttribute("id");
        canvas_id.value = "chart_ipk_canvas";
        canvas_node.setAttributeNode(canvas_id);
        target_canvas.appendChild(canvas_node);

        chart_ipk = new Chart(
            document.getElementById('chart_ipk_canvas'),
            config_ipk
        );

        // PESAN PERINGKAT

        let ipk_gabungan = [];
        ipk_pemilih = this.ipk_pemilih[index_instansi];
        ipk_saya = this.ipk_saya;
        ipk_gabungan = [...ipk_pemilih];
        ipk_gabungan.push(ipk_saya);
        ipk_gabungan.sort();
        ipk_gabungan.reverse();
        rank = ipk_gabungan.indexOf(ipk_saya);
        pesan_rank = document.getElementById('pesan_rank');
        pesan_rank.innerHTML = `<p class="text-base-content">Jika kamu memilih <span class="font-bold">${nama_instansi}</span> sekarang, kamu akan berada di peringkat ${rank + 1}</p>`
        }


</script>

