

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
                                <li class="breadcrumb-item active" aria-current="page"><span>User</span></li>
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
                <h5 class="card-title text-center">DAFTAR USER ADMIN</h5>
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
                             Tambah User
                             </button>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Nama Lengkap</th>
                                                <th>Alamat</th> 
                                                <th>Kota</th>
                                                <th>Propinsi</th>
                                                <th>HP</th>
                                                <th>Email</th>
                                                <th>Hak Akses</th>
                                            
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  
                                               $akses=array('','System Administrator','Farm Administrator','Farm Manager');
         
                                            @endphp 
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->username }}</td>
                                                <td>{{ $d->nama }}</td>
                                                <td>{{ $d->alamat }}</td>
                                                <td>{{ $d->kota }}</td>
                                                <td>{{ $d->propinsi }}</td>
                                                <td>{{ $d->hp }}</td>
                                                <td>{{ $d->email }}</td>
                                                 <td>{{ $akses[$d->level] }}</td>
                                               
                                                <td><a href="javascript:void(0);" class="edit" id="e-{{$d->id}}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a href="/admin/user/delete/{{$d->id}}"data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
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
                <h5 class="modal-title" id="addModalLabel">Tambah User</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('create_user')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                              
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Username</label>
                                                <input type="text" name="username" placeholder="Username" class="form-control"  value="{{ old('username') }}" required> 
                                                @error('username')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Password</label>
                                                <input type="password" name="password" placeholder="password" class="form-control"  value="{{ old('password') }}" required> 
                                                @error('password')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="nama" placeholder="Nama lengkap" class="form-control"  value="{{ old('nama') }}" required>
                                                @error('username')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" placeholder="Email"class="form-control" value="{{ old('email') }}" required>
                                                @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" placeholder="Alamat" class="form-control" value="{{ old('alamat') }}" required>
                                                @error('alamat')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Propinsi</label>
                                                <select name="propinsi" id="propinsi" class="form-control" value="{{ old('propinsi') }}" required>
                                                    @foreach ($province as $prov)
                                                    <option value="{{$prov->province}}">{{$prov->province}}</option>
                                                    @endforeach
                                                </select>
                                                @error('propinsi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                                    <label>Hp</label>
                                                    <input type="number" name="hp" id="edit_hp" class="form-control" value="{{ old('hp') }}" required>
                                                    @error('hp')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group mb-3">
                                                    <label>Hak Akses</label>
                                                    <select name="level" class="form-control" required>
                                                        <option value="3" selected>Farm Manager</option>
                                                        <option value="2">Farm Administrator</option>
                                                        <option value="1">System Administrator</option>
                                                        <option value="9" selected>Investor</option>
                                                        
                                                    </select>
                                                    @error('level')
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
                <h5 class="modal-title" id="editModalLabel">Edit user</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('update_user')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                              
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="row">
                                   
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="nama" id="edit_nama"  class="form-control"  value="{{ old('nama') }}" required>
                                                @error('username')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                      <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" id="edit_email" class="form-control" value="{{ old('email') }}" required>
                                                @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" id="edit_alamat" class="form-control" value="{{ old('alamat') }}" required>
                                                @error('alamat')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Propinsi</label>
                                                <select name="propinsi" id="edit_propinsi" class="edit_propinsi form-control">
                                                    @foreach ($province as $prov)
                                                    <option value="{{$prov->province}}" >{{$prov->province}}</option>
                                                    @endforeach
                                                </select>
                                                @error('propinsi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Kota</label>
                                                <select id="edit_kota" name="kota" class="edit_kota form-control" > 
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
                                                <label>Hp</label>
                                                <input type="number" name="hp" id="edit_hp" class="edit_hp form-control" value="{{ old('hp') }}" required>
                                                @error('hp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group mb-3">
                                                    <label>Hak Akses</label>
                                                    <select name="level" id="edit_level" class="form-control" required>
                                                        <option value="3" selected>Farm Manager</option>
                                                        <option value="2">Farm Administrator</option>
                                                        <option value="1">System Administrator</option>
                                                        <option value="9" selected>Investor</option>
                                                           
                                                    </select>
                                                    @error('level')
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
            var akses=['','System Administrator','Farm Administrator','Farm Manager'];
            $.ajax({
                type:'get',
                method:'get',
                url:'/admin/user/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                       $("#edit_id").val(id);
                       $("#edit_nama").val(hsl.nama);
                       $("#edit_username").val(hsl.username);
                       $("#edit_alamat").val(hsl.alamat);
                       $("#edit_propinsi").append('<option value="' + hsl.propinsi +  '"" selected>' + hsl.propinsi+ '</option>');
                       $("#edit_kota").append('<option value="' + hsl.kota  + '" selected>' + hsl.kota + '</option>');
                       $("#edit_email").val(hsl.email);
                       $("#edit_level").append('<option value="' + hsl.level  + '" selected>' + akses[hsl.level] + '</option>');
                       $(".edit_hp").val(hsl.hp);
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
            
            $("#edit_propinsi").change(function() {
            var propinsi = $("#edit_propinsi").val();
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
                        $("#edit_kota").children().remove().end();
                        $.each(data, function(i, item) {
                            $("#edit_kota").append('<option value="' + item.city_name + ' ' + item.type + '">' + item.city_name + ' ' + item.type + '</option>');
                        })
                        kecamatan();
                        $("#edit_kota").focus();

                    }
                }
            });
            })
            
        })
    </script>    
@stop