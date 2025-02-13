<?php

namespace Spatie\Permission;

use Illuminate\Support\Collection;
<<<<<<< HEAD
use Spatie\Permission\Exceptions\WildcardPermissionNotProperlyFormatted;

class WildcardPermission
=======
use Spatie\Permission\Contracts\Wildcard;
use Spatie\Permission\Exceptions\WildcardPermissionNotProperlyFormatted;

class WildcardPermission implements Wildcard
>>>>>>> main
{
    /** @var string */
    public const WILDCARD_TOKEN = '*';

    /** @var string */
    public const PART_DELIMITER = '.';

    /** @var string */
    public const SUBPART_DELIMITER = ',';

    /** @var string */
    protected $permission;

    /** @var Collection */
    protected $parts;

<<<<<<< HEAD
    /**
     * @param string $permission
     */
=======
>>>>>>> main
    public function __construct(string $permission)
    {
        $this->permission = $permission;
        $this->parts = collect();

        $this->setParts();
    }

    /**
<<<<<<< HEAD
     * @param string|WildcardPermission $permission
     *
     * @return bool
=======
     * @param  string|WildcardPermission  $permission
>>>>>>> main
     */
    public function implies($permission): bool
    {
        if (is_string($permission)) {
<<<<<<< HEAD
            $permission = new self($permission);
=======
            $permission = new static($permission);
>>>>>>> main
        }

        $otherParts = $permission->getParts();

        $i = 0;
<<<<<<< HEAD
        foreach ($otherParts as $otherPart) {
            if ($this->getParts()->count() - 1 < $i) {
                return true;
            }

            if (! $this->parts->get($i)->contains(self::WILDCARD_TOKEN)
=======
        $partsCount = $this->getParts()->count();
        foreach ($otherParts as $otherPart) {
            if ($partsCount - 1 < $i) {
                return true;
            }

            if (! $this->parts->get($i)->contains(static::WILDCARD_TOKEN)
>>>>>>> main
                && ! $this->containsAll($this->parts->get($i), $otherPart)) {
                return false;
            }

            $i++;
        }

<<<<<<< HEAD
        for ($i; $i < $this->parts->count(); $i++) {
            if (! $this->parts->get($i)->contains(self::WILDCARD_TOKEN)) {
=======
        for ($i; $i < $partsCount; $i++) {
            if (! $this->parts->get($i)->contains(static::WILDCARD_TOKEN)) {
>>>>>>> main
                return false;
            }
        }

        return true;
    }

<<<<<<< HEAD
    /**
     * @param Collection $part
     * @param Collection $otherPart
     *
     * @return bool
     */
=======
>>>>>>> main
    protected function containsAll(Collection $part, Collection $otherPart): bool
    {
        foreach ($otherPart->toArray() as $item) {
            if (! $part->contains($item)) {
                return false;
            }
        }

        return true;
    }

<<<<<<< HEAD
    /**
     * @return Collection
     */
=======
>>>>>>> main
    public function getParts(): Collection
    {
        return $this->parts;
    }

    /**
     * Sets the different parts and subparts from permission string.
<<<<<<< HEAD
     *
     * @return void
=======
>>>>>>> main
     */
    protected function setParts(): void
    {
        if (empty($this->permission) || $this->permission == null) {
            throw WildcardPermissionNotProperlyFormatted::create($this->permission);
        }

<<<<<<< HEAD
        $parts = collect(explode(self::PART_DELIMITER, $this->permission));

        $parts->each(function ($item, $key) {
            $subParts = collect(explode(self::SUBPART_DELIMITER, $item));
=======
        $parts = collect(explode(static::PART_DELIMITER, $this->permission));

        $parts->each(function ($item, $key) {
            $subParts = collect(explode(static::SUBPART_DELIMITER, $item));
>>>>>>> main

            if ($subParts->isEmpty() || $subParts->contains('')) {
                throw WildcardPermissionNotProperlyFormatted::create($this->permission);
            }

            $this->parts->add($subParts);
        });

        if ($this->parts->isEmpty()) {
            throw WildcardPermissionNotProperlyFormatted::create($this->permission);
        }
    }
}
