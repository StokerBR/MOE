@if (isset($breadcrumb))

    <nav aria-label="breadcrumb">

        <ol class="breadcrumb">

            @foreach ($breadcrumb as $b)

                @if (isset($b['url']))
                    <li class="breadcrumb-item"><a href="{{ dynUrl($b['url']) }}">{{ $b['name'] }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $b['name'] }}</li>
                @endif

            @endforeach

        </ol>

    </nav>

@endif

<div class="page-header">

    <h3 class="page-title">

        @if (isset($icon))
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="{{ $icon }}"></i>
            </span>
        @endif

        {{ $title }}

    </h3>

	@yield("page-buttons")

</div>
