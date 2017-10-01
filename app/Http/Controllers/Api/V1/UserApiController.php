<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Transformers\UserTransformer;

class UserApiController extends BaseController
{
    //
    public function getUserInfo($id)
    {
        $user = User::findOrFail($id);
        return $this->response->item($user, new UserTransformer);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return $this->response->array($user->toArray());
    }

    public function index()
    {
        //$users = User::all();
        $user = User::all();
        return $this->response->collection($users, new UserTransformer);
    }

    public function page()
    {
        $users = User::paginate(25);

        return $this->response->paginator($users, new UserTransformer)->setStatusCode(200);
    }
}
