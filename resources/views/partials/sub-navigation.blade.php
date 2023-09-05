<ul class="nav-group-items" style="height: 0px;">
  @if (isset($menu))
    @foreach ($menu as $submenu)
      {{-- active menu method --}}
      @php
        $activeClass = null;
        $active = 'active';
        $currentRouteName = Route::currentRouteName();

        if ($currentRouteName === $submenu->slug) {
            $activeClass = 'show';
        } elseif (isset($submenu->submenu)) {
            if (gettype($submenu->slug) === 'array') {
                foreach ($submenu->slug as $slug) {
                    if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                        $activeClass = $active;
                    }
                }
            } else {
                if (str_contains($currentRouteName, $submenu->slug) and strpos($currentRouteName, $submenu->slug) === 0) {
                    $activeClass = $active;
                }
            }
        }
      @endphp

      <li class="nav-item {{ $activeClass }}">
        <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}" class="{{ isset($submenu->submenu) ? 'nav-link nav-group-toggle' : 'nav-link' }}" @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
          @if (isset($submenu->icon))
            <i class="{{ 'nav-icon fa-regular fa-' . $submenu->icon }}"></i>
          @endif
          <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
        </a>

        {{-- submenu --}}
        @if (isset($submenu->submenu))
          @include('partials.sub-navigation', ['menu' => $submenu->submenu])
        @endif
      </li>
    @endforeach
  @endif
</ul>
