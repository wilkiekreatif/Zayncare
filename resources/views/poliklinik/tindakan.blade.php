<form action="{{route('poliklinik.tindakan',$trxPasien->trx_id)}}" method="POST">
  @csrf
  <input type="hidden" name="trx_id" id="trx_id" value="{{$trxPasien->trx_id}}">
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label for="tindakan">Tindakan</label>
        <select id="tindakan" autofocus name="tindakan" class="form-control select2bs4 {{ $errors->has('tindakan') ? 'is-invalid' : '' }}" style="width: 100%;">
          <option disabled selected="selected">-- Pilih salah satu --</option>
          @foreach ($tindakans as $tindakan)
            <option value="{{ $tindakan->id }}" {{ old('tindakan') == $tindakan->id ? 'selected' : '' }}>{{ $tindakan->tindakan_nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label class="col-form-label" for="tarif">Tarif</label>
        <input type="number" class="form-control" name="tarif" id="tarif">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="qty">Jumlah Tindakan</label>
        <input type="number" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" name="qty" id="qty" maxlength="3" value="" placeholder="Silahkan diisi...">
      </div>
      <div class="form-group">
        <label for="satuan">satuan</label>
        <select id="satuan" name="satuan" class="form-control {{ $errors->has('satuan') ? 'is-invalid' : '' }}" style="width: 100%;">
          <option disabled selected="selected" >-- Pilih salah satu --</option>
          <option value="Kali" {{ old('satuan') == 'Kali' ? 'selected' : '' }}>Kali</option>
          <option value="Jam" {{ old('satuan') == 'Jam' ? 'selected' : '' }}>Jam</option>
        </select>
      </div>

      <div class="text-right">
        <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> SIMPAN</button>
        <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i> RESET</button>
      </div>
    </div>
  </div>
</form>

{{-- Sript auto dropdown --}}
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function() {
    $('#tindakan').on('change', function() {
        var kode_tindakan = $(this).val();
        // console.log(kode_tindakan);
        if(kode_tindakan) {
            $.ajax({
                url:'/harga_tindakan/'+ kode_tindakan,
                type: 'GET',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType:'json',
                success: function(data){
                    // console.log(data);
                    if(data){
      
                    var kelastarif = {{ $trxPasien->kelastarif }};
                    if(kelastarif === 1){
                      var margin = data[0].margin1;
                    }else if(kelastarif === 2){
                      var margin = data[0].margin2;
                    }else if(kelastarif === 3){
                      var margin = data[0].margin3;
                    }                       
                    
                    var hargajual = (data[0].tarifdasar * margin/100) + data[0].tarifdasar;
                    $('#tarif').val(hargajual);
                    }else{
                        $('#harga').empty();
                    }
                }
            });    
        }else{
            $('#harga').empty();
        }
    });
});


</script>