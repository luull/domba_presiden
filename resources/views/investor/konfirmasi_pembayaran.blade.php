
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
                                <li class="breadcrumb-item"><a href="/investor/konfirmasi-pembayaran">Konfirmasi Pembayaran</a></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>

@section('content')
    
  <section class="section">
    
<form action ={{route('konfirmasi_pembayaran')}} method="post" enctype="multipart/form-data">
    @csrf
    <div class="section-body">
      <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
          <div class="card p-2 pt-5 pb-5">
            <div class="card-heade ">
              <h4 class="text-center">KONFIRMASI PEMBAYARAN</h4>
            </div>
            <div class="card-body">
            @if(session('message'))
            <div class="alert alert-{{session('alert')}} text-center">
            {{ session('message') }}  
            </div>
        @endif
                <div class="form-group">
                    <label>No Transaksi</label>
                    <select name="no_transaksi" class="form-control">
                    @foreach ($invoice as $item)
                        <option value="{{$item->no_transaksi}}">{{$item->no_transaksi}} - {{convert_tgl1($item->tgl_transaksi)}} - {{number_format($item->total,1)}}</option>
                    @endforeach
                    </select>
                  </div>
              <div class="form-group">
                <label>Tgl Transfer</label>
                                               
                <input type="text" id="basicFlatpickr" name ="tgl_transfer" class="form-control datepicker">
              </div>
              <div class="form-group">
                <label>Bank Tujuan</label>
                <select name="bank_tujuan" class="form-control">
                    @foreach ($bank as $item)
                        <option value="{{$item->no_akun}} - {{$item->nama_bank}} ">{{$item->no_akun}} - {{$item->nama_bank}} - {{$item->nama_akun}}</option>
                    @endforeach
                    </select>
              </div>
              <div class="form-group">
                <label>Bukti Transfer</label>
                <input type="file" name="bukti_transfer" class="form-control ">
              </div>
              
            </div>
          <div class="card-footer">
          <input type="submit" class="btn btn-info btn-block" value="Proses">
        </div>
   
        </div>
    </div>
  </div> 
</div>

</form>
  </section>
@endsection

@section('script')
  
   <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
  <script>
     var f1 = flatpickr(document.getElementById('basicFlatpickr'), {
             dateFormat: "d-m-Y",
        });
   
    </script>

@endsection