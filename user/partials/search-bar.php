    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>user/pizza-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>