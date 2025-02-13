<?php

namespace Spatie\Permission\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;
<<<<<<< HEAD
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\WildcardPermissionInvalidArgument;
=======
use Spatie\Permission\Contracts\Wildcard;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\WildcardPermissionInvalidArgument;
use Spatie\Permission\Exceptions\WildcardPermissionNotImplementsContract;
>>>>>>> main
use Spatie\Permission\Guard;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\WildcardPermission;

trait HasPermissions
{
    /** @var string */
    private $permissionClass;

<<<<<<< HEAD
=======
    /** @var string */
    private $wildcardClass;

>>>>>>> main
    public static function bootHasPermissions()
    {
        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && ! $model->isForceDeleting()) {
                return;
            }

<<<<<<< HEAD
            $model->permissions()->detach();
=======
            if (is_a($model, Permission::class)) {
                return;
            }

            $teams = PermissionRegistrar::$teams;
            PermissionRegistrar::$teams = false;
            $model->permissions()->detach();
            PermissionRegistrar::$teams = $teams;
>>>>>>> main
        });
    }

    public function getPermissionClass()
    {
        if (! isset($this->permissionClass)) {
            $this->permissionClass = app(PermissionRegistrar::class)->getPermissionClass();
        }

        return $this->permissionClass;
    }

<<<<<<< HEAD
=======
    protected function getWildcardClass()
    {
        if (! is_null($this->wildcardClass)) {
            return $this->wildcardClass;
        }

        $this->wildcardClass = false;

        if (config('permission.enable_wildcard_permission', false)) {
            $this->wildcardClass = config('permission.wildcard_permission', WildcardPermission::class);

            if (! is_subclass_of($this->wildcardClass, Wildcard::class)) {
                throw WildcardPermissionNotImplementsContract::create();
            }
        }

        return $this->wildcardClass;
    }

>>>>>>> main
    /**
     * A model may have multiple direct permissions.
     */
    public function permissions(): BelongsToMany
    {
        $relation = $this->morphToMany(
            config('permission.models.permission'),
            'model',
            config('permission.table_names.model_has_permissions'),
            config('permission.column_names.model_morph_key'),
            PermissionRegistrar::$pivotPermission
        );

        if (! PermissionRegistrar::$teams) {
            return $relation;
        }

        return $relation->wherePivot(PermissionRegistrar::$teamsKey, getPermissionsTeamId());
    }

    /**
     * Scope the model query to certain permissions only.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection $permissions
     *
     * @return \Illuminate\Database\Eloquent\Builder
=======
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  $permissions
>>>>>>> main
     */
    public function scopePermission(Builder $query, $permissions): Builder
    {
        $permissions = $this->convertToPermissionModels($permissions);

        $rolesWithPermissions = array_unique(array_reduce($permissions, function ($result, $permission) {
            return array_merge($result, $permission->roles->all());
        }, []));

        return $query->where(function (Builder $query) use ($permissions, $rolesWithPermissions) {
            $query->whereHas('permissions', function (Builder $subQuery) use ($permissions) {
                $permissionClass = $this->getPermissionClass();
                $key = (new $permissionClass())->getKeyName();
                $subQuery->whereIn(config('permission.table_names.permissions').".$key", \array_column($permissions, $key));
            });
            if (count($rolesWithPermissions) > 0) {
                $query->orWhereHas('roles', function (Builder $subQuery) use ($rolesWithPermissions) {
                    $roleClass = $this->getRoleClass();
                    $key = (new $roleClass())->getKeyName();
                    $subQuery->whereIn(config('permission.table_names.roles').".$key", \array_column($rolesWithPermissions, $key));
                });
            }
        });
    }

    /**
<<<<<<< HEAD
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection $permissions
     *
     * @return array
=======
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  $permissions
     *
>>>>>>> main
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     */
    protected function convertToPermissionModels($permissions): array
    {
        if ($permissions instanceof Collection) {
            $permissions = $permissions->all();
        }

        return array_map(function ($permission) {
            if ($permission instanceof Permission) {
                return $permission;
            }
            $method = is_string($permission) ? 'findByName' : 'findById';

            return $this->getPermissionClass()->{$method}($permission, $this->getDefaultGuardName());
        }, Arr::wrap($permissions));
    }

    /**
<<<<<<< HEAD
     * Determine if the model may perform the given permission.
     *
     * @param string|int|\Spatie\Permission\Contracts\Permission $permission
     * @param string|null $guardName
     *
     * @return bool
     * @throws PermissionDoesNotExist
     */
    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if (config('permission.enable_wildcard_permission', false)) {
            return $this->hasWildcardPermission($permission, $guardName);
        }

