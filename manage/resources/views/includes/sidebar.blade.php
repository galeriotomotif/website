<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand sticky-top">
            <a href="#">{{ $siteName }}</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <div class="user-pic" style="--image:url('{{ (Auth::user()->avatar ? url(Auth::user()->avatar) : asset('images/no-avatar.png') ) }}')">
                {{-- @if (Auth::user()->avatar)
                <img class="img-responsive img-rounded"
                    src="{{ url(\App\Helpers\ImageThumbHelper::make(Auth::user()->avatar)) }}"
                    alt="User picture">
                @else
                <img class="img-responsive img-rounded"
                    src="{{asset('images/no-avatar.png')}}"
                    alt="User picture">
                @endif --}}

            </div>
            <div class="user-info">
                <span class="user-name text-bold text-dark">{{ ucwords(Auth::user()->name) }}
                </span>
                @foreach (Auth::user()->getRoleNames() as $role)
                    <span class="user-role">{{ ucwords($role) }}</span>
                @endforeach
                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span>
            </div>
        </div>
        {{-- <!-- sidebar-header  -->
        <div class="sidebar-search">
            <div>
                <div class="input-group">
                    <input type="text" class="form-control search-menu" placeholder="Search...">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar-search  --> --}}
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>Menu</span>
                </li>
                {{-- example --}}

                @foreach (Menu::get('primaryMenu')->roots() as $item)

                <li class="{{ ($item->hasChildren()? 'sidebar-dropdown' : 'sidebar-item' ) }} {{ ($item->isActive ? 'active' : '') }}">
                    <a href="{{ (!$item->hasChildren() ? $item->url() : '#' )}}">
                        <i class="fa {{ $item->attributes['icon'] }}"></i>
                        <span>{{$item->title}}</span>
                    </a>
                    @if ($item->hasChildren())
                    <div class="sidebar-submenu" style="{{ ($item->isActive ? 'display: block;' : '') }}">
                        <ul>
                            @foreach ($item->children() as $itemChildren)
                            <li class="{{ ($itemChildren->isActive ? 'active' : '') }}">
                                <a href="{{$itemChildren->url()}}">{{$itemChildren->title}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </li>

                @endforeach

                <li class="header-menu">
                    <span>Config</span>
                </li>
                {{-- example --}}

                @hasanyrole('superadmin|developer')

                @foreach (Menu::get('configMenu')->roots() as $item)

                <li class="{{ ($item->hasChildren()? 'sidebar-dropdown' : 'sidebar-item' ) }} {{ ($item->isActive ? 'active' : '') }}">
                    <a href="{{ (!$item->hasChildren() ? $item->url() : '#' )}}">
                        <i class="fa {{ $item->attributes['icon'] }}"></i>
                        <span>{{$item->title}}</span>
                    </a>
                    @if ($item->hasChildren())
                    <div class="sidebar-submenu" style="{{ ($item->isActive ? 'display: block;' : '') }}">
                        <ul>
                            @foreach ($item->children() as $itemChildren)
                            <li class="{{ ($itemChildren->isActive ? 'active' : '') }}">
                                <a href="{{$itemChildren->url()}}">{{$itemChildren->title}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </li>

                @endforeach

                @endhasanyrole


                {{-- end example --}}

                {{-- @foreach(Menu::get('primaryMenu')->roots() as $item)
                <li class="sidebar-item {{ ($item->isActive)? "active" : "" }}">
                <a href="{!! $item->url() !!}">
                    <i class="fa {{ $item->attributes['icon'] }}"></i>
                    <span>{{ $item->title }}</span>
                </a>
                </li>
                @endforeach --}}
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
        <a href="{{route('logout')}}"> <i class="fas fa-sign-out-alt text-dark"></i> Logout</a>
    </div>
</nav>
<!-- sidebar-wrapper  -->
