<?php
/**
 * Created by PhpStorm.
 * User: clyhs
 * Date: 2017/10/1
 * Time: 9:59
 */
namespace App\Http\Api\V1\Transformers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}