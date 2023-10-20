@include('components.boiler-plate')

 <h1>Search results of Animals</h1>

    <h2>Animal name: <?= $search_term ?></h2>

    <form action="/search" method="get">
        <input type="text" name="search" value="<?= htmlspecialchars($search_term) ?>">
        <button>Search</button>
    </form>

    <ul>
        <?php foreach ($results as $animal) : ?>
            <li>
                <a href="{{ route('animals.details', ['animal_id' => $animal->id]) }}"> <h4>{{ $animal->name }}</h4></a>
                ( {{$animal->breed}})
    

        
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="/">Home</a>


</body>
</html>