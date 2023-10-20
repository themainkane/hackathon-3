
@include('components.boiler-plate')

        
            <h1>Owner Directory</h1> 
                

                <ul>
                    @foreach ($owners as $owner) 
                    <li>
                        {{-- <a href="{{ route('owners.details', ['owner_id' => $owner->id]) }}"> </a> --}}
                            <h2>Owner: {{$owner->first_name }} {{$owner->surname}}</h2>
                    <br> 
                    </li>

                    @foreach ($owner->animal as $animal)

                   <li> <a href="{{ route('animals.details', ['animal_id' => $animal->id]) }}"> <h2>{{ $animal->name }}</h2></a></li>
                        
                    @endforeach
                    <br>
                    <br>
                    @endforeach 

                

                </ul>

                {{ $owners->links() }}

        </body>

</html>