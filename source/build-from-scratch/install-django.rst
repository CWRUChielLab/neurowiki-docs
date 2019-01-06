Install Django
================================================================================
`Django <https://www.djangoproject.com/>`_ is used for conducting class surveys.

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
        *python-pip*                Alternative Python package installer
        *python-mysqldb*            Python interface to MySQL
        *python-ldap*               LDAP interface module for Python
        *python-imaging*            Python Imaging Library
        *python-docutils*           Text processing system for reStructuredText
        *libapache2-mod-wsgi*       Python WSGI adapter module for Apache
        ========================    ============================================

    using the following::

        sudo apt-get install python-pip python-mysqldb python-ldap python-imaging python-docutils libapache2-mod-wsgi
        sudo pip install --upgrade pip

4.  Install the latest version of Django with long term support (LTS)
    [#django-version]_.

    LTS versions of Django receive guaranteed support (e.g., security updates)
    for at least 3 years, although these updates must be applied manually (see
    :doc:`/update-django`). As of August 2016, the latest LTS version is
    Django 1.8.14, which will be supported until at least April 2018. The next
    LTS release should be available in April 2017.

    Run this command to install Django::

        sudo pip install Django==1.8.14

5.  Install `django-cas-ng`_ to allow integration between the Django site and
    the CWRU login servers::

        sudo pip install django-cas-ng==3.5.4

    .. _django-cas-ng: https://pypi.python.org/pypi/django-cas-ng

6.  Download our code for implementing our Django site---called
    CourseDjango---to the virtual machine (you will be asked for your password
    for DynamicsHJC)::

        git clone ssh://dynamicshjc.case.edu/~kms15/gitshare/CourseDjango.git /var/www/django

7.  Store the database password and a random "secret key" (which you do not need
    to write down) in a file accessible to Django::

        read -s -r -p "MySQL password: " DBPASS && echo "db_password = '$DBPASS'" > /var/www/django/CourseDjango/passwords.py; DBPASS= ; echo

        echo "secret_key  = '$(openssl rand -hex 32)'" >> /var/www/django/CourseDjango/passwords.py

    Protect the file::

        sudo chmod ug=rw,o= /var/www/django/CourseDjango/passwords.py*

8.  Export the survey forms from last semester's Django database. Surveys for
    both BIOL 373 and BIOL 300 are contained in a single database. You should
    export from last semester's BIOL 300 server because modifications to any
    surveys need to be preserved for future offerings of both courses.

    Run the following commands to export the survey forms (you will be asked to
    accept the unrecognized fingerprint for the BIOL 300 server -- this is
    expected -- and you will need to enter your password for the BIOL 300 server
    three times)::

        ssh hjc@biol300.case.edu "/var/www/django/manage.py dumpsurveyforms > ~/surveyforms.json"
        scp hjc@biol300.case.edu:surveyforms.json ~/
        ssh hjc@biol300.case.edu "rm ~/surveyforms.json"

9.  Create the Django database, import the survey forms, and delete the exported
    survey forms file since it is no longer needed and contains the answers to
    quiz questions (enter the <MySQL password> when prompted)::

        echo "CREATE DATABASE djangodb;" | mysql -u root -p
        /var/www/django/manage.py migrate
        /var/www/django/manage.py loaddata ~/surveyforms.json
        rm ~/surveyforms.json

10. Place static assets (CSS, JS, image files) used by the Django site
    (student-facing and admin) in a directory that can be served by Apache::

        mkdir -p /var/www/html/django/static
        /var/www/django/manage.py collectstatic --noinput --clear

11. Give the web server ownership of and access to the new files::

        sudo chown -R www-data:www-data /var/www/
        sudo chmod -R ug+rw /var/www/

12. Download and install a custom Apache configuration file for Django::

        sudo wget -O /etc/apache2/conf-available/django.conf https://dynamicshjc.case.edu/~vbox/biol373/_downloads/django.conf
        sudo a2enconf django
        sudo apache2ctl restart

    If you are curious about the contents of ``django.conf``, you can view it
    here:

    .. container:: collapsible

        django.conf

        :download:`Direct link </_downloads/misc/django.conf>`

        .. literalinclude:: /_downloads/misc/django.conf
            :language: apache

13. Log into the Django site to automatically create an account for yourself.
    Visit

        https://dynamicshjc.case.edu:8014/django

14. Edit the Django database to make yourself an administrator. Access the
    database::

        mysql -u root -p djangodb

    Enter the <MySQL password> when prompted. Execute these SQL commands:

    .. code-block:: sql

        UPDATE auth_user SET is_superuser=1 WHERE username='hjc';
        UPDATE auth_user SET is_staff=1 WHERE username='hjc';

    Type ``exit`` to quit.

15. The Django administration tools are now accessible at

        https://dynamicshjc.case.edu:8014/django/admin

    You should promote Jeff and any other TAs to superuser and staff status
    using this interface after they log into the Django site for the first time,
    which will create their accounts.

16. Shut down the virtual machine::

        sudo shutdown -h now

17. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Django installed**".


.. rubric:: Footnotes

.. [#django-version]
    You can visit `this page <https://www.djangoproject.com/download/>`__ to see
    the release schedule for LTS versions of Django.
