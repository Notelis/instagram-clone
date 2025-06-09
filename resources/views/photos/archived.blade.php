<h2>Foto yang Diarsipkan</h2>

@foreach ($photos as $photo)
    <div style="margin-bottom: 10px;">
        <strong>{{ $photo->caption }}</strong>
    </div>
@endforeach
