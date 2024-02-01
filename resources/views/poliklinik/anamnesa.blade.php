<form action="{{route('poliklinik.anamnesa',$trxPasien->trx_id)}}" method="POST">
  @csrf
  @method('PUT')
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
</form>
<div class="card card-primary card-outline">
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