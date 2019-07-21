<div class="main_page_content" id="reform_idea_index">
    <section id="content">
        <div class="container topmargin">
            <?php echo $this->Flash->render(); ?>
            <!--<div class="row">
                <div id="locationDiv">
                    <?/*= $this->Form->create('searchReformIdeas', ['name' => 'reform-idea-search','id'=>'reform-idea-search','method'=>'get']) */?>
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="zip_code" placeholder="Zipcode">
                            </td>
                            <td>
                                <?php
/*                                echo $this->Form->control('state_id', ['label' => false, 'empty' => '-- Select a State --','options' => $session['allState'], 'class' => 'form-control']);
                                */?>
                            </td>
                            <td id="countyList">
                                <?php
/*                                echo $this->Form->control('countyId', ['label' => false, 'empty' => '-- Select a County --', 'class' => 'form-control','disabled'=>true]);
                                */?>
                            </td>
                            <td id="cityList">
                                <?php
/*                                echo $this->Form->control('cityId', ['label' => false, 'empty' => '-- Select a City --', 'class' => 'form-control','disabled'=>true]);
                                */?>
                            </td>
                            <td>
                                <button style="margin-left: 44%!important;border-radius: 5%" type="submit" class="button defualt-btn nomargin">Search</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <?/*= $this->Form->end() */?>
                </div>
            </div>-->
            <div class="row">

                <div class="col-md-3 col-sm-12 col-xs-12 stories-right-side stories-xs-leftside">
                    <a href="/reform-ideas/add" class="button btn-primary btn-block text-center defualt-btn">Create Reform Idea</a>
                    <?php echo $this->element('Reform/search'); ?>
                    <div class="toogle-div">
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div class="rightbar-hidden">
                        <?php /*echo $this->element('Reform/recent'); */?>
                        <?php echo $this->element('ads', ['size' => 'Right Side(250px x 750px)']);?>                        
                    </div>
                    
                </div>

                <div id="posts" class="col-md-9 col-sm-12 col-xs-12 stories-left-side small-thumbs stories-xs-rightside">
                    <?php
                    if (!empty($reformIdeas) && count($reformIdeas) > 0) {

                        foreach ($reformIdeas as $row):
                            ?>
                            <div class="entry clearfix striese-blog-area">
                                <div class="entry-c blog-body">
                                    <?php  ?>
                                    <div class="entry-title">
                                        <h2>
                                            <?php 
                                                if(!empty($row->_matchingData['Agencies'])){
                                                    echo $this->Html->link(__($row->_matchingData['Agencies']->name), ['controller' => 'reform-ideas', 'action' => 'view', $row->id]);
                                                }else{
                                                    echo 'Agency: Not Found';
                                                }
                                            ?>
                                        </h2>
                                    </div>
                                   <h5>
                                       <?php 
                                            if(!empty($row->_matchingData['Users'])){
                                                echo $row->_matchingData['Users']->first_name . ' ' . $row->_matchingData['Users']->last_name.', '.$row->created;
                                            }else{
                                                echo 'User: Not Found';
                                            }
                                        ?>                                       
                                    </h5>
                                    <div class="entry-content">
                                        <p>
                                            <?php
                                            $descr = strip_tags($row->idea);
                                            $descr = substr($descr, 0, 400);
                                            echo wordwrap($descr, 400).' ...';
                                            ?>
                                        </p>

                                        <div class="redeamore-div">
                                            <?php echo $this->Html->link(__('Read More'), ['controller' => 'reform-ideas', 'action' => 'view', $row->id], ['class' => 'more-link btn-radius btn-shadow']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        $hasPages = $this->Paginator->numbers();
                        //checking whether the pagination div needed or not
                        if ($hasPages) {
                            ?>
                            <div class="paginator">
                                <ul class="pagination">
                                    <?= $this->Paginator->first('<< ' . __('First')) ?>
                                    <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next(__('Next') . ' >') ?>
                                    <?= $this->Paginator->last(__('Last') . ' >>') ?>
                                </ul>
                                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<h2>No Reform Idea found!</h2>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- mobile right bar hidden click show js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $(".toogle-div").click(function(){
        $(".rightbar-hidden").slideToggle("slow");
    });
});
</script>

