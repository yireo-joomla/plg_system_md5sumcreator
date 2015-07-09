# MD5SUM creator
## In short
Sorry, not possible.

## Overview of the problem
When adding CSS files and JavaScript files to Joomla, normally the following is being added:
```html
<script src="/media/com_example/js/example.js" type="text/javascript"></script>
<link rel="stylesheet" href="/media/com_example/css/example.css" type="text/css" />
```

Now, if you make use of browser caching, and if you change the content within these files, 
browsers will still show the original cached content instead of the new modified content - until the browser cache expires.
By adding a version tag to your CSS or JS, you can bypass this problem (for example `example.js?foobar`).

Joomla supports this feature by using a file called `MD5SUM` within your CSS or JS folder, and appending the content of this file
to your CSS or JS. For instance, with the example code of above, we can create a file `media/com_example/js/MD5SUM` with the content
`42` and this will result in the following HTML tag:
```html
<script src="/media/com_example/js/example.js?42" type="text/javascript"></script>
```

The question remains: How to create this file `MD5SUM` automatically so that it contains a hash of all the files contained in the same
folder?

## Solution offered by this plugin
This plugin automatically creates `MD5SUM` files for the CSS and JS folders of your template.

## Notes for developers
This only works if CSS or JS is added via the `JHtml` calls, not via the `JDocument` class directly.
