<?php

namespace Spatie\Permission\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Role
{
    /**
     * A role may be given various permissions.
<<<<<<< HEAD
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
=======
>>>>>>> main
     */
    public function permissions(): BelongsToMany;

    /**
     * Find a role by its name and guard name.
     *
<<<<<<< HEAD
     * @param string $name
     * @param string|null $guardName
     *
     * @return \Spatie\Permission\Contracts\Role
=======
     * @param  string|null  $guardName
>>>>>>> main
     *
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findByName(string $name, $guardName): self;

    /**
     * Find a role by its id and guard name.
     *
<<<<<<< HEAD
     * @param int $id
     * @param string|null $guardName
     *
     * @return \Spatie\Permission\Contracts\Role
=======
     * @param  string|null  $guardName
>>>>>>> main
     *
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findById(int $id, $guardName): self;

    /**
     * Find or create a role by its name and guard name.
     *
<<<<<<< HEAD
     * @param string $name
     * @param string|null $guardName
     *
     * @return \Spatie\Permission\Contracts\Role
=======
     * @param  string|null  $guardName
>>>>>>> main
     */
    public static function findOrCreate(string $name, $guardName): self;

    /**
     * Determine if the user may perform the given permission.
     *
<<<<<<< HEAD
     * @param string|\Spatie\Permission\Contracts\Permission $permission
     *
     * @return bool
=======
     * @param  string|\Spatie\Permission\Contracts\Permission  $permission
>>>>>>> main
     */
    public function hasPermissionTo($permission): bool;
}
