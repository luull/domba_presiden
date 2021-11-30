

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Registrasi Domba</span></li>
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
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                <div class="widget-content widget-content-area br-6">
                            <button type="button" class="btn btn-primary mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#addModal">
                             Registrasi Domba
                             </button>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Regis</th>
                                                <th>Berat Awal</th>
                                                <th>Jenis</th>
                                                <th>Kandang</th>
                                                <th>Kamar</th>
                                                <th>Harga Beli</th>
                                                <th>Supplier</th>
                                                <th>Tgl Masuk</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->no_regis }}</td>
                                                <td>{{ $d->berat_awal }} Kg</td>
                                                <td>{{ $d->jenis }}</td>
                                                <td>{{ $d->kandang }}</td>
                                                <td>{{ $d->kamar }}</td>
                                                <td>{{ $d->harga_beli }}</td>
                                                <td>{{ $d->supplier }}</td>
                                                <td>{{ $d->tgl_masuk }}</td>
                                                <td><a href="javascript:void(0);" class="edit" id="e-{{$d->id}}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a href="/admin/regis/delete/{{$d->id}}"data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Registrasi Domba</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('create_regis')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <div class="form-group mb-3">
                                        <label>No Registrasi</label>
                                        <input type="text" name="no_regis" placeholder="No Registrasi" class="form-control" required>
                                        @error('no_regis')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Tanggal Masuk</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">@</span>
                                                </div>
                                                <input id="basicFlatpickr" name="tgl_masuk" value="2020-09-04" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Tanggal Masuk">
                                                @error('tgl_masuk')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Berat Awal</label>
                                            <div class="input-group mb-4">
                                            <input type="number" name="berat_awal" placeholder="0.0" class="form-control" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">KG</span>
                                                </div>
                                                @error('berat_awal')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                        
                                            <div class="form-group mb-3">
                                                <label>Jenis Domba</label>
                                                <select class="form-control" name="jenis">
                                                    @foreach($jenis as $j)
                                                    <option value="{{ $j->jenis}}">{{ $j->jenis}}</option>
                                                    @endforeach
                                                </select>
                                                @error('jenis')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                        
                                            <div class="form-group mb-3">
                                                <label>Kandang Domba</label>
                                                <select class="form-control" name="kandang">
                                                    @foreach($kandang as $k)
                                                    <option value="{{ $k->kandang}}">{{ $k->kandang}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kandang')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label>Kamar</label>
                                                <input type="number" name="kamar" placeholder="00" class="form-control" required>
                                                @error('kamar')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Harga Beli per-KG</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">Rp.</span>
                                                </div>
                                            <input type="number" name="harga_beli" placeholder="0" class="form-control" required>
                                            @error('harga_beli')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Nama Supplier</label>
                                                <input type="text" name="supplier" class="form-control" required>
                                                @error('supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                              
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                        <button type="submit" class="btn btn-primary">Registrasi</button>
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
                <h5 class="modal-title" id="editModalLabel">Edit Registrasi Domba</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('update_regis')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="form-group mb-3">
                                        <label>No Registrasi</label>
                                        <input type="text" name="no_regis" id="edit_no_regis" placeholder="No Registrasi" class="form-control" required>
                                        @error('no_regis')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Tanggal Masuk</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">@</span>
                                                </div>
                                                <input type="date" id="edit_tgl_masuk" name="tgl_masuk" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Tanggal Masuk">
                                            </div>
                                            @error('tgl_masuk')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Berat Awal</label>
                                            <div class="input-group mb-4">
                                            <input type="number" name="berat_awal" id="edit_berat_awal" placeholder="0.0" class="form-control" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">KG</span>
                                                </div>
                                            </div>
                                            @error('berat_awal')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                        
                                            <div class="form-group mb-3">
                                                <label>Jenis Domba</label>
                                                <select class="form-control" id="edit_jenis" name="jenis">
                                                    @foreach($jenis as $j)
                                                    <option value="{{ $j->jenis}}" id="edit_jenis">{{ $j->jenis}}</option>
                                                    @endforeach
                                                </select>
                                                @error('jenis')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                        
                                            <div class="form-group mb-3">
                                                <label>Kandang Domba</label>
                                                <select class="form-control" id="edit_kandang" name="kandang">
                                                    @foreach($kandang as $k)
                                                    <option value="{{ $k->kandang}}" id="edit_kandang">{{ $k->kandang}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kandang')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label>Kamar</label>
                                                <input type="number" name="kamar" id="edit_kamar" placeholder="00" class="form-control" required>
                                                @error('kamar')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Harga Beli per-KG</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">Rp.</span>
                                                </div>
                                            <input type="number" name="harga_beli" id="edit_harga_beli" placeholder="0" class="form-control" required>
                                            @error('harga_beli')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Nama Supplier</label>
                                                <input type="text" name="supplier" id="edit_supplier" class="form-control" required>
                                                @error('supplier')
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
                url:'/admin/regis/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                       $("#edit_id").val(id);
                       $("#edit_no_regis").val(hsl.no_regis);
                       $("#edit_tgl_masuk").val(hsl.tgl_masuk);
                       $("#edit_berat_awal").val(hsl.berat_awal);
                       $("#edit_jenis").val(hsl.jenis);
                       $("#edit_kandang").val(hsl.kandang);
                       $("#edit_kamar").val(hsl.kamar);
                       $("#edit_harga_beli").val(hsl.harga_beli);
                       $("#edit_supplier").val(hsl.supplier);
                     console.log(hsl.tgl_masuk);
                       $("#editModal").modal();
                   }
                }
            });
            
        })
    </script>    
@stop