
@extends('admin.master')
 <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="/pakan/order">Pembelian Pakan  </a></li>
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
                <h5 class="card-title text-center">PEMBELIAN PAKAN KE SUPPLIER</h5>
                </div>
                <div class="card-body p-2 pt-3">
                     @if (session('message'))
                    <div class="alert alert-{{ session('alert') }} fade show">
                        {{ session('message') }}
                    </div>
                    @endif
                                      <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Nama Supplier</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->nama_supplier}}</div>
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
                             Pilih Jenis Pakan
                             </button>
                             <button type="button" class="btn btn-danger mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#payModal" id="btnProsesBayar">
                             Proses Bayar
                             </button>
                                    </div>
                                </div>
                                        
                                        
                                        
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
                <form  action="{{route('order_selesai')}}" method="Post">    
                                    @csrf
                              
                                    <div class='row'>
                                        <div class="col-6">
                                            <label>Tanggal Order</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i> </span>
                                                </div>
                                                <input id="basicFlatpickr1" name="tgl_transaksi"  class="form-control flatpickr flatpickr-input active" value="{{$tgl_order}}" type="text" >
                                                @error('tgl_transaksi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                         <div class="col-6">
                                            <label>Tanggal Estimasi</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i> </span>
                                                </div>
                                                <input id="basicFlatpickr2" name="tgl_estimasi"  class="form-control flatpickr flatpickr-input active" value="{{$tgl_order}}" type="text" >
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
                                                <input type="hidden" name="supplier_id" id="supplier_id"  value="{{$data->id}}" >
                                                
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
                <h5 class="modal-title" id="addModalLabel">Daftar Pakan</h5>
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
                                                <th>Kode </th>
                                                <th>Nama Pakan</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
                                                 <th>Jml</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($pakan as $d)
                                            <tr>
                                                <td>{{ $d->kode_pakan }}</td>
                                                <td>{{ $d->nama_pakan }}</td>
                                                <td>{{ $d->satuan_pakan }}</td>
                                                <td>Rp. {{ number_format($d->harga_pakan) }}</td>
                                                <td><input type="text" class="form-control-sm jml" size="4" id="jml-{{$d->id}}" value="0"></td>
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
        var f11 = flatpickr(document.getElementById('basicFlatpickr2'), {
            dateFormat: "d-m-Y",
        });
        $("#btnProsesBayar").hide();
        $(".jml").change(function(){
            var idnya=$(this).attr('id').split('-');
            var id=idnya[1];
            var supplier_id="<?PHP echo $data->id;?>";
                    pilih(id, supplier_id);
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
            
            
            var totalorder =$("#totalorder").val();
            totalorder=totalorder.replace(",","");
            totalorder=totalorder.replace(",","");
            totalorder=totalorder.replace(",","");
            
           
        })
    })
   
   function pilih(id,supplier_id){
       var jml=$("#jml-"+ id).val();
       $.ajax({
                type: 'get',
                method: 'get',
                url: '/dummy-beli/add/'+ id,
                data: '_token = <?php echo csrf_token() ?>' + '&supplier_id=' + supplier_id + '&jml=' + jml,
                success: function(hsl) {
                 if (hsl.status){
                      $(".message").show();
                     $(".message").html(hsl.message);
                    showdata(supplier_id);
                 }else{
                     $(".message").show();
                     $(".message").html(hsl.message);
                 }
                
            }
        });

   }
   function showdata(supplier_id){
       $("#btnProsesBayar").hide();
       
       $.ajax({
                type: 'get',
                method: 'get',
                url: '/dummy-beli/show/'+ supplier_id,
                data: '_token = <?php echo csrf_token() ?>' ,
                success: function(hsl) {
                 if (hsl.status){
                     html='<table  class="table dt-table-hover" style="width:100%">';
                     html+='<thead><tr><th>Kode Pakan</th><th>Nama Pakan</th><th>Satuan </th>';
                     html+='<th style="text-align:right">Harga</th><th>Jumlah</th><th style="text-align:right">Total</th>';
                     html+=' </tr> </thead><tbody>';

                     $.each(hsl.data, function(propName, propVal) {
                       
                        html+= '<tr><td>' + propVal.kode_pakan + '</td>'
                        html+='<td>' + propVal.nama_pakan + '</td>';
                        html+='<td>' + propVal.satuan + '</td>';
                        html+='<td align="right">' + number_format(propVal.harga,0,'.',',') + '</td>';
                        html+='<td>' + propVal.jml + '</td>';
                        html+='<td align="right">' + number_format(propVal.total,0,'.',',')+ '</td>';
                            
                        html+='</tr>';
                    });
                    html +='</tbody><tfoot>';
                    html+='<tr><td colspan=7 align="center"><div class="row pl-4 pr-4 text-danger justify-content-between"><div>Total </div><div>' + hsl.total + '</div></td></tr>';
                    
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


                    