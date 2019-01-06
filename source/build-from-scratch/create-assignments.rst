Create ScholasticGrading Assignments
================================================================================
The ScholasticGrading MediaWiki extension must be populated with all the
assignments for the entire semester.

1.  Start neurowiki_2016 and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Start neurowiki_2015 if it is not already running.

4.  If you haven't done so already, give yourself (and any other TAs) privileges
    to edit grades. Navigate to

        https://dynamicshjc.case.edu:8014/wiki/Special:UserRights

    and add each instructor to the "grader" group.

5.  Export the ScholasticGrading student groups, assignments, and
    assignment-group-membership tables from the previous year (remember to
    add the MySQL password from last Fall to the first command, and note that
    you will be prompted three times for last year's NeuroWiki password)::

        ssh hjc@neurowiki.case.edu "mysqldump --user=root --password=<NeuroWiki 2015 MySQL password> -c neurowiki_wiki public_scholasticgrading_group public_scholasticgrading_assignment public_scholasticgrading_groupassignment > ~/scholasticgrading_2015.sql"
        scp hjc@neurowiki.case.edu:scholasticgrading_2015.sql ~/
        ssh hjc@neurowiki.case.edu "rm ~/scholasticgrading_2015.sql"

    .. todo::

        For exporting content from the 2015 wiki, the commands above are fine,
        but they should be revised for the future by removing the ``public_``
        prefix and using the ``wikidb`` database name.

6.  Import the ScholasticGrading tables (note that this will delete any groups
    or assignments you have created manually, which would appear on the `Manage
    groups
    <https://dynamicshjc.case.edu:8014/w/index.php?title=Special:Grades&action=groups>`__
    page and the `Manage assignments
    <https://dynamicshjc.case.edu:8014/w/index.php?title=Special:Grades&action=assignments>`__
    page).

    The first ``sed`` command will do a search-and-replace on the year
    to make updating the dates in the next step a little faster. The second
    ``sed`` command will correct for the change in database table names as a
    result of dropping the public/private dual wiki system this year. ::

        sed -i 's/2015/2016/g' ~/scholasticgrading_2015.sql
        sed -i 's/public_//g' ~/scholasticgrading_2015.sql
        mysql -u root -p wikidb < ~/scholasticgrading_2015.sql
        rm ~/scholasticgrading_2015.sql

    Enter the <MySQL password> when prompted.

7.  Update the dates for each assignment. Navigate to the assignments management
    page,

        https://dynamicshjc.case.edu:8014/w/index.php?title=Special:Grades&action=assignments

    First, check that the point total (listed at the bottom of the page) is 100
    for both the "Grads" and "Undergrads" student groups.

    Next, for each assignment, determine the appropriate new date using the
    `syllabus <https://dynamicshjc.case.edu:8014/wiki/Course_syllabus>`__ and
    update it. Remember to "Apply changes" often so you don't lose work!

8.  To see what the assignment list looks like to a student, navigate to the
    groups management page,

        https://dynamicshjc.case.edu:8014/w/index.php?title=Special:Grades&action=groups

    Add yourself to the "Undergrads" group and press "Apply changes". Next,
    navigate to the "View all user scores" page,

        https://dynamicshjc.case.edu:8014/w/index.php?title=Special:Grades&action=viewalluserscores

    You should see the complete list of assignments under your name, along with
    the racetrack. Look this over to see if everything looks correct. All the
    runners should be all the way on the left. Once you are done, remove
    yourself from the "Undergrads" group.

    Repeat this verification step with the "Grads" group. Remove yourself from
    the "Grads" group once you are done.

9.  Shut down the virtual machine::

        sudo shutdown -h now

10. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**ScholasticGrading assignments created**".
