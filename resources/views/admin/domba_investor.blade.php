@extends('admin.master')
 
 @section('content')
    <div class="layout-px-spacing"> 
        <div class="row layout-top-spacing">
            <div class="card m-3">
                <div class="card-header">
                <?PHP 
                $judul="KESELURUHAN";
                IF ($jenis==1){
                    $judul="AVAILABLE";
                }
                 IF ($jenis==2){
                    $judul="SOLD";
                }
                ?>
                <h5 class="card-title text-center">DAFTAR DOMBA {{$judul}} </h5>
                @if (!empty($investor_name))
                 <h6 class="card-title text-center">NAMA INVESTOR : {{strtoupper($investor_name)}}</h6>
                @endif
                </div>
                <div class="card-body p-2 pt-3">
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No Registrasi</th>
                                                <th>Tgl Masuk</th>
                                                <th>Tgl Booking</th>
                                                <th>Berat Awal</th>
                                                <th>Berat Booking</th>
                                                <th>Berat Akhir</th>
                                                <th>Jenis</th>
                                                <th>Kandang</th>
                                                <th>Kamar</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>Supplier</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                             <tr>
                                                 <?PHP 
                                                 $berat_akhir=berat_akhir($d->no_regis, $d->berat_awal);
                                                 ?>

                                                <td>{{ $d->no_regis }}</td>
                                                <td>{{  convert_tgl1($d->tgl_masuk) }}</td>
                                                <td>{{ convert_tgl1($d->tgl_masuk_investor) }}</td>
                                                
                                               <td> {{ number_format($d->berat_awal,2) }}</td>
                                               <td> {{ number_format($d->berat_awal_investor,2) }}</td>
                                               <td> {{ number_format($berat_akhir,2) }}</td>
                                                <td>{{ $d->jenis }}</td>
                                                <td>{{ $d->kandang }}</td>
                                                <td>{{ $d->kamar }}</td>
                                               <td align="right">Rp. {{ number_format($d->harga_beli) }}</td>
                                                <td align="right">Rp. {{ number_format($d->harga_jual) }}</td>
                                                <td>{{ $d->supplier }}</td>
                                               

                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                           
                                        
                                </table>
                </div>
            </div>
        </div>
    </div>
@endsection