{%= prefix %}
===

This is a starter theme created by merging _s by Automattic and Foundation by Zurb. Just follow the instructions below to change out the necessary information.

This theme is a work in progress 

* Licensed under GPLv2 or later. :) Use it to make something cool.

Getting Started
---------------

To set things up manually, download `{%= prefix %}` from github. The first thing you want to do is copy the `{%= prefix %}` directory and change the name to something else - Like, say, `mythemename` - then you'll need to do a five-step find and replace on the name in all the templates.

1. Search for `'{%= prefix %}'` (inside single quotations) to capture the text domain.
2. Search for `{%= prefix %}_` to capture all the function names.
3. Search for <code>&nbsp;{%= prefix %}</code> (with a space before it) to capture DocBlocks.
4. Search for `{%= prefix %}-` to capture prefixed handles.
5. Search for `Text Domain: {%= prefix %}` in style.css.

OR

* Search for: `'{%= prefix %}'` and replace with: `'mythemename'`
* Search for: `{%= prefix %}_` and replace with: `mythemename_`
* Search for: <code>&nbsp;{%= prefix %}</code> and replace with: <code>&nbsp;mythemename</code>
* Search for: `{%= prefix %}-` and replace with: `mythemename-`
* Search for: `Text Domain: {%= prefix %}` and replace with: `Text Domain: mythemename` in style.css.

Then, update the stylesheet header in style.css and the links in footer.php with your own information. Next, update or delete this readme.

Now you're ready to go! The next step is easy to say but harder to do: make an awesome WordPress theme. :)

Good luck!
