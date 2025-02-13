<?php

namespace Spatie\Permission\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Permission
{
    /**
     * A permission can be applied to roles.
<<<<<<< HEAD
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
=======
>>>>>>> main
     */
    public function roles(): BelongsToMany;

    /**
     * Find a permission by its name.
     *
<<<<<<< HEAD
     * @param string $name
     * @param string|null $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     *
     * @return Permission
=======
     * @param  string|null  $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
>>>>>>> main
     */
    public static function findByName(string $name, $guardName): self;

    /**
     * Find a permission by its id.
     *
<<<<<<< HEAD
     * @param int $id
     * @param string|null $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     *
     * @return Permission
=======
     * @param  string|null  $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
>>>>>>> main
     */
    public static function findById(int $id, $guardName): self;

    /**
     * Find or Create a permission by its name and guard name.
     *
<<<<<<< HEAD
     * @param string $name
     * @param string|null $guardName
     *
     * @return Permission
=======
     * @param  string|null  $guardName
>>>>>>> main
     */
    public static function findOrCreate(string $name, $guardName): self;
}
