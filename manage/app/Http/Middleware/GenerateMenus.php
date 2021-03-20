<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('primaryMenu', function ($menu) {
            $menu->add('Dashboard', [
                'icon' => ' fa-tachometer-alt',
                'url' => 'dashboard'
            ])->active('dashboard/*');

            $menu->add('Page', [
                'icon' => 'fa-file',
                'url' => 'page/'
            ])->active('page/*');

            $menu->add('Blog', [
                'icon' => 'fa-database',
                'url' => 'blog'
            ]);

            $menu->blog->add('Category', [
                'icon' => 'fa-file',
                'url' => 'category/'
            ])->active('category/*');

            $menu->blog->add('Tag', [
                'icon' => 'fa-file',
                'url' => 'tag/'
            ])->active('tag/*');

            $menu->blog->add('Post', [
                'icon' => 'fa-file',
                'url' => 'post/'
            ])->active('post/*');
        });

        \Menu::make('configMenu', function ($menu) {
            // $menu->add('General', [
            //     'icon' => 'fa-cog',
            //     'url' => 'config/general'
            // ])->active('config/general/*');

            // $menu->add('User Management', [
            //     'icon' => 'fa-users',
            //     'url' => 'config/user-management'
            // ])->active('config/user-management/*');

            // $menu->userManagement->add('Role', [
            //     'icon' => 'fa-User',
            //     'url' => 'config/user-management/role'
            // ])->active('config/user-management/role/*');

            $menu->add('User', [
                'icon' => 'fa-users',
                'url' => 'user'
            ])->active('user/*');
        });

        return $next($request);
    }
}
