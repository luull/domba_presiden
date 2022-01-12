

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Daftar Booking</span></li>
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
                <h5 class="card-title text-center">DAFTAR BOOKING DOMBA OLEH INVESTOR</h5>
                </div>
                <div class="card-body p-2 pt-3">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    @if (session('message'))
                                    <div class="alert alert-{{ session('alert') }} fade show">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                <div class="widget-content widget-content-area br-6">
                           
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>No Transaksi</th>
                                                <th>Tgl Transaksi</th>
                                                <th>No Registrasi</th>
                                                <th>Investor</th> 
                                                <th>Jumlah</th>
                                                <th>Sub Total</th>
                                                <th>Diskon</th>
                                                <th>Total</th>
                                                <th>Keterangan</th>
                                                 @if (session('admin_level')<3)
                                                <th class="no-content"></th>
                                                
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->no_transaksi}}</td>
                                                <td>{{ convert_tgl1($d->tgl_transaksi)}}</td>
                                                <td>{{ $d->no_regis}}</td>
                                                <td>{{ $d->investor->nama }}</td>
                                                <td>{{ $d->qty }}</td>
                                                <td>{{ $d->sub_total }}</td>
                                                <td>{{ $d->diskon }}</td>
                                                <td>{{ $d->total }}</td>
                                                <td>{!! $d->keterangan!!}</td>
                                                 @if (session('admin_level')<3)
                                                <td>
                                                    <a href="/investor/daftar_booking/approve/{{$d->no_transaksi}}" class="approve" id="e-{{$d->id}}" title="Approve"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-checklist"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> </a>
                                                     <a href="/investor/daftar_booking/delete/{{$d->no_transaksi}}" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                </td>
                                                @endif
                                              
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>



@stop

