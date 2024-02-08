<form action="{{route('poliklinik.updateAlergi',$trxPasien->mPasien->no_rm)}}" method="POST">
  @csrf
  {{-- @method('PUT') --}}
  <input type="hidden" name="trx_id" id="trx_id" value="{{$trxPasien->trx_id}}">
  <div class="row">
    <div class="col-sm-12">
      <div class="form-floating">
        <label for="keterangan">Keterangan Alergi</label>
        <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10" placeholder="Keterangan alergi">{{ $trxPasien->mPasien->alergi }}</textarea>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <div class="text-right">
      <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> Update Data</i></button>
      <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i> Reset</button>
    </div>
</div>
</form>