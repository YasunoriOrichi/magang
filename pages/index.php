<?php
// Include the database connection file
include '../connect.php';
// Fetch data from the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Home</title>
</head>
<body class="bg-gray-100">

  <nav class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="flex items-center">
          <span class="text-xl font-bold">MyApp</span>
        </div>
        <div class="hidden md:flex space-x-6">
          <a href="index.php" class="text-yellow-400">Dashboard</a>
          <a href="item.php" class="hover:text-yellow-400">Item</a>
          <a href="customer.php" class="hover:text-yellow-400">Customer</a>
          <a href="supplier.php" class="hover:text-yellow-400">Supplier</a>
          <!-- Foto Profil -->
          <div class="relative">
            <img src="https://i.pravatar.cc/40?img=12" alt="Admin"
                class="w-8 h-8 rounded-full border-2 border-yellow-400 hover:scale-105 transition-transform duration-200">
          </div>
        </div>
        <div class="md:hidden">
          <!-- Hamburger -->
          <button id="menu-btn" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    </nav>

  <!-- Sidebar -->
  <div class="flex min-h-screen">
  <aside id="sidebar" class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 hidden md:block min-h-screen">
    <nav class="space-y-4">
      <a href="index.php" class="block py-2 px-4 rounded bg-gray-700 text-yellow-400">Dashboard</a>
      <a href="item.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Item</a>
      <a href="customer.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Customer</a>
      <a href="supplier.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Supplier</a>
    </nav>
  </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>
    
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Jumlah Item -->
        <div class="bg-red-500 rounded-xl shadow-md p-6 border-l-4 ">
          <h2 class="text-lg font-semibold">Total Item</h2>
          <p class="mt-2 text-3xl font-bold text-gray-800">128</p>
        </div>
    
        <!-- Card 2: Jumlah Customer -->
        <div class="bg-yellow-500 rounded-xl shadow-md p-6 border-l-4">
          <h2 class="text-lg font-semibold">Total Customer</h2>
          <p class="mt-2 text-3xl font-bold text-gray-800">56</p>
        </div>
    
        <!-- Card 3: Jumlah Supplier -->
        <div class="bg-green-500 rounded-xl shadow-md p-6 border-l-4">
          <h2 class="text-lg font-semibold">Total Supplier</h2>
          <p class="mt-2 text-3xl font-bold text-gray-800">12</p>
        </div>
      </div>

    <!-- Section Tabel -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
  <!-- Tabel Item -->
  <div class="bg-white rounded-xl shadow-md p-4 overflow-auto">
    <h2 class="text-lg font-semibold mb-2 text-gray-800">Data Item</h2>
    <table class="table-auto w-full text-sm text-left text-gray-600">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="px-4 py-2">ID</th>
          <th class="px-4 py-2">No Reff</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-100">
          <td class="px-4 py-2">1</td>
          <td class="px-4 py-2">KP001</td>
          <td class="px-4 py-2">Keripik Pisang</td>
          <td class="px-4 py-2">34</td>
        </tr>
        <tr class="hover:bg-gray-100">
          <td class="px-4 py-2">2</td>
          <td class="px-4 py-2">KP002</td>
          <td class="px-4 py-2">Kerupuk Udang</td>
          <td class="px-4 py-2">20</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tabel Customer -->
  <div class="bg-white rounded-xl shadow-md p-4 overflow-auto">
    <h2 class="text-lg font-semibold mb-2 text-gray-800">Data Customer</h2>
    <table class="table-auto w-full text-sm text-left text-gray-600">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="px-4 py-2">No Reff</th>
          <th class="px-4 py-2">Nama</th>
          <th class="px-4 py-2">ID</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-100">
          <td class="px-4 py-2">1</td>
          <td class="px-4 py-2">Siti</td>
          <td class="px-4 py-2">Bandung</td>
        </tr>
        <tr class="hover:bg-gray-100">
          <td class="px-4 py-2">2</td>
          <td class="px-4 py-2">Rudi</td>
          <td class="px-4 py-2">Jakarta</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tabel Supplier -->
  <div class="bg-white rounded-xl shadow-md p-4 overflow-auto">
    <h2 class="text-lg font-semibold mb-2 text-gray-800">Data Supplier</h2>
    <table class="table-auto w-full text-sm text-left text-gray-600">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="px-4 py-2">No Reff</th>
          <th class="px-4 py-2">Nama</th>
          <th class="px-4 py-2">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr class="hover:bg-gray-100">
          <td class="px-4 py-2">1</td>
          <td class="px-4 py-2">Bu Tini</td>
          <td class="px-4 py-2">Keripik</td>
        </tr>
        <tr class="hover:bg-gray-100">
          <td class="px-4 py-2">2</td>
          <td class="px-4 py-2">Pak Slamet</td>
          <td class="px-4 py-2">Kerupuk</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

    </main>
  </div>  
  
  </body>
</html>