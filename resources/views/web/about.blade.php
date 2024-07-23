<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div class="space-y-6 text-slate-700">
                        @if ($about)
                            {!! $about->content !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
