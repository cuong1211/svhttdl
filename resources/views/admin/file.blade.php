<div class="p-6 bg-white rounded-lg shadow">
    @if (session('success'))
        <div class="text-green-500 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="text-red-500 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <div>
                <input type="file" name="file">
            </div>

            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded">
                Upload
            </button>
        </div>
    </form>
</div>
