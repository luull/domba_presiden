

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Supplier</span></li>
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
                <h5 class="card-title text-center">DAFTAR SUPPLIER KESELURUHAN</h5>
                </div>
                <div class="card-body p-2 pt-3">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                <div class="widget-content widget-content-area br-6">
                            <button type="button" class="btn btn-primary mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#addModal">
                             Tambah Supplier
                             </button>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Supplier</th>
                                                <th>Jenis Supplier</th>
                                                <th>Alamat</th> 
                                                <th>Kota</th>
                                                <th>Propinsi</th>
                                                <th>Telp</th>
                                                <th>HP</th>
                                                <th>Email</th>
                                                <th>Kontak</th>
                                                <th class="no-content"></th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->nama_supplier }}</td>
                                                <td>{{ $d->jenis_supplier }}</td>
                                                <td>{{ $d->alamat }}</td>
                                                <td>{{ $d->kota }}</td>
                                                <td>{{ $d->propinsi }}</td>
                                                <td>{{ $d->telp }}</td>
                                                <td>{{ $d->hp }}</td>
                                                <td>{{ $d->email }}</td>
                                                <td>{{ $d->kontak }}</td>
                                                <td><a href="javascript:void(0);" class="edit" id="e-{{$d->id}}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a href="/admin/supplier/delete/{{$d->id}}"data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                            
                                              
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Supplier</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('create_supplier')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Nama Supplier</label>
                                                <input type="text" name="nama_supplier" placeholder="Nama supplier" class="form-control" value="{{ old('nama_supplier') }}" required>
                                                @error('nama_supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Jenis Supplier</label>
                                                <select class="form-control" name="jenis_supplier">
                                                    <option value="Domba">Domba</option>
                                                    <option value="Pakan">Pakan</option>
                                                </select>
                                                @error('jenis_supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" placeholder="Email supplier" class="form-control" value="{{ old('email') }}" required>
                                                @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Propinsi</label>
                                                <select name="propinsi" id="propinsi" class="form-control" name="propinsi" value="{{ old('propinsi') }}" required>
                                                    @foreach ($province as $prov)
                                                    <option value="{{$prov->province}}">{{$prov->province}}</option>
                                                    @endforeach
                                                </select>
                                                @error('propinsi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Kota</label>
                                                <select id="kota" name="kota" class="form-control" value="{{ old('kota') }}" required>
                                                    
                                                </select>
                                                @error('kota')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Telp</label>
                                                <input type="number" name="telp" placeholder="Telp supplier" class="form-control" value="{{ old('telp') }}" required>
                                                @error('telp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>No.Handphone</label>
                                                <input type="number" name="hp" placeholder="No Handphone supplier" class="form-control" value="{{ old('hp') }}" required>
                                                @error('hp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Kontak</label>
                                                <input type="text" name="kontak" placeholder="Kontak supplier" class="form-control" value="{{ old('kontak') }}" required>
                                                @error('kontak')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" placeholder="Alamat supplier" class="form-control" value="{{ old('alamat') }}" required>
                                                @error('alamat')
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Supplier</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('update_supplier')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                               
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Nama Supplier</label>
                                                <input type="text" name="nama_supplier" id="edit_nama_supplier" class="form-control" value="{{ old('nama_supplier') }}" required>
                                                @error('nama_supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Jenis Supplier</label>
                                                <select class="form-control" id="edit_jenis_supplier" name="jenis_supplier">
                                                    <option value="Domba">Domba</option>
                                                    <option value="Pakan">Pakan</option>
                                                </select>
                                                @error('jenis_supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" id="edit_email" class="form-control" value="{{ old('email') }}" required>
                                                @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Propinsi</label>
                                                <select name="propinsi" id="propinsi" class="edit_propinsi form-control" name="propinsi">
                                                    @foreach ($province as $prov)
                                                    <option value="{{$prov->province}}" id="edit_propinsi"  >{{$prov->province}}</option>
                                                    @endforeach
                                                </select>
                                                @error('propinsi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Kota</label>
                                                <select id="kota" name="kota" class="edit_kota form-control" > 
                                                    @foreach ($city as $ct)
                                                    <option value="{{$ct->city_name.' '.$ct->type}}" id="edit_kota" >{{$ct->city_name.' '.$ct->type}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kota')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Telp</label>
                                                <input type="number" name="telp" id="edit_telp" class="form-control" value="{{ old('telp') }}" required>
                                                @error('telp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>No.Handphone</label>
                                                <input type="number" name="hp" id="edit_hp" class="form-control" value="{{ old('hp') }}" required>
                                                @error('hp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Kontak</label>
                                                <input type="text" name="kontak" id="edit_kontak" class="form-control" value="{{ old('kontak') }}" required>
                                                @error('kontak')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" id="edit_alamat" class="form-control" value="{{ old('alamat') }}" required>
                                                @error('alamat')
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

@section('script')  
    <script >
        $(".edit").click(function(){
            var idnya=$(this).attr('id').split('-');
            var id=idnya[1];
            console.log('test');
            
            $.ajax({
                type:'get',
                method:'get',
                url:'/admin/supplier/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                       $("#edit_id").val(id);
                       $("#edit_nama_supplier").val(hsl.nama_supplier);
                       $("#edit_jenis_supplier").val(hsl.jenis_supplier);
                       $("#edit_telp").val(hsl.telp);
                       $("#edit_email").val(hsl.email);
                       $(".edit_kota").val(hsl.kota);
                       $(".edit_propinsi").val(hsl.propinsi);
                       $("#edit_kontak").val(hsl.kontak);
                       $("#edit_hp").val(hsl.hp);
                       $("#edit_alamat").val(hsl.alamat);
                       $("#editModal").modal();
                   }
                }
            });
            
        })
    </script>    
    <script>
        $(document).ready(function() {
            $("#propinsi").change(function() {
            var propinsi = $("#propinsi").val();
            console.log(propinsi);
            $.ajax({
                type: 'get',
                method: 'get',
                url: '/city/find/' + propinsi,
                data: '_token = <?php echo csrf_token() ?>',
                success: function(hsl) {
                    if (hsl.code == 404) {
                        alert(hsl.error);

                    } else {
                        var data = [];
                        data = hsl.result;
                        $("#kota").children().remove().end();
                        $.each(data, function(i, item) {
                            $("#kota").append('<option value="' + item.city_name + ' ' + item.type + '">' + item.city_name + ' ' + item.type + '</option>');
                        })
                        kecamatan();
                        $("#kota").focus();

                    }
                }
            });
            })
            $("#kota").change(function() {
                kecamatan();
            })
            
        })
    </script>    
@stop