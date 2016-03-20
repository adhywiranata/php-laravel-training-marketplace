<?php

  $remove_contact_hidden = 'block';
  $add_contact_hidden = 'block';
  if($is_contact == 1)
  {
    $add_contact_hidden='none';
  }
  else
  {
    $remove_contact_hidden='none';
  }
 ?>
    <a class="btn red-back trigger-connect full-width remove-contact"
      style="display:{{ $remove_contact_hidden }}"
      data-owner="{{ $grids->user_id }}"
      data-owner-role="2"
      data-trigger-name="{{ $grids->name }}"
      data-trigger-action="added to">Remove from Contact</a>

    <a class="btn trigger-connect full-width add-contact"
      style="display:{{ $add_contact_hidden }}"
      data-owner="{{ $grids->user_id }}"
      data-owner-role="2"
      data-trigger-name="{{ $grids->name }}"
      data-trigger-action="removed from">
      Add to Contact</a>
