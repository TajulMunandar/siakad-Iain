<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
  <li class="nav-item m-2">
    <a class="btn btn-outline-secondary py-2 text-white d-flex align-items-center" href="{{ route('dashboard') }}">
      <svg class="nav-icon text-white">
        <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
      </svg>
      {{ __('Kembali ke Dashboard') }}
    </a>
  </li>


  @foreach ($menuData[0]->menu as $menus)
    @if ($menus->parent === $desiredParent)
      @foreach ($menus->child as $menu)
        {{-- active menu method --}}
        @php
          $activeClass = null;
          $currentRouteName = Route::currentRouteName();

          if ($currentRouteName === $menu->slug) {
              $activeClass = 'active';
          } elseif (isset($menu->submenu)) {
              if (gettype($menu->slug) === 'array') {
                  foreach ($menu->slug as $slug) {
                      if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                          $activeClass = 'active';
                      }
                  }
              } else {
                  if (str_contains($currentRouteName, $menu->slug) and strpos($currentRouteName, $menu->slug) === 0) {
                      $activeClass = 'active';
                  }
              }
          }
        @endphp

        {{-- main menu --}}
        <li class="nav-group {{ $activeClass }}">
          <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'nav-link nav-group-toggle' : 'nav-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
            @isset($menu->icon)
              <i class="{{ 'nav-icon fa-regular fa-' . $menu->icon }}"></i>
            @endisset
            <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
          </a>

          {{-- submenu --}}
          @isset($menu->submenu)
            @include('partials.sub-navigation', ['menu' => $menu->submenu])
          @endisset
        </li>
      @endforeach
    @endif
  @endforeach
</ul>
