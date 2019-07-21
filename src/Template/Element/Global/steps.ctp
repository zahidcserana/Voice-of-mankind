<?php
$storyId = $this->request->params['pass'];
$id = false;
if(!empty($storyId)){
    $id = $storyId[0];
}
//pr($id);exit;
$action =$this->name . '_' . $this->template;
//$action = $this->template;
//pr($action);
$storyPage = ['Stories_add', 'Stories_edit'];
//var_dump($action);exit();
?>
<div id="processTabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="process-steps bottommargin clearfix ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"
        role="tablist">
        <li class="<?php if ($action == 'Stories_add' || $action == 'Stories_edit'){echo 'active';} ?> ui-state-default ui-corner-top" role="tab"
            tabindex="-1" aria-controls="ptab2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false">
            <a href="<?php echo $id==false?'javascript:void(0)':'/stories/edit/'.$id;?>" class="i-circled i-bordered i-alt divcenter ui-tabs-anchor" role="presentation" tabindex="-1"
               id="ui-id-2">1</a>
            <h5>Story</h5>
        </li>

        <li class="<?php echo $action == 'Stories_addDetails' ? 'active' : ''; ?> ui-state-default ui-corner-top" role="tab"
            tabindex="-1" aria-controls="ptab1" aria-labelledby="ui-id-1" aria-selected="false" aria-expanded="false">
            <a href="<?php echo $id==false?'javascript:void(0)':'/stories/add-details/'.$id;?>"
               class="i-circled i-bordered i-alt divcenter ui-tabs-anchor" role="presentation" tabindex="-1"
               id="ui-id-1">2</a>
            <h5>Details</h5>
        </li>

        <li class="<?php echo $action == 'Stories_addReferral' ? 'active' : ''; ?> ui-state-default ui-corner-top" role="tab"
            tabindex="-1" aria-controls="ptab3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false">
            <a href="<?php echo $id==false?'javascript:void(0)':'/stories/add-referral/'.$id;?>"
               class="i-circled i-bordered i-alt divcenter ui-tabs-anchor" role="presentation" tabindex="-1"
               id="ui-id-3">3</a>
            <h5>Referral</h5>
        </li>

        <li class="<?php echo $action == 'ReformIdeas_add' ? 'active' : ''; ?> ui-state-default ui-corner-top"
            role="tab" tabindex="0" aria-controls="ptab5" aria-labelledby="ui-id-5" aria-selected="true"
            aria-expanded="true">
            <a href="<?php echo $id==false?'javascript:void(0)':'/reform-ideas/add/'.$id;?>"
               class="i-circled i-bordered i-alt divcenter ui-tabs-anchor" role="presentation" tabindex="-1"
               id="ui-id-5">4</a>
            <h5>Reform Ideas</h5>
        </li>
    </ul>

</div>
<style>
    #processTabs .process-steps li {
        width: 20%
    }
</style>