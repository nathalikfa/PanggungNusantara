<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <header class="bg-gradient-to-r from-purple-700 to-pink-500 p-4 text-white text-center">
        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
    </header>
    <main class="p-6">
        <div class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-xl font-bold mb-4">Filter Refund Requests</h2>
            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center space-x-4">
                <div>
                    <label for="concert_name" class="block text-sm font-medium text-gray-700">Concert Name</label>
                    <input type="text" id="concert_name" name="concert_name"
                        value="{{ request('concert_name') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                </div>
                <div>
                    <label for="request_date" class="block text-sm font-medium text-gray-700">Request Date</label>
                    <input type="date" id="request_date" name="request_date"
                        value="{{ request('request_date') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">Filter</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Refund Requests</h2>
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">User</th>
                        <th class="py-2 px-4 text-left">Concert</th>
                        <th class="py-2 px-4 text-left">Reason</th>
                        <th class="py-2 px-4 text-left">Request Date</th>
                        <th class="py-2 px-4 text-left">Event Date</th>
                        <th class="py-2 px-4 text-left">Status</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($refunds as $refund)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $refund->user->username }}</td>
                        <td class="py-2 px-4">{{ $refund->payment->concert->name }}</td>
                        <td class="py-2 px-4">{{ $refund->reason }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($refund->created_at)->format('d F Y') }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($refund->payment->concert->date)->format('d F Y') }}</td>
                        <td class="py-2 px-4">
                            <span class="text-{{ $refund->status === 'waiting' ? 'yellow' : ($refund->status === 'accepted' ? 'green' : 'red') }}-500">
                                {{ ucfirst($refund->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4">
                            @if ($refund->status === 'waiting')
                            <form action="{{ route('admin.accept', $refund->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Accept</button>
                            </form>
                            <form action="{{ route('admin.reject', $refund->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-4 px-6 text-center text-gray-500">No refund requests found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>