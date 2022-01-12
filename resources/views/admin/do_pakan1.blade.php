
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
                <h5 class="card-title text-center">PENERIMAAN PAKAN DARI SUPPLIER</h5>
                </div>
                <div class="card-body p-2 pt-3">
                     @if (session('message'))
                    <div class="alert alert-{{ session('alert') }} fade show">
                        {{ session('message') }}
                    </div>
                    @endif
                    <form action="/pakan/do/finish" method="post">     
                              
                                      <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Nama Supplier</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$supplier->nama_supplier}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-4 p-1">Kota</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$supplier->kota}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Alamat</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$supplier->alamat}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-4 p-1">Propinsi</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$supplier->propinsi}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Handphone</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$supplier->hp}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="row p-1">
                                                <div class="col-md-4 p-1">Email</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$supplier->email}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Tanggal Order</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{convert_tgl1($tgl_order)}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="row p-1">
                                                <div class="col-md-4 p-1">No PO</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$no_po}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1 pr-0 mr-0">Tgl Terima</div>
                                                <div class="col-md-6  ml-0 pl-0">
                                                    <input type="text" name="tgl_do" id="basicFlatpickr2" class="form-control form-control-sm " value="{{$tgl_do}}"></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row p-3 ">
                                    <div class="col-12 text-right">
                                @csrf
                             <input type="hidden" id="no_po" name="no_po" value="{{$no_po}}">
                                <input type="submit" class="btn btn-danger mt-3 ml-3 mb-3 mr-3" value="Proses Penerimaan">
                            </form>
                                    </div>
                                </div>
                                        
                                        
                                        
                    <div class="table table-responsive">
                     <div id="datadummy">
                         <div class="alert alert-success text-center p-3" style="display:none" id="message"></div>
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Kode </th>
                                                <th>Nama Pakan</th>
                                                <th>Satuan</th>
                                                 <th>Jml Order</th>
                                                
                                                 <th>Diterima</th>
                                                 <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($pakan as $d)
                                            <tr id="r-{{$d->id}}">
                                                <td>{{ $d->kode_pakan }}</td>
                                                <td>{{ $d->nama_pakan }}</td>
                                                <td>{{ $d->satuan }}</td>
                                                <td>{{ number_format($d->jml) }}</td>
                                                <td><input type="text" onchange="update({{$d->id}})" class="form-control-sm jml" size="4" id="jml-{{$d->id}}" value="{{$d->jml}}"></td>
                                                <td><a href="#" class="btn btn-info btn-sm" onclick="hapus({{$d->id}})"  id="e-{{$d->id}}" title="Hapus">Hapus</a>
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
      $("#message").hide();
       var f11 = flatpickr(document.getElementById('basicFlatpickr2'), {
            dateFormat: "d-m-Y",
        });
                    
    })
    function hapus(id){
        $.ajax({
                type: 'get',
                method: 'get',
                url: '/pakan/do/del/'+ id,
                data: '_token = <?php echo csrf_token() ?>' ,
                success: function(hsl) {
                    if (hsl.status=="success"){
                        $("#r-"+id).remove();
                    }     
                    $("#message").show();
                     $("#message").html(hsl.message);
                }
        })
    }
   
   
   function update(id){
       $("#message").hide();
      
       var jml=$("#jml-"+ id).val();
       $.ajax({
                type: 'get',
                method: 'get',
                url: '/pakan/do/update/'+ id,
                data: '_token = <?php echo csrf_token() ?>' + '&id=' + id + '&jml=' + jml,
                success: function(hsl) {
                    
                    $("#message").show();
                     $("#message").html(hsl.message);
                    
                
            }
        });

   }
   
</script>
    
@endsection


                    