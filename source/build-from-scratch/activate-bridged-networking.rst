Activate Bridged Networking
================================================================================

1.  If neurowiki_2016 is running, log in and shut it down::

        ssh -p 8015 hjc@dynamicshjc.case.edu
        sudo shutdown -h now

2.  If neurowiki_2015 is running, shut it down as well::

        ssh hjc@neurowiki.case.edu
        sudo shutdown -h now

3.  In VirtualBox, select neurowiki_2016 and choose Settings > Network. Change
    the "Attached to" setting to "Bridged Adapter". Under Advanced, verify that
    the MAC address matches NeuroWiki's (see :ref:`mac-addresses-lookup` for
    instructions).

4.  Start neurowiki_2016 and log in using the new address::

        ssh-keygen -R neurowiki.case.edu
        ssh hjc@neurowiki.case.edu

5.  Fix the backup script. Log into the vbox account on DynamicsHJC::

        ssh vbox@dynamicshjc.case.edu

    and edit the file ::

        vim /Volumes/CHIELWIKI/backups/neurowiki/2016/backup-neurowiki.sh

    comment out the definitions for ``REMOTESSH`` and ``REMOTESCP`` containing
    ``dynamicshjc.case.edu`` and uncomment the definitions containing
    ``neurowiki.case.edu``.

6.  Fix SSH authentication into NeuroWiki from the vbox account. You will be
    asked to accept the unrecognized fingerprint of the virtual machine --- this
    is expected --- but you should NOT need to enter your password. The IP
    address is the static IP for neurowiki.case.edu, obtained using ``host
    neurowiki.case.edu``. ::

        ssh-keygen -R neurowiki.case.edu -R 129.22.139.42
        ssh hjc@neurowiki.case.edu

    If this works without you needing to enter a password, automatic
    authentication is properly configured. You should ``logout`` to return to
    the vbox account on DynamicsHJC, and ``logout`` again to return to the
    virtual machine.

7.  Shut down the virtual machine::

        sudo shutdown -h now

8.  Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Bridged networking enabled**".
