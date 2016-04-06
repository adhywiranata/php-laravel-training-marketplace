<div class="col-lg-12 profile-section" data-section="clients">

  <?php $flag = 1; ?>
  <div class="row">

  @foreach($clients as $client)
    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
      <div class="row experience-grid">
        <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">
          <div class="row" style="height:100px;">
              <img src="{{ url('images/corporates/'.$client) }}" width="50%"/>
          </div>
        </div>
      </div>
    </div>
  <?php $flag++; ?>
  @endforeach

  </div>
</div>
