@extends('investor.master-investor')
 <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Profil Investor</span></li>
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
            <div class="col-12">
            @if (session('message'))
            <div class="alert alert-{{ session('alert') }} text-center fade show">
                {{ session('message') }}
            </div>
            @endif
        <form  action="{{route('proses_edit_profil')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                               
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Nama</label>
                                                <input type="text" name="nama" id="edit_nama" class="form-control" value="{{ session('data_investor')->nama }}" required>
                                                @error('nama')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" id="edit_email" class="form-control" value="{{ session('data_investor')->email }}" required>
                                                @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" id="edit_alamat" class="form-control" value="{{ session('data_investor')->alamat }}" required>
                                                @error('alamat')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Propinsi</label>
                                                <select name="propinsi" id="edit_propinsi" class="edit_propinsi form-control">
                                                    <option value="{{session('data_investor')->propinsi}}" selected>{{session('data_investor')->propinsi}}</option>
                                                    @foreach ($province as $prov)
                                                    <option value="{{$prov->province}}" >{{$prov->province}}</option>
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
                                                <select id="edit_kota" name="kota" class="edit_kota form-control" > 
                                                    <option value="{{session('data_investor')->kota}}" selected >{{session('data_investor')->kota}}</option>
                                                    @foreach ($city as $ct)
                                                    <option value="{{$ct->city_name.' '.$ct->type}}" id="edit_kota" >{{$ct->city_name.' '.$ct->type}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kota')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>No.Handphone</label>
                                                <input type="number" name="hp" id="edit_hp" class="form-control" value="{{ session('data_investor')->hp }}" required>
                                                @error('hp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Kode Bank</label>
                                                <select name="kode_bank" id="edit_kode_bank" class="form-control" value="{{ session('data_investor')->kode_bank }}" required>
                                                    @foreach ($bank as $b)
                                                    <option value="{{$b->name}}">{{$b->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kode_bank')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>No Rekening</label>
                                                <input type="text" id="edit_no_rekening"  name="no_rekening" placeholder="No Rekening" class="form-control" value="{{ session('data_investor')->no_rekening }}" required>
                                                @error('no_rekening')
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
    @endsection
    @section('script')
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
    @endsection