# addImageBackground
Using Imagemagick in a PHP script to standardize the size of a batch of images and add a flat background. This is a one-off script whose task I probably should've just completed in Photoshop, but I want to use Imagemagick more because it's awesome.

* Repurposing Imagemagick code I used in another work thing.
* Basically a Bash script, but eh.
* Run in parent directory, ~/ in my case.
* Also assumes all files have extension .jpg

TODO next time:

* Break out file type so that all regular image types can be used
* Better variable scope (using OOP?)
* Get filenames from working/supplied directory instead of a gross array.
* Kill the git message about CRLF v. LF