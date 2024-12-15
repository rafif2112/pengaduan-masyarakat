<x-layout>
    <x-guest_layout>
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-800" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div>
            <form action="{{route('report.article')}}" class="flex gap-2">
                <select name="province" id="province" class="w-full rounded border border-gray-300 p-2">
                    <option value="" disabled selected>Pilih Provinsi</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                    Cari
                </button>
            </form>

            <div class="grid grid-cols-1 gap-4 py-6">
                @foreach ($reports as $report)
                    <div class="rounded bg-white p-4 shadow">
                        <div class="flex">
                            <img alt="Image of road construction with heavy machinery" class="w-1/3 rounded"
                                src="{{asset('assets/images/' . $report->image)}}" />
                            <div class="ml-4 w-2/3">
                                <a href="{{ route('report.article.show', $report->id) }}">
                                    <h2 class="text-lg underline font-bold">{{ Str::substr($report->description, 0, 50) }}</h2>
                                </a>
                                <div class="mt-2 flex items-center text-gray-600">
                                    <span class="mr-2"><i class="fas fa-eye"></i> {{ $report->viewers }}</span>
                                    <span class="mr-2"><i class="fas fa-heart"></i> {{ $report->voting ? count($report->voting) : "0" }}</span>
                                </div>
                                <p class="text-gray-600">{{ $report->user->email }}</p>
                                <p class="text-gray-600">{{ $report->created_at->diffForHumans() }}</p>
                            </div>
                            <form action="{{ route('report.article.vote', $report->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="ml-auto flex items-center">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <button type="submit" class="ml-1 text-gray-400">
                                        <i class="fas fa-heart {{ 
                                                $report->voting ? (in_array(Auth::id(), $report->voting) ? "text-red-600" : "text-gray-400") : "text-gray-400"
                                            }}"></i>
                                        Vote
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-guest_layout>
</x-layout>
