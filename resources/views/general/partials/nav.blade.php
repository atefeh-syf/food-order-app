<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                @foreach($foodMenus as $cat)
                    @foreach($cat->items as $foodMenu)
                        @if ($foodMenu->items->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('foodMenu.show', $foodMenu->id) }}" id="{{ $foodMenu->id }}"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $foodMenu->name }}</a>
                                <div class="dropdown-menu" aria-labelledby="{{ $foodMenu->id }}">
                                    @foreach($foodMenu->items as $item)
                                        <a class="dropdown-item" href="{{ route('foodMenu.show', $item->id) }}">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('foodMenu.show', $foodMenu->id) }}">{{ $foodMenu->name }}</a>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</nav>
