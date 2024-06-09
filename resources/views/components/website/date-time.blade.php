<div>
    <div class="items-left mx-auto flex h-10 max-w-7xl flex-row justify-center px-3 sm:px-6 lg:px-8">
        <div class="flex items-center whitespace-nowrap pr-5 text-xs text-green-700">
            <div
                x-data="clock()"
                x-init="startClock()"
                class="clock"
            >
                {{ now()->format('l d/m/Y') }} <span x-text="time"></span>
            </div>
        </div>
        <marquee class="flex items-center">
            <a href="#"> Thông báo số 467/TB-BGDĐT của Bộ Giáo dục avf Đào tạo V/v Tuyển sinh đi học tại Ma-rốc năm 2024 </a>
        </marquee>
        <div class="flex items-center gap-6 whitespace-nowrap pl-4 text-sm">
            <a
                class="flex items-center gap-2 text-slate-700 hover:text-blue-700"
                href="#"
            >
                <x-heroicon-c-chat-bubble-left-right class="size-4" />
                <span>Hỏi đáp</span>
            </a>
            <a
                class="flex items-center gap-2 text-slate-700 hover:text-blue-700"
                href="#"
            >
                <x-heroicon-s-envelope class="size-4" />
                <span>Liên hệ</span>
            </a>
        </div>
    </div>
    <script>
        function clock() {
            return {
                time: '',
                startClock() {
                    this.updateTime()
                    setInterval(() => {
                        this.updateTime()
                    }, 1000)
                },
                updateTime() {
                    const now = new Date()
                    const hours = String(now.getHours()).padStart(2, '0')
                    const minutes = String(now.getMinutes()).padStart(2, '0')
                    const seconds = String(now.getSeconds()).padStart(2, '0')
                    this.time = `${hours}:${minutes}:${seconds}`
                },
            }
        }
    </script>
</div>
