

<nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="/dashboard"  data-active="{{ Request::is('dashboard') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('/dashboard') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                     <li class="menu">
                        <a href="#profil" data-toggle="collapse" data-active="{{ Request::is('profil','ubah_password') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('profil','ubah_password') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('profil','ubah_password') ? '' : 'collapsed' }}">
                            <div class="">
                            <i data-feather="user"></i>
                                <span>Profil Admin</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="list-unstyled  collapse submenu list-unstyled {{ Request::is('profil','ubah_password') ? 'show' : '' }}" id="profil" data-parent="#accordionExample">
                            <li class="{{ Request::is('profil') ? 'active' : '' }}">
                                <a href="/profil"> Edit Profil </a>
                            </li>
                            <li class="{{ Request::is('ubah_password') ? 'active' : '' }}">
                                <a href="/ubah_password"> Ubah Password </a>
                            </li>
                         
                        </ul>
                    </li>
                    @if (session('admin_level')==1)
                    <li class="menu">
                        <a href="#setting" data-toggle="collapse" data-active="{{ Request::is('jenis_domba','satuan_pakan','kandang_domba') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('jenis_domba','satuan_pakan','kandang_domba') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('jenis_domba','satuan_pakan','kandang_domba') ? '' : 'collapsed' }}">
                            <div class="">
                                <i data-feather="settings"></i>
                                <span>Setting</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="list-unstyled  collapse submenu list-unstyled {{ Request::is('jenis_domba','satuan_pakan','kandang_domba') ? 'show' : '' }}" id="setting" data-parent="#accordionExample">
                            <li class="{{ Request::is('user') ? 'active' : '' }}">
                                <a href="/user"> User </a>
                            </li>
                            <li class="{{ Request::is('satuan_pakan') ? 'active' : '' }}">
                                <a href="/satuan_pakan"> Satuan Pakan </a>
                                
                            </li>
                            <li class="{{ Request::is('jenis_domba') ? 'active' : '' }}">
                                <a href="/jenis_domba"> Jenis Domba </a>
                                
                            </li>
                            <li class="{{ Request::is('kandang_domba') ? 'active' : '' }}">
                                <a href="/kandang_domba">Kandang </a>
                                
                            </li>
                           
                         
                        </ul>
                    </li>
                    @endif
                    <li class="menu">
                       
                        <a href="#supplier" data-toggle="collapse" data-active="{{ Request::is('supplier','supplier/pakan','supplier/domba') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('supplier','supplier/pakan','supplier/domba') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('supplier','supplier/pakan','supplier/domba') ? '' : 'collapsed' }}">
                            <div class="">
                                <i data-feather="truck"></i>
                                <span>Supplier</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        
                        <ul class="collapse submenu list-unstyled {{ Request::is('supplier','supplier/pakan','supplier/domba') ? 'show' : '' }}" id="supplier" data-parent="#accordionExample">
                              @if (session('admin_level')<3)
                              <li class="{{ Request::is('supplier') ? 'active' : '' }}">
                                <a href="/supplier">Daftar Supplier  </a>
                            </li>
                            @endif
                            <li class="{{ Request::is('supplier/pakan') ? 'active' : '' }}">
                                <a href="/supplier/pakan"> Supplier Pakan </a>
                            </li>
                            <li class="{{ Request::is('supplier/domba') ? 'active' : '' }}">
                                <a href="/supplier/domba"> Supplier Domba </a>
                            </li>
                           
                         
                        </ul>
                    </li>
                    
                    
                     <li class="menu">
                        <a href="#domba" data-toggle="collapse" data-active="{{ Request::is('regis_domba','penimbangan_domba','pakan') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('regis_domba','penimbangan_domba','pakan') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('regis_domba','penimbangan_domba','pakan') ? '' : 'collapsed' }}">
                            <div class="">
                            <i data-feather="clipboard"></i>
                                <span>Domba</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="list-unstyled  collapse submenu list-unstyled {{ Request::is('regis_domba','penimbangan_domba','pakan') ? 'show' : '' }}" id="domba" data-parent="#accordionExample">
                            <li>
                                <a href="#subdomba" data-toggle="collapse" aria-expanded="{{ Request::is('regis_domba') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('regis_domba') ? '' : 'collapsed' }}"> Domba <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu {{ Request::is('regis_domba') ? 'show' : '' }}" id="subdomba" data-parent="#domba"> 
                                    <li class="{{ Request::is('regis_domba') ? 'active' : '' }}">
                                        <a href="/domba"> Domba Keseluruhan </a>
                                    </li>
                                    <li>
                                        <a href="/domba/available"> Domba Avalilable </a>
                                    </li>
                                    <li>
                                        <a href="/domba/booked"> Domba Booked </a>
                                    </li>
                                    <li>
                                        <a href="/domba/sold"> Domba Sold </a>
                                    </li>
                                    <li>
                                        <a href="/domba/per_kandang"> Domba Perkandang </a>
                                    </li>
                                    <li>
                                        <a href="/domba/per_kamar"> Domba Perkamar </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="{{ Request::is('penimbangan_domba') ? 'active' : '' }}">
                                <a href="/domba/penimbangan"> Penimbangan </a>
                                
                            </li>
                            <li class="{{ Request::is('/domba/pemberian-pakan') ? 'active' : '' }}">
                                <a href="/domba/pemberian-pakan"> Pemberian Pakan </a>
                                
                            </li>
                            
                          
                         
                        </ul>
                    </li>
                    
                    <li class="menu">
                        <a href="#pakan" data-toggle="collapse" data-active="{{ Request::is('order_pakan') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('order_pakan') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('order_pakan') ? '' : 'collapsed' }}">
                            <div class="">
                            <i data-feather="box"></i>
                                <span>Pakan</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('order_pakan') ? 'show' : '' }}" id="pakan" data-parent="#accordionExample">
                             @if (session('admin_level')<3)
                            <li class="{{ Request::is('order_pakan') ? 'active' : '' }}">
                                <a href="/pakan/order"> Order Pakan </a>
                            </li>
                            
                            <li class="{{ Request::is('penerimaan_pakan') ? 'active' : '' }}">
                                <a href="/pakan/do"> Penerimaan Pakan </a>
                            </li>
                            @endif
                            <li class="{{ Request::is('laporan_pakan') ? 'active' : '' }}">
                                <a href="/pakan/po-per-tgl"> Laporan Order Pakan </a>
                            </li>
                            <li class="{{ Request::is('laporan_penerimaan_pakan') ? 'active' : '' }}">
                                <a href="/pakan/do-per-tgl"> Laporan Penerimaan Pakan </a>
                            </li>
                            <li class="{{ Request::is('stok_pakan') ? 'active' : '' }}">
                                <a href="/pakan"> Stok Pakan </a>
                            </li>
                         
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#investor" data-toggle="collapse" data-active="{{ Request::is('investor','booking','daftar_domba') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('investor','booking','daftar_domba') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('investor','booking','daftar_domba') ? '' : 'collapsed' }}">
                            <div class="">
                            <i data-feather="dollar-sign"></i>
                                <span>Investor</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('investor','booking','daftar_domba') ? 'show' : '' }}" id="investor" data-parent="#accordionExample">
                            <li class="{{ Request::is('investor') ? 'active' : '' }}">
                                <a href="/investor"> Daftar investor </a>
                            </li>
                           
                            <li class="{{ Request::is('investor/booking-list') ? 'active' : '' }}">
                                <a href="/investor/booking-list"> Daftar Booking </a>
                            </li>
                             <li class="{{ Request::is('sold_investor') ? 'active' : '' }}">
                                <a href="/investor/sold-list"> Domba Terjual </a>
                            </li>
                             <li class="{{ Request::is('sold_investor') ? 'active' : '' }}">
                                <a href="/investor/domba-list"> Daftar Domba </a>
                            </li>
                            
                         
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#customer" data-toggle="collapse" data-active="{{ Request::is('customer','order_customer') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('customer','order_customer') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('customer','order_customer') ? '' : 'collapsed' }}">
                            <div class="">
                            <i data-feather="users"></i>
                                <span>Customer</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('customer','order_customer') ? 'show' : '' }}" id="customer" data-parent="#accordionExample">
                            <li class="{{ Request::is('customer') ? 'active' : '' }}">
                                <a href="/customer"> Daftar customer </a>
                            </li>
                             @if (session('admin_level')<3)
                            <li class="{{ Request::is('customer/penjualan') ? 'active' : '' }}">
                                <a href="/customer/penjualan"> Penjualan Domba </a>
                            </li>
                            @endif
                            <li class="{{ Request::is('customer/order-list') ? 'active' : '' }}">
                                <a href="/customer/order-list">Domba Terjual </a>
                            </li>
                         
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#review" data-toggle="collapse" data-active="{{ Request::is('review','order_review') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('review','order_review') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('review','order_review') ? '' : 'collapsed' }}">
                            <div class="">
                            <i data-feather="award"></i>
                                <span>Review</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ Request::is('review','order_review') ? 'show' : '' }}" id="review" data-parent="#accordionExample">
                             <li class="{{ Request::is('order_review') ? 'active' : '' }}">
                                <a href="/pakan"> Stok Pakan </a>
                            </li>
                            <li>
                                        <a href="/domba/available"> Domba Avalilable </a>
                                    </li>
                                    <li>
                                        <a href="/domba/booked"> Domba Booked </a>
                                    </li>
                                    <li>
                                        <a href="/domba/sold"> Domba Sold </a>
                                    </li>
                                    <li>
                                        <a href="/domba/per_kandang"> Domba Perkandang </a>
                                    </li>
                                    <li>
                                        <a href="/domba/per_kamar"> Domba Perkamar </a>
                                    </li>
                         
                        </ul>
                    </li>
                    
                    <!-- <li class="menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                                <span>Apps</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                            <li>
                                <a href="apps_chat.html"> Chat </a>
                            </li>
                            <li>
                                <a href="apps_mailbox.html"> Mailbox  </a>
                            </li>
                            <li>
                                <a href="apps_todoList.html"> Todo List </a>
                            </li>                            
                            <li>
                                <a href="apps_notes.html"> Notes </a>
                            </li>
                            <li>
                                <a href="apps_scrumboard.html">Scrumboard</a>
                            </li>
                            <li>
                                <a href="apps_contacts.html"> Contacts </a>
                            </li>
                            <li>
                                <a href="#appInvoice" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Invoice <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="appInvoice" data-parent="#app"> 
                                    <li>
                                        <a href="apps_invoice-list.html"> List </a>
                                    </li>
                                    <li>
                                        <a href="apps_invoice-preview.html"> Preview </a>
                                    </li>
                                    <li>
                                        <a href="apps_invoice-add.html"> Add </a>
                                    </li>
                                    <li>
                                        <a href="apps_invoice-edit.html"> Edit </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="apps_calendar.html"> Calendar </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="widgets.html" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                                <span>Widgets</span>
                            </div>
                        </a>
                    </li> -->

                   
                    
                </ul>
                
            </nav>