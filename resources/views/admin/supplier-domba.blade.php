

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Supplier Domba</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
 @section('content')
    <div class="layout-px-spacing"> 
        <div class="row layout-top-spacing">
            <div class="card m-3">
                <div class="card-header">
                <h5 class="card-title text-center">DAFTAR SUPPLIER DOMBA</h5>
                </div>
                <div class="card-body p-2 pt-3">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                <div class="widget-content widget-content-area br-6">
                            
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Supplier</th>
                                                <th>Alamat</th> 
                                                <th>Kota</th>
                                                <th>Propinsi</th>
                                                <th>Telp</th>
                                                <th>HP</th>
                                                <th>Email</th>
                                                <th>Penanggun jawab</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->nama_supplier }}</td>
                                                <td>{{ $d->alamat }}</td>
                                                <td>{{ $d->kota }}</td>
                                                <td>{{ $d->propinsi }}</td>
                                                <td>{{ $d->telp }}</td>
                                                <td>{{ $d->hp }}</td>
                                                  <td>{{ $d->email }}</td>
                                                <td>{{ $d->kontak }}</td>
                                              
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Supplier</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('create_supplier')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Nama Supplier</label>
                                                <input type="text" name="nama_supplier" placeholder="..." class="form-control" required>
                                                @error('nama_supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>                          
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                </div>
            </div>
   
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Supplier</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('update_supplier')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Nama Supplier</label>
                                                <input type="text" id="edit_supplier" name="nama_supplier" placeholder="..." class="form-control" required>
                                                @error('nama_supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>         
                              
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                </div>
            </div>
   
        </div>
    </div>
</div>
@stop
