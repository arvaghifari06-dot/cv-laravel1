{{-- Pertahankan parameter GET lain sebagai hidden input (pengganti inputTersembunyi()) --}}
@foreach (request()->query() as $kunci => $nilai)
    @if (! in_array($kunci, $except ?? [], true) && is_string($nilai))
        <input type="hidden" name="{{ $kunci }}" value="{{ $nilai }}">
    @endif
@endforeach
