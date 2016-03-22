  @include('landing.header')
  <!----start-slide-banner---->
  <div class="slide-banner">
    <div class="wrap">
        <h1 style="width:100%; color: #fff;
    font-size: 2.2em;
    font-weight: 700;
    text-transform: uppercase; text-align:center">
          ABOUT
        </h1>
      <div class="clear"> </div>
    </div>
  </div>
  <!----//End-slide-banner---->

	<!---img-carousel---->
	<!----start-price-tables----->
	<div class="price-tables">
		<div class="wrap">
			<h3 style="font-size:1.3em; width:100%;"><span>
        CekTraining is a platform that connect you with the relevant,
        reliable and reasonable training services such as public training,
         training provider or freelance trainer.</h3>

         <br/><br/>
      <p>
        CekTraining vision is to inspire people to achieve their dream through
        effective competencies development (skill, knowledge and attitude).
        Based on Prof. Yohanes Surya video
        (https://www.youtube.com/watch?v=xXZCVp4jdBQ),
        CekTraining believes that every people deserves the
        right trainer and the right method. The right trainer
        who is able to motivate and inspire students. The right
        method that is able to simplify the training, make it easy and fun.
      </p>
      <br/><br/>
      <p>
        CekTraining has a database containing vast amount of training effectiveness
         information included in each freelance trainer or training provider profile.
        According to the principle and spirit of inspiring people, we don't charge
        any fee to professional users who needed the right training. To get full
        access of all CekTraining features, we just need you to invite your
        recommended training provider or freelance trainer so everyone can help
        each other training needs.
        At CekTraining, we respect your privacy and take protecting it seriously,
        therefore all submitted evaluation by professional users will be given
        either anonymous or transparent option.

      </p>

		</div>
	</div>
	<!----//End-price-tables----->

	<!----start-news-letter--->
	<div class="news-letter">
		<div class="wrap">
			<div class="news-letter-left">
				<h3>
					<span>{{ trans('content.footer_subscribe_small') }}</span>
					{{ trans('content.footer_subscribe') }}</h3>
			</div>
			<div class="news-letter-right">
				<form>
					<input type="text" placeholder="Enter Email here" required />
					<input type="submit" value="" />
				</form>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
	<!----//End-news-letter--->
	@include('landing.footer');
	<!---- //End-wrap---->
	</body>
</html>
