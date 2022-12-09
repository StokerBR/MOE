<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        @foreach ($menu as $item)

            @php

                // $prefix = dynPrefix();
                $prefix = '/';

                $hasChildren = isset($item['children']) && count($item['children']) > 0;
                $url = "#";

                if ($hasChildren) {

                    $item["active"] = false;

                    foreach ($item["children"] as $index => $child) {

                        $active = request()->is($prefix.'/'.$child["url"]."*");
                        $item["children"][$index]["active"] = $active;

                        if ($active) {
                            $item["active"] = true;
                        }
                    }

                } else {

                    if ($item["url"] == '/') {
                        $item["active"] = request()->is($prefix);
                    } else {
                        $item["active"] = request()->is($prefix.'/'.$item['url'].'*');
                    }
                }

            @endphp

            <li class="nav-item {{ $item['active'] ? 'active' : '' }}">

                @if ($hasChildren)
                <a class="nav-link {{ $item['active'] ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="{{ $item['active'] ? 'true' : 'false' }}" aria-controls="ui-basic">
                @else
                <a class="nav-link" href="{{ dynUrl($item['url']) }}"">
                @endif

                    <span class="menu-title">{{ $item['name'] }}</span>
                    @if ($hasChildren)
                        <i class="menu-arrow"></i>
                    @endif
                    <i class="{{ $item['icon'] }} menu-icon"></i>

                </a>

                @if ($hasChildren)

                    <div class="collapse {{ $item['active'] ? 'show' : '' }}" id="ui-basic">

                        <ul class="nav flex-column sub-menu">

                            @foreach ($item['children'] as $child)
                                <li class="nav-item"><a class="nav-link {{ $child['active'] ? 'active' : '' }}" href="{{ dynUrl($child['url']) }}">{{ $child['name'] }}</a></li>
                            @endforeach

                        </ul>

                    </div>

                @endif

            </li>

        @endforeach

    </ul>

</nav>
