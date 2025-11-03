<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actors</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Actors List</h1>

    @if(session('success'))
        <div class="bg-green-100 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <a href="{{ route('actors.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Actor</a>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-200">
            <th class="border p-2">ID</th>
            <th class="border p-2">First Name</th>
            <th class="border p-2">Last Name</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Address</th>
            <th class="border p-2">Height</th>
            <th class="border p-2">Weight</th>
            <th class="border p-2">Gender</th>
            <th class="border p-2">Age</th>
        </tr>
        </thead>
        <tbody>
        @foreach($actors as $actor)
            <tr>
                <td class="border p-2">{{ $actor->id }}</td>
                <td class="border p-2">{{ $actor->first_name }}</td>
                <td class="border p-2">{{ $actor->last_name }}</td>
                <td class="border p-2">{{ $actor->email }}</td>
                <td class="border p-2">{{ $actor->address }}</td>
                <td class="border p-2">{{ $actor->height }}</td>
                <td class="border p-2">{{ $actor->weight }}</td>
                <td class="border p-2">{{ $actor->gender }}</td>
                <td class="border p-2">{{ $actor->age }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $actors->links('pagination::tailwind') }}
    </div>
</div>
</body>
</html>
