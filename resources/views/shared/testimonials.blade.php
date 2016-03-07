<div class="col-lg-12 profile-section" data-section="testimonials">
  @for($i=0;$i<2;$i++)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 image-holder">
        <img src="{{ url('images/users/boto_simatupang.jpeg') }}" width="70%"/>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        <a href="" class="title"><i class="bigger-1" style="font-size:1em">"Great Trainer, Nice Delivery"</i></a>
        <p>Raharjo Budi</p>

        <a href="#" class="btn btn-margin red-back pull-right">Delete</a>

        <p class="description">
          Trained 50 future leaders from Smartlearn University
          to teach them the way to be a successful entrepreneur.
          Each participants learned from how to build a business
          by bootstrapping, using their own pocket money, and show
          them that a good business is not from the initial funding,
          but it is all about the business idea and brilliant strategies.
        </p>
      </div>
    </div>
  </div>
  @endfor
</div>
