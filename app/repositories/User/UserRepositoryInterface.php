<?php
    namespace Repositories\User;

    use Illuminate\Database\Eloquent\Model;
    use App\User;

    interface UserRepositoryInterface{
        public function getAlllist();
        public function getListById($id);
    }