
<div class="sidebar-categories">
    <div class="head">Меню</div>
    <ul class="main-categories">
        <li class="common-filter">
            <form action="#">
                <ul class="user-menu-side-bar">

                    <a class="list-items {{ Request::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="list-items-icon fa fa-industry" aria-hidden="true"></i> <span>Основен панел</span>
                    </a>
                    <a class="{{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                        <i class="list-items-icon fa fa-industry" aria-hidden="true"></i> <span>Редакция на профил</span>
                    </a>

                </ul>
            </form>
        </li>
    </ul>
</div>