<?php
namespace App\Repository;

use App\Repository\EloquentRepository;

class UserEloquentRepository extends EloquentRepository{
    /**
     * get model
     * @return string
     */
    public function getModel(){
        return \App\User::class;
    }

    public function getAttributes(){
        return [
            'name',
            'email',
            'password',
            'phone',
            'address',
            'gender'
        ];
    }
}