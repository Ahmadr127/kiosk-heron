{{-- Navbar kiosk: tombol beranda + pengaturan petugas + jam/tanggal live. --}}
<nav id="kiosk-navbar" class="sticky top-0 z-50 border-b border-azra-line bg-white/85 backdrop-blur-md transition-shadow duration-200" aria-label="Navigasi dan informasi kiosk">
    <div class="mx-auto flex w-full max-w-[1200px] flex-wrap items-center justify-between gap-x-3 gap-y-2 px-4 py-2 portrait:max-w-none landscape:max-w-none sm:gap-x-4 sm:px-7">
        <div class="flex gap-2 sm:gap-3">
            <a class="flex h-10 w-10 items-center justify-center rounded-[11px] border border-azra-line bg-[#f4f6f9] text-azra-navy no-underline transition duration-150 ease-out hover:-translate-y-[2px] hover:border-azra-navy hover:bg-white hover:shadow-[0_10px_18px_-10px_rgba(31,43,77,0.45)] active:translate-y-0 active:shadow-none focus-visible:outline-[3px] focus-visible:outline-offset-[3px] focus-visible:outline-azra-navy" href="{{ route('home') }}" aria-label="Beranda" title="Beranda">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M3.5 11.2 12 4l8.5 7.2" />
                    <path d="M6 10.2V19.5h12v-9.3" />
                    <path d="M10 19.5v-4.8h4v4.8" />
                </svg>
            </a>
            <a class="flex h-10 w-10 items-center justify-center rounded-[11px] border border-azra-line bg-[#f4f6f9] text-azra-navy no-underline transition duration-150 ease-out hover:-translate-y-[2px] hover:border-azra-navy hover:bg-white hover:shadow-[0_10px_18px_-10px_rgba(31,43,77,0.45)] active:translate-y-0 active:shadow-none focus-visible:outline-[3px] focus-visible:outline-offset-[3px] focus-visible:outline-azra-navy" href="{{ route('login') }}" aria-label="Pengaturan dan masuk petugas" title="Pengaturan">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="5" />
                    <circle cx="12" cy="12" r="2.1" />
                    <path d="M17 12h2.5M4.5 12H7M12 7V4.5M12 19.5V17M15.54 8.46l1.77-1.77M6.69 17.31l1.77-1.77M15.54 15.54l1.77 1.77M6.69 6.69l1.77 1.77" />
                </svg>
            </a>
        </div>

        <div class="flex items-center gap-3 max-sm:gap-2" role="timer" aria-live="off" aria-label="Jam dan tanggal hari ini">
            <span class="h-[29px] w-[40px] flex-none overflow-hidden rounded-[7px] bg-white shadow-[inset_0_0_0_1px_rgba(0,0,0,0.12)] max-sm:h-[25px] max-sm:w-[34px]" aria-hidden="true"><img class="block h-full w-full scale-[1.4] object-cover" src="{{ asset('images/flag-indonesia.svg') }}" alt=""></span>
            <span class="flex flex-col leading-snug">
                <span class="text-[21px] font-bold tabular-nums tracking-wide text-azra-navy max-sm:text-[17px]" id="jam-digital">--:--:--</span>
                <span class="text-[12.5px] font-medium text-azra-muted max-sm:text-[11.5px]" id="tanggal-hari-ini">&nbsp;</span>
            </span>
        </div>
    </div>
</nav>

<script>
    (function () {
        if (window.__kioskNavbarInit) return;
        window.__kioskNavbarInit = true;

        var HARI = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var BULAN = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        function pad(n) { return (n < 10 ? '0' : '') + n; }

        function updateClock() {
            var now = new Date();
            var jam = document.getElementById('jam-digital');
            var tanggal = document.getElementById('tanggal-hari-ini');
            if (jam) {
                jam.textContent = pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());
            }
            if (tanggal) {
                tanggal.textContent = HARI[now.getDay()] + ', ' + now.getDate() + ' ' + BULAN[now.getMonth()] + ' ' + now.getFullYear();
            }
        }

        updateClock();
        setInterval(updateClock, 1000);

        var navbar = document.getElementById('kiosk-navbar');
        function updateNavbar() {
            if (navbar) {
                navbar.classList.toggle('navbar-scrolled', window.scrollY > 6);
            }
        }
        updateNavbar();
        window.addEventListener('scroll', updateNavbar, { passive: true });
    })();
</script>
