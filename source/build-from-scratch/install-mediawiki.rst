Install MediaWiki
================================================================================

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Install these new packages,

        ========================    ============================================
        Package                     Description
        ========================    ============================================
        *php*                       server-side, HTML-embedded scripting
                                    language
        *php-pear*                  PEAR - PHP Extension and Application
                                    Repository
        *php-mbstring*              MBSTRING module for PHP
        *php-intl*                  Internationalisation module for PHP
        *php-dev*                   Files for PHP module development (needed for
                                    ``phpize`` for compiling apcu)
        *imagemagick*               image manipulation programs
        *python-mysqldb*            Python interface to MySQL
        *python-ldap*               LDAP interface module for Python
        *Mail*                      Class that provides multiple interfaces for
                                    sending emails
        *php-apcu*                  APC (Alternative PHP Cache) User Cache for
                                    PHP [#apcu]_
        ========================    ============================================

    using the following (when asked about enabling internal debugging, just
    press Enter)::

        sudo apt-get install php php-pear php-mbstring php-intl php-dev imagemagick python-mysqldb python-ldap
        sudo pear install --alldeps Mail
        sudo pecl install apcu_bc-beta
        sudo bash -c "echo extension=apcu.so > /etc/php/7.0/mods-available/apcu.ini"
        sudo bash -c "echo extension=apc.so > /etc/php/7.0/mods-available/z_apc.ini"
        sudo phpenmod apcu z_apc

4.  Download the source code for the latest version of MediaWiki with long term
    support (LTS).

    LTS versions of MediaWiki receive guaranteed support (e.g., security
    updates) for 3 years, although these updates must be applied manually (see
    :doc:`/update-mediawiki`). As of August 2016, the latest LTS version is
    MediaWiki 1.27.1, which will be supported until June 2019. The next LTS
    release should be available in mid-2018. [#mediawiki-version]_

    Run these commands to download and install the source code::

        wget -P ~ https://releases.wikimedia.org/mediawiki/1.27/mediawiki-1.27.1.tar.gz
        tar -xvzf ~/mediawiki-*.tar.gz -C /var/www
        mkdir -p /var/www/mediawiki
        mv /var/www/mediawiki-*/* /var/www/mediawiki
        rm -rf /var/www/mediawiki-* ~/mediawiki-*.tar.gz
        sudo chown -R www-data:www-data /var/www/mediawiki
        sudo chmod -R ug+rw /var/www/mediawiki

5.  Download and install a custom Apache configuration file for MediaWiki::

        sudo wget -O /etc/apache2/conf-available/mediawiki.conf https://dynamicshjc.case.edu/~vbox/biol373/_downloads/mediawiki.conf
        sudo a2enconf mediawiki
        sudo apache2ctl restart

    If you are curious about the contents of ``mediawiki.conf``, you can view it
    here:

    .. container:: collapsible

        mediawiki.conf

        :download:`Direct link </_downloads/misc/mediawiki.conf>`

        .. literalinclude:: /_downloads/misc/mediawiki.conf
            :language: apache

6.  Create and initializing the wiki database (do not forget to fill in
    the passwords)::

        php /var/www/mediawiki/maintenance/install.php --dbname wikidb --dbuser root --dbpass <MySQL password> --pass <wiki admin password> NeuroWiki Hjc

7.  Download and install the MediaWiki configuration file::

        wget -O /var/www/mediawiki/LocalSettings.php https://dynamicshjc.case.edu/~vbox/biol373/_downloads/LocalSettings.php

    Set the passwords and randomize the secret keys inside the configuration
    file::

        read -s -r -p "MySQL password: " DBPASS && sed -i '/^\$wgDBpassword/s|".*";|"'$DBPASS'";|' /var/www/mediawiki/LocalSettings.php; DBPASS= ; echo

        read -s -r -p "Gmail password: " GMPASS && sed -i '/^    .password./s|".*"|"'$GMPASS'"|' /var/www/mediawiki/LocalSettings.php; GMPASS= ; echo

        sed -i '/^\$wgSecretKey/s|".*";|"'$(openssl rand -hex 32)'";|' /var/www/mediawiki/LocalSettings.php

        sed -i '/^\$wgUpgradeKey/s|".*";|"'$(openssl rand -hex 8)'";|' /var/www/mediawiki/LocalSettings.php

    Protect the passwords in the configuration file::

        sudo chown www-data:www-data /var/www/mediawiki/LocalSettings.php*
        sudo chmod ug=rw,o= /var/www/mediawiki/LocalSettings.php*

    If you are curious about the contents of ``LocalSettings.php``, you can view
    it here:

    .. container:: collapsible

        LocalSettings.php

        :download:`Direct link </_downloads/mediawiki-1.27-compatible/LocalSettings.php>`

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/LocalSettings.php
            :language: php

8.  Create a script for toggling a security variable by downloading and
    installing a file::

        sudo wget -O /usr/local/sbin/disable-upload-script-checks https://dynamicshjc.case.edu/~vbox/biol373/_downloads/disable-upload-script-checks
        sudo chmod +x /usr/local/sbin/disable-upload-script-checks

    If you are curious about the contents of the script, you can view it here:

    .. container:: collapsible

        disable-upload-script-checks

        :download:`Direct link </_downloads/misc/disable-upload-script-checks>`

        .. literalinclude:: /_downloads/misc/disable-upload-script-checks
            :language: bash

9.  Allow MediaWiki to recognize Mathematica notebooks and package files so that
    they can be uploaded::

        echo "text nb cdf m wl" >> /var/www/mediawiki/includes/mime.types

10. Download and install a script for fetching real names for MediaWiki users.
    Since the CASAuth extension, which will be installed later, automatically
    fetches real names, this script should not need to be run regularly. ::

        sudo wget -O /usr/local/sbin/set-real-names-in-mediawiki https://dynamicshjc.case.edu/~vbox/biol373/_downloads/set-real-names-in-mediawiki

    Set the MySQL password inside the script::

        read -s -r -p "MySQL password: " DBPASS && sudo sed -i "/^sql_pass =/s|= .*|= '$DBPASS'|" /usr/local/sbin/set-real-names-in-mediawiki; DBPASS= ; echo

    Protect the password::

        sudo chown root:www-data /usr/local/sbin/set-real-names-in-mediawiki
        sudo chmod ug=rwx,o= /usr/local/sbin/set-real-names-in-mediawiki

    Run the script to fetch your real name for your account::

        sudo set-real-names-in-mediawiki
        sudo apache2ctl restart

    If you are curious about the contents of the script, you can view it here:

    .. container:: collapsible

        set-real-names-in-mediawiki

        :download:`Direct link </_downloads/misc/set-real-names-in-mediawiki>`

        .. literalinclude:: /_downloads/misc/set-real-names-in-mediawiki
            :language: python

11. The wiki should now be accessible. Open a web browser and navigate to

        https://dynamicshjc.case.edu:8014/wiki

    You should see a default page provided by MediaWiki. The wiki logo and
    favicon should be missing for now.

12. Shut down the virtual machine::

        sudo shutdown -h now

13. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**MediaWiki installed**".


.. rubric:: Footnotes

.. [#apcu]
    PHP version 7.0 is packaged with this version of Ubuntu; in earlier versions
    of Ubuntu, PHP 5 was used (fun fact: `PHP 6 never existed
    <https://wiki.php.net/rfc/php6>`__). The PHP module `APC
    <http://php.net/manual/en/book.apc.php>`__ provides the wiki with `object
    caching <https://www.mediawiki.org/wiki/Manual:Cache>`__, which should
    improve its performance. This module is compatible with PHP 5.4 and earlier,
    but not PHP 5.5, 5.6, or 7.0. For these newer versions of PHP, a replacement
    module called `APCu <http://php.net/manual/en/book.apcu.php>`__ exists. For
    the purposes of object caching, it can do the job, but it uses different
    function calls than the MediaWiki source code expects (e.g.,
    ``apcu_fetch()`` rather than ``apc_fetch()``). The versions of APCu that
    work with PHP 5.5 and 5.6 include backwards compatibility code that handles
    this. However, the version of APCu that works with PHP 7.0, which is what
    you get if you use ``sudo apt-get install php-apcu``, dropped the backwards
    compatibility. Instead, a `forked version of APCu
    <https://pecl.php.net/package/apcu_bc>`__ needs to be used which restores
    backwards compatibility. To install that, I followed the instructions found
    `here <https://serverpilot.io/community/articles/how-to-install-the-php-apcu-bc-extension.html>`__,
    which have been incorporated into the instructions above.

    This was so much fun to figure out. If you could see my face right now, you
    would know that I am totally serious and not at all being sarcastic.

.. [#mediawiki-version]
    You can visit `this page
    <https://www.mediawiki.org/wiki/Version_lifecycle>`__ to see the release
    schedule for versions of MediaWiki. The `MediaWiki download
    page <https://www.mediawiki.org/wiki/Download>`__ provides the URL for downloading the tar archive.
