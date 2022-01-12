

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Ubah Password</span></li>
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
                <h5 class="card-title text-center">UBAH PASSWORD INVESTOR</h5>
                </div>
                <div class="card-body p-2 pt-3">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    @if (session('message'))
                                    <div class="alert alert-danger fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif

                        <form  action="{{route('ubah_password_investor_admin')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                    <div class="row">
                                    
                                    
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                <label>Username</label>
                                              
                                                <div class="input-group">
                                                    <input type="username" class="form-control input-default" name="username" id="username" value="{{$id}}" >
                                                    <div class="input-group-append" >
                                                    <span class="input-group-text" id="pwd"><i class="fa fa-lg fa-user text-dark"></i></span>
                                                    </div>
                                                    
                                                </div>
                                                @error('old_password')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>Password Baru</label>
                                              
                                                <div class="input-group">
                                                    <input type="password" class="form-control input-default" name="password" id="password" >
                                                    <div class="input-group-append" >
                                                    <span class="input-group-text" id="j_pwd"><i class="fa fa-lg fa-eye text-dark"></i></span>
                                                    </div>
                                                    
                                                </div>
                                                @error('password')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label>Konfirmasi Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control input-default" name="password1" id="password1" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="k_pwd"><i class="fa fa-lg fa-eye text-dark"></i></span>
                                                    </div>
                                               
                                            </div>
                                             @error('password1')
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
@section('script')
<script>

$(document).ready(function(){
    $("#pwd").click(function(){
        var tipe=$("#old_password").attr('type');
        if (tipe=="password"){
            $("#old_password").prop('type','text');

        }else{
            $("#old_password").prop('type','password');
        }
    })
    $("#j_pwd").click(function(){
        var tipe=$("#password").attr('type');
        if (tipe=="password"){
            $("#password").prop('type','text');

        }else{
            $("#password").prop('type','password');
        }
    })
    $("#k_pwd").click(function(){
        var tipe=$("#password1").attr('type');
        if (tipe=="password"){
            $("#password1").prop('type','text');

        }else{
            $("#password1").prop('type','password');
        }
    })
})
</script>
    
@endsection



