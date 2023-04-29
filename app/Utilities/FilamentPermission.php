<?php

namespace App\Utilities;

use Filament\Facades\Filament;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FilamentPermission
{
    public static function getResources(): \Illuminate\Support\Collection
    {
        return collect(Filament::getResources())
            ->unique()
            ->map(function ($resource) {
                $resource = app($resource);

                return [
                    'resource' => Str::of($resource::getSlug())->replace('-', '_'),
                    'label' => $resource::getPluralLabel(),
                    'model' => Str::of($resource::getModel())->replace('App\\Models\\', ''),
                    'class' => $resource::class,
                ];
            });
    }

    public static function getGeneralResourcePermissionPrefixes(): array
    {
        return [
            'view',
            'viewAny',
            'create',
            'update',
            'restore',
            'restoreAny',
            'replicate',
            'reorder',
            'delete',
            'deleteAny',
            'forceDelete',
            'forceDeleteAny',
            'export',
        ];
    }

    public static function getLocalizedResourcePermissionLabel($permission)
    {
        return Arr::get([
            'view' => 'View',
            'viewAny' => 'View All',
            'create' => 'Create',
            'update' => 'Update',
            'restore' => 'Restore',
            'restoreAny' => 'Restore All',
            'replicate' => 'Replicate',
            'reorder' => 'Reorder',
            'delete' => 'Delete',
            'deleteAny' => 'Delete All',
            'forceDelete' => 'Force Delete',
            'forceDeleteAny' => 'Force Delete All',
            'export' => 'Export',
        ], $permission, $permission);
    }

    public static function getSuperAdminName(): string
    {
        return 'super_admin';
    }

    public static function getFilamentUserRoleName(): string
    {
        return 'filament_user';
    }

    public static function getDefaultGuard()
    {
        return config('auth.guards.web_admin');
    }
}
