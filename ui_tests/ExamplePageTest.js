var page = require('webpage').create();
page.open('https://www.youtube.com/watch?v=SYPxAaFdxtQ', function() {
  page.includeJs("http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js", function() {
    var evaluation = page.evaluate(function() {
      $("#logo-container").click();
      return $(".yt-user-info").find("a").html();
    });

    console.log(evaluation);

    console.log('Page forward is ' + page.canGoForward);
    console.log('Page back is ' + page.canGoBack);

    console.log('Page title: ' + page.title);

    console.log('Plain Text: ' + JSON.stringify(page.clipRect));
    //console.log('Plain Text: ' + page.plainText);
    console.log('success!');
    phantom.exit()
  });
});
