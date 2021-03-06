
var base_url = $('#base_url').val();

$(document).on('click', function(event) {
  if (!$(event.target).closest('.popup').length) {
    if (!$(event.target).closest('.trigger-popup').length) {
      $('.popup').fadeOut(200);
      $('.popup-overlay').fadeOut();
      $('#popup-container').html('');
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
  var name = $(this).data('trigger-name');
  var action = $(this).data('trigger-action');
  $('.flash-message').slideDown();
  $('.flash-message-name').html(name);
  $('.flash-message-action').html(action);
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
});

//Feature Count
$(document).on('click','.ajax-count-feature',function(){

  var feature_name = $(this).data('feature-name');
  $.ajax({
    url: base_url + '/count_feature' + '/' + feature_name,
    success: function(data){
      $('#popup-container').append(data);
    }
  });
});

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

/* TABS */
$(document).on('click','.profile-tab-list > li',function(){
  var list = $(this);
  var section = list.data('trigger');
  location.hash = '#'+section;
  $('.profile-section').fadeOut(400);
  $('.box-profile').find("[data-section='" + section + "']").fadeIn(400);
  $('.profile-tab-list > li').removeClass('active');
  $('.box-profile').find("[data-trigger='" + section + "']").addClass('active');
});

//check hashes
if(window.location.hash) {
  // Fragment exists
  section = window.location.hash;
  section = section.replace("#","");
  $('.profile-section').fadeOut(400);
  $('.box-profile').find("[data-section='" + section + "']").fadeIn(400);
  $('.profile-tab-list > li').removeClass('active');
  $('.box-profile').find("[data-trigger='" + section + "']").addClass('active');
} else {
  // Fragment doesn't exist
  section = 'training-experiences';
  $('.profile-section').fadeOut(400);
  $('.box-profile').find("[data-section='" + section + "']").fadeIn(400);
  $('.profile-tab-list > li').removeClass('active');
  $('.box-profile').find("[data-trigger='" + section + "']").addClass('active');
}
/*END OF TABS */

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

$(document).on('click','.add-contact',function(){
  var this_selector = $(this);
  var contact_owner_id = $(this).data('owner');
  var contact_owner_role_id = $(this).data('owner-role');
  $.ajax({
    url:base_url + '/create-contact/' + contact_owner_id + '/' + contact_owner_role_id,
    success: function(){
      this_selector.parent().find('.remove-contact').show();
      this_selector.hide();
    }
  });
});

$(document).on('click','.remove-contact',function(){
  var this_selector = $(this);
  var contact_owner_id = $(this).data('owner');
  var contact_owner_role_id = $(this).data('owner-role');
  $.ajax({
    url:base_url + '/remove-contact/' + contact_owner_id + '/' + contact_owner_role_id,
    success: function(){
      this_selector.parent().find('.add-contact').show();
      this_selector.hide();
    }
  });
});

//Video Popup Section
$(document).on('click','.ajax-popup-video',function(){

  var title = $(this).data('title').trim();
  var url   = $(this).data('url').trim();
  $.ajax({
    url: base_url + '/popup/video/' + title + '/' + url,
    success: function(data){
      $('#popup-container').append(data);
    }
  });
});

//Testimonial Popup Section
$(document).on('click','.ajax-popup-testimonial',function(){

  var owner_id      = $(this).data('id');
  var owner_role_id = $(this).data('roleid');
  var owner_name    = $(this).data('name');

  console.log(owner_id);

  $.ajax({
    url: base_url + '/popup/testimonial/' + owner_id + '/' + owner_role_id
                  + '/' + owner_name,
    success: function(data){
      $('#popup-container').html(data);
      $('#popup-container > .popup.send-testimonial-popup.row').show();
      $('#popup-container > .popup.send-testimonial-popup.row').css('z-index',9999);
    }
  });
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
  var role            = $('input[name=role]:checked').val();
  var keywords_temp   = $('.sf_keyword_label');
  var budget          = $('input[name=budget]').val();
  var location        = $('input[name=location]').val().trim();
  var method_temp     = $('select[name=method]').val();
  var style_temp      = $('select[name=style]').val();
  var must_have_temp  = $('input[name=must_have]:checked');
  var start_date      = $('input[name=start_date_day]')+'-'+$('input[name=start_date_month]')+'-'+$('input[name=start_date_year]');
  var end_date        = $('input[name=end_date_day]')+'-'+$('input[name=end_date_month]')+'-'+$('input[name=end_date_year]');

  var keywords = "";
  for(var i=0; i<keywords_temp.length; i++){
    if(i == 0)
      keywords += keywords_temp[i].innerHTML.replace('<i class="fa fa-close"></i>', "").trim();
    else
      keywords += "%2B"+keywords_temp[i].innerHTML.replace('<i class="fa fa-close"></i>', "").trim();
  }

  var method = "";
  for(var i=0; i<method_temp.length; i++){
    if(i == 0)
      method += method_temp[i].value.trim();
    else
      method += "%2B"+method_temp[i].value.trim();
  }

  var style = "";
  for(var i=0; i<style_temp.length; i++){
    if(i == 0)
      style += style_temp[i].value.trim();
    else
      style += "%2B"+style_temp[i].value.trim();
  }

  var must_have = "";
  for(var i=0; i<must_have_temp.length; i++){
    if(i == 0)
      must_have += must_have_temp[i].value;
    else
      must_have += "%2B"+must_have_temp[i].value;
  }

  if(role == 1)
  {
    window.location = base_url+'/trainers?keywords='+keywords+'&budget='+budget+'&location='+location+'&method='+method+'&style='+style+'&must_have='+must_have+'&start_date='+start_date+'&end_date='+end_date;
  }
  else if(role == 2)
  {
    window.location = base_url+'/training-providers?keywords='+keywords+'&budget='+budget+'&location='+location+'&method='+method+'&style='+style+'&must_have='+must_have+'&start_date='+start_date+'&end_date='+end_date;
  }
  /*else if(role == 3)
  {
    window.location = 'public-trainings';
  }*/
});

/*
===================
  ADVANCED SEARCH
===================
 */
$('#customize-training-button > button:first').click(function(){
  $('#customize-training-button').hide(700);
  $('#customize-training-option').show(700);
});

function goToSearchWizard(step, text)
{
  //set default value for var text
  text = typeof text !== 'undefined' ? text : "";

  if(step == '1')
  {
    if(text != "") $('#search-wizard-step-0 input[type=hidden]').val(text);
  }
  else if(step == '2')
  {
    if(text != ""){
      $.ajax({
        url: base_url+'/tna/getSubObjectives',
        data: {objectiveId: text},
        success: function(val){
          //$('#search-wizard-step-2 input[type=text]').attr("data-items", val);
          $('#search-wizard-step-2 select').html(val);
        }
      });
    }
  }
  else if(step == '3')
  {
    if(text != ""){

      //Stringify Sub Objective Data
      var data = "";

      /*if($('#search-wizard-step-2 input[type=text]').val() != "")
        data = $('#search-wizard-step-2 input[type=text]').val() + '#';

      for (var i = 0; i < $('#search-wizard-step-2 .fg-chip').length; i++) {
        data = data + $('#search-wizard-step-2 .fg-chip')[i].getAttribute("data-value") + '#';
      };
      data = data.slice(0, data.length-1);*/
      for (var i = 0; i < $('select[name="sub_objectives"]').length; i++) {
        data = data + $('select[name="sub_objectives"]')[i].value + '#';
      };
      data = data.slice(0, data.length-1);


      $.ajax({
        url: base_url+'/tna/getJobFunctions',
        data: {subObjective: data},
        success: function(val){
          //$('#search-wizard-step-3 input[type=text]').attr("data-items", val);
          $('#search-wizard-step-3 select').html(val);
        }
      });
    }
  }
  else if(step == '4')
  {
    if(text != ""){
      //Stringify Job Function Data
      /*var jobFunctionData = "";

      if($('#search-wizard-step-3 input[type=text]').val() != "")
        jobFunctionData = $('#search-wizard-step-3 input[type=text]').val() + '#';

      for (var i = 0; i < $('#search-wizard-step-3 .fg-chip').length; i++) {
        jobFunctionData = jobFunctionData + $('#search-wizard-step-3 .fg-chip')[i].getAttribute("data-value") + '#';
      };
      jobFunctionData = jobFunctionData.slice(0, jobFunctionData.length-1);*/


      $.ajax({
        url: base_url+'/tna/getSeniorityLevels',
        success: function(val){
          //$('#search-wizard-step-4 input[type=text]').attr("data-items", val);
          $('#search-wizard-step-4 select').html(val);
        }
      });
    }
  }
  else if(step == '5')
  {
    if(text != ""){
      $.ajax({
        url: base_url+'/tna/getIndustryTypes',
        success: function(val){
          //$('#search-wizard-step-5 input[type=text]').attr("data-items", val);
          $('#search-wizard-step-5 select').html(val);
        }
      });
    }
  }
  else if(step == '7')
  {
    if(text != ""){
      //Stringify Industry Data
      var industryData = "";

      for (var i = 0; i < $('select[name="industry_types"]').length; i++) {
        industryData = industryData + $('select[name="industry_types"]')[i].value + '#';
      };
      industryData = industryData.slice(0, industryData.length-1);


      $.ajax({
        url: base_url+'/tna/getRelated',
        data: {
          industry: industryData
        },
        success: function(val){
          //$('#search-wizard-step-7 input[type=text]').attr("data-items", val);
          $('#search-wizard-step-7 select').html(val);
        }
      });
    }
  }

  $('html, body').animate({
    scrollTop: $("#search-wizard-step-"+step).offset().top
  }, 700);
}


function submitTNA()
{
  var type = $('#search-wizard-step-0 input[type=hidden]').val();

  //Stringify Job Function Data
  var jobFunctionData = "";

  for (var i = 0; i < $('select[name="job_functions"]').length; i++) {
    jobFunctionData = jobFunctionData + $('select[name="job_functions"]')[i].value + '#';
  };
  jobFunctionData = jobFunctionData.slice(0, jobFunctionData.length-1);


  //Stringify Seniority Level Data
  var seniorityLevelData = "";

  for (var i = 0; i < $('select[name="seniority_levels"]').length; i++) {
    seniorityLevelData = seniorityLevelData + $('select[name="seniority_levels"]')[i].value + '#';
  };
  seniorityLevelData = seniorityLevelData.slice(0, seniorityLevelData.length-1);


  //Stringify Industry Data
  var industryData = "";

  for (var i = 0; i < $('select[name="industry_types"]').length; i++) {
    industryData = industryData + $('select[name="industry_types"]')[i].value + '#';
  };
  industryData = industryData.slice(0, industryData.length-1);


  //Stringify Related Skill Data
  var skill = "";

  for (var i = 0; i < $('select[name="related_skills"]').length; i++) {
    skill = skill + $('select[name="related_skills"]')[i].value + '#';
  };
  skill = skill.slice(0, skill.length-1);


  window.location = "training-needs-analysis/result?type="+type+"&jobfunction="+jobFunctionData+"&senioritylevel="+seniorityLevelData+"&industry="+industryData+"&skill="+skill;
}


/*
=============
  CONTACTS
=============
*/

function reloadContacts()
{
  var search = $('.contact-search').val();
  if(search=='') search = 'NONE';
  var sort = $('.contact-sort').val();
  var order = $('.contact-sort-order').val();

  $.ajax({
    url:base_url + '/get-contacts/'+ search +'/' + sort + '/' + order + '/a/a',
    success: function(data){
      $('#ajax-contact-list').html(data);
      $('#ajax-contact-spinner').hide();
    }
  });
}

$(document).on('keyup','.contact-search',function(){
  $('#ajax-contact-list').html('');
  $('#ajax-contact-spinner').show();
  reloadContacts();
});

$(document).on('change','.contact-sort',function(){
  $('#ajax-contact-list').html('');
  $('#ajax-contact-spinner').show();
  reloadContacts();
});

$(document).on('change','.contact-sort-order',function(){
  $('#ajax-contact-list').html('');
  $('#ajax-contact-spinner').show();
  reloadContacts();
});

/* Learning Outcome - Outcome Preferences */
function getEachMultiple(){
  $('#lo-op').val('');
  $('.training-lo').each(function(index){
    var lo_index = parseInt(index) + 1;

    var currLoOpVal = $('#lo-op').val();

    var train_val = $("[data-training-lo-index='" + lo_index + "']").val();
    var op_val = $("[data-training-op-index='" + lo_index + "']").val();
    $('#lo-op').val(currLoOpVal + '|||' + train_val + '|' + op_val);

    $('#learning-multiple').find('.template-div').attr('data-training-lo-index',lo_index);
    $('#learning-multiple').find('.template-div').find('input').attr('data-training-lo-index',lo_index);
    $('#learning-multiple').find('.template-div').find('select').attr('data-training-op-index',lo_index);
  });
}

$(document).on('click','.learning-more',function(event){
  event.preventDefault();
  //var indexNum = $('#learning-multiple').find('.template-div').data('training-lo-index');
  var indexNum = $('#lo-op').data('current-index');
  //$("[data-training-lo-index='" + lo_index + "']")
  //$('#learning-multiple').find('.template-div').data('training-lo-index',indexNum+1);
  //lo = lo.replace('data-training-lo-index="2"','data-training-lo-index="1"');
  getEachMultiple();
  var lo = $('#learning-multiple').find('.template-div').html();
  $('#learning-multiple').find('.next-div').append(lo);
});

$(document).on('blur','.blurring',function(event){
  getEachMultiple();
});

//MISCELLANEOUS
$(document).on('change','.toggle-training',function(){
  var mode = $(this).val();
  if(mode == 'inhouse'){
    $('.toggle-training-corporate').show();
  }
  else{
      $('.toggle-training-corporate').hide();
  }
});
