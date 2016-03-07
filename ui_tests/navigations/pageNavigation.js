rl = 'https://www.somewebsite.com';

// open the url
var page = require('webpage').create();
page.settings.userAgent = 'Mozilla/5.0 (Windows NT 5.2; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0';
page.open(url, function (status) {


    if (status !== 'success') {
        console.log('Unable to load the address!');
        phantom.exit();
    } else {
        window.setTimeout(function () { // Wait 20 seconds so the page loads

            page.render('1.png');

            // Begin - click on the pagination
            page.evaluate( function() {
                // find element to send click to
                var element = document.querySelector( 'ul.pageNavi li.next' );

                // create a mouse click event
                var event = document.createEvent( 'MouseEvents' );
                event.initMouseEvent( 'click', true, true, window, 1, 0, 0 );

                // send click to element
                element.dispatchEvent( event );
            });
            // End - click on the pagination

            page.render('2.png');

            phantom.exit();
        }, 20000); // Change timeout as required to allow sufficient time
    }

});
