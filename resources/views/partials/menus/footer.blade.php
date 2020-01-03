<ul style="display: flex;list-style-type: none;overflow: hidden;min-width:300px;display:flex;justify-content:space-between;align-items:center;"> 
    @foreach ($items as $menu_item)
        @if ($menu_item->title === 'Follow me:')
            <li>{{ $menu_item->title }}</li>
        @endif
        <li style="float: left;">
            <a href="{{ $menu_item->link() }}" target="_blank" style="display: block;">
                <i class="fa {{ $menu_item->title }}" style="color:#FFF;"></i>
            </a>
        </li>
    @endforeach
</ul>






{{--<div style="min-width:200px;display:flex;justify-content:space-between;align-items:center;">
        Follow me: 
        <a href="https://www.facebook.com/profile.php?id=100026349160489" target="_blank">
            <i class="fa fa-facebook facebook" aria-hidden="true" style="color:#FFF;"></i>
        </a>
        <a href="https://vk.com/popadinets86" target="_blank">
            <i class="fa fa-vk vk" aria-hidden="true" style="color:#FFF;"></i>
        </a>
        <a href="https://github.com/Roman-Ast" target="_blank">
            <i class="fa fa-github github" aria-hidden="true" style="color:#FFF;"></i>
        </a>
        <a href="https://www.linkedin.com/in/roman-popadinets-7579ab182/" target="_blank">
            <i class="fa fa-linkedin linkedin" aria-hidden="true" style="color:#FFF;"></i>
        </a>
    <a href="https://twitter.com/Roman34015128" target="_blank">
        <i class="fa fa-twitter twitter" aria-hidden="true" style="color:#FFF;"></i>
    </a>
</div>--}}