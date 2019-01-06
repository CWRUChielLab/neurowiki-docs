Configure Automatic Backup
================================================================================

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Download and install the backup script::

        sudo wget -O /usr/local/sbin/backup-wiki https://neurowiki-docs.readthedocs.io/en/latest/_downloads/backup-wiki

    Set the MySQL password inside the script::

        read -s -r -p "MySQL password: " DBPASS && sudo sed -i '/^SQLPASS=/s|=.*|='$DBPASS'|' /usr/local/sbin/backup-wiki; DBPASS= ; echo

    Protect the password::

        sudo chown root:www-data /usr/local/sbin/backup-wiki
        sudo chmod ug=rwx,o= /usr/local/sbin/backup-wiki

    If you are curious about the contents of the script, you can view it here:

    .. container:: collapsible

        backup-wiki

        :download:`Direct link </_downloads/misc/backup-wiki>`

        .. literalinclude:: /_downloads/misc/backup-wiki
            :language: bash

4.  .. todo::

        Make the backup script that lives on DynamicsHJC and the cron job list
        downloadable.

    In a different Terminal window, log into the VirtualBox Machines (vbox)
    account on DynamicsHJC::

        ssh vbox@dynamicshjc.case.edu

    Create a script that remotely executes the backup script and moves the
    archive to the backup drive. Create the file ::

        mkdir -p /Volumes/CHIELWIKI/backups/neurowiki/2016
        vim /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh

    and fill it with the following:

    .. code-block:: bash

        #!/bin/bash

        #REMOTESSH="ssh hjc@neurowiki.case.edu"
        REMOTESSH="ssh -p 8015 hjc@dynamicshjc.case.edu"

        #REMOTESCP="scp -q hjc@neurowiki.case.edu"
        REMOTESCP="scp -q -P 8015 hjc@dynamicshjc.case.edu"

        REMOTEFILE=neurowiki-backup-`date +'%Y%m%dT%H%M%S%z'`.tar.bz2
        if [ -z "$1" ]; then
            LOCALFILE=/Volumes/CHIELWIKI/backups/neurowiki/2016/$REMOTEFILE
        else
            LOCALFILE=/Volumes/CHIELWIKI/backups/neurowiki/2016/$1
        fi

        $REMOTESSH backup-wiki -q backup $REMOTEFILE
        $REMOTESCP:$REMOTEFILE $LOCALFILE
        chmod go= $LOCALFILE
        $REMOTESSH rm $REMOTEFILE

5.  Make the script executable::

        chmod u+x /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh

6.  Copy the public SSH key from the vbox account on DynamicsHJC to the virtual
    machine to allow automatic authentication (you will be asked to accept the
    unrecognized fingerprint of the virtual machine --- this is expected --- and
    you will be asked for your password to the virtual machine twice)::

        ssh-keygen -R [dynamicshjc.case.edu]:8015
        scp -P 8015 ~/.ssh/id_rsa.pub hjc@dynamicshjc.case.edu:
        ssh -p 8015 hjc@dynamicshjc.case.edu "mkdir -p .ssh && cat id_rsa.pub >> .ssh/authorized_keys && rm id_rsa.pub"

    Test whether automatic authentication is working by trying to log into the
    virtual machine from the vbox account on DynamicsHJC --- you should NOT need
    to enter your password::

        ssh -p 8015 hjc@dynamicshjc.case.edu

    If this works without you needing to enter a password, automatic
    authentication is properly configured. You should ``logout`` to return to
    the vbox account on DynamicsHJC.

7.  In the vbox account on DynamicsHJC, create a backup schedule. Create the
    file ::

        vim /Volumes/CHIELWIKI/backups/neurowiki/2016/crontab

    and fill it with the following:

    .. code-block:: bash

        ################################################################################
        #                                  NEUROWIKI                                   #
        ################################################################################
        # Make hourly backups on the odd-numbered hours (except 1 AM and 3 AM)
        0 5,9,13,17,21  * * * /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh hourA.tar.bz2
        0 7,11,15,19,23 * * * /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh hourB.tar.bz2
        # Make daily backups at 1 AM
        0 1 * * 0 /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh sunday.tar.bz2
        0 1 * * 1 /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh monday.tar.bz2
        0 1 * * 2 /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh tuesday.tar.bz2
        0 1 * * 3 /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh wednesday.tar.bz2
        0 1 * * 4 /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh thursday.tar.bz2
        0 1 * * 5 /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh friday.tar.bz2
        0 1 * * 6 /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh saturday.tar.bz2
        # Make weekly backups at 3 AM on the 1st, 8th, 15th, and 22nd of the month
        0 3 1  * * /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh `date +'\%Y-\%m'`.tar.bz2
        0 3 8  * * /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh 8th.tar.bz2
        0 3 15 * * /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh 15th.tar.bz2
        0 3 22 * * /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh 22nd.tar.bz2

8.  Schedule the backups. In the vbox account on DynamicsHJC, dump the existing
    scheduled jobs to a temporary file::

        crontab -l > /tmp/crontab.old

    Edit the temporary file, and delete the backup jobs for last year's
    NeuroWiki (leave the jobs for NeuroWikiDev for now). You can use ``Shift+v``
    in Vim to enter Visual Line mode, the up and down arrow keys to select a
    block of lines, and ``d`` to delete them all at once. ::

        vim /tmp/crontab.old

    Now append the new jobs to the old and schedule them::

        cat {/tmp/crontab.old,/Volumes/CHIELWIKI/backups/neurowiki/2016/crontab} | crontab

    Verify that the backup jobs for this year's NeuroWiki are properly
    scheduled, and that backup jobs for last year's NeuroWiki are absent::

        crontab -l

9.  Log out of the vbox account::

        logout

    You can now return to your original Terminal window.

10. Shut down the virtual machine::

        sudo shutdown -h now

11. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Automatic backups configured**".
