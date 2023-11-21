<div class="myaccount-tab-menu nav" role="tablist">

    <a href="{{ route('home.user_profile.index') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
        <i class="sli sli-user ml-1"></i>
        پروفایل
    </a>

    <a href="#orders">
        <i class="sli sli-basket ml-1"></i>
        سفارشات
    </a>

    <a href="#address">
        <i class="sli sli-map ml-1"></i>
        آدرس ها
    </a>

    <a href="{{ route('home.user_profile.wishlist') }}" class="{{ request()->is('profile/wishlist') ? 'active' : '' }}">
        <i class="sli sli-heart ml-1"></i>
        لیست علاقه مندی ها
    </a>

    <a href="{{ route('home.user_profile.comments') }}" class="{{ request()->is('profile/comments') ? 'active' : '' }}">
        <i class="sli sli-bubble ml-1"></i>
        نظرات
    </a>

    <a href="#">
        <i class="sli sli-logout ml-1"></i>
        خروج
    </a>

</div>
