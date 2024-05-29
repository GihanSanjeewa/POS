<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danul Super</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-800 shadow-md h-screen hidden md:block">
        <div class="p-4 text-white">
            <h2 class="text-xl font-bold mb-4">POS Dashboard</h2>
            <nav>
                <ul>
                    <li class="mb-2"><a href="#" class="hover:bg-blue-700 block py-2 px-4 rounded">Home</a></li>
                    <li class="mb-2"><a href="#" class="hover:bg-blue-700 block py-2 px-4 rounded">Sales</a></li>
                    <li class="mb-2"><a href="#" class="hover:bg-blue-700 block py-2 px-4 rounded">Products</a></li>
                    <li class="mb-2"><a href="#" class="hover:bg-blue-700 block py-2 px-4 rounded">Reports</a></li>
                    <li class="mb-2"><a href="#" class="hover:bg-blue-700 block py-2 px-4 rounded">Settings</a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Mobile Header -->
        <header class="bg-blue-800 shadow-md md:hidden">
            <div class="flex justify-between items-center p-4 text-white">
                <h2 class="text-xl font-bold">POS Dashboard</h2>
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="bg-blue-800 shadow-md md:hidden hidden">
            <ul>
                <li class="border-t border-b"><a href="#" class="block py-2 px-4 text-white hover:bg-blue-700">Home</a></li>
                <li class="border-b"><a href="#" class="block py-2 px-4 text-white hover:bg-blue-700">Sales</a></li>
                <li class="border-b"><a href="#" class="block py-2 px-4 text-white hover:bg-blue-700">Products</a></li>
                <li class="border-b"><a href="#" class="block py-2 px-4 text-white hover:bg-blue-700">Reports</a></li>
                <li class="border-b"><a href="#" class="block py-2 px-4 text-white hover:bg-blue-700">Settings</a></li>
            </ul>
        </nav>