<section id="content">
    <div class="container topmargin">
        <div class="row">
            <?php echo $this->Flash->render();?>
            <!-- Accout Content Area -->
            <div class="col-sm-12 account-area">
                <div class="side-tabs tabs-bordered clearfix" id="tab-5">

                    <?php echo $this->element('my_account_left_panel');?>

                    <div class="tab-container">
                        <div class="tab-content clearfix" id="mylist">
                            <?php echo $this->Html->link(__('Add New'), ['controller' => 'MyLists', 'action' => 'add'],['class' => 'button comnt-btn defualt-btn pull-right btn-lgradius']);?>
                            <?php 
                            if(!empty($myLists)):
                                foreach($myLists as $list):
                            ?>
                            <table class="table table-bordered table-condensed my-helpful-table" style="clear: both">
                                <tbody>
                                <div class="heading-block heading-area">
                                    <h3><?php echo $list->title;?></h3>
                                </div>
                                <?php
                                if(!empty($list->my_lists)):
                                    foreach($list->my_lists as $eachList):
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $eachList->name;?>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list"><?php echo $eachList->value;?></a>
                                    </td>
                                    <td>
                                        <?php echo $this->Html->link(__('Edit'), ['controller' => 'MyLists', 'action' => 'edit', $eachList->id],['class' => 'button btn-olive btn-shadow button-mini pull-right mtopxs btn-red btn-lgradius']);?>
                                    </td>
                                </tr>                                
                                <?php
                                    endforeach;
                                endif;
                                ?>
                                </tbody>
                            </table>                            
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <!-- / My List -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>