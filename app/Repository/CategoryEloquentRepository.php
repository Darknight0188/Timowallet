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

      /**
       * Build an array of category id that belong to the $parent id
       * 
       * @param int $id
       * @param collection $list
       * @return array $child
       */
      public function _findChild($parent, $list){
          $_child = $list->where('parent_id',$parent);

          if($_child->count()>0){
              foreach ($_child as $item) {
                  $child[] = $item->id;
                  $new = $this->_findChild($item->id, $list);
                  if($new != null) {
                      $child = array_merge($child, $new);
                  }
              }
          } else {
              $child = null;
          }
          return $child;
      }

      public function restore($id){
          $record = $this->find($id);

          $parent = $this->find($record->parent_id);

          if($parent->delete_flag != null){
              $parent = $this->query()->where('type',$record->type)->where('parent_id',0)->first();
              $record->parent_id = $parent_id;
          }

          $record->delete_flag = null;

          $record->save();
      }
}