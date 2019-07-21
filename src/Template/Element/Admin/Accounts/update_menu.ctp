
<ul class="tab-nav clearfix ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
  <li class="ui-state-default ui-corner-top <?=$active==='personal_info'?'ui-tabs-avtive':''?>" role="tab" tabindex="0" aria-controls="tab-1" aria-expanded="<?=$active==='personal_info'?true:false?>" aria-expanded="<?=$active==='personal_info'?true:false?>">
      <a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">Personal Info</a>
  </li>
    <?php if (strtolower($session['Auth']['User']['social_type']) != 'google') { ?>
  <li class="ui-state-default ui-corner-top <?=$active==='change_avatar'?'ui-tabs-avtive':''?>" role="tab" tabindex="0" aria-controls="tab-1" aria-expanded="<?=$active==='change_avatar'?true:false?>" aria-expanded="<?=$active==='change_avatar'?true:false?>" >

      <a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">Change Avatar</a>
    <?php } ?>
  </li>
  <li class="ui-state-default ui-corner-top <?=$active==='change_password'?'ui-tabs-avtive':''?>" role="tab" tabindex="0" aria-controls="tab-1" aria-expanded="<?=$active==='change_password'?true:false?>" aria-expanded="<?=$active==='change_password'?true:false?>">
      <a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">Change Password</a>
  </li>
</ul>