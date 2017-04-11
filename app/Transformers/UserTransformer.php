<?php
namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    
    public function transform(User $o)
    {
        return [
            'id' => (int)$o->id,
            'name' => $o->name,
            'email' => $o->email,
            
        ];
    }    
}