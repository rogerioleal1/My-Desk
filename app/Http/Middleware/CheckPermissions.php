<?php

namespace App\Http\Middleware;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Closure;

class CheckPermissions
{
    use AuthorizesRequests;

    protected $replaceActions = [
        'store'  => 'create',
        'update' => 'edit',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->authorize($this->getPermission($request));

        return $next($request);
    }

    protected function getPermission($request)
    {
        [$controler, $action] = array_pad(explode('.', $request->route()->getName()), 2, null);

        if (in_array($action, array_keys($this->replaceActions))) {
            $action = $this->replaceActions[$request->route()->getActionMethod()];
            return $controler . '.' . $action;
        }

        return $request->route()->getName();
    }
}
