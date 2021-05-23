# General
This is a webinterface for MyGekko-homeautomation. As MyGekko ist only reachable through local area network per default this software acts as a gateway to the 'outside'.
It provides a interface to open the door, get and set temperatures and heating-profiles for all rooms. For this it provides a REST-like API via https. It is implemented with
the php-Framework Laravel.

# Installation
1. Create local user with password on MyGekko-device
2. Set the local IP of myGekko-device to static
3. Download the repository, get 3rd party software in vendor-folder and input the credentials to settings.php
4. Configure a LAMP-stack on a linux-server that is in the same LAN as the myGekko. Obviously this server has to be accessible from the internet. SSL-encryption has to be
enabled.
5. Open URLs via get-http-requests to trigger commands. A list can be found in routes/web.php. These URLs can be accessed by Siri-skills/Shortcuts, mobile applications, browser
bookmarks, etc.
