## Notes

### Apache 2
Apache 2 is needed to run php application, on Windows, we would use XAMPP or WAMP server. On linux, we can install all the components independently.

For installing php, use sudo apt install php 
This installs php latest version and apache2 server. The default folder for apache2 in ubuntu is `/var/www/html/`. This can be changed by modifying the file `/etc/apache2/sites-available/000-default.conf` (sometimes this doesn't work straighaway)

After installation, apache2 autostarts on OS bootup. To disable use this command - `sudo update-rc.d apache2 disable`. This is only to stop the autostart, other operations can be done by firing respective commands ex. `sudo systemctl start apache2`, `sudo systemctl stop apache2`, `sudo systemctl apache2`

About MySQLi extentsion - PHP 7.2 when installed didn't come with mysqli extensiton, to install it, use `sudo apt install php-mysqli`