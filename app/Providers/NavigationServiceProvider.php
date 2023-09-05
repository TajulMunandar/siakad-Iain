<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $sidebarMenuJson = file_get_contents(base_path('resources/menu/sidebarMenu.json'));
    $sidebarMenuData = json_decode($sidebarMenuJson);

    // Share all menuData to all the views
    View::share('menuData', [$sidebarMenuData]);
  }
}
