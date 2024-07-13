<!-- resources/views/errors/403.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col items-center justify-center h-screen text-center bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Oops! Anda tidak memiliki izin untuk ini</h1>
    <img src="/images/403-error.png" alt="403 Error" class="w-80 mb-4">
    <a href="{{ url()->previous() }}" class="text-blue-500 font-semibold hover:underline">Kembali ke Halaman Sebelumnya</a>
</body>
</html>