=======
     * Find a permission.
     *
     * @param  string|int|\Spatie\Permission\Contracts\Permission  $permission
     * @return \Spatie\Permission\Contracts\Permission
     *
     * @throws PermissionDoesNotExist
     */
    public function filterPermission($permission, $guardName = null)
    {
>>>>>>> main
        $permissionClass = $this->getPermissionClass();

        if (is_string($permission)) {
            $permission = $permissionClass->findByName(
                $permission,
                $guardName ?? $this->getDefaultGuardName()
            );
        }

        if (is_int($permission)) {
            $permission = $permissionClass->findById(
                $permission,
                $guardName ?? $this->getDefaultGuardName()
            );
        }

        if (! $permission instanceof Permission) {
            throw new PermissionDoesNotExist();
        }

<<<<<<< HEAD
=======
        return $permission;
    }

    /**
     * Determine if the model may perform the given permission.
     *
     * @param  string|int|\Spatie\Permission\Contracts\Permission  $permission
     * @param  string|null  $guardName
     *
     * @throws PermissionDoesNotExist
     */
    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if ($this->getWildcardClass()) {
            return $this->hasWildcardPermission($permission, $guardName);
        }

        $permission = $this->filterPermission($permission, $guardName);

>>>>>>> main
        return $this->hasDirectPermission($permission) || $this->hasPermissionViaRole($permission);
    }

    /**
     * Validates a wildcard permission against all permissions of a user.
     *
<<<<<<< HEAD
     * @param string|int|\Spatie\Permission\Contracts\Permission $permission
     * @param string|null $guardName
     *
     * @return bool
=======
     * @param  string|int|\Spatie\Permission\Contracts\Permission  $permission
     * @param  string|null  $guardName
>>>>>>> main
     */
    protected function hasWildcardPermission($permission, $guardName = null): bool
    {
        $guardName = $guardName ?? $this->getDefaultGuardName();

        if (is_int($permission)) {
            $permission = $this->getPermissionClass()->findById($permission, $guardName);
        }

        if ($permission instanceof Permission) {
            $permission = $permission->name;
        }

        if (! is_string($permission)) {
            throw WildcardPermissionInvalidArgument::create();
        }

<<<<<<< HEAD
=======
        $WildcardPermissionClass = $this->getWildcardClass();

>>>>>>> main
        foreach ($this->getAllPermissions() as $userPermission) {
            if ($guardName !== $userPermission->guard_name) {
                continue;
            }

<<<<<<< HEAD
            $userPermission = new WildcardPermission($userPermission->name);
=======
            $userPermission = new $WildcardPermissionClass($userPermission->name);
>>>>>>> main

            if ($userPermission->implies($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * An alias to hasPermissionTo(), but avoids throwing an exception.
     *
<<<<<<< HEAD
     * @param string|int|\Spatie\Permission\Contracts\Permission $permission
     * @param string|null $guardName
     *
     * @return bool
=======
     * @param  string|int|\Spatie\Permission\Contracts\Permission  $permission
     * @param  string|null  $guardName
>>>>>>> main
     */
    public function checkPermissionTo($permission, $guardName = null): bool
    {
        try {
            return $this->hasPermissionTo($permission, $guardName);
        } catch (PermissionDoesNotExist $e) {
            return false;
        }
    }

    /**
     * Determine if the model has any of the given permissions.
     *
<<<<<<< HEAD
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection ...$permissions
     *
     * @return bool
=======
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  ...$permissions
>>>>>>> main
     */
    public function hasAnyPermission(...$permissions): bool
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $permission) {
            if ($this->checkPermissionTo($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if the model has all of the given permissions.
     *
<<<<<<< HEAD
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection ...$permissions
     *
     * @return bool
     * @throws \Exception
=======
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  ...$permissions
>>>>>>> main
     */
    public function hasAllPermissions(...$permissions): bool
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $permission) {
<<<<<<< HEAD
            if (! $this->hasPermissionTo($permission)) {
=======
            if (! $this->checkPermissionTo($permission)) {
>>>>>>> main
                return false;
            }
        }

        return true;
    }

    /**
     * Determine if the model has, via roles, the given permission.
<<<<<<< HEAD
     *
     * @param \Spatie\Permission\Contracts\Permission $permission
     *
     * @return bool
=======
>>>>>>> main
     */
    protected function hasPermissionViaRole(Permission $permission): bool
    {
        return $this->hasRole($permission->roles);
    }

    /**
     * Determine if the model has the given permission.
     *
<<<<<<< HEAD
     * @param string|int|\Spatie\Permission\Contracts\Permission $permission
     *
     * @return bool
=======
     * @param  string|int|\Spatie\Permission\Contracts\Permission  $permission
     *
>>>>>>> main
     * @throws PermissionDoesNotExist
     */
    public function hasDirectPermission($permission): bool
    {
<<<<<<< HEAD
        $permissionClass = $this->getPermissionClass();

        if (is_string($permission)) {
            $permission = $permissionClass->findByName($permission, $this->getDefaultGuardName());
        }

        if (is_int($permission)) {
            $permission = $permissionClass->findById($permission, $this->getDefaultGuardName());
        }

        if (! $permission instanceof Permission) {
            throw new PermissionDoesNotExist();
        }
=======
        $permission = $this->filterPermission($permission);
>>>>>>> main

        return $this->permissions->contains($permission->getKeyName(), $permission->getKey());
    }

    /**
     * Return all the permissions the model has via roles.
     */
    public function getPermissionsViaRoles(): Collection
    {
        return $this->loadMissing('roles', 'roles.permissions')
            ->roles->flatMap(function ($role) {
                return $role->permissions;
            })->sort()->values();
    }

    /**
     * Return all the permissions the model has, both directly and via roles.
     */
    public function getAllPermissions(): Collection
    {
        /** @var Collection $permissions */
        $permissions = $this->permissions;

<<<<<<< HEAD
        if ($this->roles) {
=======
        if (method_exists($this, 'roles')) {
>>>>>>> main
            $permissions = $permissions->merge($this->getPermissionsViaRoles());
        }

        return $permissions->sort()->values();
    }

    /**
<<<<<<< HEAD
     * Grant the given permission(s) to a role.
     *
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection $permissions
     *
     * @return $this
     */
    public function givePermissionTo(...$permissions)
    {
        $permissions = collect($permissions)
=======
     * Returns permissions ids as array keys
     *
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  $permissions
     * @return array
     */
    public function collectPermissions(...$permissions)
    {
        return collect($permissions)
>>>>>>> main
            ->flatten()
            ->reduce(function ($array, $permission) {
                if (empty($permission)) {
                    return $array;
                }

                $permission = $this->getStoredPermission($permission);
                if (! $permission instanceof Permission) {
                    return $array;
                }

                $this->ensureModelSharesGuard($permission);

                $array[$permission->getKey()] = PermissionRegistrar::$teams && ! is_a($this, Role::class) ?
                    [PermissionRegistrar::$teamsKey => getPermissionsTeamId()] : [];

                return $array;
            }, []);
<<<<<<< HEAD
=======
    }

    /**
     * Grant the given permission(s) to a role.
     *
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  $permissions
     * @return $this
     */
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->collectPermissions(...$permissions);
>>>>>>> main

        $model = $this->getModel();

        if ($model->exists) {
            $this->permissions()->sync($permissions, false);
            $model->load('permissions');
        } else {
            $class = \get_class($model);

            $class::saved(
                function ($object) use ($permissions, $model) {
                    if ($model->getKey() != $object->getKey()) {
                        return;
                    }
                    $model->permissions()->sync($permissions, false);
                    $model->load('permissions');
                }
            );
        }

        if (is_a($this, get_class(app(PermissionRegistrar::class)->getRoleClass()))) {
            $this->forgetCachedPermissions();
        }

        return $this;
    }

    /**
     * Remove all current permissions and set the given ones.
     *
<<<<<<< HEAD
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection $permissions
     *
=======
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  $permissions
>>>>>>> main
     * @return $this
     */
    public function syncPermissions(...$permissions)
    {
        $this->permissions()->detach();

        return $this->givePermissionTo($permissions);
    }

    /**
<<<<<<< HEAD
     * Revoke the given permission.
     *
     * @param \Spatie\Permission\Contracts\Permission|\Spatie\Permission\Contracts\Permission[]|string|string[] $permission
     *
=======
     * Revoke the given permission(s).
     *
     * @param  \Spatie\Permission\Contracts\Permission|\Spatie\Permission\Contracts\Permission[]|string|string[]  $permission
>>>>>>> main
     * @return $this
     */
    public function revokePermissionTo($permission)
    {
        $this->permissions()->detach($this->getStoredPermission($permission));

        if (is_a($this, get_class(app(PermissionRegistrar::class)->getRoleClass()))) {
            $this->forgetCachedPermissions();
        }

        $this->load('permissions');

        return $this;
    }

    public function getPermissionNames(): Collection
    {
        return $this->permissions->pluck('name');
    }

    /**
<<<<<<< HEAD
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection $permissions
     *
=======
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  $permissions
>>>>>>> main
     * @return \Spatie\Permission\Contracts\Permission|\Spatie\Permission\Contracts\Permission[]|\Illuminate\Support\Collection
     */
    protected function getStoredPermission($permissions)
    {
        $permissionClass = $this->getPermissionClass();

        if (is_numeric($permissions)) {
            return $permissionClass->findById($permissions, $this->getDefaultGuardName());
        }

        if (is_string($permissions)) {
            return $permissionClass->findByName($permissions, $this->getDefaultGuardName());
        }

        if (is_array($permissions)) {
<<<<<<< HEAD
=======
            $permissions = array_map(function ($permission) use ($permissionClass) {
                return is_a($permission, get_class($permissionClass)) ? $permission->name : $permission;
            }, $permissions);

>>>>>>> main
            return $permissionClass
                ->whereIn('name', $permissions)
                ->whereIn('guard_name', $this->getGuardNames())
                ->get();
        }

        return $permissions;
    }

    /**
<<<<<<< HEAD
     * @param \Spatie\Permission\Contracts\Permission|\Spatie\Permission\Contracts\Role $roleOrPermission
=======
     * @param  \Spatie\Permission\Contracts\Permission|\Spatie\Permission\Contracts\Role  $roleOrPermission
>>>>>>> main
     *
     * @throws \Spatie\Permission\Exceptions\GuardDoesNotMatch
     */
    protected function ensureModelSharesGuard($roleOrPermission)
    {
        if (! $this->getGuardNames()->contains($roleOrPermission->guard_name)) {
            throw GuardDoesNotMatch::create($roleOrPermission->guard_name, $this->getGuardNames());
        }
    }

    protected function getGuardNames(): Collection
    {
        return Guard::getNames($this);
    }

    protected function getDefaultGuardName(): string
    {
        return Guard::getDefaultName($this);
    }

    /**
     * Forget the cached permissions.
     */
    public function forgetCachedPermissions()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Check if the model has All of the requested Direct permissions.
<<<<<<< HEAD
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection ...$permissions
     * @return bool
=======
     *
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  ...$permissions
>>>>>>> main
     */
    public function hasAllDirectPermissions(...$permissions): bool
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $permission) {
            if (! $this->hasDirectPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the model has Any of the requested Direct permissions.
<<<<<<< HEAD
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection ...$permissions
     * @return bool
=======
     *
     * @param  string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection  ...$permissions
>>>>>>> main
     */
    public function hasAnyDirectPermission(...$permissions): bool
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $permission) {
            if ($this->hasDirectPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
