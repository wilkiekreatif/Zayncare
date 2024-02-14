<div class="card card-primary card-outline mt-2">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title">
          <i class="fab fa-wpforms"></i>
          Keterangan Pasien
        </h3>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <form action="{{route('poliklinik.updateAlergi',$trxPasien->mPasien->no_rm)}}" method="POST">
      @csrf
      {{-- @method('PUT') --}}
      <input type="hidden" name="trx_id" id="trx_id" value="{{$trxPasien->trx_id}}">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-floating">
            <label for="keterangan">Keterangan Alergi</label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" placeholder="Keterangan alergi">{{ $trxPasien->mPasien->alergi }}</textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="text-right">
        <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> Simpan</button>
        <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i></button>
      </div>
  </div>
  </form>
</div>
    