

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Edit Profil</span></li>
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
                <h5 class="card-title text-center">EDIT PROFIL</h5>
                </div>
                <div class="card-body p-2 pt-3">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif

                        <form  action="{{route('update_profil')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="row">
                                    
                                    
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="nama" value="{{ $data->nama }}" class="form-control"  value="{{ old('nama') }}" required>
                                                @error('nama')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" value="{{ $data->alamat }}" class="form-control" value="{{ old('alamat') }}" required>
                                                @error('alamat')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Propinsi</label>
                                                <select name="propinsi" id="propinsi" class="basic form-control">
                                                    @foreach ($province as $prov)
                                                    @if ($prov->province_id == $data->propinsi)
                                                    <option value="{{$prov->province}}" selected >{{$prov->province}}</option>
                                                    @else 
                                                    <option value="{{$prov->province}}" >{{$prov->province}}</option>
                                                    @endif
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
                                                <select id="kota" name="kota" class="basic form-control" > 
                                                    @foreach ($city as $ct)
                                                    @if ($ct->city_name.' '.$ct->type == $data->city_name.' '.$ct->type)
                                                    <option value="{{$ct->city_name.' '.$ct->type}}" selected>{{$ct->city_name.' '.$ct->type}}</option>
                                                    @else
                                                    <option value="{{$ct->city_name.' '.$ct->type}}">{{$ct->city_name.' '.$ct->type}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('kota')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" value="{{ $data->email }}" class="form-control" value="{{ old('email') }}" required>
                                                @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Hp</label>
                                                <input type="number" name="hp" value="{{ $data->hp }}" class="form-control" value="{{ old('hp') }}" required>
                                                @error('hp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>    
                                        <div class="col-md-12 mt-4">
                                            <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                        </div>
                                    </div>                          
                                    
                                </form>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop