
@extends('investor.master-investor')
 <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Investor  </a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Penjualan Domba</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
 @section('content')
    <div class="layout-px-spacing"> 
            <div class="card m-3">
                <div class="card-header">
                <h5 class="card-title text-center">PEMBELIAN DOMBA</h5>
                </div>
                <div class="card-body p-2 pt-3">
                     @if (session('message'))
                    <div class="alert alert-{{ session('alert') }} fade show">
                        {{ session('message') }}
                    </div>
                    @endif
                   <form  action="{{route('booking_by_investor_selesai')}}" method="Post">    
                                    @csrf
                                
                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Nama</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->nama}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Kota</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->kota}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Alamat</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->alamat}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Propinsi</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->propinsi}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Handphone</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->hp}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Email</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->email}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-3 ">
                                    <div class="col-12 text-right">
                                   <button type="button" class="btn btn-primary mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#addModal">
                             Pilih Domba
                             </button>
                             <button type="submit" class="btn btn-danger mt-3 ml-3 mb-3 mr-3"  id="btnProsesBayar">
                             Proses Selesai
                             </button>
                                    </div>
                                </div>
                                        
                                        
                                        
                                </form>
                    <div class="table table-responsive">
                     <div id="datadummy"></div>
                    
                          

                  
                    </div>
                </div> 
            </div>
        
    </div>
    <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Proses Pembayaran</h5>
                
            </div>
            <div class="modal-body">
                <form  action="{{route('booking_selesai')}}" method="Post">    
                                    @csrf
                              
                                    <div class='row'>
                                         <div class="col-12">
                                            <label>Tanggal transaksi</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i> </span>
                                                </div>
                                                <input id="basicFlatpickr" name="tgl_transaksi"  class="form-control flatpickr flatpickr-input active" type="text" >
                                                @error('tgl_transaksi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                   <div class='row'>
                                        <div class="col-12">
                                             <div class="form-group mb-3">
                                                    <label >Cara Pembayaran</label>
                                                    <select name="cara_bayar" id="cara_bayar" class="form-control form-control-sm" required>
                                                        <option value="cash" selected>Cash</option>
                                                        <option value="transfer">Transfer</option>
                                                           
                                                    </select>
                                                    @error('cara_bayar')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                             </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Keterangan</label>
                                                <input type="text" name="keterangan" id="keterangan" class=" form-control form-control-sm" value="" >
                                                <input type="hidden" name="cust_id" id="cust_id"  value="{{$data->id}}" >
                                                
                                            </div>
                                        </div>
                                    </div>
                                           
                                       <div class="row"> 
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Sub Total</label>
                                                <input type="text" name="subtotal" id="subtotal" class=" form-control form-control-sm" value="" >
                                                
                                            </div>
                                        </div>
                                    </div>
                                       <div class="row"> 
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Diskon</label>
                                                <input type="text" name="diskon" id="diskon" class=" form-control form-control-sm" value="" >
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Total </label>
                                                <input type="text" name="totalorder" id="totalorder" class=" form-control form-control-sm" value="" >
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Total Dibayar</label>
                                                <input type="text" name="dibayar" id="dibayar" class="form-control" onblur="kembalian()" value="" >
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Kembalian</label>
                                                <input type="text" name="kembalian" id="kembalian" onchange="kembalian()" class=" form-control" value="" >
                                                
                                            </div>
                                        </div>
                                    </div>
                                
                              
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                        <button type="submit" class="btn btn-success">Selesai</button>
                                    </div>
                                </form>
            </div> 
        </div>
    </div> 
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Daftar Domba</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="alert alert-danger fade show message" style="display:none" >
                    </div>
                    
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No Registrasi</th>
                                                <th>Berat</th>
                                                <th>Jenis</th>
                                                <th>Kandang</th>
                                                <th>Kamar</th>
                                                <th>Harga</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($domba as $d)
                                          <?PHP
                                            $berat_akhir=berat_akhir($d->no_regis,$d->berat_awal_investor); 
                              
                                            ?>   <tr>
                                                <td><a href="#" class="text-danger pilih" onclick="pilih ({{$d->id}},{{$data->id}})"  id="e-{{$d->id}}" title="Pilih">{{ $d->no_regis }}</a></td>
                                                <td>{{ number_format($berat_akhir,2) }} Kg</td>
                                                <td>{{ $d->jenis }}</td>
                                                <td>{{ $d->kandang }}</td>
                                                <td>{{ $d->kamar }}</td>
                                                <td>Rp. {{ number_format($d->harga_jual) }}</td>
                                               
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                         
                </div>
            </div>
        </div>
    </div>
</div>  

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#btnProsesBayar").hide();
        $("#tgl_transaksi").attr('disabled','disabled');
        $("#subtotal").attr('disabled','disabled');
        $("#dibayar").change(function(){
            var dibayar =$("#dibayar").val();
            dibayar=dibayar.replace(",","")
            dibayar=dibayar.replace(",","")
            dibayar=dibayar.replace(",","")
            
            var totalorder =$("#totalorder").val();
            totalorder=totalorder.replace(",","");
            totalorder=totalorder.replace(",","");
            totalorder=totalorder.replace(",","");
            
            var kembalian=parseInt(dibayar)-parseInt(totalorder);
            var kembalian1=number_format(kembalian,0,".",",");
        $("#kembalian").val(kembalian1);
        })
         $("#diskon").change(function(){
            var subtotal=$("#subtotal").val();
            subtotal=subtotal.replace(",","")
            subtotal=subtotal.replace(",","")
            subtotal=subtotal.replace(",","")
            var diskon=$("#diskon").val();
            diskon=diskon.replace(",","")
            diskon=diskon.replace(",","")
            diskon=diskon.replace(",","")
            var totalorder=parseInt(subtotal)-parseInt(diskon);
            $("#totalorder").val(number_format(totalorder,0,'.',','));
            $("#dibayar").val(number_format(totalorder,0,'.',','));
            var dibayar =$("#dibayar").val();
            
            dibayar=dibayar.replace(",","")
            dibayar=dibayar.replace(",","")
            dibayar=dibayar.replace(",","")
            
            var totalorder =$("#totalorder").val();
            totalorder=totalorder.replace(",","");
            totalorder=totalorder.replace(",","");
            totalorder=totalorder.replace(",","");
            
            var kembalian=parseInt(dibayar)-parseInt(totalorder);
            var kembalian1=number_format(kembalian,0,".",",");
        $("#kembalian").val(kembalian1);
        })
    })
   
   function pilih(id,cust_id){
       $.ajax({
                type: 'get',
                method: 'get',
                url: '/dummy-jual/add/'+ id,
                data: '_token = <?php echo csrf_token() ?>' + '&cust_id=' + cust_id,
                success: function(hsl) {
                 if (hsl.status){
                      $(".message").show();
                     $(".message").html(hsl.message);
                    showdata(cust_id);
                 }else{
                     $(".message").show();
                     $(".message").html(hsl.message);
                 }
                
            }
        });

   }
   function showdata(cust_id){
       $("#btnProsesBayar").hide();
       $.ajax({
                type: 'get',
                method: 'get',
                url: '/dummy-jual/show/'+ cust_id,
                data: '_token = <?php echo csrf_token() ?>' + '&cust_id=' + cust_id,
                success: function(hsl) {

                 if (hsl.status){
                     html='<table  class="table dt-table-hover" style="width:100%">';
                     html+='<thead><tr><th>No Registrasi</th>';
                     html+='<th>Berat </th><th>Jenis</th><th>Kandang</th><th>Kamar</th>';
                     html+='<th style="text-align:right">Harga </th><th style="text-align:right">Total </th> </tr> </thead><tbody>';

                     $.each(hsl.data, function(propName, propVal) {
                       
                        html+= '<tr><td>' + propVal.no_regis + '</td>'
                        html+='<td>' + propVal.berat_akhir + '</td>';
                        html+='<td>' + propVal.jenis + '</td>';
                        html+='<td>' + propVal.kandang + '</td>';
                        html+='<td>' + propVal.kamar + '</td>';
                          html+='<td align="right">' + number_format(propVal.harga,0,'.',',') + '</td>';
                        html+='<td align="right">' + number_format(propVal.total,0,'.',',')+ '</td>';
                            
                        html+='</tr>';
                    });
                    html +='</tbody><tfoot>';
                    html+='<tr><td colspan=8 align="center"><div class="row pl-4 pr-4 text-danger justify-content-between"><div>Total </div><div>' + hsl.total + '</div></td></tr>';
                    
                    html+=' </tfoot></table>';
                    $("#datadummy").html(html);
                    $("#subtotal").val(hsl.total)
                    $("#totalorder").val(hsl.total)
                    $("#dibayar").val(hsl.total)
                     $("#diskon").val(0)
                   $("#kembalian").val(0)
                   $("#btnProsesBayar").show();
                 }else{
                     $(".message").show();
                     $(".message").html(hsl.message);
                 }
                
            }
        });

   }
   function number_format (number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }
</script>
    
@endsection


                    