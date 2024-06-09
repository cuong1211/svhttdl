<x-website-layout>
    <section class="bg-[#2213390] bg-white">
        <div class="mx-auto max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
            <video
                class="w-full"
                autoplay
                loop
                muted
                src="{{ asset('files/videos/slider_3.mp4') }}"
            ></video>
        </div>
    </section>
    <section>
        <div class="mx-auto mt-6 max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-10 md:col-span-6 lg:col-span-6">
                    <x-website.home-post />
                    <x-website.education-program />
                    <x-website.staff />
                    <x-website.infrastructure />
                    <x-website.partners />
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
