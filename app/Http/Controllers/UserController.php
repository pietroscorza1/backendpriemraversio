<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['membresia', 'clases'])->get();
        return response()->json($users);
    }
    public function membresia($id){
        $user = User::findOrFail($id);
        $memb = $user->membresia;
        if ($memb === null) {
            return response()->json(['message' => 'No tiene membresias'], 404);
        }
        return response()->json($user->membresia);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string|in:client,admin,trainer'
        ]);
        $validated['role'] = $validated['role'] ?? 'client';

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:8',
            'role' => 'nullable|string|in:client,admin,trainer',
            'fin_matricula' => 'date',
        ]);


        $user = User::findOrFail($id);
        $user->update($validated);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }

}
