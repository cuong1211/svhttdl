@props([
    'publish_at' => now(),
    'field' => 'document.publish_at',
    'name' => '',
])
<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
    <div class=" max-w-xs" x-data="app_end()" x-init="[initDate(), getNoOfDays()]" x-cloak>
        <div class="relative">
            <input type="hidden" name="{{ $name }}" x-ref="date" />
            <label class="form-control w-full max-w-xs">
                <span class="label">
                    <span class="label-text text-base text-black font-medium">@lang('admin.' . $field)</span>
                </span>
                <input type="text" name={{ $name }} readonly x-model="datepickerValue"
                    @click="showDatepicker = !showDatepicker" @keydown.escape="showDatepicker = false"
                    class="border border-gray-300 bg-white text-black p-2 rounded-md pr-12" placeholder="Select date" />
                <x-heroicon-s-calendar class="absolute size-6 bottom-3 right-4 text-slate-500" />
            </label>


            <div class="absolute right-0 top-24 rounded-lg bg-white p-4 shadow-lg z-10 w-64"
                x-show.transition="showDatepicker" @click.away="showDatepicker = false">
                <div class="mb-2 flex items-center justify-between">
                    <div>
                        <span x-text="MONTH_NAMES_END[month]" class="text-black text-lg font-bold"></span>
                        <span x-text="year" class="text-gray-600 ml-1 text-lg font-normal"></span>
                    </div>
                    <div>
                        <button type="button"
                            class="hover:bg-gray-200 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out"
                            :class="{ 'cursor-not-allowed opacity-25': month == 0 }"
                            :disabled="month == 0 ? true : false" @click="month--; getNoOfDays()">
                            <svg class="text-gray-500 inline-flex h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button type="button"
                            class="hover:bg-gray-200 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out"
                            :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                            :disabled="month == 11 ? true : false" @click="month++; getNoOfDays()">
                            <svg class="text-gray-500 inline-flex h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="-mx-1 mb-3 flex flex-wrap">
                    <template x-for="(day, index) in DAYS_END" :key="index">
                        <div style="width: 14.26%" class="px-1">
                            <div x-text="day" class="text-black text-center text-xs font-medium"></div>
                        </div>
                    </template>
                </div>

                <div class="-mx-1 flex flex-wrap">
                    <template x-for="blankday in blankdays">
                        <div style="width: 14.28%" class="border border-transparent p-1 text-center text-sm"></div>
                    </template>
                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                        <div style="width: 14.28%" class="mb-1 px-1">
                            <div @click="getDateValue(date)" x-text="date"
                                class="cursor-pointer rounded-full text-center text-sm transition duration-100 ease-in-out"
                                :class="{
                                    'bg-blue-500 text-white': isToday(date) ==
                                        true,
                                    'text-gray-700 hover:bg-blue-200': isToday(
                                        date) == false
                                }">
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    [x-cloak] {
        display: none;
    }
</style>
<script>
    const MONTH_NAMES_END = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
        'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
    ]
    const DAYS_END = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7']

    function app_end() {
        return {
            showDatepicker: false,
            datepickerValue: '',

            month: '',
            year: '',
            no_of_days: [],
            blankdays: [],
            days: ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],

            initDate() {
                let today = new Date('{{ $publish_at }}')
                console.log();
                this.month = today.getMonth()
                this.year = today.getFullYear()
                this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString()
            },

            isToday(date) {
                const today = new Date()
                const d = new Date(this.year, this.month, date)

                return today.toDateString() === d.toDateString() ? true : false
            },

            getDateValue(date) {
                let selectedDate = new Date(this.year, this.month, date)
                this.datepickerValue = selectedDate.toDateString()

                this.$refs.date.value =
                    selectedDate.getFullYear() + '-' + ('0' + selectedDate.getMonth()).slice(-2) + '-' + ('0' +
                        selectedDate.getDate()).slice(-2)

                console.log(this.$refs.date.value)

                this.showDatepicker = false
            },

            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate()

                // find where to start calendar day of week
                let dayOfWeek = new Date(this.year, this.month).getDay()
                let blankdaysArray = []
                for (var i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i)
                }

                let daysArray = []
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i)
                }

                this.blankdays = blankdaysArray
                this.no_of_days = daysArray
            },
        }
    }
</script>
