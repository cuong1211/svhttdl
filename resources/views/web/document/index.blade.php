<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <h2 class="text-2xl font-semibold leading-tight">Danh sách văn bản</h2>
                    <div class="mt-6 mx-auto py-8 h-full flex flex-col">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">STT</th>
                                    <th class="py-2 px-4 border-b">Số hiệu</th>
                                    <th class="py-2 px-4 border-b">Tên văn bản</th>
                                    <th class="py-2 px-4 border-b">Ngày ban hành</th>
                                    <th class="py-2 px-4 border-b">Tải về</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docs as $item)
                                    @php
                                        $index = 1;
                                    @endphp
                                    <tr>
                                        <td class="py-2 px-4 border-b text-center">{{ $index }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $item->reference_number }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $item->name }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $item->published_at }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <a target="_blank" href="{{ $item->getFirstMedia('document_file')->getUrl() }}"
                                                class="text-blue-500 hover:underline">Tải về</a>
                                        </td>
                                    </tr>
                                    @php
                                        $index++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
