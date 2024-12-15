<x-layout>
    <x-navbar></x-navbar>
    <x-button></x-button>
    <main class="container mx-auto px-4 py-6">
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-800" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($reports as $index => $report)
            <div class="my-4 rounded-xl" id="accordion-collapse-{{ $index }}" data-accordion="collapse">
                <h2 id="accordion-collapse-heading-{{ $index }}">
                    <button type="button"
                        class="flex w-full items-center justify-between gap-3 rounded-t-xl border-2 border-gray-600 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800"
                        data-accordion-target="#accordion-collapse-body-{{ $index }}" aria-expanded="false"
                        aria-controls="accordion-collapse-body-{{ $index }}">
                        <span>Pengaduan
                            {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                        <svg data-accordion-icon class="h-3 w-3 shrink-0 rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-{{ $index }}" class="hidden"
                    aria-labelledby="accordion-collapse-heading-{{ $index }}">
                    <div class="border-2 border-gray-600 p-5 dark:border-gray-700 dark:bg-gray-900">
                        <div class="mb-2 flex items-center justify-between border-b border-gray-600 pb-2">
                            <span class="btn-data cursor-pointer" data-index="{{ $index }}">Data</span>
                            <span class="btn-gambar cursor-pointer" data-index="{{ $index }}">Gambar</span>
                            <span class="btn-status cursor-pointer" data-index="{{ $index }}">Status</span>
                        </div>
                        <div id="data-{{ $index }}">
                            <ul class="list-disc pl-5">
                                <li>Tipe: {{ $report->type }}</li>
                                <li>Lokasi: <span id="village-{{ $index }}"></span>, <span
                                        id="subdistrict-{{ $index }}"></span>, <span
                                        id="regency-{{ $index }}"></span>, <span
                                        id="province-{{ $index }}"></span></li>
                                <li>Deskripsi: {{ $report->description }}.</li>
                            </ul>
                        </div>
                        <div id="gambar-{{ $index }}" class="hidden w-full items-center justify-center">
                            <img src="{{ asset('assets/images/' . $report->image) }}" alt="gambar"
                                class="max-h-52" />
                        </div>
                        <div id="status-{{ $index }}" class="hidden">
                            @if ($responses->where('report_id', $report->id)->isNotEmpty())
                                @foreach ($responses->where('report_id', $report->id) as $response)
                                    <div class="p-2">
                                        <p class="p-2">Pengaduan Telah Ditanggapi Dengan Status
                                            <span class="text-green-500">
                                                @if ($response->response_status == 'on_process')
                                                    <span class="rounded bg-blue-500 px-4 py-2 text-white">
                                                        ON_PROCCESS
                                                    </span>
                                                @elseif ($response->response_status == 'done')
                                                    <span class="rounded bg-green-500 px-4 py-2 text-white">
                                                        DONE
                                                    </span>
                                                @elseif ($response->response_status == 'reject')
                                                    <span class="rounded bg-red-500 px-4 py-2 text-white">
                                                        REJECT
                                                    </span>
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div class="mb-4 rounded-lg bg-gray-100 p-4">
                                        <ul class="space-y-4">
                                            @if ($response->responseProgres->isNotEmpty())
                                                @foreach ($response->responseProgres as $progres)
                                                    <li class="flex items-center">
                                                        <div
                                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-500 text-white">
                                                            {{ $loop->iteration }}
                                                        </div>
                                                        <div class="ml-4">
                                                            <p class="text-sm text-gray-500">
                                                                {{ $progres->created_at->diffForHumans() }}</p>
                                                            @php $histories = $progres->histories; @endphp
                                                            <p class="text-gray-700">{{ $histories['tanggapan'] }}</p>
                                                        </div>
                                                    </li>
                                                    @if (!$loop->last)
                                                        <div class="ml-4 h-8 border-l-2 border-gray-300"></div>
                                                    @endif
                                                @endforeach
                                            @elseif ($response->response_status == 'reject')
                                                <p class="text-gray-600">
                                                    Pengaduan ditolak!!
                                                </p>
                                            @else
                                                <p class="text-gray-600">
                                                    Belum ada riwayat progress perbaikan/penyelesaian apapun
                                                </p>
                                            @endif
                                        </ul>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center gap-2">
                                    <p class="text-gray-600">
                                        Belum ada riwayat responses perbaikan/penyelesaian apapun
                                    </p>
                                    <button data-modal-target="modalDelete" data-modal-toggle="modalDelete"
                                        type="button"
                                        class="mt-2 rounded bg-red-500 px-4 py-2 text-white hover:bg-red-700">Hapus</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Main modal -->
            <div id="modalDelete" tabindex="-1" aria-hidden="true"
                class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                <div class="relative max-h-full w-full max-w-2xl p-4">
                    <!-- Modal content -->
                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Hapus Pengaduan
                            </h3>
                            <button type="button"
                                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="modalDelete">
                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{ route('report.delete', $report->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="space-y-4 p-4 md:p-5">
                                <p class="text-gray-600 dark:text-gray-400">
                                    Apakah Anda yakin ingin menghapus pengaduan ini?
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
                                <button data-modal-hide="default-modal" type="submit"
                                    class="rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Ya,
                                    Hapus</button>
                                <button data-modal-hide="default-modal" type="button"
                                    class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    <script>
        $(document).ready(function() {
            $('.btn-data').click(function() {
                let index = $(this).data('index');
                $('#data-' + index).show();
                $('#gambar-' + index).hide();
                $('#status-' + index).hide();
            });

            $('.btn-gambar').click(function() {
                let index = $(this).data('index');
                $('#data-' + index).hide();
                $('#gambar-' + index).show();
                $('#status-' + index).hide();
            });

            $('.btn-status').click(function() {
                let index = $(this).data('index');
                $('#data-' + index).hide();
                $('#gambar-' + index).hide();
                $('#status-' + index).show();
            });

            @foreach ($reports as $index => $report)
                // function IIFE (Immediately Invoked Function Expression) adalah function yang langsung dijalankan tanpa perlu dipanggil
                (function(index) {
                    // parameter index berasal dari variabel $index yang di ambil dari foreach
                    let provinsiId = "{{ $report->province }}";
                    let kotaId = "{{ $report->regency }}";
                    let kecamatanId = "{{ $report->subdistrict }}";
                    let kelurahanId = "{{ $report->village }}";

                    $.when(
                        $.get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json'),
                        $.get(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`),
                        $.get(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`),
                        $.get(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
                    ).done(function(provinces, regencies, districts, villages) {
                        let province = provinces[0].find(data => data.id == provinsiId);
                        let regency = regencies[0].find(data => data.id == kotaId);
                        let district = districts[0].find(data => data.id == kecamatanId);
                        let village = villages[0].find(data => data.id == kelurahanId);

                        if (province) {
                            $('#province-' + index).html(province.name);
                        }
                        if (regency) {
                            $('#regency-' + index).html(regency.name);
                        }
                        if (district) {
                            $('#subdistrict-' + index).html(district.name);
                        }
                        if (village) {
                            $('#village-' + index).html(village.name);
                        }
                    }).fail(function(error) {
                        console.error('Error fetching location data:', error);
                    });
                })({{ $index }});
            @endforeach
        });
    </script>
</x-layout>
