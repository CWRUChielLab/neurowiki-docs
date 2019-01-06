Create Django Survey Sessions
================================================================================
Although the forms for the Django surveys are already in the Django database,
dated instances of the surveys, called sessions, are not yet created.

1.  Start neurowiki_2016 and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Start neurowiki_2015 if it is not already running.

4.  Export the Django survey sessions from the previous year (you will be
    prompted three times for last year's NeuroWiki password)::

        ssh hjc@neurowiki.case.edu "/var/www/django/manage.py dumpdata survey.surveysession > ~/surveysessions_2015.json"
        scp hjc@neurowiki.case.edu:surveysessions_2015.json ~/
        ssh hjc@neurowiki.case.edu "rm ~/surveysessions_2015.json"

5.  Import the survey sessions (note that this will delete any survey sessions
    that you have created manually, which would appear on `this admin page
    <https://dynamicshjc.case.edu:8014/django/admin/survey/surveysession/>`__).
    The first command (``sed``) will do a search-and-replace on the year to make
    updating the dates in step 7 a little faster. ::

        sed -i 's/2015/2016/g' ~/surveysessions_2015.json
        /var/www/django/manage.py loaddata ~/surveysessions_2015.json
        rm ~/surveysessions_2015.json

6.  Close all the imported survey sessions so that students cannot begin
    accessing them::

        echo "UPDATE survey_surveysession SET open=0;" | mysql -u root -p djangodb

    Enter the <MySQL password> when prompted.

7.  If you haven't done so already, update the dates on the syllabus:

        https://dynamicshjc.case.edu:8014/wiki/Course_syllabus

8.  Update the dates assigned to each survey session in the Django database. For
    each survey listed on the `syllabus
    <https://dynamicshjc.case.edu:8014/wiki/Course_syllabus>`__, click its link
    to navigate to the survey. From there, click the "Edit Survey" button.
    Change the survey date to match the new date listed on the syllabus, and
    then save the survey session. Do this for every survey on the syllabus.

9.  Navigate to the Django admin page for managing all survey sessions:

        https://dynamicshjc.case.edu:8014/django/admin/survey/surveysession/

    Look over the list of sessions for any that still need to be updated. Fix
    these now.

10. Test the links to surveys found on the
    `Course syllabus <https://dynamicshjc.case.edu:8014/wiki/Course_syllabus>`__,
    `Term Paper Proposal <https://dynamicshjc.case.edu:8014/wiki/Term_Paper_Proposal>`__, and
    `Term Paper Benchmarks <https://dynamicshjc.case.edu:8014/wiki/Term_Paper_Benchmarks>`__
    pages to make sure they point to the right sessions and that they have the
    correct dates.

11. Shut down the virtual machine::

        sudo shutdown -h now

12. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Django survey sessions created**".
