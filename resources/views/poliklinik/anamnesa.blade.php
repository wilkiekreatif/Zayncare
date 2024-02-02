<form action="{{route('poliklinik.anamnesa')}}" method="POST">
  @csrf
  {{-- @method('PUT') --}}
  <input type="hidden" name="trx_id" id="trx_id" value="{{$trxPasien->trx_id}}">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label class="col-form-label" for="detakjantung">Detak jantung /menit</label>
        <input type="number" class="form-control" name="detakjantung" id="detakjantung" maxlength="3" value="" placeholder="Silahkan diisi...">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="tensi1">Tensi darah</label>
        <div class="row">
          <div class="col-sm-3">
            <input type="number" width="30%" class="form-control" name="tensi1" id="tensi1" maxlength="3" value="" placeholder="Silahkan diisi...">
          </div>
          <div class="col-sm-0.5">
            <label class="col-form-label" for="tensi">/</label>
          </div>
          <div class="col-sm-3">
            <input type="number" width="30%" class="form-control" name="tensi2" id="tensi2" maxlength="3" value="" placeholder="Silahkan diisi...">
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label class="col-form-label" for="suhu">Suhu badan (Derajat Celcius)</label>
        <input type="number" class="form-control" name="suhu" id="suhu" maxlength="5" value="" placeholder="Silahkan diisi...">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="beratbadan">Berat badan (Kg)</label>
        <input type="number" class="form-control" name="beratbadan" id="beratbadan" maxlength="3" value="" placeholder="Silahkan diisi...">
      </div>
    </div>
  </div>
  <div class="text-right">
    <button type="submit" onclick="return confirm('Apakah data tersebut sudah sesuai?')" class="btn btn-success"> <i class="fas fa-save"> </i> SIMPAN</button>
    <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i> RESET</button>
  </div>
</form>
<div class="card card-primary card-outline mt-2">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title">
          <i class="fab fa-wpforms"></i>
          Riwayat Anamnesa
        </h3>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    {{-- Form inputan tindakan --}}
  </div>
</div>