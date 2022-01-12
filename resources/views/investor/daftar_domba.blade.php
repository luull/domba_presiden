

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Registrasi Domba</span></li>
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
                <div class="widget-content widget-content-area br-6">
                            <button type="button" class="btn btn-primary mt-3 ml-3 mb-3 mr-3" data-toggle="modal" data-target="#addModal">
                             DAFTAR DOMBA {{$investor}}
                             </button>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Registrasi</th>
                                                <th>Status</th>
                                                <th>Berat Awal</th>
                                                <th>Berat Akhir</th>
                                                <th>Jenis</th>
                                                <th>Kandang</th>
                                                <th>Kamar</th>
                                                <th>Harga Beli</th>
                                                <th>Tgl Masuk</th>
                                                <th>Status</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;
                                            $status=array('Available','Booked','Sold') ?>
                                            @foreach($data as $d)
                                            <?PHP
                                            $berat_akhir=berat_akhir($d->no_regis,$d->berat_awal); 
                              
                                            ?>
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d->no_regis }}</td>
                                                <td>{{ $status[$d->status] }}</td>
                                                <td>{{ number_format($d->berat_awal,2) }} Kg</td>
                                                <td>{{ number_format($berat_akhir,2) }} Kg</td>
                                                <td>{{ $d->jenis }}</td>
                                                <td>{{ $d->kandang }}</td>
                                                <td>{{ $d->kamar }}</td>
                                                <td>Rp. {{ number_format($d->harga_beli) }}</td>
                                                <td>{{ $d->tgl_masuk }}</td>
                                                <td>{{ $d->status }}</td>
                                                <td>
                                                <a href="/investor/domba/detil/{{$d->no_regis}}"><i data-feather="list"></i></a>
                                            </td>
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                </table>
                </div>
            </div>
       
        </div>
    </div>

@stop

@section('script')
   
      <script>
       /* Tanpa Rupiah */
            var tanpa_rupiah = document.getElementById('rupiah');
            tanpa_rupiah.addEventListener('keyup', function(e)
            {
                tanpa_rupiah.value = formatRupiah(this.value);
            });
            
            /* Fungsi */
            function formatRupiah(angka, prefix)
            {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split    = number_string.split(','),
                    sisa     = split[0].length % 3,
                    rupiah     = split[0].substr(0, sisa),
                    ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                    
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
	</script>
    <script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah2');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
		}
	</script>
@stop