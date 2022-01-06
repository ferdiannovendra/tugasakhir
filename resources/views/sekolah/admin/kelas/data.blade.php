<select name="siswa[]" id="" class="form-select" multiple>
    @foreach ($data as $d)
    <option value="{{ $d->id }}">{{ $d->name }} {{ $d->lname }}</option>
    @endforeach
</select>
<br>
<input type="checkbox" name="checkall" id=""> Pilih Semua
<br>
<button class="btn btn-primary" type="submit">Submit</button>
