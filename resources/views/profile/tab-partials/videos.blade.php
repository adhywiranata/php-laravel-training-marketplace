<div class="col-lg-12 profile-section" data-section="videos">
  <?php $user_id = (isset(Auth::user()->id))?Auth::user()->id:''; ?>
  @if($grids->user_id == $user_id)
  <a href="{{ url('dashboard/video/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Video
  </a>
  @endif
  <?php $flag = 1; ?>

  <div class="row">
  @foreach($videos as $video)
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="row experience-grid">
        <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">
          <div class="row">
            <a class="title trigger-popup ajax-popup-video"
                style="font-size:1.2em;"
                data-title="{{$video->video_name}}"
                data-url="{{$video->video_path}}">
              {{$video->video_name}}
            </a>
            <p class="description">
              {{$video->video_description}}
            </p>
          </div>
          <div class="row video-grid">
            <img
              class="trigger-popup ajax-popup-video"
              src="http://img.youtube.com/vi/{{$video->video_path}}/0.jpg"
              width="100%;"
              data-title="{{$video->video_name}}"
              data-url="{{$video->video_path}}"
              />
            <span class="fa fa-play fa-4x text-white"></span>
          </div>
        </div>
      </div>
    </div>
  <?php $flag++; ?>
  @endforeach
  </div>
</div>
