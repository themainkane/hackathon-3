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
                <?= $animal->name ?>
                (<?= $animal->breed ?>)
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="/">Home</a>


</body>
</html>