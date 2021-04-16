<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Http\Requests\User\UserRequest;

class UserController extends Controller
{

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Usuário cadastrado.');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Usuário deletado.');
    }

}
