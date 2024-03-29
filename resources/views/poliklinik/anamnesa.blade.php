<div class="row">
  <div class="col-sm-8">
    <div class="card card-primary card-outline mt-2">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">
              <i class="fab fa-wpforms"></i>
              Anamnesa pasien
            </h3>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{route('poliklinik.anamnesa',$trxPasien->trx_id)}}" method="POST">
          @csrf
          {{-- @method('PUT') --}}
          <input type="hidden" name="trx_id" id="trx_id" value="{{$trxPasien->trx_id}}">
          <input type="hidden" name="id" id="id" value="{{$trxPasien->mPasien->id}}">
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
                    <input type="number" width="30%" class="form-control" name="tensi1" id="tensi1" maxlength="3" value="" placeholder="...">
                  </div>
                  <div class="col-sm-0.5">
                    <label class="col-form-label" for="tensi">/</label>
                  </div>
                  <div class="col-sm-3">
                    <input type="number" width="30%" class="form-control" name="tensi2" id="tensi2" maxlength="3" value="" placeholder="...">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-form-label" for="suhu">Suhu badan (Derajat Celcius)</label>
                <input type="number" class="form-control" name="suhu" id="suhu" maxlength="5" value="" placeholder="Silahkan diisi...">
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label" for="beratbadan">Berat badan (Kg)</label>
                    <input type="number" class="form-control" name="beratbadan" id="beratbadan" maxlength="3" value="" placeholder="Silahkan diisi...">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-form-label" for="tinggibadan">Tinggi Badan (Cm)</label>
                    <input type="number" class="form-control" name="tinggibadan" id="tinggibadan" maxlength="3" value="" placeholder="Silahkan diisi...">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
              <button type="submit" class="btn btn-success"> <i class="fas fa-plus"> </i></button>
              <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i></button>
            </div>
        </div>
    </form>
    </div>
  </div>
  <div class="col-sm-4">
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
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
              <th style="background-color: rgb(120, 186, 196)">TANGGAL</th>
              <th style="background-color: rgb(120, 186, 196)">DETAK JANTUNG</th>
              <th style="background-color: rgb(120, 186, 196)">TENSI</th>
              <th style="background-color: rgb(120, 186, 196)">SUHU</th>
              <th style="background-color: rgb(120, 186, 196)">BERAT BADAN</th>
              <th style="background-color: rgb(120, 186, 196)">TINGGI BADAN</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($anamnesa as $anm)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $anm->created_at }}</td>
              <td><b>{{ $anm->detakjantung }}</b> /Menit</td>
              <td><b>{{ $anm->tensi1 }}</b>/<b>{{ $anm->tensi2 }}</b></td>
              <td><b>{{ $anm->suhu }}</b> <sup>o</sup>C</td>
              <td><b>{{ $anm->beratbadan }}</b> kg</td>
              <td><b>{{ $anm->tinggibadan }}</b> Cm</td>
              {{-- <td>
                <form method="POST" action="{{ route('poliklinik.deletetindakan', ['trx_id' => $trxPasien->trx_id, 'id' => $tindakan->id]) }}" onsubmit="return confirm('Apakah anda yakin akan membatalkan pasien ini?');">
                  @method('PUT') <!-- Menambahkan metode spoofing untuk PUT -->
                  @csrf
                    <button type="submit" class="btn btn-sm btn-danger {{ $trxPasien->status == '1' ? '' : 'disabled'}}" data-toggle="tooltip" data-placement="bottom" title="Batalkan tindakan">
                      <i class="fas fa-trash"></i> Batal
                    </button>
                </form>
            </td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>