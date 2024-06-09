<div>
    <h2 class="font-semibold text-green-700">@lang('web.partners')</h2>
    <p class="mb-4 mt-3 text-4xl font-extrabold">@lang('web.partners_title')</p>
    <p class="mb-6 text-slate-500">@lang('web.partners_text')</p>
    <ul class="grid grid-cols-4 gap-5 py-5 backdrop-blur">
        <li class="flex items-center justify-center">
            <a href="#">
                <figure class="flex flex-col items-center">
                    <img
                        class="size-36 rounded-full"
                        src="{{ asset('files/images/partners/cbttng.jpeg') }}"
                        alt=""
                    />
                    <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">
                        Trang thông tin quốc gia về bảo tồn thiên nhiên và đa dạng sinh học
                    </figcaption>
                </figure>
            </a>
        </li>
        <li class="flex items-center justify-center">
            <a href="#">
                <figure class="flex flex-col items-center">
                    <img
                        class="size-36 rounded-full"
                        src="{{ asset('files/images/partners/cres.png') }}"
                        alt=""
                    />
                    <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">
                        Viện Tài Nguyên và môi Trường Đại học quốc gia Hà nội(VNU-CRES)
                    </figcaption>
                </figure>
            </a>
        </li>
        <li class="flex items-center justify-center">
            <a href="#">
                <figure class="flex flex-col items-center">
                    <img
                        class="size-36 rounded-full"
                        src="{{ asset('files/images/partners/itet.jpeg') }}"
                        alt=""
                    />
                    <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">Viện Kỹ Thuật và Công Nghệ Môi Trường - ITET</figcaption>
                </figure>
            </a>
        </li>
        <li class="flex items-center justify-center">
            <a href="#">
                <figure class="flex flex-col items-center">
                    <img
                        class="size-36 rounded-full"
                        src="{{ asset('files/images/partners/vtnnh.png') }}"
                        alt=""
                    />
                    <figcaption class="mt-4 text-center text-sm font-bold text-blue-700">Viện Thổ Nhưỡng Nông hóa</figcaption>
                </figure>
            </a>
        </li>
    </ul>
</div>
