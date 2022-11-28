<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a href="./" class="nav-link <?php echo (getCurrentPage() == 'index') ? 'active' : ''?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
        <?php 
                $category = new Category;
                $menu = $category->getMenu();
                if($menu){
                    foreach($menu as $items){
                        ?>
                <li class="nav-item">
                    <a href="category.php?id=<?php echo $items->id ?>" class="nav-link <?php echo (getCurrentPage() == 'category' && $_GET['id'] == $items->id) ? 'active' : ''?>">
                        <?php echo $items->title ?>
                            
                    </a></li>

                  <?php  
                    }
                }
         ?>
</ul>