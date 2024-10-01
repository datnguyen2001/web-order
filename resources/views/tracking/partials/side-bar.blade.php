<!-- sidebar -->
<div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="{{route('admin.tracking.home.index')}}" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <i class="bi bi-bag-check-fill fs-4"></i>
                    </span>
            <span class="logo-text">Tracking Order</span>
        </a>
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
            <li><a class="m-link" href="{{route('admin.tracking.home.index')}}"><i class="icofont-home fs-5"></i> <span>Trang Chủ</span></a></li>
            <li><a class="m-link" href="{{route('admin.tracking.home.index')}}"><i class="icofont-notepad fs-5"></i> <span>Chi Tiết</span></a></li>
            <li><a class="m-link" href="{{route('admin.tracking.customer.index')}}"><i class="icofont-funky-man fs-5"></i> <span>Quản Lý Khách Hàng</span></a></li>
        </ul>
        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>
