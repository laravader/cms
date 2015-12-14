<?php

namespace App\Providers;

use App\Helpers\Menu\MenuBuilder;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use UnexpectedValueException;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });

        $this->mapMenu($router, config('menu'));
    }

    private function mapMenu(Router $router, array $menus) {
        foreach ($menus as $menu) {
            if (is_array($menu)) {
                $this->mapMenu($router, $menu);
                continue;
            } else if (!$menu instanceof MenuBuilder) {
                throw new UnexpectedValueException("Expect menu to be instanceof MenuBuilder.");
            }

            $router->group(['namespace' => $menu->getNamespace()], function ($router) use ($menu) {
                $menu->registerRoutes($router);
            });
        }
    }
}
