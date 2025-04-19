<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>App Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <div class="flex justify-center mb-6">
            <label for="main-logo" class="cursor-pointer">
                <div class="w-32 h-32 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-camera text-gray-500 text-2xl"></i>
                </div>
                <input type="file" id="main-logo" class="hidden" accept="image/*" onchange="loadFile(event, 'main-logo-preview')"/>
            </label>
            <div id="main-logo-preview" class="mt-2"></div>
        </div>
        <div class="space-y-4">
            <div>
                <label class="block text-gray-500 text-sm">Title App</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="App Title"/>
            </div>
            <div>
                <label class="block text-gray-500 text-sm">Name App</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="App Name"/>
            </div>
            <div>
                <label class="block text-gray-500 text-sm">Logo</label>
                <input type="file" id="logo-file" class="w-full border border-gray-300 rounded-lg p-2" accept="image/*"/>
            </div>
            <div>
                <label class="block text-gray-500 text-sm">Icon App</label>
                <input type="file" id="icon" class="w-full border border-gray-300 rounded-lg p-2" accept="image/*"/>
            </div>
        </div>
        <div class="mt-6">
            <button class="w-full bg-blue-500 text-white py-2 rounded-lg text-lg font-semibold">Save Information</button>
        </div>
    </div>

    
</body>
</html>