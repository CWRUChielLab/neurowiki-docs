Configuring the Development Server
================================================================================

1.  If neurowiki_2016 is running, log in and shut it down::

        ssh hjc@neurowiki.case.edu
        sudo shutdown -h now

2.  If neurowikidev_2015 is running, shut it down as well::

        ssh hjc@neurowikidev.case.edu
        sudo shutdown -h now

3.  Using VirtualBox, take a snapshot of the current state of neurowiki_2016.
    Name it "**Last shared state between neurowiki and neurowikidev**".

4.  In VirtualBox, create a clone of neurowiki_2016 by selecting the virtual
    machine and Machine > Clone, and choosing the following settings:

    - New machine name
        - Name: neurowikidev_2016
        - Do NOT check "Reinitialize the MAC address of all network cards"
    - Clone type
        - Full clone
    - Snapshots
        - Current machine state

    Drag-and-drop the new virtual machine into the "2016" group under "BIOL
    373".

5.  In VirtualBox, select neurowikidev_2016 and choose Settings > Network.
    Verify that the "Attached to" setting is set to "Bridged Adapter". Under
    Advanced, change the MAC address to match NeuroWikiDev's (see
    :ref:`mac-addresses-lookup` for instructions).

6.  Restart neurowiki_2016. Start neurowikidev_2016 for the first time and log
    in::

        ssh-keygen -R neurowikidev.case.edu
        ssh hjc@neurowikidev.case.edu

7.  Change the name that the development server uses to identify itself to the
    network::

        sudo hostnamectl set-hostname neurowikidev

8.  You should now be able to access it in a browser:

        https://neurowikidev.case.edu

9.  .. todo::

        Make the backup script that lives on DynamicsHJC and the cron job list
        downloadable.

    Log into the vbox account on DynamicsHJC::

        ssh vbox@dynamicshjc.case.edu

    Create a script that remotely executes the backup script on the development
    virtual machine and moves the archive to the backup drive. Create the file
    ::

        mkdir -p /Volumes/CHIELWIKI/backups/neurowikidev/2016
        vim /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh

    and fill it with the following:

    .. code-block:: bash

        #!/bin/bash

        REMOTESSH="ssh hjc@neurowikidev.case.edu"
        #REMOTESSH="ssh -p 8015 hjc@dynamicshjc.case.edu"

        REMOTESCP="scp -q hjc@neurowikidev.case.edu"
        #REMOTESCP="scp -q -P 8015 hjc@dynamicshjc.case.edu"

        REMOTEFILE=neurowikidev-backup-`date +'%Y%m%dT%H%M%S%z'`.tar.bz2
        if [ -z "$1" ]; then
            LOCALFILE=/Volumes/CHIELWIKI/backups/neurowikidev/2016/$REMOTEFILE
        else
            LOCALFILE=/Volumes/CHIELWIKI/backups/neurowikidev/2016/$1
        fi

        $REMOTESSH backup-wiki -q backup $REMOTEFILE
        $REMOTESCP:$REMOTEFILE $LOCALFILE
        chmod go= $LOCALFILE
        $REMOTESSH rm $REMOTEFILE

10. Make the script executable::

        chmod u+x /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh

11. In the vbox account on DynamicsHJC, create a backup schedule. Create the
    file ::

        vim /Volumes/CHIELWIKI/backups/neurowikidev/2016/crontab

    and fill it with the following:

    .. code-block:: bash

        ################################################################################
        #                                 NEUROWIKIDEV                                 #
        ################################################################################
        # Make hourly backups on the odd-numbered hours (except 1 AM and 3 AM)
        0 5,9,13,17,21  * * * /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh hourA.tar.bz2
        0 7,11,15,19,23 * * * /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh hourB.tar.bz2
        # Make daily backups at 1 AM
        0 1 * * 0 /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh sunday.tar.bz2
        0 1 * * 1 /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh monday.tar.bz2
        0 1 * * 2 /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh tuesday.tar.bz2
        0 1 * * 3 /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh wednesday.tar.bz2
        0 1 * * 4 /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh thursday.tar.bz2
        0 1 * * 5 /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh friday.tar.bz2
        0 1 * * 6 /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh saturday.tar.bz2
        # Make weekly backups at 3 AM on the 1st, 8th, 15th, and 22nd of the month
        0 3 1  * * /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh `date +'\%Y-\%m'`.tar.bz2
        0 3 8  * * /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh 8th.tar.bz2
        0 3 15 * * /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh 15th.tar.bz2
        0 3 22 * * /Volumes/CHIELWIKI/backups/neurowikidev/2016/backup-neurowikidev.sh 22nd.tar.bz2

12. Schedule the backups. In the vbox account on DynamicsHJC, dump the existing
    scheduled jobs to a temporary file::

        crontab -l > /tmp/crontab.old

    Edit the temporary file, and delete the backup jobs for last year's
    NeuroWikiDev. You can use ``Shift+v`` in Vim to enter Visual Line mode, the
    up and down arrow keys to select a block of lines, and ``d`` to delete them
    all at once. ::

        vim /tmp/crontab.old

    Now append the new jobs to the old and schedule them::

        cat {/tmp/crontab.old,/Volumes/CHIELWIKI/backups/neurowikidev/2016/crontab} | crontab

    Verify that the backup jobs for this year's NeuroWikiDev are properly
    scheduled, and that backup jobs for last year's NeuroWikiDev are absent::

        crontab -l

13. Fix SSH authentication into NeuroWikiDev from the vbox account. You will be
    asked to accept the unrecognized fingerprint of the virtual machine --- this
    is expected --- but you should NOT need to enter your password. The IP
    address is the static IP for neurowikidev.case.edu, obtained using ``host
    neurowikidev.case.edu``. ::

        ssh-keygen -R neurowikidev.case.edu -R 129.22.139.49
        ssh hjc@neurowikidev.case.edu

    If this works without you needing to enter a password, automatic
    authentication is properly configured. You should ``logout`` to return to
    the vbox account on DynamicsHJC, and ``logout`` again to return to the
    virtual machine.

14. Shut down the development virtual machine::

        sudo shutdown -h now

15. Using VirtualBox, take a snapshot of the current state of neurowikidev_2016.
    Name it "**neurowikidev configured**".

16. Restart neurowikidev_2016.
