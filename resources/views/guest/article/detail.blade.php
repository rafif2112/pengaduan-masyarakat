<x-layout>
    <x-guest_layout>
        <!-- Main Content -->
        <div class="mb-4 rounded-lg bg-white p-4 shadow-lg">
            <div class="flex">
                <img alt="Image of a densely populated urban area with many makeshift houses" class="w-1/2 rounded-lg"
                    height="200" src="{{ asset('assets/images/' . $report->image) }}" width="250" />
                <div class="ml-4">
                    <p class="text-gray-600">
                        {{ $report->created_at->diffForHumans() }}
                    </p>
                    <p class="mt-2 text-gray-800">
                        {{ $report->description }}
                    </p>
                    <div class="mt-4 rounded bg-yellow-300 px-4 py-2 text-black">
                        {{ $report->type }}
                    </div>
                </div>
            </div>
        </div>
        <div class="rounded-lg bg-white p-6 shadow-lg">
            @foreach ($comments as $comment)
                <div class="flex items-start mb-4">
                    <i class="fas fa-user mr-2 text-gray-500">
                    </i>
                    <div class="w-full">
                        <p class="text-blue-600">
                            {{ $comment->user->email }}
                        </p>
                        <p class="text-gray-600 mb-2">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                        <p class="text-gray-800">
                            {{ $comment->comment }}
                        </p>
                    </div>
                </div>         
            @endforeach
            <form action="{{ route('report.comment') }}" method="POST">
                @csrf
                <div class="mb-2 flex items-start">
                    <i class="fas fa-user mr-2 text-gray-500">
                    </i>
                    <div class="w-full">
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <textarea class="mb-2 w-full rounded-lg border border-gray-300 p-2" name="comment" placeholder="Komentar" id="comment"
                            rows="4"></textarea>
                        <label for="comment">Komentar</label>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="rounded bg-green-700 px-4 py-2 text-white">
                        Buat Komentar
                    </button>
                </div>
            </form>
        </div>
    </x-guest_layout>
</x-layout>
