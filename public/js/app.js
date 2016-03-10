
$(document).on('click', function(event) {
  if (!$(event.target).closest('.popup').length) {
    if (!$(event.target).closest('.trigger-popup').length) {
      $('.popup').fadeOut(200);
      $('.popup-overlay').fadeOut();
      $("video").each(function () { this.pause() });
      /* Reset request section to first section */
      $('.request-section-wrapper').data('section',1);
    }
  }
});

$(document).on('click','.popup-close',function(e){
  e.preventDefault();
  $('.popup').fadeOut(200);
  $('.popup-overlay').fadeOut();
  $("video").each(function () { this.pause() });
});

$(document).on('click','.trigger-sign-in',function(e){
  e.preventDefault();
  $('.popup-overlay').fadeIn();
  $('.sign-in-popup').fadeIn(400);
});

$(document).on('click','.trigger-connect',function(e){
  e.preventDefault();
  $('.flash-message').slideDown();
  setTimeout("$('.flash-message').slideUp()", 2000);
});

$(document).on('click','.close-flash-message',function(e){
  e.preventDefault();
  $('.flash-message').slideUp();
});

$(document).on('click','.view_phone',function(e){
  $(this).hide();
  $('.invisible_phone').show();
});

/*
* UTILITIES
*/

$(document).on('click','.trigger-collapse',function(e){
  e.preventDefault();
  var collapsible_target = $(this).data('trigger-collapse');
  $("[data-collapse='" + collapsible_target + "']").slideToggle();
})

/*
* GRID LIST
*/
highlight_skills();

function highlight_skills(){
  var query = '';
  query += $('#hidden-tag-highlighter').val();
  if(query != 'undefined')
  {
    var splitted = query.split('|||');
    $('.skill-tag').each(function(){
      var string = $(this).html();
      var loop = 0;
      for(loop = 0; loop < splitted.length; loop++)
      {
        if(string.indexOf(splitted[loop]) >= 0)
        {
          $(this).addClass('tag-highlighted');
        }
      }

    });
  }
}

$(document).on('keyup','input[name=sf_keywords]',function(e){
  var code = e.keyCode || e.which;
  $('.sf_keyword_assist').fadeIn();
  var keyword = $(this).val();
  var prev = $(this).prev(); //previous label, useful for backspace removal

  if(code == 13) //Enter keycode
  {
    if(keyword != '')
    {
    //$('#sf_keywords_box')
      var label = '<div class="sf_keyword_label"> ';
      label    +=  keyword;
      label    += ' <i class="fa fa-close"></i>';
      label    += '</div>';
      $(this).before(label);
      $(this).val('');
      $('.sf_keyword_assist').fadeOut();
    }
  }
  if(code == 8) //Back keycode
  {
    if(keyword == '')
    {
      if(prev.hasClass('sf_keyword_delete_cursor'))
      {
        prev.remove();
      }
      else
      {
        prev.addClass('sf_keyword_delete_cursor');
      }
    }
    else
    {
      prev.removeClass('sf_keyword_delete_cursor');
    }
  }

});

$(document).on('blur','input[name=sf_keywords]',function(e){
   $('.sf_keyword_assist').fadeOut();
 });

 $(document).on('click','.sf_keyword_label .fa-close',function(){
   $(this).parent().remove();
 });

/*
* Request Trainers
*/

$(document).on('click','.trigger-request-trainer',function(e){
  e.preventDefault();
  /* reset the request slides sections to first */
  request_to_first();
  /* show the popup */
  $('.popup-overlay').fadeIn();
  $('.request-popup').fadeIn(400);
  $('.request-section-next').show();
});

$(document).on('click','.check-btn',function(e){
  e.preventDefault();
  var checked = ($(this).data('checked') == 0)?1:0;
  if(checked == 1)
  {
    $(this).removeClass('light-grey-back');
    $(this).addClass('green-back');
    $(this).removeClass('text-grey');
    $(this).addClass('text-white');
    $(this).find('.fa').removeClass('fa-circle-o');
    $(this).find('.fa').addClass('fa-check-circle');
  }
  else
  {
    $(this).addClass('light-grey-back');
    $(this).removeClass('green-back');
    $(this).addClass('text-grey');
    $(this).removeClass('text-white');
    $(this).find('.fa').addClass('fa-circle-o');
    $(this).find('.fa').removeClass('fa-check-circle');
  }
  $(this).data('checked',checked);
});

