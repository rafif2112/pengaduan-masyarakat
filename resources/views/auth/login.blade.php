<x-layout>
    <x-button></x-button>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Section -->
        <div class="bg-orange-500 p-10 flex flex-col justify-center w-full md:w-3/5">
            <h2 class="text-3xl text-white font-bold mb-6">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-white text-sm font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-white text-sm font-medium">Password</label>
                    <input id="password" type="password" name="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                </div>
                <div class="flex gap-2">
                    <a href="{{route('register')}}" class="w-full text-center py-2 px-4 bg-yellow-500 text-white rounded-md shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Buat akun</a>
                    <button type="submit" class="w-full py-2 px-4 bg-teal-800 text-white rounded-md shadow-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Login</button>
                </div>
            </form>
        </div>
    
        <!-- Right Section -->
        <div class="w-full md:w-1/2 h-64 md:h-auto bg-cover bg-center relative bg-white" role="img" aria-label="Background image description">
        </div>
    </div>
</x-layout>