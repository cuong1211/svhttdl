<div>
    <h2 class="font-semibold text-green-700">@lang('web.infrastructure')</h2>
    <p class="mb-4 mt-3 text-4xl font-extrabold">@lang('web.infrastructure_title')</p>
    <p class="mb-6 text-slate-500">@lang('web.infrastructure_text')</p>
    <ul class="grid grid-cols-4 gap-5 py-5 backdrop-blur">
        @for ($i=1;$i<=4;$i++)
            <li class="flex items-center justify-center">
                <a href="#">
                    <figure class="flex flex-col items-center">
                        <x-heroicon-o-building-library class="size-36 rounded-full bg-blue-200 p-8 text-blue-300" />
                        {{-- <img
                        class="size-36 rounded-full"
                        src="{{ asset('files/images/partners/cbttng.jpeg') }}"
                        alt=""
                        /> --}}
                        <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">Thư viện</figcaption>
                    </figure>
                </a>
            </li>
        @endfor
    </ul>
</div>
