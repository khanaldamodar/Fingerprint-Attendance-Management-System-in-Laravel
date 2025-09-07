<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Attendance Logs</h1>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Device User ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($attendances as $attendance)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->user->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->user->device_user_id ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->timestamp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($attendance->status == 'Check-in')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $attendance->status }}
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ $attendance->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
</body>
</html>
