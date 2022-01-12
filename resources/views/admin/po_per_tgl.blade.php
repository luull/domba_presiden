
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Customer</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Daftar Penjualan Domba</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
 @section('content')
    <div class="layout-px-spacing"> 
        <div class="row layout-top-spacing justify-content-center">
            <div class="card m-3">
                <div class="card-header">
                <h5 class="card-title text-center">DAFTAR PEMBELIAN PAKAN KE SUPPLIER</h5>
                </div>
                <div class="card-body p-2 pt-3">
                    <form  action="{{route('po_per_tanggal')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                
                                    <div class="row ">
                                        <div class="col-12">
                                        <label>Supplier</label>
                                                <div class="input-group" >
                                                    <input type="text" class="form-control input-default" name="nama" id="nama"  >
                                                    <input type="hidden" id="supplier_id" name="supplier_id"  >
                                                    <div class="input-group-append" >
                                                    <span class="input-group-text" id="find" data-toggle="modal" data-target="#customerModal"><i class="fa fa-lg fa-search text-dark"></i></span>
                                                    </div>
                                            
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                         <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Tanggal Pembelian</label>
                                            <div class="input-group mb-4">
                                               
                                                <input id="rangeCalendarFlatpickr" name="tanggal"  class="form-control flatpickr flatpickr-input active" type="text" >
                                               <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i> </span>
                                                </div>
                                            </div>
                                            </div>
                                       

                                            </div>
                                        </div>
                                    <div class="row justify-content-center">
                                                <button class="btn btn-info ml-3">Proses</button>
                                        
                                    <div>
                                    
                                </form>
                </div> 
            </div
        </div>
    </div>
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Daftar Supplier</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                     <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th> 
                                                <th>Kota</th>
                                                <th>Propinsi</th>
                                                <th>HP</th>
                                                <th>Email</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td >{{ $i++ }}</td>
                                                <td id="{{$d->id}}" class="nama" style="cursor:pointer;color:blue">{{ $d->nama_supplier}}</td>
                                                <td>{{ $d->alamat }}</td>
                                                <td>{{ $d->kota }}</td>
                                                <td>{{ $d->propinsi }}</td>
                                                <td>{{ $d->hp }}</td>
                                                <td>{{ $d->email }}</td>
                                               
                                              
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
    var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
        dateFormat: "d-m-Y",
    mode: "range"
});

$(".nama").click(function(){
            var id=$(this).attr('id');
            var nama=$("#" + id).html();
            $("#nama").val(nama);
            $("#supplier_id").val(id);
            $("#btnProses").show();
            $("#customerModal").modal('hide');
              

       })
</script>
    
@endsection

