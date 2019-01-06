Creating Student Accounts and Teams
================================================================================

For the second day of class, you will need to assign students to teams. During
the first two weeks of classes, before the add/drop deadline has passed,
students may join or leave the course, and team assignments will need to be
adjusted accordingly.

Additionally, if you need to assign grades to a student who does not yet have an
account on the wiki, you will need to create one for them before you will be
able to do so.

These instructions will help you accomplish all of these tasks using one script.


.. _create-students-and-teams-install-script:

Installing the Student Account and Team Creation Script
--------------------------------------------------------------------------------

The script needs to be installed only once. Skip to
:ref:`create-students-and-teams-use-script` if installation is complete.

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Install this new package,

        ========================    ============================================
        Package                     Description
        ========================    ============================================
        *python-yaml*               YAML parser and emitter for Python
        ========================    ============================================

    using the following::

        sudo apt-get install python-yaml

4.  Download and install the script for creating student accounts and assigning
    students to teams::

        sudo wget -O /usr/local/sbin/register-students-and-teams https://neurowiki-docs.readthedocs.io/en/latest/_downloads/register-students-and-teams

    Set the MySQL password inside the script::

        read -s -r -p "MySQL password: " DBPASS && sudo sed -i "/^sql_pass =/s|= .*|= '$DBPASS'|" /usr/local/sbin/register-students-and-teams; DBPASS= ; echo

    Protect the password::

        sudo chown root:www-data /usr/local/sbin/register-students-and-teams
        sudo chmod ug=rwx,o= /usr/local/sbin/register-students-and-teams

    If you are curious about the contents of the script, you can view it here:

    .. container:: collapsible

        register-students-and-teams

        :download:`Direct link </_downloads/misc/register-students-and-teams>`

        .. literalinclude:: /_downloads/misc/register-students-and-teams
            :language: python



.. _create-students-and-teams-use-script:

Using the Student Account and Team Creation Script
--------------------------------------------------------------------------------

To use the script, you must first create an input file (a text file with a
simple syntax, see below) containing a list of the emails of students enrolled
in the course and of the instructors. Students who have selected their teammates
can be placed together, and all others will be assigned to teams randomly.

When executed, the script does the following:

- Reads the input file
- Looks up real name information for each email address if a name is not
  specified
- Creates wiki and Django accounts for students and instructors who do not
  already have one
- Assigns students to teams who do not already have one
- Grants privileges to instructors
- Writes an output file containing the name details and modified team
  configuration
- Prints to the screen wikitext that should be copied into the `Student list`_
  wiki page

.. _`Student list`: https://neurowiki.case.edu/wiki/Student_list

The output file has the same syntax as the input file, so it can be run through
the script again with modifications to make changes to the roster and team
assignments. You can even change someone's real name in the output file to a
preferred alternative and rerun the script to change their name on the wiki.

To use the script for the first time this semester, first log into the virtual machine::

    ssh hjc@neurowiki.case.edu

Check for any old input or output files in your home directory that were created
by running the script last year::

    ls ~

If any are present, delete them using ``rm``.

Next, create a file to serve as the input to the script::

    vim ~/input.txt

You should create something that looks like this::

    - Needs team:
        - george.washington@case.edu
        - john.adams@case.edu
        - thomas.jefferson@case.edu
        - james.madison@case.edu
        - james.monroe@case.edu
        - john.quincy.adams@case.edu
        - andrew.jackson@case.edu

    - Instructors:
        - hillel.chiel@case.edu
        - jeffrey.gill@case.edu

Note that the indentations must be spaces, not tabs. Pay attention to
punctuation and white space, e.g., there needs to be a space after each hyphen.
Emails may be of the form ``first.last@case.edu`` or ``abc123@case.edu``.

If some students have requested to be partnered together, you may specify that
now::

    - Team 1:
        - john.adams@case.edu
        - john.quincy.adams@case.edu

    - Needs team:
        - george.washington@case.edu
        - thomas.jefferson@case.edu
        - james.madison@case.edu
        - james.monroe@case.edu
        - andrew.jackson@case.edu

    - Instructors:
        - hillel.chiel@case.edu
        - jeffrey.gill@case.edu

To run the script, execute the following::

    sudo register-students-and-teams ~/input.txt

An output file called ``output-XXX.txt`` will be created, where ``XXX`` will be
a timestamp, and changes to the database will be made. You may use the
``--dry-run`` flag with the script to create the output file without actually
making changes to the MediaWiki or Django databases.

In addition to creating an output file, the script will print messages to the
screen. The last set of messages include wikitext that you should copy into the
`Student list`_ wiki page.

The output file will look something like this::

    - Team 1:
      - john.adams@case.edu:
          first: John
          last: Adams
          uid: jxa
      - john.quincy.adams@case.edu:
          first: John
          last: Adams
          uid: jqa
    - Team 2:
      - andrew.jackson@case.edu:
          first: Andrew
          last: Jackson
          uid: axj
      - james.monroe@case.edu:
          first: James
          last: Monroe
          uid: jxm2
    - Team 3:
      - james.madison@case.edu:
          first: James
          last: Madison
          uid: jxm
      - thomas.jefferson@case.edu:
          first: Thomas
          last: Jefferson
          uid: txj
      - george.washington@case.edu:
          first: George
          last: Washington
          uid: gxw
    - Instructors:
      - hillel.chiel@case.edu:
          first: Hillel
          last: Chiel
          uid: hjc
      - jeffrey.gill@case.edu:
          first: Jeffrey
          last: Gill
          uid: jpg18

In this example, because there were an odd number of students, a team of three
was created.

.. note::

    For BIOL 373, students who are enrolled as graduate students must be
    manually marked as such in the grading system. Visit the `Manage groups
    <https://neurowiki.case.edu/wiki/Special:Grades/groups>`__ page for the
    grading software and switch the graduate students from the "Undergrads" to
    the "Grads" group.

If you later need to make changes to the roster, **you should use the output
file as the new input**. Make a copy of the file first, modify it, and then
re-run the script.

Suppose John Quincy Adams tells you that he prefers to go by "Johnny". You just
need to modify JQA's first name in the output file and re-run the script.

Suppose James Monroe drops the course. The script isn't clever enough to see
that one of the members of the team of three needs to be moved to Team 2 to
rebalance them. To resolve this, you should modify the output file by deleting
James Monroe and moving one of the members of Team 3 into Team 2 manually before
re-running the script.

If a large number of new students enrolls in the class after some teams already
exist, you can randomly assign them to new teams by adding the ``Needs team:``
heading used in the original input file.
