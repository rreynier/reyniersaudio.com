<div id="store" class="whiteBox">
    <script type="text/javascript">
        function addtocart(tocart) {  
            
            $('form#' + tocart).submit();

        }
    </script>
    <div id="mainBar">

        <h1><?php echo $partType['title']; ?></h1>
        <?php echo $partType['longDesc']; ?>

        <div id="controls">
            <script>
                $(document).ready(function() {   
                    $('#controls h3').click( function(e) { 
                        e.stopPropagation();
                        $('#controls ul').show();                
                    })                      
                    $(document).click(  function() { 
                        $('#controls ul').hide(); 
                    });                
                })     

            </script>

            <?php foreach ($order_by_list as $order_by) {
                if($order_by['active']) { ?>

                    <h3><?php echo $order_by['title']; ?></h3>

                <?php }
            } ?>

            <ul>

                <?php foreach ($order_by_list as $order_by) {  ?>
                    <?php $class='';
                    if($order_by['active']) {
                        $class = 'class="active"';
                    }?>
                <li <?php echo $class; ?>>         
                    <a href="<?php echo $seo_title . $previous_filters . '&order_by=' . $order_by['url']; ?>"><span class="raquo">&raquo;</span> <?php echo $order_by['title']; ?></a>
                </li>
                    <?php } ?>
            </ul>  
                    
            <span class="resultCount">Showing: <?php echo count($parts); ?> result(s)</span>

        </div>

        <?php if($parts) { ?>
        <ul id="partList">
                <?php foreach ((array) $parts as $part) { ?>
            <li>
                <div class="col1">
                    <img src="/images/parts/tn/<?php echo $part['image_url']; ?>" title="<?php echo $part['part_img_title']; ?>" />
                </div>

                <div class="col2">
                    <h2>
                        <a href="<?php echo '/recording-computer-studio-gear/product/' . $part['part_id'] . '-' . clean($part['title']); ?>"><?php echo $part['part_title']; ?></a>
                    </h2>
                    <p class="shortDesc"><?php echo strip_tags(str_replace('<br />', ' - ' ,$part['part_short_desc'])); ?></p>
                            <?php
                            $DOM = new DOMDocument;
                            $DOM->loadHTML($part['long_desc']);
                            $paragraphs = $DOM->getElementsByTagName('p');

                            ?>
                    <div class="longDesc"><?php for ($i = 0; $i < 1; $i++)  echo '<p>' . get_snippet($paragraphs->item($i)->nodeValue,270) .
                                            ' <a href="/recording-computer-studio-gear/product/' . $part['part_id'] . '-' . clean($part['title']) . '">...</a></p>'; ?></div>
                    <a class="showDetails" href="<?php echo '/recording-computer-studio-gear/product/' . $part['part_id'] . '-' . clean($part['title']); ?>">Show Details</a>
                </div>
                <div class="col3">                    
                    <?php foreach($part['tags'] as $key=>$tag) {  if ($key == 'Brand') { ?>
                        <img id="brandImage" src="/images/brand/<?php echo strtolower(str_replace(' ','-',$tag)); ?>.png" title="<?php echo $tag; ?>" />
                    <?php } } ?>                    
                    <span class="price">
					<?php 
                        if($part['discount'] > 0) { 
							echo '<span class="saveAmount">Save $' . money($part['discount'],true,true) . '</span>';									
                            echo '<span class="discountedPrice">$' . money($part['part_price'],true,true) . '</span>';  
							echo '<span class="originalPrice">$' . money($part['part_cost'],true,true) . '</span>';          
                                                    
                        } else {
                            echo '<span class="normalPrice">$' . money($part['part_price'],true,true) . '</span>';      
                        }   
                    ?></span>
                    <div class="addToCartButton">
                        
                        <form method="post" id="part<?php echo ($part['part_id']); ?>" action="http://www.ewebcart.com/13951/cart">
                            <input type="hidden" name="name" value="<?php echo $part['title']; ?>">
                            <input type="hidden" name="description" value="<?php echo $part['part_short_desc']; ?>">
                            <input type="hidden" name="price" value="<?php echo $part['part_price']; ?>">      
                            <input type="hidden" name="add" value="Add to Cart" />
                            <!--<a href="javascript: addtocart('part<?php echo ($part['part_id']); ?>')">Add to Cart</a>-->
							<a href="#">Add to Cart</a>
                        </form>

                    </div>
                </div>
            </li>

                    <?php } ?>

        </ul>

            <?php } else { ?>

        <p class="noResults">No items match your filter criteria.</p>

            <?php } ?>

    </div>

    <div id="sideBar">
        <h2>Filters</h2>
        <?php if (isset($active_filters)) { ?>
        <div id="appliedFilters">
            <h3>Applied Filters:</h3>
            <ul>
                    <?php foreach ($active_filters as $active_filter) { ?>

                <li><?php echo $active_filter; ?></li>

                        <?php } ?>
            </ul>
        </div>
            <?php } ?>

        <div id="availableFilters">
            <script>
                $(document).ready(function() {   
                    $('#availableFilters h3').click( function() { 
                        $(this).parent().toggleClass('open');
                    })    
             
                })     

            </script>            
            <?php $count = 0; foreach ($tag_list as $tag_key => $tag_values) { $count < 2 ? $class= 'open' : $class = ''; ?>
            <div class="tagKey <?php echo $class; ?>">
                <h3><span><?php echo $tag_key; ?></span></h3>
                <ul>
                    <?php
    
                    foreach ((array) $tag_values as $tag_value) {
                        $match = 0;
                        foreach ((array) $filters as $filter_key => $filter_values) {
                            foreach ((array) $filter_values as $filter_value) {
                                if ((clean($tag_key) == clean($filter_key)) && (clean($tag_value) == clean($filter_value))) {
                                    $match = 1;
                                }
                            }
                        }

                        if ($match != 1) {
                            echo '<li>';                  
                            if($previous_filters == '&filters=') {
                                echo '<a href="' .$seo_title . $previous_filters . clean($tag_key) . '::' . clean($tag_value) . '&order_by=' . $active_order_by . '">' . $tag_value . '</a>';
                            } else {

                                echo '<a href="' .$seo_title . $previous_filters . ',,' . clean($tag_key) . '::' . clean($tag_value) . '&order_by=' . $active_order_by . '">' . $tag_value . '</a>';
                            }
                            echo '</li>';
                        }
                    }
                    
                    if($match == 1){ echo '<li class="selected">Selected</li>'; }
              
                    ?>
                </ul>
            </div>

            <?php $count++; } ?>
        </div>
        <div class="endPartList"></div>
    </div>        

</div>