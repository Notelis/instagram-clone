<h2>Foto yang Disimpan</h2>

@foreach ($photos as $photo)
    <div style="margin-bottom: 10px;">
        <strong>{{ $photo->caption }}</strong><br>
        <small>Diupload oleh: {{ $photo->user->name ?? 'Tidak diketahui' }}</small>
    </div>
@endforeach
