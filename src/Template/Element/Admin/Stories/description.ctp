<div class="m-widget3__header">
    <div class="m-widget3__info">
		<span class="m-widget3__username">
			<h3>Description
				<a data-toggle="modal" data-target="#descriptionModal"
                   data-whatever="@getbootstrap">
					<i class="la la-pencil"></i>
				</a>
			</h3>
		</span>
        <span class="m-widget3__time">
			<?php
            $date1 = date("Y-m-d H:i:s");
            $date2 = $story->created;
            $datetime1 = new DateTime($date1);
            $datetime2 = new DateTime($date2);

            $interval = $datetime2->diff($datetime1);
            echo $interval->format('%R%a days ago');
            ?>
		</span>
    </div>
</div>
<div class="m-widget3__body">
    <p class="m-widget3__text">
        <?php echo $story->description; ?>
    </p>
</div>

<!-- Description modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo $this->Form->create($story, array('name' => 'description-form', 'id' => 'description-form')) ?>
            <div class="modal-body">
                <div align="center" class="alert alert-warning" id="msg-description" style="display: none"></div>
                <?php echo $this->Form->control('story_id', ['type' => 'hidden', 'value' => $story->id]); ?>
                <div class="form-group">
                    <label for="description" class="form-control-label">Description:</label>
                    <?php echo $this->Form->textarea('description', array('label' => false, 'class' => 'form-control', 'required' => 'true', 'id' => 'summernote')); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                <div id="loader-div" class="m-loader m-loader--brand" style="width: 30px; display: none;"></div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>