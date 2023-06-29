<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    private $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function create()
    {
        $all_cars = $this->car->all();

        return view('list.create')->with('all_cars', $all_cars);
    }

    public function add()
    {
        return view('list.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'year' => 'required',
            'model' => 'required',
            'manufacture' => 'required',
        ]);

        $car = new Car();
        $car->name = $request->name;
        $car->price = $request->price;
        $car->year = $request->year;
        $car->model = $request->model;
        $car->manufacture = $request->manufacture;
        $car->save();

        return redirect()->route('car.create');
    }

    public function edit($id)
    {
        $car = $this->car->findOrFail($id);

        return view('list.edit')->with('car', $car);
    }

    public function update(Request $request, $id)
    {
        $car = $this->car->findOrFail($id);
        $car->name = $request->name;
        $car->price = $request->price;
        $car->year = $request->year;
        $car->model = $request->model;
        $car->manufacture = $request->manufacture;
        $car->save();

        return redirect()->route('car.create');
    }

    public function destroy($id)
    {
        $car = $this->car->findOrFail($id);
        $car->delete();

        return redirect()->route('car.create');
    }

    public function destroyConfirmation($id)
    {
        $car = $this->car->findOrFail($id);

        return view('list.delete')->with('car', $car);
    }
}
