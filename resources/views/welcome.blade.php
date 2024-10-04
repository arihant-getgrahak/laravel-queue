<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Uploaded Files</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Uploaded Files</h1>

        <!-- File Upload Form -->
        <div class="mb-6">
            <form action="{{ url('/store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="file-upload" class="block text-lg font-medium text-gray-700">Upload a file</label>
                <div class="mt-2 flex items-center">
                    <input id="file-upload" name="image" type="file" required
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Upload</button>
                </div>
            </form>
        </div>

        <!-- Display Uploaded Files -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @if (count($files) == 0)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <p>No files found</p>
                </div>
            @else
                @foreach ($files as $file)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if (in_array(pathinfo($file->file_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <img class="w-full h-48 object-cover" src="{{ $file->image }}" alt="Uploaded file">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold text-gray-800">{{ basename($file->file_name) }}</h2>
                                <p class="text-sm text-gray-500">Uploaded on: <span class="text-gray-600">{{ $file->created_at }}</span></p>
                            </div>
                        @elseif (in_array(pathinfo($file->file_name, PATHINFO_EXTENSION), ['pdf']))
                            <div class="flex flex-col items-center justify-center h-48 p-4">
                                <embed src="{{ $file->image }}" type="application/pdf" class="w-full h-full border" />
                                <h2 class="text-lg font-semibold text-gray-800 mt-2">{{ basename($file->file_name) }}</h2>
                                <p class="text-sm text-gray-500">Uploaded on: <span class="text-gray-600">{{ $file->created_at }}</span></p>
                            </div>
                        @else
                            <div class="p-4">
                                <h2 class="text-lg font-semibold text-gray-800">{{ basename($file->file_name) }}</h2>
                                <p class="text-sm text-gray-500">Uploaded on: <span class="text-gray-600">{{ $file->created_at }}</span></p>
                                <p class="text-sm text-gray-500">Unsupported file type.</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        if ("{{ session('success') }}") {
            alert("{{ session('success') }}");
        }
        if ("{{ session('error') }}") {
            alert("{{ session('error') }}");
        }
    </script>
</body>

</html>
