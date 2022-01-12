

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Penimbangan Domba</span></li>
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
                            <H4 class="text-center p-3">DAFTAR PENIMBANGAN DOMBA</h4>
               
                            @if (session('admin_level')<3)
                             <button type="button" class="btn btn-primary mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#addModal">
                             Penimbangan Domba
                             </button>
                             @endif
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Regis</th>
                                                <th>Berat Timbang</th>
                                                <th>Vitamin</th>
                                                <th>Tanggal Timbang</th>
                                                 @if (session('admin_level')<3)
                                                <th class="no-content"></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->no_regis }}</td>
                                                <td>{{ $d->berat_timbang }} Kg</td>
                                                <td>{{ $d->vitamin }}</td>
                                                <td>{{ convert_tgl1($d->tgl_timbang )}}</td>
                                             @if (session('admin_level')<3)
                                                 <td>
                                                
                                                <a href="#" class="edit" id="e-{{$d->id}}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a href="/admin/penimbangan/delete/{{$d->id}}"data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                            @endif
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Penimbangan Domba</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form  action="{{route('create_penimbangan')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                 
                                    <div class="form-group mb-3">
                                        <label>No Registrasi</label>
                                        <select class="form-control basic no-regis" id="no_regis" name="no_regis" >
                                            @foreach($data_domba as $d)
                                            <option value="{{$d->no_regis}}">{{$d->no_regis}}</option>
                                            @endforeach
                                        </select>
                                        @error('no_regis')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        <!-- <input type="text" name="no_regis" placeholder="No Registrasi" class="form-control" required> -->
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                      <div class="col-md-12" id="data_terakhir">
                                      </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Tanggal timbang</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input id="basicFlatpickr" name="tgl_timbang" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Tanggal timbang">
                                            </div>
                                            @error('tgl_timbang')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Berat timbang</label>
                                            <div class="input-group mb-4">
                                            <input type="text" name="berat_timbang" placeholder="0.0" class="form-control" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">KG</span>
                                                </div>
                                            </div>
                                            @error('berat_timbang')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> 
                                    <label>Penambahan Vitamin atau Suplemen</label>
                                    <div class="form-group">
   

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="YA" checked name="vitamin" value="YA" class="custom-control-input">
                                            <label class="custom-control-label" for="YA">Ya</label>
                                            </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio"  id="TIDAK" name="vitamin" value="TIDAK" class="custom-control-input">
                                            <label class="custom-control-label" for="TIDAK">Tidak</label>
                                        </div>
                                        @error('vitamin')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>                             
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title" id="editModalLabel">Edit Penimbangan Domba</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                <form action="{{route('update_penimbangan')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                 
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="form-group mb-3">
                                        <label>No Registrasi</label>
                                        <input type="text" name="no_regis" id="edit_no_regis" placeholder="No Registrasi" class="form-control no-regis" required>
                                        @error('no_regis')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                              
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Tanggal timbang</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" name="tgl_timbang" id="edit_tgl_timbang" class="form-control flatpickr flatpickr-input active" placeholder="Tanggal timbang">
                                            </div>
                                            @error('tgl_timbang')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Berat timbang</label>
                                            <div class="input-group mb-4">
                                            <input type="text" id="edit_berat_timbang" name="berat_timbang" placeholder="0.0" class="form-control" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">KG</span>
                                                </div>
                                            </div>
                                            @error('berat_timbang')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> 
                                    <label>Penambahan Vitamin atau Suplemen</label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="YA" name="vitamin" value="YA" class="custom-control-input">
                                            <label class="custom-control-label" for="YA">Ya</label>
                                            </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="TIDAK" name="vitamin" value="TIDAK" class="custom-control-input">
                                            <label class="custom-control-label" for="TIDAK">Tidak</label>
                                        </div>
                                        @error('vitamin')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
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
    <script>
         var no_regis=$("#no_regis").val();
           
            timbangan_terakhir(no_regis);
         var f2 = flatpickr(document.getElementById('edit_tgl_timbang'), {
             dateFormat: "d-m-Y",
        });
       var f1 = flatpickr(document.getElementById('basicFlatpickr'), {
             dateFormat: "d-m-Y",
        });
       
        $(".edit").click(function(){
            var idnya=$(this).attr('id').split('-');
            var id=idnya[1];
            $.ajax({
                type:'get',
                method:'get',
                url:'/admin/penimbangan/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                        var a_tgl_timbang=hsl.tgl_timbang.split("-");
                       var tgl_timbang=a_tgl_timbang[2] + "-" + a_tgl_timbang[1] + "-" + a_tgl_timbang[0];
                     
                       $("#edit_id").val(id);
                       $("#edit_no_regis").val(hsl.no_regis);
                       $("#edit_tgl_timbang").val(tgl_timbang);
                       $("#edit_berat_timbang").val(hsl.berat_timbang);
                       $(".edit_vitamin").val(hsl.vitamin);
                       $("#" + hsl.vitamin ).attr('checked','checked');
                       $("#editModal").modal();
                   }
                }
            });
            
        })
        $(".basic").select2({
            tags: true
        });
         $(".no-regis").change(function(){
             var no_regis=$(this).val();
           
            timbangan_terakhir(no_regis);
        })
        function covert_tgl(tgl){
            var a_tgl=tgl.split("-");
            return a_tgl[2] + "-" + a_tgl[1] + "-" + a_tgl[0];
        }
        function timbangan_terakhir(no_regis){
            $.ajax({
                type:'get',
                method:'get',
                url:'/domba/timbangan-terakhir/' + no_regis ,
                data:'_token = <?php echo csrf_token() ?>'  + '&no_regis=' + no_regis  ,
                success:function(hsl) {
                    data='Penimbagan Terakhir<br><table class="table table-danger"> <tr><td>Tgl Penimbangan</td><td>: ' + covert_tgl(hsl.tgl_timbang) + '</td>';
                    data+='<td>Berat </td><td>: '+ hsl.berat_timbang +'</td><td>Vitamin </td><td>: ' + hsl.vitamin +'</td></tr></table>'
                        $("#data_terakhir").html(data);
                  
                } 
            })
        }
    </script>   
 
@stop