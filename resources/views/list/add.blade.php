@extends('layouts.app')

@section('title', 'Car | Add')

@section('content')
  <div class="row">
    <div class="col-4">
      <table class="table table-bordered table-hover">
        <tr>
          <td>
            <a href="{{route('car.create')}}" class="text-dark" style="text-decoration: none;">Car index</a>
          </td>
        </tr>
        <tr>
          <td>
            <a href="{{route('car.add')}}" class="text-dark" style="text-decoration: none;">Add a new car</a>
          </td>
        </tr>
      </table>
    </div>
    <div class="col-8">
      <form action="{{ route('car.store')}}" method="POST">
        @csrf
        <!-- @method('PATCH')
        <input type="hidden" name="_method" value="PATCH">
         -->
        <input type="text" name="name" id="" class="form-control">
        <label for="name">Car name</label>

        <input type="number" name="price" id="" class="form-control">
        <label for="price">Car price</label>

        <input type="text" name="year" id="" class="form-control">
        <label for="year">Year released</label>

        <input type="text" name="model" id="" class="form-control">
        <label for="model">Car model</label>

        <input type="text" name="manufacture" id="" class="form-control">
        <label for="manufacture">Car manufacture</label><br>

        <button type="submit" class="btn btn-success w-25 mt-3">Save new car</button>
      </form>
    </div>
  </div>
@endsection
