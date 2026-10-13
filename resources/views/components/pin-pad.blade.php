{{-- PIN pad numerik kiosk: tombol 0-9, hapus, enter.
     Mengisi input yang sedang fokus di antara [data-pin-input].
     Atribut input yang didukung:
       data-pin-input            penanda input yang bisa diisi PIN pad
       data-pin-format="date"    format otomatis DD-MM-YYYY (8 digit)
       data-pin-maxlength="16"   batas digit (default 16) --}}
@props(['id' => 'pin-pad'])

<div id="{{ $id }}" data-pin-pad class="select-none rounded-[22px] border border-azra-line bg-white/90 p-4 shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur sm:p-5" role="group" aria-label="Tombol angka">
    <div class="grid grid-cols-3 gap-3 sm:gap-3.5">
        @foreach (['1', '2', '3', '4', '5', '6', '7', '8', '9'] as $digit)
            <button type="button" data-pin-key="{{ $digit }}" class="flex h-[68px] items-center justify-center rounded-2xl border border-azra-line bg-white text-[26px] font-bold tabular-nums text-azra-navy shadow-[0_4px_0_rgba(31,43,77,0.12)] transition duration-100 hover:-translate-y-0.5 hover:border-azra-navy active:translate-y-[2px] active:shadow-none portrait:h-[76px]">{{ $digit }}</button>
        @endforeach
        <button type="button" data-pin-key="hapus" class="flex h-[68px] flex-col items-center justify-center gap-1 rounded-2xl border border-red-200 bg-[#fff1f0] text-[15px] font-bold text-[#c81e1e] shadow-[0_4px_0_rgba(200,30,30,0.15)] transition duration-100 hover:-translate-y-0.5 active:translate-y-[2px] active:shadow-none portrait:h-[76px]" aria-label="Hapus satu digit">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 5H8.5L3 12l5.5 7H21a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1Z" /><path d="m12 9.5 5 5M17 9.5l-5 5" /></svg>
            Hapus
        </button>
        <button type="button" data-pin-key="0" class="flex h-[68px] items-center justify-center rounded-2xl border border-azra-line bg-white text-[26px] font-bold tabular-nums text-azra-navy shadow-[0_4px_0_rgba(31,43,77,0.12)] transition duration-100 hover:-translate-y-0.5 hover:border-azra-navy active:translate-y-[2px] active:shadow-none portrait:h-[76px]">0</button>
        <button type="button" data-pin-key="enter" class="flex h-[68px] flex-col items-center justify-center gap-1 rounded-2xl bg-azra-teal text-[15px] font-bold text-white shadow-[0_4px_0_rgba(0,119,116,0.4)] transition duration-100 hover:-translate-y-0.5 hover:brightness-110 active:translate-y-[2px] active:shadow-none portrait:h-[76px]" aria-label="Lanjut">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m4.5 12.5 5 5 10-11" /></svg>
            Enter
        </button>
    </div>
</div>

<script>
    (function () {
        if (window.__pinPadInit) return;
        window.__pinPadInit = true;

        function digitsOnly(value) { return String(value || '').replace(/\D/g, ''); }

        function formatDate(raw) {
            raw = digitsOnly(raw).slice(0, 8);
            var parts = [];
            if (raw.length > 0) parts.push(raw.slice(0, 2));
            if (raw.length > 2) parts.push(raw.slice(2, 4));
            if (raw.length > 4) parts.push(raw.slice(4, 8));
            return parts.join('-');
        }

        function maxLengthOf(field) {
            var max = parseInt(field.getAttribute('data-pin-maxlength') || '16', 10);
            return isNaN(max) ? 16 : max;
        }

        function applyValue(field, raw) {
            raw = digitsOnly(raw).slice(0, maxLengthOf(field));
            field.value = field.getAttribute('data-pin-format') === 'date' ? formatDate(raw) : raw;
            field.dispatchEvent(new Event('input', { bubbles: true }));
        }

        var active = null;

        function setActive(field) {
            active = field;
            document.querySelectorAll('[data-pin-input]').forEach(function (el) {
                el.classList.toggle('pin-active', el === field);
            });
        }

        function fields() {
            return Array.prototype.slice.call(document.querySelectorAll('[data-pin-input]'));
        }

        // Input pertama menjadi aktif secara default agar PIN pad langsung bisa dipakai.
        document.addEventListener('DOMContentLoaded', function () {
            var list = fields();
            if (list.length > 0) setActive(list[0]);
        });

        document.addEventListener('focusin', function (e) {
            var field = e.target && e.target.closest ? e.target.closest('[data-pin-input]') : null;
            if (field) setActive(field);
        });

        document.addEventListener('click', function (e) {
            var btn = e.target && e.target.closest ? e.target.closest('[data-pin-key]') : null;
            if (!btn) return;
            e.preventDefault();
            if (!active || !document.contains(active)) {
                var list = fields();
                if (list.length === 0) return;
                setActive(list[0]);
            }
            var key = btn.getAttribute('data-pin-key');
            var raw = digitsOnly(active.value);
            if (key === 'hapus') {
                applyValue(active, raw.slice(0, -1));
            } else if (key === 'enter') {
                var form = active.closest('form');
                if (form) {
                    if (typeof form.requestSubmit === 'function') form.requestSubmit();
                    else form.submit();
                }
            } else {
                if (raw.length < maxLengthOf(active)) applyValue(active, raw + key);
            }
            if (document.activeElement && typeof document.activeElement.blur === 'function' && document.activeElement !== active) {
                document.activeElement.blur();
            }
        });

        // Keyboard fisik (untuk pengujian di desktop): angka, backspace, enter.
        document.addEventListener('keydown', function (e) {
            if (!active || e.target !== active) return;
            if (/^[0-9]$/.test(e.key)) {
                var raw = digitsOnly(active.value);
                if (raw.length < maxLengthOf(active)) applyValue(active, raw + e.key);
                e.preventDefault();
            } else if (e.key === 'Backspace') {
                // Biarkan perilaku bawaan menghapus format, lalu rapikan.
                setTimeout(function () { applyValue(active, digitsOnly(active.value)); }, 0);
            } else if (e.key === 'Enter') {
                var form = active.closest('form');
                if (form) {
                    e.preventDefault();
                    if (typeof form.requestSubmit === 'function') form.requestSubmit();
                    else form.submit();
                }
            }
        });
    })();
</script>
