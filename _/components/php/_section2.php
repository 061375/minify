<h2>Section Two</h2>
<section>
    <?php
        // this just gives a loose idea to what you might use this for
        // the image list might be loaded from a folder or a database or array
        // then the result would be baked into the final HTML doc
        for($i = 0; $i < 8; $i++) {
            echo '<img src="http://placehold.it/200x200"/>'."\n";
        }
    ?>
</section>