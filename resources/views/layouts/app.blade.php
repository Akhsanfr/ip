<!DOCTYPE html>
<html lang="en" x-data="tema()" :data-theme="tema" x-init="cekTema()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Cek your IP</title>
    @livewireStyles
</head>
<body class="">
    {{-- Navigation --}}
    <div class="flex items-center bg-accent space-x-4 p-4">
        <div class="text-primary-content font-bold flex-grow">
            {{ session('user')->name }} | {{ session('user')->kelas->kelas }} <span class="text-sm text-primary">({{ session('user')->npm }})</span>

        </div>
        {{-- <div class="form-control flex flex-row items-center" @click="tema == 'dark' ? tema = 'cupcake' : tema = 'dark'"> --}}
        <div class="form-control flex flex-row items-center" @click="setTema()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
              </svg>
            <label class="cursor-pointer label">
              <input type="checkbox" checked="checked" class="toggle toggle-primary" id="tema">
            </label>
          </div>
        <div class="relative" x-data="{menu : false}" @click="menu = !menu" @click.outside="menu = false">
            <img src="{{ session('user')->avatar }}" alt="" class="rounded-full overflow-hidden h-8 w-8 cursor-pointer">
            <div class="absolute z-50 top-12 right-0" x-show="menu" x-transition>
                <ul class="menu py-3 shadow-lg bg-base-200 rounded-lg">
                    <li>
                        <a  href="{{ route('auth.logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{-- Content --}}
    <div>
        {{ $slot }}
    </div>
    <div class="fixed bottom-4 right-4" x-data="{show:false}" @click.outside="show=false">
        <div class="relative">
            <img src="{{ asset('contribution.png') }}" alt="" class=" h-16 cursor-pointer" @click="show=!show">
            <div class="bg-accent bottom-16 right-16 p-4 absolute rounded-xl w-96" x-transition x-show="show">
                <p class="text-neutral leading-4">Hai, <strong>Temanset!</strong> Ada saran maupun kritik dengan website ini? Atau kamu ingin berkontribusi untuk melengkapi data yang kurang? Yuk hubungi <strong>admin</strong> atau isi aja <strong>formulir</strong> dibawah ini.</p>
                <div class="flex flex-row space-x-2 mt-4 w-min">
                    <a href="https://wa.me/6282311357266" target="_blank" class="btn btn-primary btn-outline btn-sm flex-nowrap space-x-2">
                        <img src="{{ asset('whatsapp.png') }}" alt="" class="h-4">
                        <span>Taufik</span>
                    </a>
                    <a href="https://wa.me/6285790417607" target="_blank" class="btn btn-primary btn-outline btn-sm flex-nowrap space-x-2">
                        <img src="{{ asset('whatsapp.png') }}" alt="" class="h-4">
                        <span>fr</span>
                    </a>
                    <a href="https://forms.gle/SuyNcQryyZAwsZTk9" target="_blank" class="btn btn-primary btn-outline btn-sm flex-nowrap space-x-2">
                        <img src="{{ asset('forms.png') }}" alt="" class="h-4">
                        <span>Formulir</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script>
        function tema(){
            return {
                tema : 'dark',
                setTema(){
                    console.log(this.tema);
                    if(this.tema == 'cupcake'){
                        document.cookie = "tema=dark; expires= 18 Dec 2022 12:00:00 UTC; SameSite=None; Secure";
                        this.tema = 'dark';
                    } else {
                        document.cookie = "tema=cupcake; expires= 18 Dec 2022 12:00:00 UTC; SameSite=None; Secure";
                        this.tema = 'cupcake';
                    }
                },
                cekTema(){
                    let tema;
                    let key = 'tema';
                    Cookies = decodeURIComponent(document.cookie).split(';');
                    Cookies.forEach((e)=>{
                        Cookie = e.substr(1);
                        NamaCookie = Cookie.split('=')[0];
                        if(NamaCookie == key){
                            tema = Cookie.split('=')[1];
                        }
                    });
                    return this.tema = tema;
                }
            }
        }
    </script>
</body>
</html>
