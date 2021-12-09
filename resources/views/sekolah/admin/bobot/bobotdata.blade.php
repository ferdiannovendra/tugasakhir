<table class="table">
    <thead>
        <tr>
            <th>Pengetahuan</th>
            <th>Keterampilan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @if($data != null)
                <td><input type="number" class="form-control" name="b_pengetahuan" value="{{$data->pivot->bobot_pengetahuan}}" id=""></td>
                <td><input type="number" class="form-control" name="b_keterampilan" value="{{$data->pivot->bobot_keterampilan}}" id=""></td>
            @elseif($data == null)
                <td><input type="number" class="form-control" name="b_pengetahuan" value="0" id=""></td>
                <td><input type="number" class="form-control" name="b_keterampilan" value="0" id=""></td>
            @endif
        </tr>
    </tbody>
</table>

<button type="submit" class="btn btn-primary">Simpan</button>
