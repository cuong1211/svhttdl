<x-website-layout>
    @include('web.employee.css')
    <div class="container ">
        <h1 class="level-1 rectangle">Ban giám đốc sở</h1>
        <ol class="level-2-wrapper">
            <li>
                <h2 class="level-2 rectangle">Quản lý nhà nước</h2>
                <ol class="level-3-wrapper" style="--n: {{ count($employees->where('type', 'Quản lý nhà nước')) }}">
                    @foreach ($employees as $employee)
                        @if ($employee->type == 'Quản lý nhà nước')
                            <li>
                                <h3 class="level-3 rectangle employee-node" data-name="{{ $employee->name }}">
                                    {{ $employee->name }}</h3>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
            <li>
                <h2 class="level-2 rectangle">Đơn vị sự nghiệp</h2>
                <ol class="level-3-wrapper" style="--n: {{ count($employees->where('type', 'Đơn vị sự nghiệp')) }}">
                    @foreach ($employees as $employee)
                        @if ($employee->type == 'Đơn vị sự nghiệp')
                            <li>
                                <h3 class="level-3 rectangle employee-node" data-name="{{ $employee->name }}">
                                    {{ $employee->name }}</h3>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </ol>
    </div>

    <!-- Modal -->

    @push('scripts_bottom')
    @endpush
</x-website-layout>
