<?php

if (! function_exists('getModelForGuard')) {
    /**
<<<<<<< HEAD
     * @param string $guard
     *
=======
>>>>>>> main
     * @return string|null
     */
    function getModelForGuard(string $guard)
    {
        return collect(config('auth.guards'))
            ->map(function ($guard) {
                if (! isset($guard['provider'])) {
                    return;
                }

                return config("auth.providers.{$guard['provider']}.model");
            })->get($guard);
    }
}

if (! function_exists('setPermissionsTeamId')) {
    /**
<<<<<<< HEAD
     * @param int|string|\Illuminate\Database\Eloquent\Model $id
     *
=======
     * @param  int|string|\Illuminate\Database\Eloquent\Model  $id
>>>>>>> main
     */
    function setPermissionsTeamId($id)
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId($id);
    }
}

if (! function_exists('getPermissionsTeamId')) {
    /**
     * @return int|string
     */
    function getPermissionsTeamId()
    {
        return app(\Spatie\Permission\PermissionRegistrar::class)->getPermissionsTeamId();
    }
}
