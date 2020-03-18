<?php
namespace App\Repository;

use App\Repository\EloquentRepository;

class CategoryEloquentRepository extends EloquentRepository{
    /**
     * get model
     * @return string
     */

     public function getModel(){
         return \App\Category::class;
     }

     public function getAttributes(){
         return [
             'user_id',
             'type',
             'name',
             'parent_id'
         ];
     }

     /**
      * @return array $child
      * @param int $parent
      * Call the _findChild method to build an array of cat_id that belong to the specified id
      */

      public function findChild($parent){
          $list = $this->getAll();
          return $this->_findChild($parent,$lists);
      }
}