                       

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
                                <li class="breadcrumb-item"><a href="/regis_domba">Domba</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Data Detil Domba</span></li>
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
            <div class="col-md-8 ">
                <div class="widget infobox-3" style="width:100% !Important;">
                    <div class="info-icon">
                        <i data-feather="clipboard"></i>
                    </div>
                            <h5>DETIL DOMBA</h5>
                            <HR>
                            <div class="col-md-12">
                            <table class="table table-responsive">
                                <tr><td>No Registrasi</td><td>{{ $data->no_regis}}</td></tr>
                                <tr><td>Status</td><td>{{ $data->status_domba->keterangan}}</td></tr>
                                <tr><td>Tgl Masuk</td><td>{{ $data->tgl_masuk}}</td></tr>
                                <tr><td>Supplier</td><td>{{ $data->supplier}}</td></tr>
                                <tr><td>Berat Awal</td><td>{{ $data->berat_awal}} Kg</td></tr>
                                <tr><td>Jenis Domba</td><td>{{ $data->jenis}}</td></tr>
                                <tr><td>Kandang</td><td>{{ $data->kandang}}</td></tr>
                                <tr><td>Kamar</td><td>{{ $data->kamar}}</td></tr>
                                  <tr><td>Harga/Kg</td><td>Rp. {{ number_format($data->harga_beli)}}</td></tr>
                              
                                
                            </table>  
                        </div>
                </DIV>  
                  
            </DIV>
        </DIV>   

        <div class="row layout-top-spacing">
                       <div class="col-md-4 layout-spacing">
                            <div class="widget widget-activity-five">
                            <div class="widget-heading">
                                <h5 class="">DATA PENIMBANGAN</h5>
                            </div>

                                <div class="widget-content">

                                    <div class="w-shadow-top"></div>

                                    <div class="mt-container mx-auto">
                                        <div class="timeline-line">
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-secondary"><i data-feather="clipboard"></i></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Berat Awal : <a href="javscript:void(0);"><span>{{ $data->berat_awal }} Kg</span></a></h5>
                                                    </div>
                                                    <p>{{ $data->tgl_masuk}}</p>
                                                </div>
                                            </div>
                                            @foreach($penimbangan as $p)
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-success"><i data-feather="calendar"></i></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Update Berat : <a href="javscript:void(0);"><span>{{ $p->berat_timbang }} Kg</span></a></h5>
                                                    </div>
                                                    <p>{{ $p->tgl_timbang }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                                                         
                                        </div>                                    
                                    </div>

                                    <div class="w-shadow-bottom"></div>
                                </div>
                            </div>
                        </div>
                    
    
                       <div class="col-md-8 layout-spacing">
                            <div class="widget widget-activity-five">
                            <div class="widget-heading">
                                <h5 class="">PEMBERIAN PAKAN</h5>
                            </div>
                            @if ($pakan)
                                <div class="widget-content">

                                            <table class="table table-responsive">
                                                 <tr><th>Tanggal</th>
                                                    <th>Kandang</th>
                                                    <th>Jadwal</th>
                                                    <th>Berat Badan</th>
                                                    <th>Total Pakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pakan as $pkn)
                                                <tr><td>{{$pkn->tanggal}}</td>
                                                    <td>{{$pkn->kandang}}</td>
                                                    <td>{{$pkn->jadwal}}</td>
                                                    <td>{{number_format($pkn->total_berat_domba,2)}}</td>
                                                    <td>{{number_format($pkn->total_pakan,2)}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            </table>                             
                                                                         


                              
                            </div>
                            @endif
                        </div>
                    
        
    </div>
@stop

