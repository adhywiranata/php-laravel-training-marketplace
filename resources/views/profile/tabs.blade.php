<div class="row box-profile padding-10">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="profile-tab-list">
      <li class="active ajax-count-feature"
        data-trigger="training-experiences"
        data-feature-name="training_experience">Training Delivery Experiences</li>
      @if($role == 2)
      <li data-trigger="trainers">Trainers</li>
      @endif
      @if($role == 1)
      <li data-trigger="work-experiences" class="ajax-count-feature"
        data-feature-name="work_experience">Work Experiences</li>
      <!--<li data-trigger="work-experiences">Education</li>-->
      @endif
      <li data-trigger="programs" class="ajax-count-feature"
        data-feature-name="training_program">Training Programs</li>
      <li data-trigger="testimonials" class="ajax-count-feature"
        data-feature-name="testimonial">Testimonials</li>
      <li data-trigger="certifications" class="ajax-count-feature"
        data-feature-name="certification">Certifications</li>
      <li data-trigger="awards" class="trigger-popup ajax-count-feature"
        data-feature-name="awards">Awards</li>
      <li data-trigger="skills" class="ajax-count-feature"
        data-feature-name="skill">Skills and Endorsement</li>
      <li data-trigger="videos" class="ajax-count-feature"
        data-feature-name="video">Videos</li>
      <li data-trigger="clients" class="ajax-count-feature"
          data-feature-name="client">Client</li>
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

  @include('profile.tab-partials.videos')

  @include('profile.tab-partials.clients')
</div>
