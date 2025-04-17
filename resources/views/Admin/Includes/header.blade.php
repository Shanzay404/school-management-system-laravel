<a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
</a>

<div class="profile-link">
   Dashboard: {{ Auth::user()->getRoleNames()->first() }}
</div>