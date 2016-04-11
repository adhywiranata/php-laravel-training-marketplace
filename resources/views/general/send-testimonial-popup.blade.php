<div class="popup send-testimonial-popup row" style="display:none; width:50%; left:30%;" data-popup="send-testimonial">
  <a href="" class="popup-close text-black"><span class="lnr lnr-cross"></span></a>
  <div class="padding-20 col-lg-12 col-sm-12 sign-form-col request-section-wrapper" data-section="1">
    <h4 class="border-bottom">Write a Testimony About <?php if(isset($owner_name)){ echo $owner_name; } ?></h4>
    <?php if(isset($owner_role_id)){ $role_id = $owner_role_id; }else{ $role_id = 0; } ?>
    <?php if(isset($owner_id)){ $id = $owner_id; }else{ $id = 0; } ?>
    <form action="{{url('dashboard/testimonial/'.$role_id.'/'.$id.'/create')}}" class="fg-form text-left padding-20" method="post">
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <label>Testimony {{ $errors->first('testimony') }}</label>
      <input type="textarea" name="testimony"/>
  <!--
      <div class="col-xs-12 fg-input"
        data-type="textarea"
        data-label="Testimony {{ $errors->first('testimony') }}"
        data-name="testimony"
        data-validation=""
        data-placeholder="insert testimony"
        data-classes="form-control"
        data-current="">
      </div>
-->
      <button type="submit" class="col-xs-12 fg-submit" data-value="Save"></button>

    </form>
  </div>
</div>
