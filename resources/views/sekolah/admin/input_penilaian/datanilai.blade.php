<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            @foreach($kd as $k)
            <th>{{$k->kode_kd}}. {{$k->kompetensi_dasar}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($getSiswa as $s)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$s->name}}</td>
            @foreach($kd as $k)
            <?php $skip = false; ?>
                @foreach ($nilai as $n)
                    @if($n->users_idusers == $s->id && $n->idkompetensi_dasar == $k->idkompetensi_dasar)
                    <th><input type="number" class="form-control" value="{{$n->nilai}}" name="nilai{{$s->id}}_{{$k->idkompetensi_dasar}}" id=""></th>
                    <?php $skip=true;?>
                    @break
                    @endif
                @endforeach
                @if(!$skip)
                <th><input type="number" class="form-control" value="0" name="nilai{{$s->id}}_{{$k->idkompetensi_dasar}}" id=""></th>
                @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

<button type="submit" class="btn btn-primary">Simpan</button>
