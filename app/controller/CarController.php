<?php
namespace App\Controller;

use App\Models\Car;
use Core\BaseController;

class CarController extends BaseController{
    
    public function index(){

       /* add new */
        // echo 'new Car()';
        // $modelNew = new Car();
        // $modelNew->mark = 'NISSAN';
        // $modelNew->model = 'X-TRAIL';
        // $modelNew->motor = '3.0';
        // $modelNew->speed = '180';
        // $modelNew->year = '2018';
        // $modelNew->save();
        // dump($modelNew);

        /* get all */
        echo 'Car::all()';
        $result = Car::all();

        dump($result);
        
        // foreach($result as $item){
        //     dump($item);
        // }

        /* find by id*/
        // $model = Car::find(1);
        // dump($model->toArray());
        //dump($model->toJson());

        /* save update data if find result*/     
        // $model->mark = 'Chevrolet';
        // $model->model = 'Camaro';
        // $model->motor = '3.0';
        // $model->speed = '250';
        // $model->year= '2015';
        // $model->save();

    }

}