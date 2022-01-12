
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
                                <li class="breadcrumb-item"><a href="/pakan/order">Pembelian Pakan  </a></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
 @section('content')
    <div class="layout-px-spacing"> 
            <div class="card m-3">
                <div class="card-header">
                <h5 class="card-title text-center">DETIL PEMBELIAN DOMBA</h5>
                </div>
                <div class="card-body p-2 pt-3">
                     @if (session('message'))
                    <div class="alert alert-{{ session('alert') }} fade show">
                        {{ session('message') }}
                    </div>
                    @endif
                                      <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Nomor Invoice</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->no_po}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-4 p-1">Tanggal Order</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{convert_tgl1($data->tgl_po)}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Investor</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$data->investor}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-4 p-1">Total</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$nama_investor($data->id_investor))}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">No Rek</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$bank->no_akun}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-4 p-1">Nama Bank </div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$bank-nama_bank}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pl-2 pr-2">
                                        <div class="col-6 ">
                                            <div class="row p-1">
                                                <div class="col-md-3 p-1">Atas Nama</div>
                                                <div class="col-md-6 border border-success rounded p-1">{{$bank->nama_akun}}</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                  
                                        
                                        
                                        
                    <div class="table table-responsive pt-5">
                     <div id="datadummy">
                         <div class="alert alert-success text-center p-3" style="display:none" id="message"></div>
                         <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No Registrasi</th>
                                                <th>Berat Awal</th>
                                                <th>Berat Akhir</th>
                                                <th>Jenis</th>
                                                <th>Kandang</th>
                                                <th>Kamar</th>
                                                <th>Harga Beli</th>
                                                <th>Supplier</th>
                                                <th>Tgl Masuk</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($domba as $d)
                                          <?PHP
                                            $berat_akhir=berat_akhir($d->no_regis,$d->berat_awal); 
                              
                                            ?>   <tr>
                                                <td><a href="#" class="text-danger pilih" onclick="pilih ({{$d->id}},{{$data->id}})"  id="e-{{$d->id}}" title="Pilih">{{ $d->no_regis }}</a></td>
                                                <td>{{ number_format($d->berat_awal,2) }} Kg</td>
                                                <td>{{ number_format($berat_akhir,2) }} Kg</td>
                                                <td>{{ $d->jenis }}</td>
                                                <td>{{ $d->kandang }}</td>
                                                <td>{{ $d->kamar }}</td>
                                                <td>Rp. {{ number_format($d->harga_beli) }}</td>
                                                <td>{{ $d->supplier }}</td>
                                                <td>{{ $d->tgl_masuk }}</td>
                                           
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                        
                     </div>
                    
                          

                  
                    </div>
                </div> 
            </div>
        
    </div>
    

@endsection
