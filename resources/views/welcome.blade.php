<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-3xl font-bold">Contact Us</h1>
        <form action="{{ url('/contact') }}" method="post" class="space-y-4 border border-black w-1/3 p-4 mt-4">
            @csrf

            <div class="flex flex-col gap-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="border border-black p-1 rounded-md"
                    placeholder="Your name" required value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="border border-black p-1 rounded-md"
                    placeholder="Your email" required value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" id="phone" class="border border-black p-1 rounded-md"
                    placeholder="Your phone" required value="{{ old('phone') }}">
                @error('phone')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="border border-black p-1 rounded-md" accept="image/*">
                @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full border border-black p-1 rounded-md bg-blue-500 text-white">Submit</button>
        </form>
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