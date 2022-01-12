
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
                                <li class="breadcrumb-item"><a href="/pakan">Pakan</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Stok Incoming</span></li>
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
                <h5 class="card-title text-center">DAFTAR STOK INCOMING<BR>
                JENIS PAKAN {{strtoupper($pakan->nama_pakan)}}  </h5>
                </div>
                <div class="card-body p-2 pt-3">
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No PO</th>
                                                <th>Tanggal PO</th>
                                                <th>Tanggal Estimasi</th> 
                                                <th>Jml Order</th>
                                                <th>Jml Diterima</th>
                                                <th>Stok Incoming </th>
                                                <th>Supplier</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <?PHP 
                                            $selisih=$d->jml-$d->diterima;
                                            $nama_supplier=get_supplier_name($d->supplier_id) ; ?>      
                                            <tr>
                                                <td ><a href="/pakan/po/{{$d->id}}" class="text-primary">{{ $d->no_po}}</a></td>
                                                <td>{{ $d->tgl_po }}</td>
                                                <td>{{ $d->tgl_estimasi }}</td>
                                                <td>{{ $d->jml }}</td>
                                                <td>{{ $d->diterima }}</td>
                                                <td class="text-danger">{{ $selisih }}</td>
                                                <td >{{ $nama_supplier }}</td>
                                                
                                              
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                            </div> 
                        </div>
    </div>
</div>
@endsection

