

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Order Pakan</span></li>
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
                             Order Pakan
                             </button>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Order</th>
                                                <th>Tgl Order</th>
                                                <th>Tgl Estimasi</th>
                                                <th>Jenis Pakan</th>
                                                <th>Harga</th>
                                                <th>Supplier</th>
                                                <th>Status</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->no_order }}</td>
                                                <td>{{ $d->tgl_order }}</td>
                                                <td>{{ $d->tgl_estimasi }}</td>
                                                <td>{{ $d->jenis_pakan }}</td>
                                                <td>Rp. {{ $d->harga }}</td>
                                                <td>{{ $d->supplier }}</td>
                                                @if($d->status == 1)
                                                <td><button class="btn btn-default btn-sm disabled"><i class="fa fa-check-circle text-success"></i> <br> Diterima <br> <small>{{ $d->tgl_terima }}</small></button></td>
                                                @else 
                                                <td><a href="javascript:void(0);" class="received btn btn-warning btn-rounded" id="e-{{$d->id}}">Terima</a></td>
                                                @endif
                                                <td><a href="javascript:void(0);" class="get" id="e-{{$d->id}}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a href="/admin/order_pakan/delete/{{$d->id}}"data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="statModal" tabindex="-1" role="dialog" aria-labelledby="statModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statModalLabel">Terima Pakan</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                    <form  action="{{route('received_order_pakan')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf                 
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl_terima">
                                <input type="hidden" id="edit_id2" name="id">
                                <label>Nomor Order</label>
                                <input type="text" class="form-control mb-3" id="edit_no_order2" readonly>
                                <label>Supplier</label>
                                <input type="text" class="form-control" id="edit_supplier2" readonly>
                                <hr>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                        <button type="submit" class="btn btn-success">Terima Pakan</button>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Order Pakan</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('create_order_pakan')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                             
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Tanggal Order</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">@</span>
                                                </div>
                                                <input id="basicFlatpickr" name="tgl_order" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Tanggal Order">
                                                @error('tgl_order')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal Estimasi</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">@</span>
                                                </div>
                                                <input id="basicFlatpickr2" name="tgl_estimasi" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Tanggal Estimasi">
                                                @error('tgl_estimasi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-2">
                                            
                                            <div class="form-group mb-3">
                                                <label>Jenis Pakan</label>
                                                <select class="form-control" name="jenis_pakan">
                                                    @foreach($jenis_pakan as $j)
                                                    <option value="{{ $j->id}}">{{ $j->pakan}}</option>
                                                    @endforeach
                                                </select>
                                                @error('jenis_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-5">
                                            <label>Harga Beli</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">Rp.</span>
                                                </div>
                                            <input type="text" name="harga" id="rupiah" class="form-control" required>
                                            @error('harga')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group mb-3">
                                                <label>Supplier</label>
                                                <select class="form-control" name="supplier">
                                                    @foreach($supplier as $s)
                                                    <option value="{{ $s->id}}">{{ $s->nama_supplier}}</option>
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
                <h5 class="modal-title" id="editModalLabel">Edit Registrasi Domba</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('update_order_pakan')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <input type="hidden" id="edit_id" name="id">
                                    <input type="hidden" id="edit_no_order" name="no_order">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Tanggal Order</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">@</span>
                                                </div>
                                                <input type="date" id="edit_tgl_order" name="tgl_order" class="form-control flatpickr flatpickr-input active" placeholder="Tanggal Order">
                                                @error('tgl_order')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal Estimasi</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">@</span>
                                                </div>
                                                <input type="date" id="edit_tgl_estimasi" name="tgl_estimasi" class="form-control flatpickr flatpickr-input active" placeholder="Tanggal Estimasi">
                                                @error('tgl_estimasi')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-2">
                                            
                                            <div class="form-group mb-3">
                                                <label>Jenis Pakan</label>
                                                <select class="form-control" id="edit_jenis_pakan" name="jenis_pakan">
                                                    @foreach($jenis_pakan as $j)
                                                    <option value="{{ $j->id}}" id="edit_jenis_pakan">{{ $j->pakan}}</option>
                                                    @endforeach
                                                </select>
                                                @error('jenis_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-5">
                                            <label>Harga Beli</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">Rp.</span>
                                                </div>
                                            <input type="text" id="rupiah2" name="harga" class="edit_harga form-control" required>
                                            @error('harga')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group mb-3">
                                            <label>Supplier</label>
                                                <select class="form-control" name="supplier" id="edit_supplier">
                                                    @foreach($supplier as $s)
                                                    <option value="{{ $s->id}}" id="edit_supplier">{{ $s->nama_supplier}}</option>
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
        $(".get").click(function(){
            var idnya=$(this).attr('id').split('-');
            var id=idnya[1];
            console.log(id);
            
            $.ajax({
                type:'get',
                method:'get',
                url:'/admin/order_pakan/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                       $("#edit_id").val(id);
                       console.log(id)
                       $("#edit_no_order").val(hsl.no_order);
                       $("#edit_tgl_order").val(hsl.tgl_order);
                       $("#edit_tgl_estimasi").val(hsl.tgl_estimasi);
                       $("#edit_jenis_pakan").val(hsl.jenis_pakan);
                       $(".edit_harga").val(hsl.harga);
                       $("#edit_supplier").val(hsl.supplier);
                       $("#editModal").modal();
                   }
                }
            });
            
        })
    </script>    
    <script >
        $(".received").click(function(){
            var idnya=$(this).attr('id').split('-');
            var id=idnya[1];
            
            $.ajax({
                type:'get',
                method:'get',
                url:'/admin/order_pakan/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                       $("#edit_id2").val(id);
                       $("#edit_no_order2").val(hsl.no_order);
                       $("#edit_supplier2").val(hsl.supplier);
                       $("#statModal").modal();
                   }
                }
            });
            
        })
    </script>    
    <script type="text/javascript">
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