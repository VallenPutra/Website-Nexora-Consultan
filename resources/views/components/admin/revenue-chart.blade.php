@props(['data' => []])

@php
    $max = collect($data)->max('amount') ?: 1;
    $barWidth = 44;
    $gap = 28;
    $chartHeight = 160;
    $width = count($data) * ($barWidth + $gap);

    $formatShort = function (int $amount) {
        if ($amount >= 1_000_000) {
            return round($amount / 1_000_000, 1).'jt';
        }
        return number_format($amount, 0, ',', '.');
    };
@endphp

<div class="overflow-x-auto">
    <svg viewBox="0 0 {{ $width }} {{ $chartHeight + 40 }}" class="w-full h-auto" style="min-width: {{ $width }}px" role="img" aria-label="Monthly revenue bar chart, demo data">
        @foreach ($data as $i => $point)
            @php
                $barHeight = max(6, ($point['amount'] / $max) * $chartHeight);
                $x = $i * ($barWidth + $gap) + $gap / 2;
                $y = $chartHeight - $barHeight;
                $isLast = $i === count($data) - 1;
            @endphp
            <g>
                <rect x="{{ $x }}" y="{{ $y }}" width="{{ $barWidth }}" height="{{ $barHeight }}" rx="6"
                    fill="{{ $isLast ? '#F59E0B' : '#FFE3AE' }}" />
                <text x="{{ $x + $barWidth / 2 }}" y="{{ $y - 8 }}" text-anchor="middle" font-size="11" fill="#171A2B" font-weight="600">
                    {{ $formatShort($point['amount']) }}
                </text>
                <text x="{{ $x + $barWidth / 2 }}" y="{{ $chartHeight + 22 }}" text-anchor="middle" font-size="12" fill="#6B7280">
                    {{ $point['month'] }}
                </text>
            </g>
        @endforeach
        <line x1="0" y1="{{ $chartHeight }}" x2="{{ $width }}" y2="{{ $chartHeight }}" stroke="#E5E7EB" stroke-width="1" />
    </svg>
</div>
