<?php

namespace App\Http\Controllers;

use App\Http\Resources\SneakersResource;
use App\Models\Sneakers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SneakersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static $wrap = 'sneakers';

    public function index()
    {
        $sneakers = Sneakers::all();

        $my_sneakers=array();
        foreach($sneakers as $sneakers){
            array_push($my_sneakers,new SneakersResource($sneakers));
        }

        return $my_sneakers;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getByBrand($brand_id){
        $sneakers=Sneakers::get()->where('brand_id',$brand_id);

        if(count($sneakers)==0){
            return response()->json('Brand with this id does not exist!');
        }

        $my_sneakers=array();
        foreach($sneakers as $sneakers){
            array_push($my_sneakers,new SneakersResource($sneakers));
        }

        return $my_sneakers;
    }

    public function mySneakers(Request $request){
        $sneakers=Sneakers::get()->where('user_id',Auth::user()->id);
        if(count($sneakers)==0){
            return 'You do not have saved sneakers!';
        }
        $my_sneakers=array();
        foreach($sneakers as $sneakers){
            array_push($my_sneakers,new SneakersResource($sneakers));
        }

        return $my_sneakers;
    }

    public function getByType($type_id){
        $sneakers=Sneakers::get()->where('type_id',$type_id);

        if(count($sneakers)==0){
            return response()->json('ID of this type does not exist!');
        }

        $my_sneakers=array();
        foreach($sneakers as $sneakers){
            array_push($my_sneakers,new SneakersResource($sneakers));
        }

        return $my_sneakers;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'model'=>'required|String|max:255',
            'color'=>'required|String|max:255',
            'releaseYear'=>'required|Integer|max:2023',
            'brand_id'=>'required',
            'type_id'=>'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $sneakers=new Sneakers;
        $sneakers->model=$request->model;
        $sneakers->color=$request->color;
        $sneakers->releaseYear=$request->releaseYear;
        $sneakers->user_id=Auth::user()->id;
        $sneakers->type_id=$request->type_id;
        $sneakers->brand_id=$request->brand_id;

        $sneakers->save();

        return response()->json(['Sneakers is saved successfully!',new SneakersResource($sneakers)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sneakers  $sneakers
     * @return \Illuminate\Http\Response
     */
    public function show(Sneakers $sneakers)
    {
        return new SneakersResource($sneakers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sneakers  $sneakers
     * @return \Illuminate\Http\Response
     */
    public function edit(Sneakers $sneakers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sneakers  $sneakers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sneakers $sneakers)
    {
        $validator=Validator::make($request->all(),[
            'model'=>'required|String|max:255',
            'color'=>'required|String|max:255',
            'releaseYear'=>'required|Integer|max:2023',
            'brand_id'=>'required',
            'type_id'=>'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $sneakers->model=$request->model;
        $sneakers->color=$request->color;
        $sneakers->releaseYear=$request->releaseYear;
        $sneakers->user_id=Auth::user()->id;
        $sneakers->type_id=$request->type_id;
        $sneakers->brand_id=$request->brand_id;

        $result=$sneakers->update();

        if($result==false){
            return response()->json('Difficulty with updating!');
        }
        return response()->json(['Sneakers is updated successfully!',new SneakersResource($sneakers)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sneakers  $sneakers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sneakers $sneakers)
    {
        $sneakers->delete();

        return response()->json('Sneakers '.$auto->model .' is deleted successfully!');
    }
}
