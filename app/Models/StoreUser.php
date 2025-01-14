<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Lazy\LazyUuidFromString;

class StoreUser implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable;
    use Authorizable;

    public function __construct(
        public string|null|LazyUuidFromString $id,
        public string $name,
        public string $avatar,
        public array $permissions,
        public Api $api,
    ) {
    }

    public function getKeyName(): string
    {
        return 'id';
    }

    public function getPermissions(): Collection
    {
        return Collection::make($this->permissions);
    }
}
