@forelse($category as $rowcat)
{{ $rowcat->kategori }}
{{ $rowcat->jenis }}

@empty
@endforelse