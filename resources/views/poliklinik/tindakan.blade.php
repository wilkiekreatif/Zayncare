<div class="row">
  <div class="col-sm-8">
    <div class="card card-primary card-outline">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3"><i class="fa fa-user-injured"> </i> Tindakan Pasien</h3>
      </div><!-- /.card-header -->
      <div class="card-body">
        <form action="{{route('poliklinik.tindakan',$trxPasien->trx_id)}}" method="POST">
          @csrf
          <input type="hidden" name="trx_id" id="trx_id" value="{{$trxPasien->trx_id}}">
          <div class="row">
            <div class="col-sm-8">
              <div class="form-group">
                <label for="tindakan" class="col-form-label" >Tindakan</label>
                <select id="tindakan" name="tindakan" class="form-control select2bs4 {{ $errors->has('tindakan') ? 'is-invalid' : '' }}" style="width: 100%;">
                  <option disabled selected="selected">-- Pilih salah satu --</option>
                  @foreach ($tindakans as $tindakan)
                    <option value="{{ $tindakan->id }}" {{ old('tindakan') == $tindakan->id ? 'selected' : '' }}>{{ $tindakan->tindakan_nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-form-label" for="tarif">Tarif</label>
                <input readonly type="number" class="form-control" name="tarif" id="tarif">
              </div>
            </div>
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
        </div>
        <div class="card-footer">
          <div class="text-right">
            <button type="submit" class="btn btn-success"> <i class="fas fa-plus"> </i></button>
            <button type="reset" class="btn btn-danger"> <i class="fas fa-undo-alt"> </i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card card-primary card-outline">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3"><i class="fa fa-user-injured"> </i> Tindakan Pasien</h3>
      </div><!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th style="background-color: rgb(120, 186, 196)" width="2%">No</th>
              <th style="background-color: rgb(120, 186, 196)">TINDAKAN</th>
              <th style="background-color: rgb(120, 186, 196)">JUMLAH</th>
              <th style="background-color: rgb(120, 186, 196)">TOTAL TARIF</th>
              <th style="background-color: rgb(120, 186, 196)">OPSI</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($trxTindakans as $tindakan)
            @php
                $total = number_format($tindakan->total,0,',','.');
            @endphp
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $tindakan->mtindakan->tindakan_nama }}</td>
              <td>{{ $tindakan->qty }} {{ $tindakan->satuan }}</td>
              <td>Rp. {{ $total }}</td>
              <td>
                <form method="POST" action="{{ route('poliklinik.deletetindakan', ['trx_id' => $trxPasien->trx_id, 'id' => $tindakan->id]) }}" onsubmit="return confirm('Apakah anda yakin akan membatalkan pasien ini?');">
                  @method('PUT')
                  @csrf
                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Batalkan tindakan">
                      <i class="fas fa-trash"></i> Batal
                    </button>
                </form>
            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Sript auto dropdown --}}
{{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
