{{-- Keyboard virtual kiosk (popup bawah): muncul saat input [data-keyboard] diklik.
     Tombol: huruf (Shift untuk kapital), angka, spasi, hapus, tutup, enter (= kirim form). --}}
@props(['id' => 'vkbd'])

<div id="{{ $id }}" data-vkbd class="vkbd-panel fixed inset-x-0 bottom-0 z-[60] px-3 pb-4 pt-2 sm:px-6" role="dialog" aria-label="Keyboard virtual" aria-hidden="true">
    <div class="mx-auto w-full max-w-[900px] rounded-3xl border border-white/10 bg-azra-navy/95 p-3 shadow-[0_-12px_40px_-12px_rgba(0,0,0,0.6)] backdrop-blur-md sm:p-4">
        <div class="mb-2 flex items-center justify-between px-1">
            <span class="text-[13px] font-semibold uppercase tracking-[0.14em] text-white/60">Keyboard</span>
            <button type="button" data-vkbd-key="tutup" class="flex items-center gap-1.5 rounded-xl bg-white/10 px-4 py-2 text-[14px] font-bold text-white transition hover:bg-white/20 active:scale-95">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 6 12 12M18 6 6 18" /></svg>
                Tutup
            </button>
        </div>
        <div data-vkbd-rows class="flex flex-col gap-2"></div>
        <div class="mt-2 flex gap-2">
            <button type="button" data-vkbd-key="enter" class="flex h-[58px] flex-1 items-center justify-center gap-2 rounded-2xl bg-azra-teal text-[17px] font-bold text-white shadow-[0_4px_0_rgba(0,0,0,0.35)] transition hover:brightness-110 active:translate-y-[2px] active:shadow-none">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m4.5 12.5 5 5 10-11" /></svg>
                Enter
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        if (window.__vkbdInit) return;
        window.__vkbdInit = true;

        var panel = document.querySelector('[data-vkbd]');
        var rowsBox = panel ? panel.querySelector('[data-vkbd-rows]') : null;
        if (!panel || !rowsBox) return;

        var ROWS = ['1234567890', 'QWERTYUIOP', 'ASDFGHJKL', 'ZXCVBNM'];
        var caps = true;
        var active = null;

        function keyButton(label, action, wide) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = label;
            btn.setAttribute('data-vkbd-key', action);
            btn.className = 'flex h-[54px] ' + (wide ? 'flex-[2]' : 'flex-1') + ' items-center justify-center rounded-xl bg-white text-[19px] font-bold text-azra-navy shadow-[0_4px_0_rgba(0,0,0,0.35)] transition hover:bg-[#e8f4f2] active:translate-y-[2px] active:shadow-none';
            return btn;
        }

        function render() {
            rowsBox.innerHTML = '';
            ROWS.forEach(function (row) {
                var div = document.createElement('div');
                div.className = 'flex gap-2';
                row.split('').forEach(function (ch) {
                    var label = /[A-Z]/.test(ch) && !caps ? ch.toLowerCase() : ch;
                    div.appendChild(keyButton(label, 'char:' + ch));
                });
                rowsBox.appendChild(div);
            });
            var bottom = document.createElement('div');
            bottom.className = 'flex gap-2';
            var shift = keyButton('Shift', 'shift', true);
            if (caps) shift.classList.add('vkbd-shift-on');
            bottom.appendChild(shift);
            bottom.appendChild(keyButton('Spasi', 'space', true));
            bottom.appendChild(keyButton('Hapus', 'hapus', true));
            rowsBox.appendChild(bottom);
        }

        function show() {
            panel.classList.add('vkbd-open');
            panel.setAttribute('aria-hidden', 'false');
            // Beri ruang di bawah body agar tombol submit tidak tertutup panel.
            try { document.body.style.paddingBottom = panel.offsetHeight + 'px'; } catch (_) { /* abaikan */ }
        }

        function hide() {
            panel.classList.remove('vkbd-open');
            panel.setAttribute('aria-hidden', 'true');
            try { document.body.style.paddingBottom = ''; } catch (_) { /* abaikan */ }
        }

        function insert(text) {
            if (!active) return;
            var start = active.selectionStart !== null ? active.selectionStart : active.value.length;
            var end = active.selectionEnd !== null ? active.selectionEnd : active.value.length;
            active.value = active.value.slice(0, start) + text + active.value.slice(end);
            var pos = start + text.length;
            try { active.setSelectionRange(pos, pos); } catch (_) { /* abaikan */ }
            active.dispatchEvent(new Event('input', { bubbles: true }));
        }

        function backspace() {
            if (!active) return;
            var start = active.selectionStart !== null ? active.selectionStart : active.value.length;
            var end = active.selectionEnd !== null ? active.selectionEnd : active.value.length;
            if (start !== end) {
                active.value = active.value.slice(0, start) + active.value.slice(end);
                try { active.setSelectionRange(start, start); } catch (_) { /* abaikan */ }
            } else if (start > 0) {
                active.value = active.value.slice(0, start - 1) + active.value.slice(end);
                try { active.setSelectionRange(start - 1, start - 1); } catch (_) { /* abaikan */ }
            }
            active.dispatchEvent(new Event('input', { bubbles: true }));
        }

        // Cegah input kehilangan fokus (dan keyboard fisik menutup) saat tombol ditekan.
        panel.addEventListener('mousedown', function (e) { e.preventDefault(); });

        panel.addEventListener('click', function (e) {
            var btn = e.target && e.target.closest ? e.target.closest('[data-vkbd-key]') : null;
            if (!btn) return;
            e.preventDefault();
            var action = btn.getAttribute('data-vkbd-key');
            if (action.indexOf('char:') === 0) {
                var ch = action.slice(5);
                insert(/[A-Z]/.test(ch) && !caps ? ch.toLowerCase() : ch);
            } else if (action === 'space') {
                insert(' ');
            } else if (action === 'hapus') {
                backspace();
            } else if (action === 'shift') {
                caps = !caps;
                render();
            } else if (action === 'tutup') {
                hide();
            } else if (action === 'enter') {
                hide();
                if (active) {
                    var form = active.closest('form');
                    if (form) {
                        if (typeof form.requestSubmit === 'function') form.requestSubmit();
                        else form.submit();
                    }
                }
            }
        });

        document.addEventListener('focusin', function (e) {
            var input = e.target && e.target.closest ? e.target.closest('[data-keyboard]') : null;
            if (input) {
                active = input;
                try { input.setAttribute('inputmode', 'none'); } catch (_) { /* abaikan */ }
                show();
            }
        });

        document.addEventListener('click', function (e) {
            var input = e.target && e.target.closest ? e.target.closest('[data-keyboard]') : null;
            if (input) {
                active = input;
                show();
                return;
            }
            // Klik di luar panel & input menutup keyboard.
            if (panel.classList.contains('vkbd-open') && !(e.target && e.target.closest && e.target.closest('[data-vkbd]'))) {
                hide();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && panel.classList.contains('vkbd-open')) hide();
        });

        render();
    })();
</script>
