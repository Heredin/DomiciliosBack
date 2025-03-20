<?php

namespace App\Customs\Services\Domicilio;

use App\Models\Domicilio;
use App\Models\User;

class DomicilioService
{
    public function create(array $data)
    {
        $domicilio = auth()->user()->domicilios()->create($data);
        return $domicilio;
    }
    public function updateDomicilio(Domicilio $domicilio, array $data)
    {
        $this->postAuthorizationCheck($domicilio);
        $domicilio->update($data);
        return $domicilio;
    }
    public function postAuthorizationCheck(Domicilio $domicilio)
    {
        #check if the user authorized to modify the domicilio
        if ($domicilio->user_id !== auth()->user()->id) {
            throw new \Illuminate\Auth\Access\AuthorizationException(message: 'You do not have permission to update or to access to this domicilio.');
        }
    }
    public function userDomicilios(User $user)
    {
        return $user->domicilios()->latest()->paginate(perPage: 10);
    }
    public function deleteDomicilios(Domicilio $domicilio)
    {
        $this->postAuthorizationCheck($domicilio);
        return $domicilio->delete();
    }
}
