<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
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
        try{
            Permission::get()->map(function($permission){
                Gate::define($permission->slug,function($user) use($permission){
                    return $user->hasPermissionTo($permission);
                });
            });
        }catch(\Exception $e){
            report($e);
            // return false;
        }


        // Create Blade Directive
        Blade::directive('role',function($role){
            $role = trim($role,"'\"");
            return "<?php if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->hasRole('{$role}')): ?>";
        });

        Blade::directive('endrole',function(){
            return "<?php endif; ?>";
        });

        //Create Blade Directive for Permissions
        Blade::directive('permission',function($permission){
            $cleaned  = trim($permission,"'");
            dd(auth()->guard('admin')->user()->permissions);
            dd(auth()->guard('admin')->user()->can($cleaned));
            return "<?php if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->can('{$cleaned}')): ?>";
        });

        Blade::directive('endpermission',function(){
            return "<?php endif; ?>";
        });
    }
}
