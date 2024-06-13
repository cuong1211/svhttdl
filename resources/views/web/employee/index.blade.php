<x-website-layout>
    @include('web.employee.css')
    <section>
        <div class="bg-gray-100 flex items-center justify-center h-screen">

            <div class="container">
                <h1 class="level-1 rectangle">Ban giám đốc sở</h1>
                <ol class="level-2-wrapper">
                    <li>
                        <h2 class="level-2 rectangle">Quản lý nhà nước</h2>
                        <ol class="level-3-wrapper" style="--n">
                            @foreach ($employees as $employee)
                                @if ($employee->type == 'Quản lý nhà nước')
                                    <li>
                                        <h3 class="level-3 rectangle">{{ $employee->name }}</h3>
                                    </li>
                                @endif
                            @endforeach

                        </ol>
                    </li>
                    <li>
                        <h2 class="level-2 rectangle">Đơn vị sự nghiệp</h2>
                        <ol class="level-3-wrapper">
                            @foreach ($employees as $employee)
                                @if ($employee->type == 'Đơn vị sự nghiệp')
                                    <li>
                                        <h3 class="level-3 rectangle">{{ $employee->name }}</h3>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </section>
    @push('scripts_bottom')
        <script>
            document.querySelectorAll('.level-3-wrapper').forEach(wrapper => {
                const itemCount = wrapper.querySelectorAll('li').length;
                wrapper.style.setProperty('--n', itemCount);
            });
        </script>
    @endpush
</x-website-layout>
