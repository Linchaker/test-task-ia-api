<?php

declare(strict_types=1);

namespace App\Models\Managers;

use App\Data\Service\MyServicesData;
use App\Data\Service\SearchServiceData;
use App\Helpers\Format;
use App\Models\Actor;
use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class ActorManager
{
    public static function getAll(int $perPage = null): Collection|LengthAwarePaginator
    {
        $query = Actor::query()
            ->orderByDesc('id');

        if ($perPage) {
            return $query->paginate($perPage);
        }
        return $query->get();
    }
}
