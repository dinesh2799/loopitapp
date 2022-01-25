<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;
class CarController extends Controller
{
    private $status = 200;
    public function addCar(Request $request)
    {

        // validate inputs
        $validator = Validator::make($request->all(),
            [
                "model" => "required|unique:cars",
                "brand" => "required",
                "stock" => "required|numeric|min:0"
            ]
        );


        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }

        $car_id = $request->id;
        $available =$request->stock - $request->booked;
        $Array = array(
            "model" => $request->model,
            "brand" => $request->brand,
            "stock" => $request->stock,
            "booked" => $request->booked,
            "available" => $available,
        );

        if ($car_id != "") {
            $car = Car::find($car_id);
            if (!is_null($car)) {
                $updated_status = Car::where("id", $car_id)->update($Array);
                if ($updated_status == 1) {
                    return response()->json(["status" => $this->status, "success" => true, "message" => "Car detail updated successfully"]);
                } else {
                    return response()->json(["status" => "failed", "message" => "Whoops! failed to update, try again."]);
                }
            }
        } else {
            $available =0;
            $Array = array(
                "model" => $request->model,
                "brand" => $request->brand,
                "stock" => $request->stock,
                "booked" => $available,
                "available" => $request->stock,
            );
            $car = Car::create($Array);
            if (!is_null($car)) {
                return response()->json(["status" => $this->status, "success" => true, "message" => "Car record created successfully", "data" => $car]);
            } else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
            }
        }
    }

    public function cars()
    {
        $cars = Car::all();
        return response()->json([
            'status'=> 200,
            'cars'=>$cars,
        ]);
    }

    public function edit($id)
    {
        $car = Car::find($id);
        if($car)
        {
            return response()->json([
                'status'=> 200,
                'car' => $car,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Car ID Found',
            ]);
        }

    }

   public function update(Request $request, $id)
   {
       $value=$request->input('stock');
       $validator = Validator::make($request->all(),[
           "model" => "required",
           "brand" => "required",
           "stock" => "required|numeric|min:0",
           "booked" => "numeric|lte:$value|min:0"
       ]);

       if($validator->fails())
       {
           return response()->json([
               'status'=> 422,
               'validationErrors'=> $validator->messages(),
           ]);
       }
       else
       {
           $car = Car::find($id);
           if($car)
           {
               $car->model = $request->input('model');
               $car->brand = $request->input('brand');
               $car->stock = $request->input('stock');
               $car->booked = $request->input('booked');
               $car->available = $request->input('stock') - $request->input('booked');

               $car->update();

               return response()->json([
                   'status'=> 200,
                   'message'=>'Car Updated Successfully',
               ]);
           }
           else
           {
               return response()->json([
                   'status'=> 404,
                   'message' => 'No Car ID Found',
               ]);
           }
       }
   }


    public function destroy($id)
    {
        $car = Car::find($id);
        if($car)
        {
            $car->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Car Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Car Found',
            ]);
        }
    }


}
