

@include('components.boiler-plate');
    
<div>
    {{-- <h4><a href="{{ route('animals.edit', $animal->id)}}">Edit Details </a></h4> --}}

    {{-- <form action="{{route('movies.destroy', $movie->id)}}" method="post">
    @method('DELETE');
    @csrf
    <button>Delete</button>
    </form> --}}

    </div>

    <h1>Animal Detials</h1>
    <br>
    <br>
      <div>
        <h4> Name: {{$animal->name}}</h4>
        <br>
        <h4>Type: {{$animal->species}}</h4>
        <br>
        <h4>Breed:{{$animal->breed}}</h4>
        <br>
        <p>Age: {{$animal->age}}    Weight {{$animal->weight}}</p>
      </div>
    
    <h2>Cast and crew</h2>

</body>

</html>