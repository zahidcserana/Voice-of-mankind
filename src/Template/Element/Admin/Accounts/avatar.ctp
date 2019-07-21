<?php echo $this->Form->create('img', array('url' => '/admin/users/up_profile_image/' . $user['id'], 'type' => 'file')); ?>
<?php
$file = WWW_ROOT . 'img' . DS . 'stories' . DS . $user['id'] . DS . $user['avatar_name'];
$notExist = false;
if ($user['avatar_name'] != '' && file_exists($file)) {
    $imgFile = '/img' . DS . 'stories'. DS . $user['id'] . DS . $user['avatar_name'];
} else {
    $imgFile = '/img/users/profile.png';
    $notExist = true;
}
?>
<div class="col_half col_last">
    <img src="<?php echo $imgFile; ?>" width="200" height="200" style="border-radius: 10px;" alt="">
    <br/>
    <?php if (!$notExist) { ?>
        <a href="<?php echo '/admin/users/deleteimage/' . $user['id']; ?>"
           class="btn btn-brand">Delete Featured Image</a>
    <?php } ?>
</div>
<div class="clear"></div>
<br>
<?php if ($notExist) { ?>
    <div class="col_half col_last">
       <!-- <label for="exampleInputFile1">Upload Featured Image *</label>-->
        <input d="input-8" class="file-input" type="file" name="file" accept="image/*"
               class="file-loading" data-allowed-file-extensions='[]'>
    </div>
    <div class="clear"></div>
    <br>
    <div class="col_full">
        <button class="btn btn-brand" type="submit"
                id="template-contactform-submit" name="template-contactform-submit" value="submit">
            Save
        </button>
    </div>
<?php } ?>
<?php echo $this->Form->end(); ?>
