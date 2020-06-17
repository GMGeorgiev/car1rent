
<link href="{{ asset('css/reset.css') }}" rel="stylesheet">
<script src="{{ asset('js/admin-js.js') }}"></script>

    <div class="sidebar">

        <a class="{{ Request::is('admin/dashboard') ? ' active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fa fa-bar-chart"></i> <span>{{  __('language.dashboard')}}</span>
        </a>
        <a class="{{ Request::is('admin/users') ? ' active' : '' }}" href="{{ route('admin.users') }}">
            <i class="fa fa-group"></i> <span>{{  __('language.users')}}</span>
        </a>
        <li>
            <a href="#pageSubmenuCars" data-toggle="collapse" aria-expanded="{{ Request::is('admin/cars-settings*') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/cars-settings*') ? ' active' : '' }}"><i class="fa fa-car"></i> <span>{{  __('language.car-settings')}}</span></a>
            <ul class="collapse list-unstyled {{ Request::is('admin/cars-settings/*') ? 'collapse show' : '' }}" id="pageSubmenuCars">
                <li>
                    <a class="list-items {{ Request::is('admin/cars-settings/makers') ? ' active' : '' }}" href="{{ route('admin.cars-settings.makers') }}">
                        <i class="list-items-icon fa fa-industry" aria-hidden="true"></i> <span>{{  __('language.maker')}}</span>
                    </a>
                </li>
                <li>
                    <a class=" list-items {{ Request::is('admin/cars-settings/models') ? ' active' : '' }}" href="{{ route('admin.cars-settings.models') }}">
                        <i class="list-items-icon fa fa-th"></i> <span>{{  __('language.models')}}</span>
                    </a>
                </li>
                <li>
                    <a class=" list-items {{ Request::is('admin/cars-settings/cars') ? ' active' : '' }}" href="{{ route('admin.cars-settings.cars') }}">
                        <i class="list-items-icon fa fa-car"></i> <span>{{  __('language.cars')}}</span>
                    </a>
                </li>
                <li>
                    <a class="list-items {{ Request::is('admin/cars-settings/car-extras') ? ' active' : '' }}" href="{{ route('admin.cars-settings.car-extras') }}">
                        <i class="list-items-icon fa fa-cogs"></i> <span>{{  __('language.extras')}}</span>
                    </a>
                </li>
                <li>
                    <a class="list-items {{ Request::is('admin/cars-settings/fleets') ? ' active' : '' }}" href="{{ route('admin.cars-settings.fleets') }}">
                        <i class="list-items-icon fa fa fa-sitemap"></i> <span>{{  __('language.fleet-class')}}</span>
                    </a>
                </li>
                <li>
                    <a class="list-items {{ Request::is('admin/cars-settings/fuels') ? ' active' : '' }}" href="{{ route('admin.cars-settings.fuels') }}">
                        <i class="list-items-icon fa fa-tint"></i> <span>{{  __('language.fuels')}}</span>
                    </a>
                </li>
                <li>
                    <a class="list-items {{ Request::is('admin/cars-settings/coupes') ? ' active' : '' }}" href="{{ route('admin.cars-settings.coupes') }}">
                        <i class="list-items-icon fa fa-random"></i> <span>{{  __('language.coupes')}}</span>
                    </a>
                </li>
                <li>
                    <a class="list-items {{ Request::is('admin/cars-settings/sipp-code') ? ' active' : '' }}" href="{{ route('admin.cars-settings.sipp-code') }}">
                        <i class="list-items-icon fa fa-tags"></i> <span>SIPP Codes</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenuoficies" data-toggle="collapse" aria-expanded="{{ Request::is('admin/offices-settings*') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/offices-settings*') ? ' active' : '' }}"><i class="fa fa-globe"></i> <span>{{  __('language.office-settings')}}</span></a>
            <ul class="collapse list-unstyled {{ Request::is('admin/offices-settings/*') ? 'collapse show' : '' }}" id="pageSubmenuoficies">
                <li>
                    <a class="list-items {{ Request::is('admin/offices-settings/countries') ? ' active' : '' }}" href="{{ route('admin.offices-settings.countries') }}">
                        <i class="list-items-icon fa fa-flag"></i> <span>{{  __('language.countries')}}/{{  __('language.cities')}}</span>
                    </a>
                </li>
                <li>
                    <a class=" list-items {{ Request::is('admin/offices-settings/offices') ? ' active' : '' }}" href="{{ route('admin.offices-settings.offices') }}">
                        <i class="list-items-icon fa fa-building" aria-hidden="true"></i> <span>{{  __('language.offices')}}</span>
                    </a>
                </li>
                <li>
                    <a class=" list-items {{ Request::is('admin/offices-settings/city-to-city') ? ' active' : '' }}" href="{{ route('admin.offices-settings.city-to-city') }}">
                        <i class="list-items-icon fa fa-building" aria-hidden="true"></i> <span>{{  __('language.cityToCity')}}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenuPrices" data-toggle="collapse" aria-expanded="{{ Request::is('admin/prices-settings*') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/prices-settings*') ? ' active' : '' }}"><i class="fa fa-money"></i> <span>{{  __('language.prices-settings')}}</span></a>
            <ul class="collapse list-unstyled {{ Request::is('admin/prices-settings/*') ? 'collapse show' : '' }}" id="pageSubmenuPrices">
                <li>
                    <a class=" list-items {{ Request::is('admin/prices-settings/price-rules') ? ' active' : '' }}" href="{{ route('admin.prices-settings.price-rules') }}">
                        <i class="list-items-icon fa fa-eur" aria-hidden="true"></i> <span>{{  __('language.price-rules')}}</span>
                    </a>
                </li>
                <li>
                    <a class=" list-items {{ Request::is('admin/prices-settings/coupons') ? ' active' : '' }}" href="{{ route('admin.price-settings.coupons') }}">
                        <i class="list-items-icon fa fa-percent" aria-hidden="true"></i> <span>{{  __('language.coupons')}}</span>
                    </a>
                </li>

            </ul>
        </li>
        <li>
            <a href="#pageSubmenuRental" data-toggle="collapse" aria-expanded="{{ Request::is('admin/rental-settings*') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/rental-settings*') ? ' active' : '' }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Rental</span></a>
            <ul class="collapse list-unstyled {{ Request::is('admin/rental-settings/*') ? 'collapse show' : '' }}" id="pageSubmenuRental">
                <li>
                    <a class=" list-items {{ Request::is('admin/rental-settings/rent-extras') ? ' active' : '' }}" href="{{ route('admin.rental-settings-extras') }}">
                        <i class="list-items-icon fa fa-cubes" aria-hidden="true"></i> <span>Рент Екстри</span>
                    </a>
                </li>
                <li>
                    <a class=" list-items {{ Request::is('admin/rental-settings/insurance') ? ' active' : '' }}" href="{{ route('admin.rental-settings-insurance') }}">
                        <i class="list-items-icon fas fa-shield-alt"></i> <span>Рент Застраховки</span>
                    </a>
                </li>
                <li>
                    <a class=" list-items {{ Request::is('admin/rental-settings/settings') ? ' active' : '' }}" href="{{ route('admin.rental-settings-settings') }}">
                        <i class="list-items-icon fa fa-cogs" aria-hidden="true"></i> <span>Рент Настройки</span>
                    </a>
                </li>

            </ul>
        </li>


    </div>
{{--<div class="sidebar-categories">--}}
    {{--<div class="head">Меню</div>--}}
    {{--<ul class="main-categories">--}}
        {{--<li class="common-filter">--}}
            {{--<form action="#">--}}
                {{--<ul class="user-menu-side-bar">--}}

                    {{--<a class="{{ Request::is('admin/dashboard') ? ' active' : '' }}"--}}
                       {{--href="{{ route('admin.dashboard') }}">--}}
                        {{--<i class="fa fa-bar-chart"></i> <span>{{  __('language.dashboard')}}</span>--}}
                    {{--</a>--}}
                    {{--<a class="{{ Request::is('admin/users') ? ' active' : '' }}" href="{{ route('admin.users') }}">--}}
                        {{--<i class="fa fa-group"></i> <span>{{  __('language.users')}}</span>--}}
                    {{--</a>--}}
                    {{--<li>--}}
                        {{--<a href="#pageSubmenuCars" data-toggle="collapse"--}}
                           {{--aria-expanded="{{ Request::is('admin/cars-settings*') ? 'true' : 'false' }}"--}}
                           {{--class="dropdown-toggle {{ Request::is('admin/cars-settings*') ? ' active' : '' }}"><i--}}
                                    {{--class="fa fa-car"></i> <span>{{  __('language.car-settings')}}</span></a>--}}
                        {{--<ul class="collapse list-unstyled {{ Request::is('admin/cars-settings/*') ? 'collapse show' : '' }}"--}}
                            {{--id="pageSubmenuCars">--}}
                            {{--<li>--}}
                                {{--<a class="list-items {{ Request::is('admin/cars-settings/makers') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.makers') }}">--}}
                                    {{--<i class="list-items-icon fa fa-industry" aria-hidden="true"></i>--}}
                                    {{--<span>{{  __('language.maker')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/cars-settings/models') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.models') }}">--}}
                                    {{--<i class="list-items-icon fa fa-th"></i> <span>{{  __('language.models')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/cars-settings/cars') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.cars') }}">--}}
                                    {{--<i class="list-items-icon fa fa-car"></i> <span>{{  __('language.cars')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class="list-items {{ Request::is('admin/cars-settings/car-extras') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.car-extras') }}">--}}
                                    {{--<i class="list-items-icon fa fa-cogs"></i> <span>{{  __('language.extras')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class="list-items {{ Request::is('admin/cars-settings/fleets') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.fleets') }}">--}}
                                    {{--<i class="list-items-icon fa fa fa-sitemap"></i>--}}
                                    {{--<span>{{  __('language.fleet-class')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class="list-items {{ Request::is('admin/cars-settings/fuels') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.fuels') }}">--}}
                                    {{--<i class="list-items-icon fa fa-tint"></i> <span>{{  __('language.fuels')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class="list-items {{ Request::is('admin/cars-settings/coupes') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.coupes') }}">--}}
                                    {{--<i class="list-items-icon fa fa-random"></i>--}}
                                    {{--<span>{{  __('language.coupes')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class="list-items {{ Request::is('admin/cars-settings/sipp-code') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.cars-settings.sipp-code') }}">--}}
                                    {{--<i class="list-items-icon fa fa-tags"></i> <span>SIPP Codes</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#pageSubmenuoficies" data-toggle="collapse"--}}
                           {{--aria-expanded="{{ Request::is('admin/offices-settings*') ? 'true' : 'false' }}"--}}
                           {{--class="dropdown-toggle {{ Request::is('admin/offices-settings*') ? ' active' : '' }}"><i--}}
                                    {{--class="fa fa-globe"></i> <span>{{  __('language.office-settings')}}</span></a>--}}
                        {{--<ul class="collapse list-unstyled {{ Request::is('admin/offices-settings/*') ? 'collapse show' : '' }}"--}}
                            {{--id="pageSubmenuoficies">--}}
                            {{--<li>--}}
                                {{--<a class="list-items {{ Request::is('admin/offices-settings/countries') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.offices-settings.countries') }}">--}}
                                    {{--<i class="list-items-icon fa fa-flag"></i> <span>{{  __('language.countries')}}--}}
                                        {{--/{{  __('language.cities')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/offices-settings/offices') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.offices-settings.offices') }}">--}}
                                    {{--<i class="list-items-icon fa fa-building" aria-hidden="true"></i>--}}
                                    {{--<span>{{  __('language.offices')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#pageSubmenuPrices" data-toggle="collapse"--}}
                           {{--aria-expanded="{{ Request::is('admin/prices-settings*') ? 'true' : 'false' }}"--}}
                           {{--class="dropdown-toggle {{ Request::is('admin/prices-settings*') ? ' active' : '' }}"><i--}}
                                    {{--class="fa fa-money"></i> <span>{{  __('language.prices-settings')}}</span></a>--}}
                        {{--<ul class="collapse list-unstyled {{ Request::is('admin/prices-settings/*') ? 'collapse show' : '' }}"--}}
                            {{--id="pageSubmenuPrices">--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/prices-settings/price-rules') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.prices-settings.price-rules') }}">--}}
                                    {{--<i class="list-items-icon fa fa-eur" aria-hidden="true"></i>--}}
                                    {{--<span>{{  __('language.price-rules')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/prices-settings/coupons') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.price-settings.coupons') }}">--}}
                                    {{--<i class="list-items-icon fa fa-percent" aria-hidden="true"></i>--}}
                                    {{--<span>{{  __('language.coupons')}}</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#pageSubmenuRental" data-toggle="collapse"--}}
                           {{--aria-expanded="{{ Request::is('admin/rental-settings*') ? 'true' : 'false' }}"--}}
                           {{--class="dropdown-toggle {{ Request::is('admin/rental-settings*') ? ' active' : '' }}"><i--}}
                                    {{--class="fa fa-handshake-o" aria-hidden="true"></i> <span>Rental</span></a>--}}
                        {{--<ul class="collapse list-unstyled {{ Request::is('admin/rental-settings/*') ? 'collapse show' : '' }}"--}}
                            {{--id="pageSubmenuRental">--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/rental-settings/rent-extras') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.rental-settings-extras') }}">--}}
                                    {{--<i class="list-items-icon fa fa-cubes" aria-hidden="true"></i>--}}
                                    {{--<span>Рент Екстри</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/rental-settings/insurance') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.rental-settings-insurance') }}">--}}
                                    {{--<i class="list-items-icon fas fa-shield-alt"></i> <span>Рент Застраховки</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a class=" list-items {{ Request::is('admin/rental-settings/settings') ? ' active' : '' }}"--}}
                                   {{--href="{{ route('admin.rental-settings-settings') }}">--}}
                                    {{--<i class="list-items-icon fa fa-cogs" aria-hidden="true"></i>--}}
                                    {{--<span>Рент Настройки</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}

                {{--</ul>--}}
            {{--</form>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</div>--}}

