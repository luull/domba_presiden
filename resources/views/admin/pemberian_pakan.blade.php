

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Pemberian Pakan Domba</span></li>
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
                            <H4 class="text-center p-3">DAFTAR PEMBERIAN PAKAN</h4>
               
                            @if (session('admin_level')<3)
                           <button type="button" class="btn btn-primary mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#addModal">
                             Pemberian Pakan Domba
                             </button>
                             @endif
                          
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kandang</th>
                                                <th>Tanggal</th>
                                                <th>Jadwal</th>
                                                <th>Total Berat</th>
                                                <th>Total Pakan</th>
                                                <th>Detil Pakan</th>
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
                                                <td>{{ $d->kandang }}</td>
                                                <td>{{ convert_tgl1($d->tanggal) }}</td>
                                                <td>{{ $d->jadwal }}</td>
                                                <td>{{ number_format($d->total_berat_domba,2) }}</td>
                                                <td>{{ number_format($d->total_pakan,2) }} {{$d->satuan}}</td>
                                                <td>{!! $d->detil_pakan !!}</td>
                                                 @if (session('admin_level')<3)
                                                <td>
                                                
                           
                                                <a href="/domba/pemberian-pakan/delete/{{$d->id}}"data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
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
                <h5 class="modal-title" id="addModalLabel">Pemberian Pakan</h5>
                
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{route('proses_pemberian_pakan')}}" method="post">
                        @csrf
                                <div class="row mb-2">
                                  <div class="col-md-4">
                                            <label>Kandang Domba</label>
                                                <select class="form-control "  id="kandang_input" name="kandang">
                                                    @foreach($kandang as $k)
                                                    <option value="{{ $k->kandang}}">{{ $k->kandang}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kandang')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                    <div class="col-md-4">
                                            <label>Tanggal</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input id="basicFlatpickr" name="tanggal" class="form-control flatpickr flatpickr-input active" type="text" >
                                            </div>
                                            @error('tgl_timbang')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Total Berat Terakhir</label>
                                                <input type="text" class="form-control" name="total_berat_domba" id="total_berat_domba" >
                                                @error('total_berat_domba')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        
                                       
                                        <div class="col-md-4">
                                            <label>Jadwal</label>
                                                <select class="form-control" name="jadwal">
                                                    <option value="Pagi">Pagi</option>
                                                    <option value="Siang">Siang</option>
                                                    <option value="Sore">Sore</option>
                                                
                                                </select>
                                                @error('kandang')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        
                                       
                                        <div class="col-md-4">
                                            <label>Total Pakan</label>
                                                <input type="text" class="form-control" name="total_pakan">
                                                @error('total_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                            <label>Satuan</label>
                                                 <select class="form-control" name="satuan" id="satuan">
                                                    @foreach($satuan as $s)
                                                    <option value="{{ $s->satuan}}">{{ $s->satuan}}</option>
                                                    @endforeach
                                                </select>
                                                @error('satuan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        
                                    </div> 
                                   
                                    <div class="row mt-2 mb-2">
                                    <div class="col-md-6">
                                            <label>Jenis Pakan</label>
                                                 <select class="form-control" name="jenis_pakan" id="jenis_pakan">
                                                    @foreach($pakan as $j)
                                                    <option value="{{$j->id}}">{{$j->kode_pakan}} : {{ $j->nama_pakan}} </option>
                                                    @endforeach
                                                </select>
                                                @error('jenis_pakan')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        <div class="col-md-5">
                                            <label>Jumlah</label>
                                                 
                                            <div class="input-group mb-6">
                                                <input type="number" name="jml" id="jml" placeholder="00" class="form-control" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" >{{$j->satuan_pakan}}</span>
                                                </div>
                                                      <a href="#"  class=" btn btn-primary btn-sm" onclick="pilih()"">Tambah</a>
                                      
                                                @error('jml')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>   
                                    <div class="row mb-2">
                                        
                                             
                                       
                                        <div class="mt-3 col-md-12">
                                            <label>Daftar Detil Pakan</label>
                                        
                                            <div id="tabel_detil_pakan">   
                                            </div>
                                        </tbody>
                                    </table>
                                        
                                           
                                        
                                    </div>       
                                </div>
                            </div>                     
                                    <div class="modal-footer pt-2">
                                        <button type="submit" class="btn btn-primary">Proses</button>
                                     <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                                       
                                    </div>
                    </div>
                </form>
            </div>
   
        </div>
    </div>
</div>

@stop

@section('script')
    <script>
        $(document).ready(function(){
            total_berat_per_kandang()
        })
       var f1 = flatpickr(document.getElementById('basicFlatpickr'), {
             dateFormat: "d-m-Y",
        });
        $("#btnTambah").click(function(){
            var id=$("#jenis_pakan").val();
            var jml=$("#jml").val();
        })
        $("#kandang_input").change(function(){
           total_berat_per_kandang()
        })
        function total_berat_per_kandang(){
             var kandang=$("#kandang_input").val();
            $.ajax({
                type:'get',
                method:'get',
                url:'/domba/berat-per-kandang' ,
                data:'_token = <?php echo csrf_token() ?>'  + '&kandang=' + kandang  ,
                success:function(hsl) {
                   $("#total_berat_domba").val(hsl)
                  
                } 
            })
        }
        function pilih(){
        var id=$("#jenis_pakan").val();
                    var jml=$("#jml").val();
                    var tgl=$("#basicFlatpickr").val()
                    $.ajax({
                        type:'get',
                        method:'get',
                        url:'/pakan/detil_pakan/add' ,
                        data:'_token = <?php echo csrf_token() ?>'  + '&id=' + id + '&jml=' + jml +'&tanggal=' + tgl ,
                        success:function(hasil) {
                              if (hasil.status){

                                html='<table id="zero-config" class="table dt-table-hover" style="width:100%">';
                                html=html + '<thead> <tr><th>No</th><th>Kode Pakan</th><th>Jenis Pakan</th><th>Satuan Pakan</th><th>Jumlah Pakan</th></tr>';
                                html=html + '</thead><tbody>';
                                hsl=hasil.data;
                                for (i=0; i<hsl.length;i++){
                                    no =i+1;
                                    html=html+ '<tr><td>' + no + '</td><td>' + hsl[i].kode_pakan + '</td>';
                                    html=html+ '<td>' + hsl[i].jenis_pakan + '</td>';
                                    html=html+ '<td>' + hsl[i].satuan + '</td>';
                                    html=html+ '<td>' + hsl[i].jml + '</td></tr>';
                                    
                                }
                                html=html + '</tbody></table>';
                            $("#tabel_detil_pakan").html(html)
                            }else{
                                alert(hasil.message)
                            }
                        
                        } 
                    })
        }
        
    </script>   
 
@stop