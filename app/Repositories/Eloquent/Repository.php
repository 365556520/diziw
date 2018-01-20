<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;

abstract class Repository implements RepositoryInterface{
    /*App容器*/
    protected $app;
    /*操作model*/
    protected $model;
    public function __construct(Application $app) {
        $this->app = $app;
        $this->makeModel();
    }
    abstract function model();
    //返回一个实例的model
    public function makeModel(){
        $model = $this->app->make($this->model());
        /*是否是Model实例*/
        if (!$model instanceof Model){
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        $this->model = $model;
    }


    public function all($columns = ['*']){

        }

        public function find($id, $columns = ['*']){

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
         * Update a entity in repository by id
         *
         * @param array $attributes
         * @param       $id
         *
         * @return mixed
         */
        public function update(array $attributes, $id){

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