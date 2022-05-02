<html>
    <head>
        <title>Search Results</title>
    </head>

    <body>
        <h1>Search Results</h1>


        <p><a href='<?= BASE ?>/Account/home'>Back</a></p>
        <p><a href='<?= BASE ?>/Product/sortSearch/<?=$data['search_word'] ?>'>Sort results</a></p>
        
        <?php 
            if (isset($data['search_results'])) {
                foreach ($data['search_results'] as $search_result ) {
                    echo "<h2>$search_result->name</h2>";
                    echo "<p>$search_result->price $</p>";
                    //picture 
                    echo "<img src='$search_result->picture_path' alt='$search_result->name' width='200' height='200'>";
                }
            }
        ?>
    </body>
</html>