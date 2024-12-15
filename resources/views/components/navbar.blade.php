<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-globe text-2xl"></i>
            @if (auth()->user()->role == 'guest')
                <a href="{{route('report.article')}}" class="ml-2 text-lg font-semibold">Pengaduan</a>
            @elseif (auth()->user()->role == 'staff')
                <a href="{{route('staff.report.index')}}" class="ml-2 text-lg font-semibold">Pengaduan</a>
            @elseif (auth()->user()->role == 'head_staff')
                <a href="{{route('head_staff.user.index')}}" class="ml-2 text-lg font-semibold">Kelola Akun</a>
            @endif
        </div>
        <a href="{{route('logout')}}" class="bg-gray-200 text-center cursor-pointer text-gray-800 px-4 py-2 rounded">Logout</a>
    </div>
</nav>