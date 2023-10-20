@include('components.boiler-plate')

<h1>An Awesome Pet Clinic</h1>

<p>Bacon ipsum dolor amet tail pig landjaeger, shankle spare ribs kevin jerky chicken beef ribs sirloin brisket. Swine ground round porchetta buffalo tenderloin shoulder, jowl sausage leberkas landjaeger fatback doner sirloin chuck. Ham hock tongue pork shankle shank. Shankle meatball doner, ground round turkey picanha cupim t-bone bresaola andouille leberkas tri-tip short ribs pork chop.
</p>

<p>Brisket capicola tail ground round frankfurter jerky. Ham cow chislic, beef beef ribs hamburger prosciutto t-bone kevin meatball salami leberkas. Spare ribs brisket chicken flank swine. Biltong landjaeger shoulder chuck sausage. Pork loin pork chislic pork belly, shankle flank beef ribs meatloaf tongue beef ribeye salami t-bone ball tip. Biltong bresaola cow shoulder andouille brisket swine turducken pastrami beef ribs ribeye meatball picanha. Jowl frankfurter buffalo picanha boudin.</p>

 <h2>Search for an animal:</h2>

    <form action="/search" method="get">
        <input type="text" name="search">
        <button>Search</button>
    </form>


    <a href="/animals">List of Animals</a>
    <a href="/animals/create">Create new Animal</a>
    <a href="/animals/edit">Edit</a>
</body>
</html>