<!-- Category Right Side -->
<div class="col_full">
    <div class="stories-right-title">
        <h3><span>Category</span></h3>
    </div>
    <ul class="list-unstyled category-list">
        <?php
        if (!empty($storyCategories)) {
            foreach ($storyCategories as $i => $v) {
                ?>
                <li>
                    <a href="/stories/story-by-category/<?php echo $i; ?>">
                        <i class="fa fa-angle-right"></i>&nbsp; <?php echo $v; ?>
                    </a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>