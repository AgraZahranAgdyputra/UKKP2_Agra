<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    private array $features = ['users', 'pengaduan', 'tanggapan', 'kategori'];
    private array $roles = ['admin', 'staff', 'customer'];

    public function index(): View
    {
        $permissions = RolePermission::all()->groupBy('role');

        return view('permissions.index', [
            'permissions' => $permissions,
            'features' => $this->features,
            'roles' => $this->roles,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        foreach ($this->roles as $role) {
            foreach ($this->features as $feature) {
                RolePermission::updateOrCreate(
                    ['role' => $role, 'feature' => $feature],
                    [
                        'can_view'   => $request->boolean("perm.{$role}.{$feature}.can_view"),
                        'can_create' => $request->boolean("perm.{$role}.{$feature}.can_create"),
                        'can_edit'   => $request->boolean("perm.{$role}.{$feature}.can_edit"),
                        'can_delete' => $request->boolean("perm.{$role}.{$feature}.can_delete"),
                    ]
                );
            }
        }

        return redirect()->route('permissions.index')->with('success', 'Hak akses berhasil diperbarui.');
    }
}
