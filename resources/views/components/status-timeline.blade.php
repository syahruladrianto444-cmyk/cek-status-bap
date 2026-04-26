<div class="relative max-w-xl mx-auto">
    {{-- Vertical line --}}
    <div class="absolute left-4 md:left-8 top-0 h-full border-r-2 border-gray-200 z-0" style="left: calc(2rem - 1px); @media (max-width: 768px) { left: calc(1rem - 1px); }"></div>

    <ul class="relative z-10 space-y-8">
        @php
            $currentIndex = $pemohon->current_status_index;
            $historiesGrouped = $pemohon->statusHistories->keyBy('status');
        @endphp

        @foreach($statusFlow as $index => $flowStatus)
            @php
                $displayStatus = \App\Models\Pemohon::APPLICANT_STATUS_MAPPING[$flowStatus] ?? $flowStatus;
                $isCompleted = $index <= $currentIndex;
                $isCurrent = $index === $currentIndex;
                $isPending = $index > $currentIndex;
                $history = $historiesGrouped->get($flowStatus);

                // Styling logic
                if ($isCurrent) {
                    $iconBg = 'bg-govt-blue';
                    $iconColor = 'text-white';
                    $borderStr = 'ring-4 ring-blue-100';
                    $textColor = 'text-govt-dark font-bold';
                    $dotContent = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>';
                } elseif ($isCompleted) {
                    $iconBg = 'bg-emerald-500';
                    $iconColor = 'text-white';
                    $borderStr = '';
                    $textColor = 'text-gray-900 font-semibold';
                    $dotContent = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                } else {
                    $iconBg = 'bg-white border-2 border-gray-300';
                    $iconColor = 'text-gray-300';
                    $borderStr = '';
                    $textColor = 'text-gray-400 font-medium';
                    $dotContent = '<span class="w-2.5 h-2.5 bg-gray-300 rounded-full"></span>';
                }
            @endphp

            <li>
                <div class="flex items-start">
                    <div class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full md:w-16 md:h-16 md:-ml-4 bg-white z-10 transition-colors">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $iconBg }} {{ $iconColor }} {{ $borderStr }} shadow-sm">
                            {!! $dotContent !!}
                        </div>
                    </div>
                    <div class="ml-4 md:ml-6 mt-1 flex-1">
                        <h4 class="text-lg {{ $textColor }}">{{ $displayStatus }}</h4>
                        
                        @if($history)
                            <div class="mt-2 bg-gray-50 border border-gray-100 rounded-lg p-4 shadow-sm relative overflow-hidden {{ $isCurrent ? 'ring-1 ring-govt-blue border-govt-blue' : '' }}">
                                @if($isCurrent)
                                    <div class="absolute top-0 left-0 w-1 h-full bg-govt-blue"></div>
                                @endif
                                
                                <div class="flex flex-wrap items-center justify-between gap-y-2 gap-x-4 mb-2">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $history->created_at->timezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB
                                    </div>
                                    
                                    @if($history->status_detail)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ in_array($history->status_detail, ['Disetujui']) ? 'bg-emerald-100 text-emerald-800' : 
                                               (in_array($history->status_detail, ['Ditolak', 'Tidak Disetujui']) ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                                            {{ $history->status_detail }}
                                        </span>
                                    @endif
                                </div>
                                
                                @if($history->keterangan)
                                    <p class="text-sm text-gray-700 font-medium">Catatan:</p>
                                    <p class="text-sm text-gray-600 mt-1 italic">{{ $history->keterangan }}</p>
                                @endif
                            </div>

                            {{-- Small Notification Alert --}}
                            @if($flowStatus === 'Hasil BAP' && $history?->status_detail === 'Disetujui')
                                <div class="mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg shadow-sm">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-bold text-emerald-800 uppercase tracking-wider">Pemberitahuan:</h3>
                                            <div class="mt-1 text-sm text-emerald-700 leading-relaxed">
                                                <p>Proses BAP Anda telah <strong>SELESAI</strong>. Silahkan datang ke Kantor Imigrasi Kelas I Non TPI Pemalang untuk tahap foto Paspor.</p>
                                                <div class="mt-3 bg-white/50 p-2 rounded border border-emerald-100 grid grid-cols-2 gap-2 text-[11px] font-bold">
                                                    <div>
                                                        <span class="block text-emerald-600 text-[9px] uppercase tracking-tighter">Senin - Kamis</span>
                                                        <span>08.00 - 15.00</span>
                                                    </div>
                                                    <div>
                                                        <span class="block text-emerald-600 text-[9px] uppercase tracking-tighter">Jumat</span>
                                                        <span>08.00 - 15.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @elseif($isCurrent && !$history)
                            <p class="text-sm text-gray-500 mt-1">Sedang dalam proses.</p>
                        @elseif($isPending)
                            <p class="text-sm text-gray-400 mt-1">Menunggu tahapan sebelumnya selesai.</p>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
