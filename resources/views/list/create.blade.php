@extends('layouts.app')

@section('title', 'Car | Index')

@section('content')
  <div class="row mt-3">
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
    @php
    $all_cars = $all_cars->toArray();

    $perPage = 4; // 1ページあたりの表示数

    $totalCars = count($all_cars);

    $totalPages = ceil($totalCars / $perPage);

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $offset = ($currentPage - 1) * $perPage;

    $cars = array_slice($all_cars, $offset, $perPage);

    @endphp
    @foreach($cars as $car)
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Car {{$car['id']}}</h5>
            <table class="table table-bordered">
              <tr>
                <td class="text-start">Name:</td>
                <td class="text-center">{{$car['name']}}</td>
              </tr>
              <tr>
                <td class="text-start">Price:</td>
                <td class="text-center">{{$car['price']}}</td>
              </tr>
              <tr>
                <td class="text-start">Year released:</td>
                <td class="text-center">{{$car['year']}}</td>
              </tr>
              <tr>
                <td class="text-start">Model:</td>
                <td class="text-center">{{$car['model']}}</td>
              </tr>
              <tr>
                <td class="text-start">Manufacture:</td>
                <td class="text-center">{{$car['manufacture']}}</td>
              </tr>
            </table>
          </div>
          <div class="card-footer">
            <a href="{{ route('car.destroy', ['id' => $car['id']]) }}" class="btn btn-danger float-start">Delete</a>
            <a href="{{route('car.edit', ['id' => $car['id']])}}" class="btn btn-outline-secondary float-end">Edit</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection

@section('footer')
  @if($totalPages > 1)
    <div class="pagination">
      <a href="#" class="page-numbers" id="prevPage">&lt;</a>
      @for($i = 1; $i <= $totalPages; $i++)
        <a href="#" class="page-numbers{{$i == $currentPage ? ' current' : ''}}" data-page="{{$i}}">{{$i}}</a>
      @endfor
      <a href="#" class="page-numbers" id="nextPage">&gt;</a>
    </div>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    // ページングのリンク要素とイベントリスナーを取得
    const pageLinks = document.querySelectorAll('.page-numbers');
    pageLinks.forEach(link => {
      link.addEventListener('click', (event) => {
        event.preventDefault();
        const page = event.target.dataset.page;
        if (page) {
          fetchData(page);
        }
      });
    });

    // データ取得関数
    function fetchData(page) {
      axios.get(`{{route('car.create')}}?page=${page}`)
        .then(response => {
          const data = response.data;
          const contentElement = document.querySelector('.row');
          contentElement.innerHTML = data.content;
          const paginationElement = document.querySelector('.pagination');
          paginationElement.innerHTML = data.pagination;
        })
        .catch(error => {
          console.error(error);
        });
    }
  </script>
@endsection
