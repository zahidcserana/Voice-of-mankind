<h4 class="nomargin">Agency:
    <?php echo $story->agency->name; ?>
    <a data-toggle="modal" data-target="#agencyModal"
       data-whatever="@getbootstrap">
        <i class="la la-pencil"></i>
    </a>
</h4>
Email: <?php echo $story->agency->email; ?> <br>
Phone: <?php echo $story->agency->phone; ?> <br>
City: <?php echo $story->agency->city; ?> <br>
Address: <?php echo $story->agency->address; ?> <br>

<!-- Agency modal -->
<div class="modal fade" id="agencyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agency Update</h5>
                <h5 style="margin-left: 5%"><?php echo $this->Html->link(__('New Agency'), ['controller' => 'Agencies', 'action' => 'add', 'prefix' => 'admin']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo $this->Form->create($story, array('name' => 'agency-form', 'id' => 'agency-form', 'class' => 'm-form m-form--fit m-form--label-align-right')) ?>
            <div class="modal-body">
                <div align="center" class="alert alert-warning" id="msg-agency" style="display: none"></div>
                <?php echo $this->Form->control('story_id', ['type' => 'hidden', 'value' => $story->id]); ?>
                <div class="form-group">
                    <label for="description" class="form-control-label">Agency Type:</label>
                    <div class="m-radio-list">
                        <?php foreach ($agencyTypes as $row) {
                            $checked = '';
                            if ($story->agency->type == $row['value']) {
                                $checked = 'checked';
                            }
                            ?>
                            <label class="m-radio">
                                <input type="radio" name="agency_type" id="agency_type"
                                       value="<?php echo $row['value'] ?>" <?php echo $checked; ?>>
                                <?php echo $row['text'] ?>
                                <span></span>
                            </label>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="form-control-label">Agency:</label>
                    <?php
                    if ($story['agency']['name'] == '') {
                        $defaultAgency = '-- Select Agency --';
                    } else {
                        $defaultAgency = $story['agency']['name'];
                    }
                    echo $this->Form->control('agency_id', ['value' => $story['agency']['name'], 'label' => false, 'class' => 'form-control m-input ', 'empty' => $defaultAgency, 'id' => 'selectAgency']);
                    ?>
                    <input type="hidden" id="currentAgencyId" value="<?php echo $story->agency->id;?>">
                    <input type="hidden" id="currentAgencyName" value="<?php echo $story->agency->name;?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                <div id="agency-loader" class="m-loader m-loader--brand" style="width: 30px; display: none;"></div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

