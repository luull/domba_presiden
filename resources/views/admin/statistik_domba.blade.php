                       

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Statistik Domba</span></li>
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
                       <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-activity-five">
                            <div class="widget-heading">
                                <h5 class="">Penimbangan</h5>

                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Mark as Read</a>
                                        </div>
                                    </div>
                                </div>
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
                                            <div class="item-timeline timeline-new">
                                                @if($data->status == 0)
                                                <div class="t-dot">
                                                    <div class="t-warning"><i data-feather="tag"></i></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Status : <a href="javscript:void(0);"><span>Belum Terjual</span></a></h5>
                                                    </div>
                                                    <p>Jenis : {{ $data->jenis}}</p>
                                                </div>
                                                @endif
                                            </div>                                
                                        </div>                                    
                                    </div>

                                    <div class="w-shadow-bottom"></div>
                                </div>
                            </div>
                        </div>
                    
        </div>
    </div>
@stop

