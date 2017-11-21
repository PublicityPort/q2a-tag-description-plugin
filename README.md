# Question2Answer Tag Description Plugin #

## About ##

This is a plugin for **Question2Answer** that allows tag descriptions to be shown on tag pages and in tooltips


## Description ##
This is a copy of http://docs.question2answer.org/plugins/tutorial/


## Installation ##

* Install [Question2Answer][]. This plugin requires at least version 1.6 (see the change log for details)
* Make sure the [cURL][] and [JSON][] extensions are installed and enabled in PHP. HybridAuth library requires these extensions in order to work properly.
* Get the source code for this plugin from [Github][], either using [Git][], or downloading directly:

   - To download using git, install git and then type 
      
      `git clone git@github.com:PublicityPort/q2a-tag-description-plugin.git`
      
   - To download directly, go to the [project page][Github] and click **[Download ZIP][download]**

* Copy the plugin folder to `qa-plugin` directory. It is recommended to remove the Facebook Login plugin that ships with Q2A.
* Rename the file `providers-sample.php` to `providers.php` and make it write-accessible to the user under which the web-server is running. The plugin code must be able to write to this file.


## Configuration ##

* Go to **Admin -> Plugins** on your Q2A installation and click options for Tag Description plugin. Select appropriate options.
* Go to **Admin -> Layout**. You should see Tag Description in widget area. Add it wherever you want.


  [Question2Answer]: http://www.question2answer.org/install.php
  [Git]: http://git-scm.com/
  [Github]: https://github.com/alixandru/q2a-publicityport-login
  [cURL]: http://www.php.net/manual/en/book.curl.php
  [JSON]: http://www.php.net/manual/en/book.json.php
  [download]: https://github.com/alixandru/q2a-publicityport-login/archive/master.zip


## Disclaimer ##
This code has not been extensively tested on high-traffic installations of Q2A. You should perform your own tests before using this plugin on a live (production) environment. 


## License ##
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.


## About Q2A ##
Question2Answer is a free and open source platform for Q&A sites. For more information, visit [http://www.question2answer.org/](http://www.question2answer.org/)
