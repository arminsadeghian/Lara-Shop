<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Dashboard -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin-panel/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Brands -->
    <li class="nav-item {{ request()->is('admin-panel/brands') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.brands.index') }}">
            <i class="fas fa-store"></i>
            <span> برند ها </span></a>
    </li>

    <!-- Nav Item - Products -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
           aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-shopping-cart"></i>
            <span> محصولات </span>
        </a>
        <div id="collapseProducts" class="collapse
        {{ request()->is('admin-panel/products*') ? 'show' : '' }}
        {{ request()->is('admin-panel/attributes*') ? 'show' : '' }}
        {{ request()->is('admin-panel/categories*') ? 'show' : '' }}"
             aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin-panel/products') ? 'active' : '' }}"
                   href="{{ route('admin.products.index') }}">محصولات</a>
                <a class="collapse-item {{ request()->is('admin-panel/attributes') ? 'active' : '' }}"
                   href="{{ route('admin.attributes.index') }}">ویژگی ها</a>
                <a class="collapse-item {{ request()->is('admin-panel/categories') ? 'active' : '' }}"
                   href="{{ route('admin.categories.index') }}">دسته بندی ها</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Banners -->
    <li class="nav-item {{ request()->is('admin-panel/banners') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.banners.index') }}">
            <i class="fas fa-images"></i>
            <span> بنر ها </span></a>
    </li>

    <!-- Nav Item - Tags -->
    <li class="nav-item {{ request()->is('admin-panel/tags') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tags.index') }}">
            <i class="fas fa-tags"></i>
            <span>تگ ها</span></a>
    </li>

    <!-- Nav Item - Gift -->
    <li class="nav-item {{ request()->is('admin-panel/coupons') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.coupons.index') }}">
            <i class="fas fa-gift"></i>
            <span>کد تخفیف</span></a>
    </li>

    <!-- Nav Item - Comments -->
    <li class="nav-item {{ request()->is('admin-panel/comments') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.comments.index') }}">
            <i class="fa fa-comment"></i>
            <span>کامنت ها</span></a>
    </li>

    <!-- Nav Item - Orders -->
    <li class="nav-item {{ request()->is('admin-panel/orders') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-money-check"></i>
            <span>سفارشات</span></a>
    </li>

    <!-- Nav Item - Transactions -->
    <li class="nav-item {{ request()->is('admin-panel/transactions') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.transactions.index') }}">
            <i class="fas fa-credit-card"></i>
            <span>تراکنش ها</span></a>
    </li>

    <!-- Nav Item - Contacts -->
    <li class="nav-item {{ request()->is('admin-panel/contacts') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.contacts.index') }}">
            <i class="fas fa-comment-alt"></i>
            <span>پیام های کاربران</span></a>
    </li>

    <!-- Nav Item - Exit -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.logout') }}">
            <i class="fas fa-sign-out-alt" style="font-size: 18px"></i>
            <span>خروج</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
