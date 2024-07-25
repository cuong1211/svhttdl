<x-website-layout>
    @include('web.employee.css')
    <div class="container ">
        @foreach ($employees as $employee)
            @if ($employee->type == null)
                <a href="{{ route('employee.show', ['employee' => $employee->id]) }}" style="color: white">
                    <h1 class="level-1 rectangle">Ban giám đốc sở</h1>
                </a>
            @endif
        @endforeach
        <ol class="level-2-wrapper">
            <li>
                <h2 class="level-2 rectangle">Quản lý nhà nước</h2>
                <ol class="level-3-wrapper" style="--n: {{ count($employees->where('type', 'Quản lý nhà nước')) }}">
                    @foreach ($employees as $employee)
                        @if ($employee->type == 'Quản lý nhà nước')
                            <li>
                                <a href="{{ route('employee.show', ['employee' => $employee->id]) }}"
                                    style="color: white">
                                    <h3 class="level-3 rectangle employee-node" data-name="{{ $employee->name }}">
                                        {{ $employee->name }}</h3>
                                </a>
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
                                <a href="{{ route('employee.show', ['employee' => $employee->id]) }}"
                                    style="color: white">
                                    <h3 class="level-3 rectangle employee-node" data-name="{{ $employee->name }}">
                                        {{ $employee->name }}</h3>

                                </a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </li>
        </ol>
        <table border="1" cellspacing="0" cellpadding="4" id="table_articles"
            style="width: 100%; text-align: center;">
            <tr>
                <td width="200" style="background:#2A3F54 ; color: #fff;"><strong>Ảnh</strong></td>
                <td style="background:#2A3F54 ; color: #fff;"><strong>Họ và tên</strong></td>
                <td style="background:#2A3F54 ; color: #fff;"><strong>Chức vụ</strong></td>
            </tr>

            @foreach ($staff as $item)
                <tr style="color: #333333; ">
                    <td style="margin-left: 10px; align-items: center;">
                        @if ($item->getFirstMedia('staff_image'))
                            <img src="{{ $item->getFirstMedia('staff_image')->getUrl('') }}" alt=""
                                width="100px">
                        @else
                            <img src="{{ asset($item->image) }}" alt="" width="100px">
                        @endif
                    </td>
                    <td style="text-align: center">
                        <span>{{ $item->name }}</span>
                    </td>
                    <td style="text-align: center;">
                        <span>
                            {{ $item->position->name }}
                        </span>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

    @push('scripts')
        <script>
            const wrappers = document.querySelectorAll('.level-2-wrapper');
            if (wrappers.length > 0) {
                wrappers[wrappers.length - 1].classList.add('hidden');
            }
        </script>
    @endpush


</x-website-layout>
