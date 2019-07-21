<div class="col_full">
    <div class="stories-right-title">
        <h3> <span>Archive</span></h3>
    </div>
    <ul class="list-unstyled archive-list">
        <?php
        for ($i = 1; $i <= 6; $i++) {
            $month = date("F,Y", strtotime( date( 'Y-m-01' )." -$i months"));
            $intTimeVal = strtotime( date( 'Y-m-01' )." -$i months");
            ?>
            <li>
                <a href="/stories/stories-by-month/<?php echo $intTimeVal;?>">
                    <i class="fa fa-angle-right"></i>&nbsp;<?php echo $month;?>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>