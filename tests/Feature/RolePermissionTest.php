<?php

namespace Tests\Feature;

use App\Models\RolePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_has_default_access_when_permission_rows_are_missing(): void
    {
        $this->assertTrue(RolePermission::allowed('admin', 'users', 'can_view'));
        $this->assertTrue(RolePermission::allowed('admin', 'pengaduan', 'can_view'));
    }
}
