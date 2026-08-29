<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = [
        'role',
        'feature',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
    ];

    protected function casts(): array
    {
        return [
            'can_view' => 'boolean',
            'can_create' => 'boolean',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean',
        ];
    }

    /**
     * Check if a role has a specific ability on a feature.
     */
    public static function allowed(string $role, string $feature, string $ability = 'can_view'): bool
    {
        $permission = static::where('role', $role)
            ->where('feature', $feature)
            ->first();

        if ($permission) {
            return (bool) $permission->{$ability};
        }

        // Default access fallback for initial setup until permissions are configured.
        $adminDefaults = ['users', 'pengaduan', 'tanggapan', 'kategori', 'permissions'];
        $staffDefaults = ['pengaduan', 'tanggapan'];
        $customerDefaults = ['pengaduan'];

        if ($role === 'admin') {
            return in_array($feature, $adminDefaults, true);
        }

        if ($role === 'staff') {
            return in_array($feature, $staffDefaults, true);
        }

        if ($role === 'customer') {
            return in_array($feature, $customerDefaults, true);
        }

        return false;
    }
}
