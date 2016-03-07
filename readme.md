##SPEAQUS

Speaqus is a web-based application for trainer's evaluation.

##Usage Documentation

Bower packages are installed within the resources/assets/bower.
To install a package, use  `bower install <package-name>` on project root.

Stylesheets to be modified are in the form of SCSS file in the resources/assets/sass/ main.scss

##Builds

During a build, please use gulp to compile any scripts.
Use `gulp` to execute all gulp tasks, and `gulp watch` to watch for any changes.
To watch tests, use `gulp tdd`

Note: All tasks will assume a development environment, and will exclude minification. For production, use gulp --production.

##Required Js

this project uses:
jquery.js
bootstrap.min.js
underscore.js

This project uses Gulp task-runner and PhantomJs for headless website testing. Basic phantom.js tests are run along with gulp, but several another tests can be manually run using `phantomjs <dir><testname>`
