<x-website-layout>
    @include('web.employee.css')
    <section>
        <div class="bg-gray-100 flex items-center justify-center min-h-screen">
            <div class="container text-white text-center">
                <h1 class="level-1 rectangle">Ban giám đốc sở</h1>
                <ol class="level-2-wrapper">
                    <li>
                        <h2 class="level-2 rectangle">Quản lý nhà nước</h2>
                        <ol class="level-3-wrapper" style="--n: {{ count($employees->where('type', 'Quản lý nhà nước')) }}">
                            @foreach ($employees as $employee)
                                @if ($employee->type == 'Quản lý nhà nước')
                                    <li>
                                        <h3 class="level-3 rectangle employee-node" data-name="{{ $employee->name }}">{{ $employee->name }}</h3>
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
                                        <h3 class="level-3 rectangle employee-node" data-name="{{ $employee->name }}">{{ $employee->name }}</h3>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="employee-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-xl font-bold mb-4" id="modal-title">Employee Details</h2>
            <p id="modal-content"></p>
            <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded" id="close-modal">Close</button>
        </div>
    </div>

    @push('scripts_bottom')
        <script>
            // JavaScript to handle modal opening and closing
            document.querySelectorAll('.employee-node').forEach(node => {
                node.addEventListener('click', () => {
                    const name = node.getAttribute('data-name');
                    document.getElementById('modal-title').innerText = name;
                    document.getElementById('modal-content').innerText = `Details about ${name}...`;
                    document.getElementById('employee-modal').classList.remove('hidden');
                });
            });

            document.getElementById('close-modal').addEventListener('click', () => {
                document.getElementById('employee-modal').classList.add('hidden');
            });
        </script>
    @endpush
</x-website-layout>
