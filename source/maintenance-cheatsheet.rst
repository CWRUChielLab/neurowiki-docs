Wiki Maintenance Cheatsheet
================================================================================

.. todo::

    The instructions for new TAs ought to be moved to their own page.

- Steps to take for new TAs:

    - Ask the TA to log into the wiki to automatically create their MediaWiki
      account. You should then visit `Special:UserRights
      <https://neurowiki.case.edu/wiki/Special:UserRights>`__ and add them to
      the *administrator*, *bureaucrat*, and *grader* user groups.

    - Instruct the TA to replace the contents of their personal page (accessed
      by clicking their name in the top-right corner while logged in) with the
      following (they should ignore the warning intended for students)::

        {{instructor links}}

    - Ask the TA to log into the Django site by visiting any survey to
      automatically create their Django account. You should then visit the
      `Django user admin page
      <https://neurowiki.case.edu/django/admin/auth/user/>`__ and grant them the
      *Staff status* and *Superuser status* permissions.

    - Update the neuroinstructors@case.edu mailing list subscribers:

        https://groups.google.com/a/case.edu/forum/#!managemembers/neuroinstructors/members/active

    - Update the instructor and office hours listing on the *Course policies*
      page:

        https://neurowiki.case.edu/wiki/Course_policies

- Some useful commands:

    - Logging in, with port forwarding::

        ssh -p 8015 hjc@dynamicshjc.case.edu

    - Logging in, with bridged networking::

        ssh hjc@neurowiki.case.edu

    - Copying files from your local machine to your home folder on the server,
      with port forwarding::

        scp -P 8015 /path/to/local/files hjc@dynamicshjc.case.edu:

    - Copying files from your local machine to your home folder on the server,
      with bridged networking::

        scp /path/to/local/files hjc@neurowiki.case.edu:

    - Testing Django code as non-staff (do not forget to undo when done with
      ``is_staff=1``!):

      .. code-block:: sql

        mysql -u root -p djangodb
        UPDATE auth_user SET is_staff=0 WHERE username='hjc';

    - Emptying the `ScholasticGrading grade log
      <https://neurowiki.case.edu/wiki/Special:Log/grades>`__ (useful for
      development)::

        echo "DELETE FROM logging WHERE log_type='grades';" | mysql -u root -p wikidb

    - Viewing APT package descriptions::

        apt-cache search foo

    - Cleaning up directories::

        find . -name \*.pyc -exec rm \{\} \;
        find . -name \*~ -exec rm \{\} \;

- Important file locations:

    =================================  =========================================
    Apache error and access logs       ``/var/log/apache2/``
    Apache configuration directory     ``/etc/apache2/``
    Apache configuration files         ``/etc/apache2/conf-available/``
    SSL certificates                   ``/media/sf_ssl-certificates/``
    Web root directory                 ``/var/www/html/``
    MediaWiki source directory         ``/var/www/mediawiki/``
    MediaWiki extensions directory     ``/var/www/mediawiki/extensions/``
    MediaWiki configuration file       ``/var/www/mediawiki/LocalSettings.php``
    Django directory                   ``/var/www/django/``
    Simulations directory              ``/var/www/html/JSNeuroSim/``
    =================================  =========================================
