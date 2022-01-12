

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Jenis Pakan</span></li>
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
                    <h3 class="text-center p-3">DAFTAR JENIS PAKAN</H3>
                             @if (session('admin_level')<3)
                             <button type="button" class="btn btn-primary mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#addModal">
                             Tambah Jenis Pakan
                             </button>
                             @endif
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Pakan</th>
                                                <th>Jenis Pakan</th>
                                                <th>Satuan Pakan</th>
                                                <th>Harga Pakan</th>
                                                <th>Stok Awal</th>
                                                <th>Stok Masuk</th>
                                                <th>Stok Incoming</th>
                                                <th>Stok Keluar</th>
                                                <th>Stok Akhir</th>
                                                 @if (session('admin_level')<3)
                                                <th class="no-content"></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->kode_pakan }}</td>
                                                <td>{{ $d->nama_pakan }}</td>
                                                <td>{{ $d->satuan_pakan }}</td>
                                                <td>Rp.{{ $d->harga_pakan }}</td>
                                                <td>{{ $d->stok_awal }}</td>
                                                <td>{{ $d->stok_masuk }}</td>
                                                <td><a href="/pakan/incoming/{{ $d->kode_pakan }}">{{ $d->incoming }}</a></td>
                                                <td>{{ $d->stok_keluar }}</td>
                                                <td>{{ $d->stok }}</td>
                                                @if (session('admin_level')<3)
                                                 <td><a href="javascript:void(0);" class="edit" id="e-{{$d->id}}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a href="/admin/pakan/delete/{{$d->id}}"data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Penambahan Jenis Pakan</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('create_pakan')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Jenis Pakan</label>
                                                <input type="text" name="nama_pakan" class="form-control" required>
                                                @error('nama_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Stok Awal Pakan</label>
                                                <input type="text" name="stok_pakan"  class="form-control" value="0" required>
                                                @error('stok_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Satuan Pakan</label>
                                                <select class="form-control" name="satuan_pakan">
                                                    @foreach($satuan as $s)
                                                    <option value="{{ $s->satuan}}">{{ $s->satuan}}</option>
                                                    @endforeach
                                                </select>
                                                @error('satuan_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Harga</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">Rp.</span>
                                                </div>
                                            <input type="text" id="rupiah2" name="harga_pakan" placeholder="0" class="form-control" required>
                                            @error('harga')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                         <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Supplier</label>
                                                <select  name="supplier" class="form-control" required>
                                                    @foreach ($supplier as $item)
                                                        <option value="{{$item->id}}">{{$item->nama_supplier}}</option>
                                                    @endforeach
                                                </select>    
                                                @error('supplier')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>                          
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                        <button type="submit" class="btn btn-primary">Proses</button>
                                    </div>
                                </form>
                </div>
            </div>
   
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Pakan</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('update_pakan')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <input type="hidden" id="edit_id" name="id">
                                    <input type="hidden" id="edit_kode_pakan" name="kode_pakan">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Jenis Pakan</label>
                                                <input type="text" name="nama_pakan" id="edit_nama_pakan" class="form-control" required>
                                                @error('nama_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Stok Awal</label>
                                                <input type="number" name="stok_pakan" id="edit_stok_pakan" placeholder="0" class="form-control" required>
                                                @error('stok_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Satuan Pakan</label>
                                                <select class="form-control" name="satuan_pakan" id="edit_satuan_pakan">
                                                    @foreach($satuan as $s)
                                                    <option value="{{ $s->satuan}}" id="edit_satuan_pakan">{{ $s->satuan}}</option>
                                                    @endforeach
                                                </select>
                                                @error('satuan_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label>Harga</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">Rp.</span>
                                                </div>
                                            <input type="text" id="rupiah" name="harga_pakan" placeholder="0" class="edit_harga_pakan form-control" required>
                                            @error('harga')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Supplier</label>
                                                <select  name="supplier" class="form-control" id="edit_supplier" required>
                                                    @foreach ($supplier as $item)
                                                        <option value="{{$item->id}}">{{$item->nama_supplier}}</option>
                                                    @endforeach
                                                </select>    
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
                url:'/admin/pakan/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                       $("#edit_id").val(id);
                       $("#edit_kode_pakan").val(hsl.kode_pakan);
                       $(".edit_harga_pakan").val(hsl.harga_pakan);
                       $("#edit_nama_pakan").val(hsl.nama_pakan);
                       $("#edit_stok_pakan").val(hsl.stok_awal);
                       $("#edit_satuan_pakan").val(hsl.satuan_pakan);
                       $("#edit_supplier").val(hsl.supplier);
                       $("#editModal").modal();
                   }
                }
            });
            
        })
    </script>    
        <script>
       /* Tanpa Rupiah */
            var tanpa_rupiah = document.getElementById('rupiah');
            tanpa_rupiah.addEventListener('keyup', function(e)
            {
                tanpa_rupiah.value = formatRupiah(this.value);
            });
            
            /* Fungsi */
            function formatRupiah(angka, prefix)
            {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split    = number_string.split(','),
                    sisa     = split[0].length % 3,
                    rupiah     = split[0].substr(0, sisa),
                    ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                    
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
	</script>
    <script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah2');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
		}
	</script>
@stop