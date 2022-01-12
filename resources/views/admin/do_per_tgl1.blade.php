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
                                <li class="breadcrumb-item active" aria-current="page"><span>Pembelian Ke Supplier</span></li>
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
                <h5 class="card-title text-center">{{$judul}} </h5>
                <h5 class="card-title text-center">{{$judul1}} </h5>
                
                </div>
                <div class="card-body p-2 pt-3">
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <?php $i=1; ?>
                                            <tr>
                                                <th>No</th>
                                                <th>No PO</th>
                                                <th>No DO</th> 
                                                <th>Tgl Do</th> 
                                                <th>Jml Item</th>
                                                <th>Total</th> 
                                                 
                                                <th>Supplier</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $d)
                                            <tr>
                                                <td >{{ $i++ }}</td>
                                                <td><a href="/pakan/do/{{$d->id}}" target="_blank" class="text-danger">{{ $d->no_po}}</a></td>
                                                <td>{{ $d->no_do}}</td>
                                                <td>{{ convert_tgl1($d->tgl_do) }}</td>
                                                <td>{{ $d->jml }}</td>
                                                <td>{{ $d->total }}</td>
                                                <td>{{ $d->supplier->nama_supplier }}</td>
                                                
                                              
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>

            </div> 
        </div> 
    </div> 
@endsection
