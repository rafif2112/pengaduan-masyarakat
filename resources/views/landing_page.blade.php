<x-layout>
    <x-button></x-button>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Section -->
        <div class="bg-orange-500 text-white p-10 flex flex-col justify-center w-full md:w-3/5">
            <h1 class="text-4xl font-bold mb-6">Pengaduan Masyarakat</h1>
            <p class="text-lg mb-6">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi perspiciatis aut pariatur doloremque 
                laborum quis in praesentium at, recusandae obcaecati dicta accusantium delectus asperiores illum minima 
                veritatis iure quidem amet rerum fugit quaerat illo!
            </p>
            <a href="{{route('login')}}" class="bg-teal-800 text-center text-white px-6 py-3 rounded hover:bg-teal-700">BERGABUNG!</a>
        </div>
    
        <!-- Right Section -->
        <div class="w-full md:w-1/2 h-64 md:h-auto bg-cover bg-center relative bg-white" role="img" aria-label="Background image description">
        </div>
    </div>
</x-layout>