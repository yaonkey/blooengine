
<script>
(function($){
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);
</script>

<style>
    #dropdown-active:hover{
        background: none;
    }
    
    #category_items:hover{
        background:none;
        color:#6A5ACD;
    }
    
    #buy-button-dropdown:hover{
        background:none;
        color:#6A5ACD;
        text-decoration: none;
    }
    
    #buy-button-dropdown{
        margin-left:-65px;
    }
    
    li.dropdown.open{
        background: none;   
    }
    
    li.dropdown.open li{
        background: none;
    }
    
    li ul{
        background: none;
    }
    
    #buy-button-dropdown:focus{
        text-decoration: none;
        background: none;
    }
    
    a#buy-button-dropdown.dropdown-toggle{
        text-decoration: none;
        background: none;
    }
    
    li.dropdown::marker{
        background: none;
    }
    
    #dropdown-but-menu:hover{
        background:none;
        color:#6A5ACD;
        text-decoration: none;
    }
    
    #dropdown-but-menu:focus{
        background:none;
        color:#6A5ACD;
        text-decoration: none;
    }
</style>

<ul>
        <li class="dropdown">
            <a id='buy-button-dropdown' href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-dollar"></i> Купить <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a id='dropdown-active' href="/catalog/page-1">Показать все</a></li>
                    
                    <!-- Аксессуары -->
                    <li class='dropdown dropdown-submenu'>
                        <a id='dropdown-but-menu' href="#" class="dropdown-toggle" data-toggle="dropdown">Аксессуары <b class="caret"></b></a>
                            <ul class='dropdown-menu'> 
                                <?php 
                                    $categories = Category::getCategoriesList();
                                    foreach ($categories as $categoryItem): 
                                ?>          
                                <?php if ($categoryItem['type'] == 0): ?>
                            <li> <a id='category_items' href="/category/<?php echo $categoryItem['id'];?>">
                                <?php echo $categoryItem['name'];?>
                            </a></li>                
                            <?php endif ?>
                            <?php endforeach; ?>                                  
                            </ul>
                    </li>
                    
                    <!-- Кальяны -->
                    <li class='dropdown dropdown-submenu'>
                        <a id='dropdown-but-menu' href="#" class="dropdown-toggle" data-toggle="dropdown">Кальяны <b class="caret"></b></a>
                            <ul class='dropdown-menu'> 
                                <?php 
                                    $categories = Category::getCategoriesList();
                                    foreach ($categories as $categoryItem): 
                                ?>          
                                <?php if ($categoryItem['type'] == 1): ?>
                            <li> <a id='category_items' href="/category/<?php echo $categoryItem['id'];?>">
                                <?php echo $categoryItem['name'];?>
                            </a></li>                
                            <?php endif ?>
                            <?php endforeach; ?>  
                                
                            </ul>
                    </li>
                    
                    <!-- Уголь -->
                    <li class='dropdown dropdown-submenu'>
                        <a id='dropdown-but-menu' href="#" class="dropdown-toggle" data-toggle="dropdown">Уголь <b class="caret"></b></a>
                            <ul class='dropdown-menu'> 
                                <?php 
                                    $categories = Category::getCategoriesList();
                                    foreach ($categories as $categoryItem): 
                                ?>          
                                <?php if ($categoryItem['type'] == 2): ?>
                            <li> <a id='category_items' href="/category/<?php echo $categoryItem['id'];?>">
                                <?php echo $categoryItem['name'];?>
                            </a></li>                
                            <?php endif ?>
                            <?php endforeach; ?>  
                                
                            </ul>
                    </li>
                    
                    <!-- Чаши -->
                    <li class='dropdown dropdown-submenu'>
                        <a id='dropdown-but-menu' href="#" class="dropdown-toggle" data-toggle="dropdown">Чаши <b class="caret"></b></a>
                            <ul class='dropdown-menu'> 
                                <?php 
                                    $categories = Category::getCategoriesList();
                                    foreach ($categories as $categoryItem): 
                                ?>          
                                <?php if ($categoryItem['type'] == 3): ?>
                            <li> <a id='category_items' href="/category/<?php echo $categoryItem['id'];?>">
                                <?php echo $categoryItem['name'];?>
                            </a></li>                
                            <?php endif ?>
                            <?php endforeach; ?>  
                                
                            </ul>
                    </li>
                    
                    <!-- Кальянные смеси -->
                    <li class='dropdown dropdown-submenu'>
                        <a id='dropdown-but-menu' href="#" class="dropdown-toggle" data-toggle="dropdown">Кальянные смеси <b class="caret"></b></a>
                            <ul class='dropdown-menu'> 
                                <?php 
                                    $categories = Category::getCategoriesList();
                                    foreach ($categories as $categoryItem): 
                                ?>          
                                <?php if ($categoryItem['type'] == 4): ?>
                            <li> <a id='category_items' href="/category/<?php echo $categoryItem['id'];?>">
                                <?php echo $categoryItem['name'];?>
                            </a></li>                
                            <?php endif ?>
                            <?php endforeach; ?>  
                                
                            </ul>
                    </li>
                    
                     
           </ul>
        </li>
      </ul>
         