<script>
    $(document).ready(function() {
        $('#resizedImages span:first').show();
        $('#resizedImages .active').show().animate({opacity:1},1000);
        $('#tnImages img').click( function() {
            $('#resizedImages img.active').show().animate({opacity:0},1000);
            $('#resizedImages img').removeClass('active').hide();
            $('#resizedImages span.hover').hide();
            var id = $(this).attr('id');
            $('#resizedImages #image_' + id).show().addClass('active');
            $('#resizedImages #image_' + id).parent().find('span.hover').show();
            $('.active').show().animate({opacity:1},1000);
            $('.centered').css( 'margin-top' , top_margin);
        })

        $('.tabcontent div:first').show();
        $('.tabnav li:first').addClass('active');
        $('.tabnav li>a').click( function() {
            $(this).parent().parent().parent().find('.tabcontent div').hide();
            $('.tabnav li').removeClass('active');
            $(this).parent().addClass('active');
            id = $(this).attr('href');
            parameter = id.replace('#','.');
            $(this).parent().parent().parent().find(parameter).show();
        })
        $('span.hover').hover( function(){
            $(this).stop().animate({opacity:1},1000);},
        function(){
            $(this).stop().animate({opacity:.0},1000);})
    })  

    function addtocart(tocart) {  

        $('form#' + tocart).submit();

    }    

</script>

<div class="whiteBox" id="storePart">
    <div id="mainBar">
        <div id="resizedImages">
            <div class="centered">
                <?php foreach ($part->images as $key=>$image) { ?>
                <a target="_blank" href="/images/parts/full/<?php echo $image->imageUrl; ?>"><span class="hover"></span>
                    <img <?php if($key==0) {echo 'class="active resize"';} ?>src="/images/parts/resized/<?php echo $image->imageUrl; ?>" alt="<?php echo $image->title; ?>" id="image_<?php echo $image->id; ?>" />
                </a>
                <?php } ?>
            </div>
        </div>

        <h1><?php echo $part->title; ?></h1>
        <p class="shortDesc"><?php echo strip_tags(str_replace('<br />', ' - ' ,$part->shortDesc)); ?></p>
        <div id="longDesc"><?php echo $part->longDesc; ?></div>

        <ul id="tags">
        <?php foreach($tags as $tag) { ?>
        <li>
            <span class="tagTitle"><?php echo $tag[0]; ?>:</span>
            <span class="tagValue"><?php echo $tag[1]; ?></span>
        </li>
        <?php } ?>
        </ul>
        
    </div>
    <div id="sideBar">
        <h2>Alternate Images</h2>
        <ul id="tnImages">
            <?php foreach ($part->images as $image) { ?>
            <li><div class="centered"><img src="/images/parts/tn/<?php echo $image->imageUrl; ?>" alt="Thumbnail - <?php echo $image->title; ?>" id="<?php echo $image->id; ?>" /></div></li><div class="bottom"></div>
    <?php } ?>
        </ul>   

        <?php foreach($tags as $key=>$tag) {  if ($key == 'Brand') { ?>
            <img id="brandImage" src="/images/brand/<?php echo strtolower(str_replace(' ','-',$tag[1])); ?>.png" title="<?php echo $tag[1]; ?>" />
        <?php } } ?>

        <div class="price">
            
			
			<span class="saveAmount">Save $<?php echo money($part->discount,true,true);?></span>
			$<?php echo money($part->partCost - $part->discount,true,true); ?>
			<span class="originalPrice">$<?php echo money($part->partCost,true,true);?></span>
        </div>
        <div class="addToCartButton">

            <form method="post" id="part<?php echo $part->id; ?>" action="http://www.ewebcart.com/13951/cart">
                <input type="hidden" name="name" value="<?php echo $part->title; ?>">
                <input type="hidden" name="description" value="<?php echo $part->shortDesc; ?>">
                <input type="hidden" name="price" value="<?php echo ($part->partCost - $part->discount); ?>">      
                <input type="hidden" name="add" value="Add to Cart" />
                <!--<a href="javascript: addtocart('part<?php echo $part->id; ?>')">Add to Cart</a>-->
				<a href="#">Add to Cart</a>
            </form>

        </div>        
    </div>

</div>