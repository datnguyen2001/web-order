<div class="box-header">
    <div class="header-top">
        <div class="box-content header-content header-content-top">
            <div class="header-content-item">
                <a href="{{route('home.main')}}">Trang chủ</a>
                <a href="">Biểu phí</a>
                <a href="">Tải công cụ đặt hàng</a>
                <a href="">1688.com</a>
                <a href="">Liên hệ</a>
                <a href="">Góp ý dịch vụ</a>
            </div>
            <div class="header-content-item">
                @if(!\Illuminate\Support\Facades\Auth::check())
                    <a href="{{route('login')}}">Đăng nhập</a>
                    <a href="{{route('register')}}">Đăng ký</a>
                @else
                    <div class="dropdown">
                        <a data-bs-toggle="dropdown" aria-expanded="false"
                           style="display: inline-block;padding-bottom: 3px">
                            {{\Illuminate\Support\Facades\Auth::user()->full_name}} <i class="fa-solid fa-angle-down"
                                                                                       style="color:#F9471B;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fa-regular fa-user"
                                                                                        style="padding-right: 5px"></i>
                                    Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="{{route('order')}}"><i class="fa-regular fa-clipboard"
                                                                                      style="padding-right: 5px"></i>
                                    Quản lý đơn hàng</a></li>
                            <li><a class="dropdown-item" href="{{url('lich-su-giao-dich/vi')}}"><i
                                        class="fa-regular fa-credit-card" style="padding-right: 5px"></i> Tài khoản trả
                                    trước</a></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}"><i
                                        class="fa-solid fa-arrow-right-from-bracket" style="padding-right: 5px"></i>
                                    Đăng xuất</a></li>
                        </ul>
                    </div>
                @endif
                <a href="{{route('cart')}}" class="position-relative">Giỏ hàng <i class="fa-solid fa-cart-shopping"></i>
                    <div class="circle-cart">{{$countCartItem}}</div>
                </a>
            </div>
        </div>
    </div>
    @if($activeHeader == 1)
        <div class="header-bottom">
            <div class="box-content header-content header-content-bottom">
                <a href="{{route('home')}}">
                    <img src="{{asset(@$setting->logo)}}" alt="" class="img-logo">
                </a>
                <div class="content-bottom-header">
                    <form action="{{route('product.search')}}" method="GET" class="box-search">
                        <div class="box-input-search">
                            <input type="text" class="input-search-header" name="keySearch" value="{{request()->get('keySearch')}}"
                                   placeholder="Nhập từ khoá hoặc link sản phẩm trên 1688 để tìm kiếm">
                        </div>
                        <button type="submit" class="box-btn-search">
                            <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                            <div class="title-btn-search">
                                Tìm kiếm
                            </div>
                        </button>
                    </form>
                    <div class="search-camera">
                        <i class="fa-solid fa-camera"></i>
                        <div>Tìm bằng ảnh</div>
                    </div>
                </div>
                <a href="">
                    <img src="{{asset('assets/images/extension.png')}}" alt="" class="img-extension">
                </a>
            </div>
        </div>
        @elseif($activeHeader == 2)
        <div class="header-bottom">
            <div class="box-content header-content header-content-bottom">
                <a href="{{route('taobao.home')}}">
                    <img src="{{asset(@$setting->logo)}}" alt="" class="img-logo">
                </a>
                <div class="content-bottom-header">
                    <form action="{{route('taobao.product.search')}}" method="GET" class="box-search">
                        <div class="box-input-search">
                            <input type="text" class="input-search-header" name="keySearch" value="{{request()->get('keySearch')}}"
                                   placeholder="Nhập từ khoá hoặc link sản phẩm trên taobao để tìm kiếm">
                        </div>
                        <button type="submit" class="box-btn-search">
                            <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                            <div class="title-btn-search">
                                Tìm kiếm
                            </div>
                        </button>
                    </form>
                    <div class="search-camera">
                        <i class="fa-solid fa-camera"></i>
                        <div>Tìm bằng ảnh</div>
                    </div>
                </div>
                <a href="">
                    <img src="{{asset('assets/images/extension.png')}}" alt="" class="img-extension">
                </a>
            </div>
        </div>
    @else
        <div class="d-flex justify-content-center align-items-center gap-5">
            <a class="cta" href="{{route('home')}}">
                <span>1688</span>
                <span>
                      <svg width="60px" height="20px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg"
                           xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <path class="one"
                                d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="two"
                                d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="three"
                                d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                fill="#FFFFFF"></path>
                        </g>
                      </svg>
                </span>
            </a>
            <a class="cta" href="{{route('taobao.home')}}">
                <span>TaoBao</span>
                <span>
                      <svg width="60px" height="20px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg"
                           xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <path class="one"
                                d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="two"
                                d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="three"
                                d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                fill="#FFFFFF"></path>
                        </g>
                      </svg>
                </span>
            </a>
        </div>
    @endif
</div>

