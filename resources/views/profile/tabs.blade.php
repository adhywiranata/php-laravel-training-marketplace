<div class="row box-profile">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="profile-tab-list">
      <li class="active" data-trigger="speaking-experiences">Training Experiences</li>
      @if($role == 2)
      <li data-trigger="trainers">Trainers</li>
      @endif
      @if($role == 1)
      <li data-trigger="work-experiences">Work Experiences</li>
      <!--<li data-trigger="work-experiences">Education</li>-->
      @endif
      <li data-trigger="programs">Training Programs</li>
      <li data-trigger="testimonials">Testimonials</li>
      <li data-trigger="certifications">Certifications</li>
      <li data-trigger="awards">Awards</li>
      <li data-trigger="skills">Skills and Endorsement</li>
    </ul>
  </div>

  @include('profile.tab-partials.speaking-experiences')

  @if($role == 2)
    @include('profile.tab-partials.trainers')
  @endif

  @if($role == 1)
    @include('profile.tab-partials.work-experiences')
  @endif

  @include('profile.tab-partials.programs')

  @include('profile.tab-partials.testimonials')

  @include('profile.tab-partials.certifications')

  @include('profile.tab-partials.awards')

  @include('profile.tab-partials.skills')

</div>
