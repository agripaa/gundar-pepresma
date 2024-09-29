<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/logo-gundar.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200 h-screen flex justify-center items-center">
    <div class="bg-white w-full max-w-lg p-8 rounded-lg shadow-lg">
        <div class="flex flex-col justify-between items-center ">
            <img src="{{ asset('images/logo.png') }}" alt="Gunadarma University Logo" class="w-6/12 mb-2">
        </div>
        
        <form action="{{ url('/login') }}" method="POST" class="space-y-6">
            @csrf
            <h1 class="text-2xl font-semibold text-center tracking-wider">LOGIN</h1>
            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>
</html>
