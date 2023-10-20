@include('components.boiler-plate')

    {{-- @include('components.messages') --}}

    <h1> Add pet </h1>

    @if ($animal->id)

        {{-- <form action="/movies/{{$movies->id}}" method="post"></form> --}}
      <form action="{{ route('animals.update', $animal->id)}}" method="post">   {{-- we define the route using the name in this case (movies.update) --}}

    @method('PUT')

    @else
    
    <form action="{{ route('animals.store') }}" method="post">    {{-- everything inside {{ }} is php --}}

    @endif

            @csrf    
            
            
            <label> Name </label>
            <br>
            <input name="name" value="{{old('name', $animal->name)}}" />
            <br>
            <br>
            <label> Species </label>
            <br>
            <input name="species" value="{{ old('species', $animal->species)}}" />
            <br>
            <br>
            <label> Breed </label>
            <br>
            <input name="breed" value="{{ old('breed', $animal->breed)}}" />
            <br>
            <br>
            <label> Age </label>
            <br>
            <input name="age" value="{{ old('age', $animal->age)}}" />
            <br>
            <br>
            <label> Weight </label>
            <br>
            <input name="weight" value="{{ old('weight', $animal->weight)}}" />
            <br>
            <br>
            <button>Save</button>
    </form>

    @if ($animal->id) 

        <form action="{{ route('animals.destroy', $animal->id)}}" method='post'>
            @method('DELETE')
            @csrf
            <button>Delete</button>

        </form>
        @endif
    
</body>
</html>








