
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
        <div class="row justify-content-center layout-top-spacing">
            <div class="card m-3">
                <div class="card-header">
                <h5 class="card-title text-center">BOOKING DOMBA KE INVESTOR</h5>
                </div>
                <div class="card-body p-2 pt-3">
                    <form  action="{{route('create_investor')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                
                                    <div class="row">
                                         <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label>Investor</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-default" name="nama" id="nama"  >
                                                    <input type="hidden" id="investor_id" name="investor_id"  >
                                                    <div class="input-group-append" >
                                                    <span class="input-group-text" id="find" data-toggle="modal" data-target="#investorModal"><i class="fa fa-lg fa-search text-dark"></i></span>
                                                    </div>
                                                     <button type="button" class="btn btn-primary ml-3" id="btnProses">Proses</button>
  
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

<div class="modal fade" id="investorModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Kandang</h5>
                
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
                                                <th>Kode Bank</th>
                                                <th>No Rekening</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td >{{ $i++ }}</td>
                                                <td id="{{$d->id}}" class="nama" style="cursor:pointer;color:blue">{{ $d->nama}}</td>
                                                <td>{{ $d->alamat }}</td>
                                                <td>{{ $d->kota }}</td>
                                                <td>{{ $d->propinsi }}</td>
                                                <td>{{ $d->hp }}</td>
                                                <td>{{ $d->email }}</td>
                                                <td>{{ $d->kode_bank }}</td>
                                                <td>{{ $d->no_rekening }}</td>
                                               
                                              
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
            $("#investor_id").val(id);
            $("#btnProses").show();
            $("#investorModal").modal('hide');
              

       })
       $("#btnProses").click(function(){
           var id=$("#investor_id").val();
           location.href="/investor/booking/" + id
       })
    })
</script>
    
@endsection
                    