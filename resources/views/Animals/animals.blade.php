
@include('components.boiler-plate')

        
            <h1>Pet Directory</h1> <ul> 
                

                <table>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Breed</th>
                    </tr>

                    @foreach ($animals as $animal) 
                    <tr>   

                            <td><a href="{{ route('animals.details', ['animal_id' => $animal->id]) }}"> <h2>{{ $animal->name }}</h2></a></td>
                            
                            <td>{{$animal->species}} </td> 
                        
                            <td> {{$animal->breed}} </td>
                     </tr>
                    @endforeach 
                </table>

                {{ $animals->links() }}

        </body>

</html>

{{-- @include('components.boiler-plate')

        
            <h1>Pet Directory</h1> <ul> 
                <a href="/">Home</a>
                <ul>
                    @foreach ($animals as $animal) 
                    <li>
                        <a href="{{ route('animals.details', ['animal_id' => $animal->id]) }}"> <h2>{{ $animal->name }}</h2></a>
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

</html> --}}

{{-- {{ $movie->genres->pluck('name')->implode(', ') }} --}}