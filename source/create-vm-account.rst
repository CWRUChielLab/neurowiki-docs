Creating Virtual Machine Accounts
================================================================================

These instructions will guide you through all the steps needed to create a new
account for someone (e.g., a TA) on the virtual machine. Throughout these
instructions, you should replace the placeholder ``<name>`` with the actual name
of the new account.

.. warning::

    The created account will have unlimited administrative privileges on the
    virtual machine. Be careful who you give an account to.

1.  An existing sysadmin must run the following commands to create the account.
    The first command creates the new account and adds it to the sudo (sysadmin)
    group. The second command sets an initial password for the account. Be
    prepared to share this with the owner of the new account. ::

        sudo useradd -m -s /bin/bash -G sudo <name>
        sudo passwd <name>

.. note::

    The remaining steps should be performed by the account owner.

2.  To connect to the virtual machine remotely, you must have access to a
    command line interface on your personal machine. If you own a Mac or Linux
    computer, Terminal should already be installed. If you own a Windows
    computer, you should install the `Windows Subsystem for Linux
    <https://msdn.microsoft.com/commandline/wsl>`__ (Windows 10 only) or `Cygwin
    <https://www.cygwin.com/>`__.

3.  At the command line on your personal machine, log into the virtual machine
    using one of the following pairs of commands::

        ssh-keygen -R [dynamicshjc.case.edu]:8015
        ssh -p 8015 <name>@dynamicshjc.case.edu

    if the virtual machine is still under construction and is connected to the
    network using port forwarding, or ::

        ssh-keygen -R neurowiki.case.edu
        ssh <name>@neurowiki.case.edu

    if the virtual machine is publicly visible and using bridged netorking.

    First, you will be asked to accept the unrecognized fingerprint of the
    virtual machine; enter "yes". Second, you will need to enter your password.
    Finally, you should be greeted by a welcome message, and the command prompt
    should change to ``<name>@neurowiki:~$``.

    If you would like to change your password, you may do so now using the
    following command::

        passwd

4.  On the virtual machine, add yourself to the www-data (Apache web server)
    group to make accessing files in the web directory easier::

        sudo usermod -a -G www-data <name>

    You must ``logout`` and back in for this change to take effect (you do not
    need to do so now).

.. note::

    The following steps are optional.

5.  If you would like to be able to log into the virtual machine without needing
    to enter your password, do the following.

    First, logout of the virtual machine to return to your personal computer::

        logout

    Second, generate an SSH key on your personal computer if you do not have one
    already. If you do, this command will recognize that and do nothing.
    Otherwise, press Enter three times when asked about the file location and
    passphrase::

        [ -e ~/.ssh/id_rsa ] || ssh-keygen

    Third, copy your public SSH key to the virtual machine using one of the
    following commands (you will need to enter your password for the
    virtual machine once or twice).

    If the virtual machine is still under construction and is connected to the
    network using port forwarding, and if ``ssh-copy-id`` is available on your
    personal computer, use ::

        ssh-copy-id -p 8015 <name>@dynamicshjc.case.edu

    If ``ssh-copy-id`` is unavailable, use ::

        scp -P 8015 ~/.ssh/id_rsa.pub <name>@dynamicshjc.case.edu:
        ssh -p 8015 <name>@dynamicshjc.case.edu "mkdir -p .ssh && cat id_rsa.pub >> .ssh/authorized_keys && rm id_rsa.pub"

    If the virtual machine is publicly visible and using bridged netorking, and
    if ``ssh-copy-id`` is available on your personal computer, use ::

        ssh-copy-id <name>@neurowiki.case.edu

    If ``ssh-copy-id`` is unavailable, use ::

        scp ~/.ssh/id_rsa.pub <name>@neurowiki.case.edu:
        ssh <name>@neurowiki.case.edu "mkdir -p .ssh && cat id_rsa.pub >> .ssh/authorized_keys && rm id_rsa.pub"

    You should now be able to log into the virtual machine without entering your
    password. Do so now using using one of the following commands::

        ssh -p 8015 <name>@dynamicshjc.case.edu

    if the virtual machine is still under construction and is connected to the
    network using port forwarding, or ::

        ssh <name>@neurowiki.case.edu

    if the virtual machine is publicly visible and using bridged netorking.

6.  Create a Vim configuration file on the virtual machine by following the
    directions in :ref:`vimrc`.
