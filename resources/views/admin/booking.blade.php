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
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget-content widget-content-area br-6">
                                    
                            <div class="container ml-4 mr-4 mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <form action="" onblur="myFunction()"></form>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No Transaksi</label>
                                                    <input type="text" class="form-control" value="{{ $no_trans }}" readonly>
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
                                                    <input type="text" class="form-control" value="{{ $tgl_trans }}" readonly>
                                                </div>
                                                <label>Metode Pembayatan</label>
                                                <div class="form-group">
                                                    <select name="cara_bayar" class="form-control" >
                                                        <option value="Tunai">Tunai</option>
                                                        <option value="Debit">Debit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            </form>
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
                                                    <p>Rp. 0</p>
                                                </div>
                                            </div>
            
            
                                            <div class="widget-content">
            
                                  
                                                <div class="invoice-list">
            
                                                    <div class="inv-detail">
                                                    
                                                        <div class="info-detail-1">
                                                            <p>Diskon </p>
                                                            <p><span class="w-currency">Rp.</span> <span class="bill-amount">1000</span></p>
                                                        </div>
                                                        <div class="info-detail-1">
                                                            <p>Total </p>
                                                            <p><span class="w-currency">Rp.</span> <span class="bill-amount">1000</span></p>
                                                        </div>
                                                    </div>
            
                                                    <!-- <div class="inv-action">
                                                        <a href="javascript:void(0);" class="btn btn-outline-primary view-details">View Details</a>
                                                        <a href="javascript:void(0);" class="btn btn-outline-primary pay-now">Pay Now $29.51</a>
                                                    </div> -->
                                                </div>
                                            </div>
            
                                    </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="widget-content widget-content-area br-6">
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <?php $i=1; ?>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>No Regis</th> 
                                        <th>Berat</th> 
                                        <th>Berat</th> 
                                        <th class="no-content"></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>balak</td>
                                        <td>02712</td>
                                        <td>15kg</td>
                                        <td><a href="javascript:void(0);" class="edit" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('script')  
    <script>
       function myFunction() {
           console.log('berhasil');
           $.ajax({
                method: "post",
                url: "add_h_booking",
                data: {
                    id: data
                },
                success: function(response) {
                    alert(response);
                }
            });
        }
    </script>    
    @stop