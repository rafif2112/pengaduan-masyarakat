<div class="fixed bottom-4 right-4 space-y-4" style="z-index: 9999">
    @if (Auth::check())
        @if (Auth::user()->role == 'guest')
            <a href="{{ route('report.article') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ route('report.index') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-info-circle"></i>
            </a>
            <a href="{{ route('report.create') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-edit"></i>
            </a>
        @elseif (Auth::user()->role == 'staff')
            <a href="{{ route('staff.report.index') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ route('staff.report.index') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-info-circle"></i>
            </a>
            <a href="{{ route('staff.report.index') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-edit"></i>
            </a>
        @elseif (Auth::user()->role == 'head_staff')
            <a href="{{ route('head_staff.index') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ route('head_staff.index') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-info-circle"></i>
            </a>
            <a href="{{ route('head_staff.user.index') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
                <i class="fas fa-edit"></i>
            </a>
        @endif
    @else
        <a href="{{ route('login') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
            <i class="fas fa-home"></i>
        </a>
        <a href="{{ route('login') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
            <i class="fas fa-info-circle"></i>
        </a>
        <a href="{{ route('login') }}" class="w-12 h-12 bg-teal-800 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700">
            <i class="fas fa-edit"></i>
        </a>
    @endif
</div>