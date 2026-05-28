 <table id="data_penilaian" class="table table-striped border" style="width:100%; font-size: 10px;" border="1">
     <thead class="">
         <tr>
             <th rowspan="2">NO</th>
             <th rowspan="2" class="text-center">NAMA BARANG</th>
             <th colspan="4" class="text-center">ALTERNATIF SUPPLIER</th>

         </tr>
         <tr>
             <th>1</th>
             <th>2</th>
             <th>3</th>
             <th>4</th>
         </tr>
     </thead>
     <tbody>
         @php
         $no = 1;
         @endphp
         @foreach ($brg as $brgs)
         <tr>
             <td>{{ $no++ }}</td>
             <td>{{ $brgs->m_barang_name }}</td>
             @php
             $suplier = DB::table('data_supp_brg_cab')
             ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'data_supp_brg_cab.m_supplier_code')
             ->where('data_supp_brg_cab.m_barang_code', $brgs->m_barang_code)
             ->where('data_supp_brg_cab.log_master_code', $code)
             ->orderBy('data_supp_brg_cab.data_supp_brg_cab_score', 'DESC')->get();
             @endphp
             @foreach ($suplier as $sup)
             <td><b style="color: red;">{{ $sup->m_supplier_name }}</b> ( <strong class="text-primary">{{ $sup->data_supp_brg_cab_score }}</strong> )
                 <table border="1" style="border-collapse: collapse;">
                     <tr>
                         @foreach ($cat as $cats)
                         <th><small>{{$cats->t_penilaian_cat_name}} {{ $cats->t_penilaian_cat_score }}</small></th>
                         @endforeach
                     </tr>
                     <tr>
                         @foreach ($cat as $cats)
                         @php
                         $point = DB::table('log_penilaian_cab')
                         ->join('t_penilaian_detail','t_penilaian_detail.t_penilaian_detail_code','=','log_penilaian_cab.t_penilaian_detail_code')
                         ->join('t_penilaian_cat','t_penilaian_cat.t_penilaian_cat_code','=','t_penilaian_detail.t_penilaian_cat_code')
                         ->where('log_penilaian_cab.m_barang_code',$brgs->m_barang_code)
                         ->where('log_penilaian_cab.log_master_code',$code)
                         ->where('log_penilaian_cab.m_supplier_code',$sup->m_supplier_code)
                         ->where('t_penilaian_cat.t_penilaian_cat_code',$cats->t_penilaian_cat_code)
                         ->where('t_penilaian_detail.t_penilaian_detail_type','option')
                         ->sum('log_penilaian_cab.log_penilaian_cab_score');
                         @endphp

                         <td>{{ $point }}</td>

                         @endforeach
                     </tr>
                 </table>
                 Note :
                 @php
                 $note = DB::table('log_penilaian_cab_desc')
                 // ->where('m_barang_code',$brgs->m_barang_code)
                 ->where('log_master_code',$code)
                 ->where('m_supplier_code',$sup->m_supplier_code)
                 ->get();
                 @endphp
                 @foreach ($note as $notes)
                 @if ($notes->log_penilaian_cab_desc_text != "")
                 <li style="margin-left: 10px;">{{ $notes->log_penilaian_cab_desc_text }} <a href="#" id="button-remove-desc-penilaian" data-id="{{ $notes->log_penilaian_cab_code_desc }}" data-code="{{ $code }}"><span class="fas fa-window-close" ></span></a></li>
                 @endif
                 @endforeach
             </td>
             @endforeach
             @if ($suplier->count() == 1)
             <td>-</td>
             <td>-</td>
             <td>-</td>
             @elseif ($suplier->count() == 2)
             <td>-</td>
             <td>-</td>
             @elseif ($suplier->count() == 3)
             <td>-</td>
             @endif
         </tr>
         @endforeach
     </tbody>
 </table>
 <script>
     new DataTable('#data_penilaian', {
         responsive: true
     });
 </script>
