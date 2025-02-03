<?php

namespace App\Http\Controllers\ApiRestControllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct() {}

    public function listarRoles(Request $request) {
        $roles = Role::all();
        return response()->json(['roles' => $roles], 200);
    }
}
?>
