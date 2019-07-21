<?php 
    if(isset($ads) && !empty($ads)){ ?>
<div class="col_full">
    <?php    
        if(isset($ads['Premium'][ $size ]) && !empty($ads['Premium'][ $size ])){
            echo $ads['Premium'][ $size ];
        }else if(isset($ads['Basic'][ $size ]) && !empty($ads['Basic'][ $size ])){
            echo $ads['Basic'][ $size ];
        } else if(isset($ads['Default'][ $size ]) && !empty($ads['Default'][ $size ])){
            echo $ads['Default'][ $size ];
        }
    ?>
</div>
<br/><br/>
<?php
} ?>
