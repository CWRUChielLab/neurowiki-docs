Updating MediaWiki
================================================================================

The `MediaWiki-announce mailing list
<https://lists.wikimedia.org/mailman/listinfo/mediawiki-announce>`__ provides
announcements for security updates and new releases. Emails from this list
provide links to patches that make upgrading easy. The patches can also be found
`here <http://releases.wikimedia.org/mediawiki/>`__. General instructions for
upgrading can be found `here
<https://www.mediawiki.org/wiki/Manual:Upgrading>`__.

The following provides an example of how to upgrade using a patch file::

    wget -P ~ http://releases.wikimedia.org/mediawiki/1.27/mediawiki-1.27.2.patch.gz
    gunzip ~/mediawiki-1.27.2.patch.gz
    patch -p1 -d /var/www/mediawiki < ~/mediawiki-1.27.2.patch
    rm ~/mediawiki-1.27.2.patch
    sudo chown -R www-data:www-data /var/www/mediawiki
    sudo chmod -R ug+rw /var/www/mediawiki
    sudo chmod ug=rw,o= /var/www/mediawiki/LocalSettings.php*
    php /var/www/mediawiki/maintenance/update.php
