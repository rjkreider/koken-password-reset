# koken-password-reset
reset koken password manually with this script

From the Archive.org website:  http://web.archive.org/web/20150921092907/help.koken.me/customer/portal/articles/1182607-recovering-a-lost-password

Recovering a lost password
Last Updated: Mar 23, 2015 11:51AM EDT
If you are no longer able to access Koken due to a lost password there are a couple of ways to regain access. Here's how.

Note: It is not possible to retrieve your password directly from the MySQL database. Koken stores the passwords in an encrypted format for your security, so do not attempt to retrieve or modify the password directly in MySQL.

Resetting your password via the browser
When you attempt a login that fails, Koken will raise a warning message in the lower right corner of the screen. Part of that message will be a link to "reset your password". Click that link, then fill in the email address for your Koken user. In a few minutes you'll receive an email with instructions on how to reset the password.

If you don't see an email in your inbox, check your spam/junk folder to make sure the email didn't land there. If after a while you still don't see an email, proceed to the manual reset procedure below.

Resetting your password manually
If you are not able to reset your password via the browser, we also provide a PHP file that will reset the password for you. Here's how to use it.

1) Download password reset script
Download this password reset script. Unzip the file.

2) Upload script to Koken installation
Upload the password-reset.php file you find inside the zip to the directory where Koken is installed on your server. This would be either the root HTML directory of your site or a folder labeled "koken", depending on where the application was originally installed.

3) Load script in your web browser
Once uploaded you'd then request the document in your web browser, like so:

http://yourdomain.com/password-reset.php or http://yourdomain.com/koken/password-reset.php

4) Sign-in with new password
A new password should appear in the browser. Use this password to sign-in to your Koken installation.

5) Delete script from server
Important: Delete the password-reset.php file you uploaded!

6) Edit password again if necessary
After you've successfully signed in you may edit your assigned password to something else. Go to Settings > Administrator to make that change.

7) Consider installing Email endpoints plugin
To ensure you get all system emails in the future, you can install the free Email endpoints plugin from the Koken store. This plugin sends any Koken email through dependable third party services or your own SMTP server.
