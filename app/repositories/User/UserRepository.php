<?php
    namespace Repositories\User;

    use Illuminate\Database\Eloquent\Model;
    use App\User;

    class UserRepository implements UserRepositoryInterface{
        protected $user;
        public function __construct(User $user){
            $this->user = $user;
        }

        public function getAllList(){
            return $this->user->all();
        }

        public function getListById($id){
            return $this->user->findOrFail($id);
        }
    }