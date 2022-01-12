
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Penerimaan Pakan</span></li>
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
                <h5 class="card-title text-center">PENERIMAAN PAKAN DARI SUPPLIER </h5>
                </div>
                <div class="card-body p-2 pt-3">
                     @if (session('message'))
                    <div class="alert alert-{{ session('alert') }} fade show">
                        {{ session('message') }}
                    </div>
                    @endif
                         <form action ="/pakan/do" method="post">       
                           @csrf
                                    <div class="row ">
                                         <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>No Order</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-default" name="no_po" id="no_po"  >
                                                    <div class="input-group-append" >
                                                    <span class="input-group-text" id="find" data-toggle="modal" data-target="#customerModal"><i class="fa fa-lg fa-search text-dark"></i></span>
                                                    </div>
                                                     <button type="submit" class="btn btn-primary ml-3" >Proses</button>
  
                                                </div>
                                                @error('username')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                       

                                            </div>
                                        </div>
                            </form>            
                            
                </div> 
            </div
        </div>
    </div>

<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Data Pembelian</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                     <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>No Transaksi</th>
                                                <th>Tgl Transaksi</th> 
                                                <th>Tgl Estimasi</th> 
                                                <th>Jml Item</th>
                                                <th>Total</th> 
                                                 
                                                <th>Supplier</th>
                                                <th>Cara Bayar</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td >{{ $i++ }}</td>
                                                <td id="{{$d->no_po}}" class="nama" style="cursor:pointer;color:blue">{{ $d->no_po}}</td>
                                                <td>{{ convert_tgl1($d->tgl_po) }}</td>
                                                <td>{{ convert_tgl1($d->tgl_estimasi) }}</td>
                                                <td>{{ $d->jml }}</td>
                                                <td>{{ $d->total }}</td>
                                                <td>{{ $d->supplier->nama_supplier }}</td>
                                                <td>{{ $d->cara_bayar }}</td>
                                                
                                              
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

            $("#btnProses").hide();
       $(".nama").click(function(){
            var id=$(this).attr('id');
            var nama=$("#" + id).html();
            $("#nama").val(nama);
            $("#no_po").val(id);
            $("#btnProses").show();
            $("#customerModal").modal('hide');
              

       })
       $("#btnProses").click(function(){
           var id=$("#no_po").val();
           location.href="/pakan/do/" + id
       })
    })
</script>
    
@endsection
                    