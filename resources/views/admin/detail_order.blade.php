

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Order Pakan</span></li>
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
                @if (session('message'))
                <div class="alert alert-{{ session('alert') }} fade show">
                    {{ session('message') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                                        <div class="widget-content widget-content-area br-6">
                                    
                                        <div class="container mt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>No Transaksi : <b>{{ $dummy->no_transaksi }}</b></p>
                                                <p>Tanggal Order : <b>{{ $dummy->tgl_order }}</b></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p style="float:right !important;">Supplier : <b>{{ $dummy->supplier }}</b></p>
                                                <p style="float:right !important;">Tanggal Estimasi : <b>{{ $dummy->tgl_estimasi }}</b></p>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 mb-5">
                                                
                                                <div class="widget-table-one">
                                
                                                    <div class="widget-content">
                                                        @foreach($pakan as $d)
                                                        <div class="transactions-list t-success">
                                                            <div class="t-item">
                                                                <div class="t-company-name">
                                                                    <div class="t-icon">
                                                                        <div class="avatar avatar-xl">
                                                                            <span class="avatar-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="t-name">
                                                                        <h4>{{ $d->nama_pakan }}</h4>
                                                                        <p class="meta-date">{{ $d->kode_pakan }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="t-rate rate-inc">
                                                                    <p><span>Rp.{{ $d->harga_pakan }}/{{ $d->satuan_pakan }}</span></p>
                                                                </div>
                                                                    <form action="{{route('create_dummy') }}" method="Post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $dummy->id }}">
                                                                        <input type="hidden" name="no_transaksi" value="{{ $dummy->no_transaksi }}">
                                                                        <input type="hidden" name="id_order" value="{{ $dummy->no_order }}">
                                                                        <input type="hidden" name="tgl_order" value="{{ $dummy->tgl_order }}">
                                                                        <input type="hidden" name="tgl_estimasi" value="{{ $dummy->tgl_estimasi }}">
                                                                        <input type="hidden" name="tgl_transaksi" value="{{ $dummy->tgl_transaksi }}">
                                                                        <input type="hidden" name="supplier" value="{{ $dummy->supplier }}">
                                                                        <input type="hidden" name="order_by" value="{{ $dummy->order }}">
                                                                        <input type="hidden" name="nama_pakan" value="{{ $d->nama_pakan }}">
                                                                        <input type="hidden" name="total" value="{{ $d->harga_pakan }}">
                                                                        <input type="text" class="form-control" name="jumlah_pakan" placeholder="0" style="width:60px !important;float:left !Important;" >
                                                                        <button type="submit" class="btn btn-rounded btn-success ml-4 mt-2"><i class="fa fa-plus"></i></button>
                                                                    </form>
                                                               
                                                            </div>
                                                       
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                    <div class="col-md-4">
                                    <div class="widget widget-account-invoice-three">

                                <div class="widget-heading" style="max-height:200px !Important;">
                                    <div class="wallet-usr-info">
                                        <div class="usr-name">
                                            <span class="pl-3 pt-2"> {{ $dummy->supplier }}</span>
                                        </div>
                                       
                                    </div>
                                    <div class="wallet-balance">
                                        <p>Total</p>
                                        <h5 class=""><span class="w-currency">Rp.</span>2953</h5>
                                    </div>
                                </div>


                                <div class="widget-content">

                                    <!-- <div class="bills-stats">
                                        <span>Pending</span>
                                    </div> -->

                                    <div class="invoice-list">

                                        <div class="inv-detail">
                                            @foreach($dummyorder as $d)
                                            <div class="info-detail-1">
                                                <p>{{ $d->nama_pakan }} ({{ $d->jumlah_pakan }}) </p>
                                                <p><span class="w-currency">Rp.</span> <span class="bill-amount">{{$d->total}}</span></p>
                                            </div>
                                            @endforeach
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
    @stop
    <!-- @section('script')
    <script >
        $(".get").click(function(){
            var idnya=$(this).attr('id').split('-');
            var id=idnya[1];
            console.log(id);
            
            $.ajax({
                type:'get',
                method:'get',
                url:'/admin/detail_pakan/find/'  + id ,
                data:'_token = <?php echo csrf_token() ?>'   ,
                success:function(hsl) {
                   if (hsl.error){
                       alert(hsl.message);

                   } else{
                       $("#edit_id").val(id);
                       $("#get_nama_pakan").val(hsl.nama_pakan);
                       $("#get_jumlah_pakan").val(hsl.jumlah_pakan);

                   }
                }
            });
            
        })
    </script>
    @stop -->