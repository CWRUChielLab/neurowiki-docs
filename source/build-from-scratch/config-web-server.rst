Configure Web Server with HTTPS
================================================================================

1.  If the virtual machine is running, log in and shut it down::

        ssh -p 8015 hjc@dynamicshjc.case.edu
        sudo shutdown -h now

2.  Share the SSL certificate directory owned by the VirtualBox Machines (vbox)
    account on DynamicsHJC (``~vbox/ssl-certificates``) with the virtual machine
    as a shared folder. Shared folders are accessible on the virtual machine
    under the mount point ``/media``. In VirtualBox, select Machine > Settings >
    Shared Folders, press the "+" button, and use the following settings:

    - Folder Path: ``/Users/vbox/ssl-certificates``
    - Folder Name: ssl-certificates
    - Check "Read-only"
    - Check "Auto-mount"

    Press "OK" twice to close the Settings windows.

3.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

4.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

5.  The Apache web server operates as user www-data in group www-data. Give the
    web server ownership of and access to the web directory::

        sudo chown -R www-data:www-data /var/www/
        sudo chmod -R ug+rw /var/www/
        sudo find /var/www -type d -exec chmod g+s {} \;

6.  Download and install the ``check-ssl-cert-expiration`` script::

        sudo wget -O /usr/local/sbin/check-ssl-cert-expiration https://dynamicshjc.case.edu/~vbox/biol373/_downloads/check-ssl-cert-expiration
        sudo chmod +x /usr/local/sbin/check-ssl-cert-expiration

    The script looks for the shared folder set up in step 2 and prints the
    expiration dates of any certificates found there. Check that this is working
    and that the certificates are current::

        sudo check-ssl-cert-expiration

    If you are curious about the contents of ``check-ssl-cert-expiration``, you
    can view it here:

    .. container:: collapsible

        check-ssl-cert-expiration

        :download:`Direct link </_downloads/misc/check-ssl-cert-expiration>`

        .. literalinclude:: /_downloads/misc/check-ssl-cert-expiration
            :language: bash

7.  Disable some default Apache configuration files, and download and install
    a custom Apache configuration file for handling SSL certificates::

        sudo a2dissite 000-default default-ssl
        sudo wget -O /etc/apache2/sites-available/smart-ssl.conf https://dynamicshjc.case.edu/~vbox/biol373/_downloads/smart-ssl.conf
        sudo a2enmod rewrite ssl
        sudo a2ensite smart-ssl
        sudo apache2ctl restart

    The determination of which SSL certificate to use is done automatically
    by looking at the URL used to access the site. If port forwarding is enabled
    and the virtual machine is accessed using https://dynamicshjc.case.edu:8014,
    the certificate for DynamicsHJC will be selected automatically. If bridged
    networking is enabled and the virtual machine is accessed using
    https://neurowiki.case.edu, the certificate for NeuroWiki will be selected
    automatically. Later, when the virtual machine is cloned and converted to
    NeuroWikiDev, its certificate will be selected automatically.

    If you are curious about the contents of ``smart-ssl.conf``, you can view it
    here:

    .. container:: collapsible

        smart-ssl.conf

        :download:`Direct link </_downloads/misc/smart-ssl.conf>`

        .. literalinclude:: /_downloads/misc/smart-ssl.conf
            :language: apache

8.  The web server should now be active. Open a web browser and navigate to

        https://dynamicshjc.case.edu:8014

    You should see a default page provided by Apache.

9.  Delete that default page::

        rm /var/www/html/index.html

10. Discourage bots, such as Google's web crawler, from visiting some parts of
    the site. Download and install ``robots.txt``::

        wget -O /var/www/html/robots.txt https://dynamicshjc.case.edu/~vbox/biol373/_downloads/robots.txt

    If you are curious about the contents of ``robots.txt``, you can view it
    here:

    .. container:: collapsible

        robots.txt

        :download:`Direct link </_downloads/misc/robots.txt>`

        .. literalinclude:: /_downloads/misc/robots.txt

11. Shut down the virtual machine::

        sudo shutdown -h now

12. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Web server configured with HTTPS**".
