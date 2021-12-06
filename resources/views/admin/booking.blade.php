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
                               <li class="breadcrumb-item active" aria-current="page"><span>Supplier Domba</span></li>
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
           <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <form action="{{ route('update_dummy')}}" id="form1" method="Post" enctype="multipart/form-data">
                @csrf
            @if (session('message'))
            <div class="alert alert-{{ session('alert') }} fade show">
                {{ session('message') }}
            </div>
            @endif
  
               <div class="row">
                    <div class="col-md-12">
                        <div class="widget-content widget-content-area br-6">
                                    
                            <div class="container ml-4 mr-4 mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No Transaksi</label>
                                                    <input type="text" name="no_transaksi" class="form-control" value="{{ $no_trans }}" readonly>
                                                </div>
                                                <label>Investor</label>
                                                <div class="form-group">
                                                    <select name="id_investor" class="form-control">
                                                    @foreach ( $investor as $i )
                                                        <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tgl Transaksi</label>
                                                    <input type="text" name="tgl_transaksi" class="form-control" value="{{ $tgl_trans }}" readonly>
                                                </div>
                                                <label>Metode Pembayaran</label>
                                                <div class="form-group">
                                                    <select name="cara_bayar" class="form-control" >
                                                        <option value="Tunai">Tunai</option>
                                                        <option value="Debit">Debit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="widget widget-account-invoice-three">

                                            {{-- <div class="widget-heading" style="max-height:200px !Important;">
                                                <div class="wallet-usr-info">
                                                    <div class="usr-name">
                                                        <span class="pl-3 pt-2"></span>
                                                    </div>
                                                   
                                                </div>
                                                <div class="wallet-balance">
                                                    <p>Total</p>
                                                    <h5 class=""><span class="w-currency">Rp.</span>0</h5>
                                                </div>
                                            </div> --}}
                                            <div class="widget-amount" style="margin-top:-15px !Important">

                                               
                                                <div class="w-a-info funds-spent" style="width: 80% !Important;">
                                                    <span>Sub Total <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span>
                                              
                                                    <p>Rp.0</p>
                                                </div>
                                            </div>
            
            
                                            <div class="widget-content">
            
                                  
                                                <div class="invoice-list">
            
                                                    <div class="inv-detail">
                                                    
                                                        <div class="info-detail-1">
                                                            <p>Diskon </p>
                                                            <p><span class="w-currency">Rp.</span> <span class="bill-amount">-</span></p>
                                                        </div>
                                                        <div class="info-detail-1">
                                                            <p>Total </p>
                                                            <p><span class="w-currency">Rp.</span> <span class="bill-amount">0</span></p>
                                                        </div>
                                                    </div>
            
                                                    <!-- <div class="inv-action">
                                                        <a href="javascript:void(0);" class="btn btn-outline-primary view-details">View Details</a>
                                                        <a href="javascript:void(0);" class="btn btn-outline-primary pay-now">Pay Now $29.51</a>
                                                    </div> -->
                                                </div>
                                            </div>
            
                                        </div>
                                        <a href="#" class="btn btn-primary btn-block btn-rounded mt-3" data-toggle="modal" data-target="#detailModal"> <i class="fa fa-plus"></i> Detail Booking</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="widget-content widget-content-area br-6">
                            <table id="zero-config2" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <?php $i=1; ?>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>ID Domba</th> 
                                        <th>Berat</th> 
                                        <th class="no-content"></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $dummy as $d )
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $d->no_transaksi }}</td>
                                        <td>{{ $d->no_regis }}</td>
                                        <td>{{ $d->berat }}</td>
                                        <td><a href="javascript:void(0);" class="edit" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Transaksi Booking</h5>
                        
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <table class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <?php $i=1; ?>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>ID Domba</th> 
                                        <th>Berat</th> 
                                        <th class="no-content"></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $domba as $d )
                                    <tr>
                                         
                                            <td>{{ $i++ }}</td>
                                            <td> <input type="text" class="form-control" name="no_transaksi" value="{{$no_trans}}" readonly></td>
                                            <td> <input type="text" class="form-control" name="no_regis" value="{{$d->no_regis}}" readonly></td>
                                            <td> <input type="text" class="form-control" name="berat" value="{{$d->berat_akhir}}" readonly></td>
                                            <td> <button type="submit" form="form1" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
    {{-- @section('script')  
    <script type="text/javascript">
        function form_submit() {
          document.getElementById("form1").submit();
         }    
        </script>
    @stop --}}