@extends('layouts.app')

@section('content')
    <div class="card border-info mb-5">
        <div class="card-body">
            <a href="/datas" class="btn btn-outline-info text-left">Back</a>
            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#exampleModal">
                Delete Data
            </button>
        
            <h4 class="text-center">Name: <strong>{{$data->sensor->name}}</strong></h4>  
            <h5 class="text-center">Location: <strong>{{$data->sensor->location}}</strong></h5>
            <h5 class="text-center">Owner: <em>{{$data->sensor->user->name}}</em></h5>
            <hr> 
            <div class="show_container__custom text-center">
                <div class="item_group">
                    <img src="{{asset("storage/img/temperature.png")}}" alt="temperature">
                    <div class="details">
                        <h5>Air Temperature</h5>
                        <hr>
                        <h5>{{$data->temperature}} &deg;C</h5>
                    </div>
                </div>
                <div class="item_group">
                    <img src="{{asset("storage/img/humidity.png")}}" alt="humidity">
                    <div class="details">
                        <h5>Air Humidity</h5>
                        <hr>
                        <h5>{{$data->humidity}} %</h5>
                    </div>
                </div>
                <div class="item_group">
                    <img src="{{asset("storage/img/pressure.png")}}" alt="pressure">
                    <div class="details">
                        <h5>Air Pressure</h5>
                        <hr>
                        <h5>{{$data->pressure}} hPa</h5>
                    </div>
                </div>
            </div> 
            <hr class="">
            <div class="text-center">
                <h5>Reading moment: </h5> 
                <h5>{{$data->created_at}}</h5>
            </div>
        </div>
    </div> 

     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data? This action can be undone!
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form class="float-right" action="{{ action('DatasController@destroy', $data->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </div>
        </div>
        </div>
    </div>
@endsection