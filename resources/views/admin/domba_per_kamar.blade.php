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
        <div class="row layout-top-spacing justify-content-center">
            <div class="card m-3">
                <div class="card-header">
                <h5 class="card-title text-center">DAFTAR DOMBA PER KAMAR </h5>
                </div>
                <div class="card-body p-2 pt-3">
                    <form  action="{{route('domba_per_kamar')}}" method="Post" enctype="multipart/form-data">    
                                    @csrf
                                
                                    <div class="row ">
                                         <div class="col-12">
                                             <div class="form-group mb-3">
                                            
                                            <label>Jenis Kandang</label>
                                                <select name="kandang"  class="form-control">
                                                @foreach ($kandang as $item)
                                                    <option value="{{$item->kandang}}">{{$item->kandang}}</option>
                                    
                                                @endforeach
                                                </select>
                                            </DIV>
                                        
                                        </div> 
                                        <div class="col-12">
                                             <div class="form-group mb-3">
                                            
                                            <label>Jenis Kamar</label>
                                                <select name="kamar"  class="form-control">
                                                @foreach ($kamar as $item)
                                                    <option value="{{$item->kamar}}">{{$item->kamar}}</option>
                                    
                                                @endforeach
                                                </select>
                                            </DIV>
                                                    <input type="submit" class="btn btn-info btn-block" value="Proses">
                                        
                                        </div> 
                                    </div>
                                </form >
                            </div>

            </div> 
        </div> 
    </div> 
@endsection
