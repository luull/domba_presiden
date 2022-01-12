@extends('admin.master')
 
 @section('content')
    <div class="layout-px-spacing"> 
        <div class="row layout-top-spacing">
            <div class="card m-3">
                <div class="card-header">
                <h5 class="card-title text-center">DAFTAR DOMBA TERJUAL</h5>
                @if (!empty($investor_name))
                 <h6 class="card-title text-center">NAMA INVESTOR : {{strtoupper($investor_name)}}</h6>
                @endif
                 <h6 class="card-title text-center">TANGGAL : {{convert_tgl1($tg1)}} S/D {{convert_tgl1($tg2)}} </h6>
                </div>
                <div class="card-body p-2 pt-3">
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No Transaksi</th>
                                                <th>Tgl Transaksi</th>
                                               @if (!empty($investor_name))
                                                <th>Investor</th>
                                               @endif 
                                                <th>Jumlah</th>
                                                <th>Sub Total</th>
                                                <th>Diskon</th>
                                                <th>Total</th>
                                                <th>Cara Bayar</th>
                                                <th>Keterangan</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;
                                            $gjml=0;
                                            $gsubtotal=0;$gtotal=0;$gdiskon=0;?>
                                            @foreach($data as $d)
                                             <tr>
                                                <td>{{ $d->no_transaksi }}</td>
                                                <td>{{ $d->tgl_transaksi }}</td>
                                                @if (!empty($investor_name))
                                               <td>{{ get_investor_name($d->id_investor) }}</td>
                                               @endif
                                               <td> {{ number_format($d->qty) }}</td>
                                                <td align="right">Rp. {{ number_format($d->sub_total) }}</td>
                                                <td align="right">Rp. {{ number_format($d->diskon) }}</td>
                                                <td align="right">Rp. {{ number_format($d->total) }}</td>
                                                <td>{{ $d->cara_bayar }}</td>
                                                <td>{{ $d->keterangan }}</td>
                                                <?PHP 
                                                $gjml=$gjml+$d->qty;
                                                $gsubtotal=$gsubtotal+$d->sub_total;
                                                $gdiskon=$gdiskon+$d->diskon;
                                                $gtotal=$gtotal+$d->total;?>

                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                              <tr><td colspan="2">Total</td>
                                                <td>{{number_format($gjml)}}</td> 
                                                <td align="right">Rp. {{number_format($gsubtotal)}}</td> 
                                                <td align="right">{{number_format($gdiskon)}}</td> 
                                                <td align="right">{{number_format($gtotal)}}</td> 
                                            <td colspan=2></td></tr> 
                                        
                                </table>
                </div>
            </div>
        </div>
    </div>
@endsection