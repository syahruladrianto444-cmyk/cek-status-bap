@php
    $colorClass = match($status) {
        'Selesai BAP' => 'badge-success',
        'Diajukan ke Kepala Kantor' => 'badge-info',
        'Proses Penindakan di Kasubsi' => 'badge-warning',
        'Wawancara BAP' => 'badge-gray',
        default => 'badge-gray'
    };
@endphp

<span class="{{ $colorClass }} {{ $attributes->get('class') }}">
    {{ $status }}
</span>
