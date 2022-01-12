

<nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="/dashboard-investor"  data-active="{{ Request::is('dashboard') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('/dashboard') ? 'true' : 'false' }}" class="dropdown-toggle">
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
                                <span>Profil </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="list-unstyled  collapse submenu list-unstyled {{ Request::is('profil','ubah_password') ? 'show' : '' }}" id="profil" data-parent="#accordionExample">
                            <li class="{{ Request::is('profil') ? 'active' : '' }}">
                                <a href="/investor/profil"> Edit Profil </a>
                            </li>
                            <li class="{{ Request::is('ubah_password') ? 'active' : '' }}">
                                <a href="/investor/ubah_password"> Ubah Password </a>
                            </li>
                         
                        </ul>
                    </li>
                    
                    
                    
                    
                     <li class="menu">
                        <a href="#domba" data-toggle="collapse" data-active="{{ Request::is('regis_domba','penimbangan_domba','pakan') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('regis_domba','penimbangan_domba','pakan') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('regis_domba','penimbangan_domba','pakan') ? '' : 'collapsed' }}">
                            <div class="">
                            <i data-feather="clipboard"></i>
                                <span>Transaksi</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="list-unstyled  collapse submenu list-unstyled {{ Request::is('regis_domba','penimbangan_domba','pakan') ? 'show' : '' }}" id="domba" data-parent="#accordionExample">
                            
                            <li class="{{ Request::is('/investor/order') ? 'active' : '' }}">
                                <a href="/investor/booking1"> Pembelian Domba </a>
                                
                            </li>
                            <li class="{{ Request::is('/investor/konfirmasi-pembayaran') ? 'active' : '' }}">
                                <a href="/investor/konfirmasi-pembayaran"> Konfirm Pembayaran </a>
                                
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
                            <li class="{{ Request::is('regis_domba') ? 'active' : '' }}">
                                        <a href="/investor/domba"> Domba  Keseluruhan </a>
                                    </li>
                                    <li>
                                        <a href="/investor/domba/available"> Domba Avalilable </a>
                                    </li>
                                  
                                    <li>
                                        <a href="/investor/domba/sold"> Domba Sold </a>
                                    </li>
                           
                           
                            <li class="{{ Request::is('order_review') ? 'active' : '' }}">
                                <a href="/investor/domba/per_kandang">Domba Per Kandang </a>
                            </li>
                            <li class="{{ Request::is('order_review') ? 'active' : '' }}">
                                <a href="/investor/domba/per_kamar">Domba Per Kamar </a>
                            </li>
                         
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="/investor/logout"  class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span>Log Out</span>
                            </div>
                        </a>
                    </li>
                     
                    
                </ul>
                
            </nav>