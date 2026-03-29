<li>
    <div class="pohon-node shadow-sm {{ $person->jenis_kelamin == 'L' ? 'gender-l' : 'gender-p' }}">
        <img src="{{ $person->foto_url }}"
            alt="{{ $person->nama }}"
            class="rounded-circle mb-2"
            style="width: 50px; height: 50px; object-fit: cover; border: 2px solid white;">

        <div class="pohon-info">
            <strong class="d-block">{{ $person->nama }}</strong>
            <small class="text-muted" style="font-size: 0.7rem;">
                {{ $person->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                @if($person->tanggal_lahir)
                <br>({{ $person->tanggal_lahir->format('Y') }})
                @endif
            </small>
        </div>
    </div>

    @if($person->anak->count() > 0)
    <ul>
        @foreach($person->anak as $child)
        @include('anggota.node', ['person' => $child])
        @endforeach
    </ul>
    @endif
</li>