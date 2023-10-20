


@include('components.boiler-plate')

        
            <h1>Pet Directory</h1> <ul> 
                <a href="/">Home</a>
                <ul>
                    @foreach ($animals as $animal) 
                    <li>
                        {{-- <a href="{{ route('animals.details', ['animal_id' => $animal->id]) }}"> </a>--}}
                    <h2>{{ $animal->name }}</h2>
                    <br> 
                    Type: {{$animal->species}} 
                    <br>
                    Breed: {{$animal->breed}}
                    <br>
                    <br>
                    </li>
                    @endforeach 
                </ul>

                {{ $animals->links() }}

        </body>

</html>

{{-- {{ $movie->genres->pluck('name')->implode(', ') }} --}}