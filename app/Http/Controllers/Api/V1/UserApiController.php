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
}
