<div class="col-span-12 md:col-span-6 card p-8 flex flex-row justify-start items-center space-x-4 bg-base-200 overflow-visible">
    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg>
    <div class="flex flex-col items-start">
        <span >
          {{ $judul }}
        </span>
        <div class="flex flex-row items-center space-x-4">
            <div class="relative"  x-data="{
                show : false,
            }">
                <div class="btn btn-xs btn-outline btn-primary" @click="show = true" @click.outside="show = false">
                    {{ $pilihanInstansi ?? 'Silakan pilih data' }}
                </div>
                <div x-show="show" x-transition class="absolute z-50 top-10 card bg-primary text-base-content text-left p-4 max-h-80 overflow-y-auto">
                    <ul>
                        @forelse($instansis as $instansi)
                            <li class="hover:bg-opacity-25 hover:bg-neutral cursor-pointer whitespace-nowrap " wire:click="{{$wireClick}}({{ $instansi->id }})">{{$instansi->nama_singkatan}}</li>
                        @empty
                            <option>No data available</option>
                        @endforelse
                    </ul>
                </div>
            </div>
            <button class="btn btn-sm btn-primary space-x-2" wire:click="show_instansi('{{ $pilihan }}')">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                <span class="hidden sm:inline-block md:hidden lg:inline-block">Lihat Data<span>
            </button>
        </div>
        @if($pilihanInstansi)
          <small>
              {{ $jumlahInstansi }} Orang memilih kantor yang sama dengan pilihanmu pada {{ $judul }}!
          </small>
          <small>
              {{ $jumlahPartisipanKelas }} Orang teman sekelas kamu telah memilih {{ $judul }}!
          </small>
        @endif
    </div>
</div>
