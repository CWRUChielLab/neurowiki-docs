Install Operating System
================================================================================

1.  Log into the VirtualBox Machines (vbox) account on DynamicsHJC in front of
    the keyboard and monitor, or using interactive screen sharing (see
    :doc:`/screen-sharing` for details).

2.  On DynamicsHJC, download the installation disk image (ISO file) for the
    latest version of Ubuntu Server with long term support (LTS).

    LTS versions of Ubuntu Server receive guaranteed support (e.g., security
    updates) for 5 years. As of August 2016, the latest LTS version is Ubuntu
    Server 16.04.1 (Xenial Xerus) 64-bit, which will be supported until April
    2021. The next LTS release should be available in April 2018.
    [#ubuntu-version]_

    You can download the Ubuntu Server ISO file `here
    <http://www.ubuntu.com/download/server>`__.

3.  In VirtualBox [#virtualbox]_, press "New" to create a new virtual machine,
    and choose the following settings:

    - Create Virtual Machine
        - Name and operating system
            - Name: neurowiki_2016
            - Type: Linux
            - Version: Ubuntu (64 bit)
        - Memory size: 2048 MB
        - Hard drive: Create a virtual hard drive now
    - Create Virtual Hard Drive
        - Hard drive file type: VDI (VirtualBox Disk Image)
        - Storage on physical hard drive: Dynamically allocated
        - File location: neurowiki_2016
        - File size: 30 GB

    .. warning::

        Do not immediately start the virtual machine! If you do, you should
        delete it and start over, since this may result in an improperly
        configured network interface on the virtual machine.
        [#network-interface]_

4.  After creating the virtual machine, select it and choose Machine > Group.
    Click on the new group's name ("New group"), click Group > Rename Group, and
    rename the group to "2016". Finally, drag-and-drop the new group into the
    "BIOL 373" group.

5.  Set up port forwarding for the virtual machine (see :doc:`/networking-bg`
    for a more detailed explanation). This will allow you to access the new
    virtual machine at a temporary URL as you build it, and the wiki from the
    previous year can remain accessible at https://neurowiki.case.edu until this
    setup is complete.

    In VirtualBox, select the virtual machine and choose Settings > Network.
    With the "Adapter 1" tab selected, change the "Attached to" setting to
    "NAT".

    Under Advanced, click Port Forwarding. Here you can create rules that bind a
    port on the host machine (DynamicsHJC) to a port on the guest machine
    (neurowiki_2016). You need to create two rules (click the "+" button)
    [#host-ports]_:

    =======  ========  =============  =========  =============  ==========
    Name     Protocol  Host IP        Host Port  Guest IP       Guest Port
    =======  ========  =============  =========  =============  ==========
    HTTPS    TCP       [leave blank]  8014       [leave blank]  443
    SSH      TCP       [leave blank]  8015       [leave blank]  22
    =======  ========  =============  =========  =============  ==========

6.  At the end of this instruction set, you will
    :doc:`activate-bridged-networking` (again see :doc:`/networking-bg` for
    background). To make that process as easy as possible, you should set the
    MAC address for the virtual machine now.

    Follow the instructions in :ref:`mac-addresses-lookup` to identify the MAC
    address for NeuroWiki. In VirtualBox, open Settings > Network again, and
    under Advanced replace the randomly generated MAC address with NeuroWiki's.

    Until bridge networking is activated, the MAC address will not actually do
    anything other than ensure that the network interface on the virtual machine
    is properly configured when the operating system is installed.
    [#network-interface]_

7.  Start the new virtual machine. A first-run wizard will begin. Select the
    Ubuntu Server disk image (ISO file) in the Downloads directory on
    DynamicsHJC as a start-up disk.

8.  The virtual machine will boot from the start-up disk. After choosing English
    as the installer language, choose "Install Ubuntu Server" and select the
    following settings:

    - Select a language
        - English
    - Select your location
        - United States
    - Configure the keyboard
        - Detect keyboard layout: No
        - Country of origin for the keyboard: English (US)
        - Keyboard layout: English (US)
    - Configure the network
        - Hostname: neurowiki
    - Set up users and passwords
        - Full name: Hillel Chiel
        - Username: hjc
        - Password: <system password>
        - Encrypt your home directory: No
    - Configure the clock
        - Timezone: America/New York
    - Partition disks
        - Partitioning method: Guided - use entire disk and set up LVM
        - Select the only available disk to partition
        - Write the changes to disks and configure LVM: Yes
        - Amount of volume group to use for guided partitioning: max
        - Write the changes to disks: Yes
    - Configure the package manager
        - HTTP proxy information: [leave blank]
    - Configuring tasksel
        - How do you want to manage upgrades on this system: Install security
          updates automatically
    - Software selection
        - Choose software to install [use Space to select and Enter to finish]:
            - LAMP server
            - Mail server
            - standard system utilities
            - OpenSSH server
        - When prompted, provide a <MySQL password>
        - Postfix Configuration
            - General type of mail configuration: Internet Site
            - System mail name: neurowiki.case.edu
    - Install the GRUB boot loader on a hard disk
        - Install the GRUB boot loader to the master boot record: Yes

    After the installation completes, the virtual machine will restart.

9.  The virtual machine should immediately be accessible via SSH from the
    internet. Connecting to the virtual machine remotely via SSH, rather than at
    DynamicsHJC's physical keyboard or using screen sharing will allow you to
    conveniently enter the remaining commands found in these instructions by
    copying and pasting them into the Terminal window on your own machine.

    To setup SSH connectivity from your personal computer, as well as complete
    some additional account configuration, visit :doc:`/create-vm-account` and
    follow the instructions starting with step 2.

10. If you are not already logged in, do so now::

        ssh -p 8015 hjc@dynamicshjc.case.edu

11. Create an account for Jeff (username: ``gill``) and any other TAs you would
    like to have sudo privileges on the server by completing the first step in
    :doc:`/create-vm-account`. Instruct them to complete the remaining steps in
    that document to finish configuring their accounts. Account creation and
    configuration can also be done at a later time.

12. Upgrade all packages::

        sudo apt-get update
        sudo apt-get dist-upgrade

13. Install these new packages,

        ========================    ============================================
        Package                     Description
        ========================    ============================================
        *ntp*                       Network Time Protocol daemon for automatic
                                    system time sync
        *virtualbox-guest-utils*    VirtualBox guest utilities for communicating
                                    with VM host for time sync and folder
                                    sharing
        ========================    ============================================

    using the following::

        sudo apt-get install ntp virtualbox-guest-utils

14. Shut down the virtual machine::

        sudo shutdown -h now

15. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**OS installed**".


.. rubric:: Footnotes

.. [#ubuntu-version]
    You can visit `this page <https://wiki.ubuntu.com/LTS>`__ to see the release
    schedule for LTS versions of Ubuntu.

.. [#virtualbox]
    As of this writing, we are using `VirtualBox <http://www.virtualbox.org>`__
    version 5.0.26 r108824.

.. [#network-interface]
    In earlier versions of Ubuntu, I encountered this issue where a virtual
    machine initialized with the wrong MAC address required some extra work to
    correct the mistake when it came time to activate bridged networking. I
    think in more recent versions of Ubuntu the MAC address might be detected at
    boot time, which means ensuring it is set properly now is not actually
    necessary, but I haven't tested this extensively.

.. [#host-ports]
    Although the guest ports must have exactly these values (443 and 22 are the
    default ports for HTTPS and SSH, respectively), the host ports were, in
    fact, chosen arbitrarily. You can choose any numbers you like for the host
    ports (up to 65536), but they must not conflict with standard ports that
    DynamicsHJC needs for its own services (ports 0-1024 are reserved for common
    applications, so you should not use values within that range) or any other
    virtual machine that is running using port forwarding. To access the virtual
    machine from off campus, you should also consider using host ports that have
    univeristy firewall exceptions (see :doc:`/firewall-bg` for details). For
    the purposes of this  document, I will assume you are using the host ports
    listed above.
