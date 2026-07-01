  <div class="table-responsive scrollbar">
      <table class="table table-hover table-striped overflow-hidden">
          <thead class="bg-warning text-white">
              <tr>
                  <th scope="col">Tahun</th>
                  <th scope="col">Bulan</th>
                  <th scope="col">Cabang</th>
                  <th class="text-center" scope="col">Status</th>
                  <th class="text-end" scope="col">Amount</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data as $datas)
              <tr class="align-middle">

                  <td class="text-nowrap">{{ $datas->b_validasi_data_tahun }}</td>
                  <td class="text-nowrap">{{ $datas->b_validasi_data_bulan }}</td>
                  <td class="text-nowrap">{{ $datas->b_validasi_data_cabang }}</td>
                  <td>
                    <span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Proses<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                  </td>
                  <td class="text-end">
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-template" data-code="{{ $datas->b_validasi_data_code }}" id="button-proses-validasi-bisone">Proses</button>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