function request_transition(){
  var section = $('.request-section-wrapper').data('section');
  if(section == 1)
  {
    $('.request-section-prev').hide();
  }
  else
  {
    $('.request-section-prev').show();
  }
  if(section == 5)
  {
    $('.request-section-next').hide();
    $('.request-section-finish').show();
  }
  else
  {
    $('.request-section-next').show();
    $('.request-section-finish').hide();
  }
  $('.request-section').slideUp(400);
  $('.request-section-' + parseInt(section)).slideDown(400);
}

function request_to_first(){
  $('.request-section-wrapper').data('section',1);
  $('.request-section').hide();
  $('.request-section-1').show();
}

$(document).on('click','.request-section-next',function(e){
  e.preventDefault();
  var section_wrapper = $(this).closest('.request-section-wrapper');
  section_wrapper.data('section',section_wrapper.data('section')+1);
  request_transition(section_wrapper.data('section'));
});

$(document).on('click','.request-section-prev',function(e){
  e.preventDefault();
  var section_wrapper = $(this).closest('.request-section-wrapper');
  section_wrapper.data('section',section_wrapper.data('section')-1);
  request_transition(section_wrapper.data('section'));
});

$(document).on('click','.request-section-finish',function(e){
  e.preventDefault();
  var section_wrapper = $(this).closest('.request-section-wrapper');
  section_wrapper.data('section',1);
  $('.request-section').slideUp(400);
  $('.request-section-last').slideDown(400);
  $('.request-section-trigger').hide();
});

/*
* USER PROFILE
*/

$('.profile-section').hide();
$('.box-profile').find("[data-section='speaking-experiences']").show();
$('.box-profile').find("[data-section='evaluation-summary']").show();

$(document).on('click','.profile-tab-list > li',function(){
  var list = $(this);
  var section = list.data('trigger');
  $('.profile-section').fadeOut(400);
  $('.box-profile').find("[data-section='" + section + "']").fadeIn(400);
  $('.profile-tab-list > li').removeClass('active');
  $('.box-profile').find("[data-trigger='" + section + "']").addClass('active');
});

$(document).on('click','.trigger-popup',function(){
  var popup = $(this).data('trigger-popup');
  $('.popup-overlay').fadeIn();
  $("[data-popup='"+ popup +"']").fadeIn(400);
});

$(document).on('click','.skill-tag',function(){
  var popup = 'skill';
  $('.popup-overlay').fadeIn();
  $("[data-popup='"+ popup +"']").fadeIn(400);
});

/*
* USER EVALUATIONS
*/

$(document).on('click','.toggle-evaluation-expand',function(){
  if($(this).data('expand') == 0)
  {
    $('.evaluation-grid').hide();
    $(this).closest('.evaluation-grid').show();
    $(this).parent().parent().find('.audience-evaluation-list').slideDown(400);
    $(this).find('i').removeClass('fa-caret-right');
    $(this).find('i').addClass('fa-caret-down');
    $(this).data('expand',1);
  }
  else
  {
    $('.evaluation-grid').show();
    $(this).parent().parent().find('.audience-evaluation-list').slideUp(400);
    $(this).find('i').removeClass('fa-caret-down');
    $(this).find('i').addClass('fa-caret-right');
    $(this).data('expand',0);
  }
});

/*
* TRAINING MANAGEMENT
*/
var training_table = $('#training-table').DataTable( {
        "scrollX": true
    } );
var training_provider_table = $('#training-provider-table').DataTable( {
        "scrollX": true
    }   );
var audience_table = $('#audience-table').DataTable( {
        "scrollX": true
    }   );
var questionnaire_table = $('#questionnaire-table').DataTable();

$(document).on( 'click','a.toggle-vis', function (e) {
    e.preventDefault();

    // Get the column API object
    var column = training_table.column( $(this).attr('data-column') );
    // Toggle the visibility
    column.visible( ! column.visible() );
} );

$('.box-profile').find("[data-section='trainings']").show();

//sidebar

$(document).on('click','.btn-submit',function(){
  var role = $('input[name=role]:checked').val();
  var title = $('input[name=title]').val();
  if(role == 1)
  {
    if(role != '')
    {
      window.location = 'trainers-fandy';
    }
    else{
    window.location = 'trainers';

    }
  }
  if(role == 2)
  {
    window.location = 'training-providers';
  }
  if(role == 3)
  {
    window.location = 'public-trainings';
  }
});

/*
 * ADVANCED SEARCH
 */
function goToSearchWizard(step)
{
  $('html, body').animate({
    scrollTop: $("#search-wizard-step-"+step).offset().top
  }, 700);
}
