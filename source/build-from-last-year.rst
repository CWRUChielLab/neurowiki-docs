Building from Last Year
================================================================================

1.  If last year's virtual machine is running, log in and shut it down::

        ssh hjc@neurowiki.case.edu
        sudo shutdown -h now

2.  In VirtualBox, create a clone of last year's virtual machine by selecting it
    and Machine > Clone, and choosing the following settings:

    - New machine name
        - Name: neurowiki_YYYY (new year here)
        - Do NOT check "Reinitialize the MAC address of all network cards"
    - Clone type
        - Full clone
    - Snapshots
        - Current machine state

3.  After cloning the virtual machine, select it and choose Machine > Group.
    Click on the new group's name ("New group"), click Group > Rename Group, and
    rename the group to the current year. Finally, drag-and-drop the new group
    into the "BIOL 373" group.

4.  Using VirtualBox, take a snapshot of the current state of the new virtual
    machine. Name it "**Cloned from neurowiki_YYYY**" (old year).

5.  Start the new virtual machine and log in::

        ssh hjc@neurowiki.case.edu

6.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

7.  Install this new package if necessary,

        =========================== ============================================
        Package                     Description
        =========================== ============================================
        *jq*                        lightweight and flexible command-line JSON
                                    processor
        =========================== ============================================

    using the following::

        sudo apt-get install jq

8.  If it is not already installed, download and install the wiki reset script::

        sudo wget -O /usr/local/sbin/reset-wiki https://neurowiki-docs.readthedocs.io/en/latest/_downloads/reset-wiki

    Set the MySQL password inside the script::

        read -s -r -p "MySQL password: " DBPASS && echo && sudo sed -i '/^SQLPASS=/s|=.*|='$DBPASS'|' /usr/local/sbin/reset-wiki; DBPASS=

    Choose a password for a new wiki account that will be created by the reset
    script and store it inside the script (you will need this again in step
    11)::

        read -s -r -p "Wiki password for new bot account (min 8 chars): " BOTPASS && echo && sudo sed -i '/^BOTPASS=/s|=.*|='$BOTPASS'|' /usr/local/sbin/reset-wiki; BOTPASS=

    Protect the passwords::

        sudo chown root:www-data /usr/local/sbin/reset-wiki
        sudo chmod ug=rwx,o= /usr/local/sbin/reset-wiki

    If you are curious about the contents of the script, you can view it here:

    .. container:: collapsible

        reset-wiki

        :download:`Direct link </_downloads/misc/reset-wiki>`

        .. literalinclude:: /_downloads/misc/reset-wiki
            :language: bash

9.  .. todo::

        Add instructions for updating ignored users in the reset-wiki script and
        for first saving exemplars.

10. Start a ``screen`` session::

        screen -dRR

    The screen session will allow you to disconnect from the server without
    interrupting the script as it runs.

11. Run the script and follow the step-by-step instructions::

        sudo reset-wiki

    If this is the first time the script is run, three new wiki accounts will be
    created. You will be asked to choose passwords for each. It is fine to use
    the same password for all three. The password for the first account (the
    bot) must match the password stored in the script, which you specified in
    step 8. The passwords for the other two accounts will never be needed after
    they are created.

    Running this script can take a long time (hours). If you need to disconnect
    from the server while the script is running, press ``Ctrl-a d`` (that's the
    key combination ``Ctrl-a`` followed by the ``d`` key alone) to detach from
    the screen session. You can then log out of the server. To return to the
    screen session later, just run ``screen -dRR`` again after logging in.

12. Once the wiki has been successfully reset, shut down the virtual machine::

        sudo shutdown -h now

13. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Former students' wiki content deleted**".

14. Delete the first snapshot, created in step 4, to save disk space.

15. Restart the virtual machine and log in::

        ssh hjc@neurowiki.case.edu

16. Unlock the wiki so that students can make edits if it is still locked from
    the end of the last semester (running the command will tell you whether it
    is locked or unlocked)::

        sudo lock-wiki

17. .. todo::

        Need to add instructions for updating miscellaneous wiki pages, syllabus
        dates, assignment dates, survey session dates after resetting the wiki.
