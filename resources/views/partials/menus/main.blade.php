<nav>
    @foreach ($items as $menu_item)
        
        <a href="{{ $menu_item->link() }}" class="p-2 text-light">
            {{ $menu_item->title }}
        </a>
        
    @endforeach
</nav>
