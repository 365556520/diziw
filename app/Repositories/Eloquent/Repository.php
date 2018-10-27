<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;
/*仓库实实现类接口*/
abstract class Repository implements RepositoryInterface{
    /*App容器*/
    protected $app;
    /*操作model*/
    protected $model;
    public function __construct(Application $app) {
        $this->app = $app;
        $this->makeModel();
    }
    //抽象方法（实现类必须重写这个抽象方法）
    abstract function model();
    //返回一个实例的model
    public function makeModel(){
        //Container类中 $this->app->make 方法来代替 new model()的Class:
        $model = $this->app->make($this->model());
        /*是否是Model实例不是抛出异常*/
        if (!$model instanceof Model){
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        $this->model = $model;
    }
    /*得到当前用户列表权限*/
    public function getUserPermissions($tableName){
        //得到权限
        $permissions = [
                       'show'=>auth()->user()->can(config('admin.permissions.'.$tableName.'.show')),//查看权限
                       'edit'=>auth()->user()->can(config('admin.permissions.'.$tableName.'.edit')),  //编辑权限
                       'delete'=>auth()->user()->can(config('admin.permissions.'.$tableName.'.delete'))];//删除权限
        return $permissions;
    }
    public function all($columns = ['*']){
        return $this->model->all($columns);
    }

    public function find($id, $columns = ['*']){
        return $this->model->select($columns)->find($id);
    }
        /**
         * Find data by field and value
         *
         * @param       $field
         * @param       $value
         * @param array $columns
         *
         * @return mixed
         */
        public function findByField($field, $value, $columns = ['*']){
            $model = new $this->model;
            return $model->where($field,$value)->get();
        }
        /**
         * Find data by multiple fields
         *
         * @param array $where
         * @param array $columns
         *
         * @return mixed
         */
        public function findWhere(array $where, $columns = ['*']){

        }
        /**
         * Find data by multiple values in one field
         *
         * @param       $field
         * @param array $values
         * @param array $columns
         *
         * @return mixed
         */
        public function findWhereIn($field, array $values, $columns = ['*']){

        }
        /**
         * Save a new entity in repository
         *
         * @param array $attributes
         *
         * @return mixed
         */
        public function create(array $attributes){
            $model = new $this->model;
            return $model->fill($attributes)->save();
        }
        /**
         * 根据id更新数组
         *
         * @param array $attributes
         * @param       $id
         *
         * @return mixed
         */
        public function update(array $attributes, $id){
            $model = $this->model->findOrFail($id);
            return  $model->fill($attributes)->save();
        }
        /**
         * Update or Create an entity in repository
         *
         * @throws ValidatorException
         *
         * @param array $attributes
         * @param array $values
         *
         * @return mixed
         */
        public function updateOrCreate(array $attributes, array $values = []){
        }
        /**
         * Delete a entity in repository by id
         *
         * @param $id
         *
         * @return int
         */
        public function delete($id){
            return $this->model->destroy($id);
        }
        /**
         * Order collection by a given column
         *
         * @param string $column
         * @param string $direction
         *
         * @return $this
         */
        public function orderBy($column, $direction = 'asc'){

        }
        /**
         * Load relations
         *
         * @param $relations
         *
         * @return $this
         */
        public function with($relations){

        }
}