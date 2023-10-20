
@include('components.boiler-plate')

                        <h1>Owners Directory</h1>
                <a href="/">Home</a>

                <table>
                    <tr>
                        <th>Owner's Name</th>
                        <th>Animals</th>
                    </tr>

                    @foreach ($owners as $owner)  
                    <tr>   
                            <td>Owner: {{$owner->first_name }} {{$owner->surname}}</td>
                    @foreach ($owner->animal as $animal)
                    
                            <td><a href="{{ route('animals.details', ['animal_id' => $animal->id]) }}"> <p>{{ $animal->name }}</p></a></td>

                     </tr>
                    @endforeach 
                     @endforeach 
                </table>

               {{ $owners->links() }}
           

        </body>

</html>