<div class="box-header-mobile">
    @if($activeHeader == 1)
    <a href="{{route('home')}}" class="link-logo-page">
        <img src="{{asset(@$setting->logo)}}" alt="" class="img-logo">
    </a>
    <div class="content-bottom-header">
        <form action="{{route('product.search')}}" method="GET" class="box-search">
            <div class="box-input-search">
                <input type="text" class="input-search-header" name="keySearch" value="{{request()->get('keySearch')}}"
                       placeholder="Nhập từ khoá sản phẩm trên 1688 để tìm kiếm">
            </div>
            <button type="submit" class="box-btn-search">
                <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                <div class="title-btn-search">
                    Tìm kiếm
                </div>
            </button>
        </form>
        <div class="search-camera">
            <i class="fa-solid fa-camera"></i>
        </div>
    </div>
        <button class="btn-menu-mobile" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
                aria-controls="offcanvasMenu"><i class="fa-solid fa-bars"></i></button>
        @elseif($activeHeader == 2)
        <a href="{{route('taobao.home')}}" class="link-logo-page">
            <img src="{{asset(@$setting->logo)}}" alt="" class="img-logo">
        </a>
        <div class="content-bottom-header">
            <form action="{{route('taobao.product.search')}}" method="GET" class="box-search">
                <div class="box-input-search">
                    <input type="text" class="input-search-header" name="keySearch" value="{{request()->get('keySearch')}}"
                           placeholder="Nhập từ khoá sản phẩm trên taobao để tìm kiếm">
                </div>
                <button type="submit" class="box-btn-search">
                    <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                    <div class="title-btn-search">
                        Tìm kiếm
                    </div>
                </button>
            </form>
            <div class="search-camera">
                <i class="fa-solid fa-camera"></i>
            </div>
        </div>
        <button class="btn-menu-mobile" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenuTaoBao"
                aria-controls="offcanvasMenu"><i class="fa-solid fa-bars"></i></button>
    @else
        <div class="d-flex justify-content-center align-items-center gap-5 w-100 line-btn-web">
            <a class="cta" href="{{route('home')}}">
                <span>1688</span>
                <span>
                      <svg width="60px" height="20px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg"
                           xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <path class="one"
                                d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="two"
                                d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="three"
                                d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                fill="#FFFFFF"></path>
                        </g>
                      </svg>
                </span>
            </a>
            <a class="cta" href="{{route('taobao.home')}}">
                <span>TaoBao</span>
                <span>
                      <svg width="60px" height="20px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg"
                           xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <path class="one"
                                d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="two"
                                d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                          <path class="three"
                                d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                fill="#FFFFFF"></path>
                        </g>
                      </svg>
                </span>
            </a>
        </div>
        @endif
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title title-menu-mobile" id="offcanvasRightLabel">Danh mục</h5>
        <button type="button" class="btn-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body pt-0">
        <div class="accordion" id="accordionExample">
            @foreach($category as $index => $cate)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_{{$index}}">
                        <button class="accordion-button accordion-menu" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{$index}}" aria-expanded="false"
                                aria-controls="collapse_{{$index}}">
                            <a href="{{route('category',$cate->slug)}}" class="d-flex align-center gap-3 py-1">
                                {{--                            <img src="{{asset('assets/images/Thoi_trang.png')}}" alt="" class="img-category">--}}
                                <span class="item-category" style="color: black">{{$cate->name}}</span>
                            </a>
                        </button>
                    </h2>
                    <div id="collapse_{{$index}}" class="accordion-collapse collapse"
                         aria-labelledby="heading_{{$index}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach($cate->children as $cate2)
                                <a href="{{url('danh-muc/'.$cate->slug.'/'.$cate2->slug)}}" class="title-big-category"
                                   style="font-weight: 600;color: #1a1a1a">{{$cate2->name}}</a>
                                <div class="d-flex align-items-center flex-wrap mb-2 gap-2">
                                    @foreach($cate2->grandchildren as $cate3)
                                        <a href="{{url('danh-muc/'.$cate->slug.'/'.$cate2->slug.'/'.$cate3->slug)}}"
                                           class="title-small-category">{{$cate3->name}}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenuTaoBao" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title title-menu-mobile" id="offcanvasRightLabel">Danh mục</h5>
        <button type="button" class="btn-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body pt-0">
        <div class="accordion" id="accordionExample">
            @foreach($categoryTaobao as $index => $cate)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_{{$index}}">
                        <button class="accordion-button accordion-menu" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{$index}}" aria-expanded="false"
                                aria-controls="collapse_{{$index}}">
                            <a href="{{route('taobao.category',$cate->slug)}}" class="d-flex align-center gap-3 py-1">
                                {{--                            <img src="{{asset('assets/images/Thoi_trang.png')}}" alt="" class="img-category">--}}
                                <span class="item-category" style="color: black">{{$cate->name}}</span>
                            </a>
                        </button>
                    </h2>
                    <div id="collapse_{{$index}}" class="accordion-collapse collapse"
                         aria-labelledby="heading_{{$index}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach($cate->children as $cate2)
                                <a href="{{url('taobao/danh-muc/'.$cate->slug.'/'.$cate2->slug)}}" class="title-big-category"
                                   style="font-weight: 600;color: #1a1a1a">{{$cate2->name}}</a>
                                <div class="d-flex align-items-center flex-wrap mb-2 gap-2">
                                    @foreach($cate2->grandchildren as $cate3)
                                        <a href="{{url('taobao/danh-muc/'.$cate->slug.'/'.$cate2->slug.'/'.$cate3->slug)}}"
                                           class="title-small-category">{{$cate3->name}}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
