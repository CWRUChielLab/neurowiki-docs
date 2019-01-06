MAC Addresses
================================================================================

See :doc:`networking-bg` for additional background.


.. _mac-addresses-lookup:

Looking Up MAC Addresses
--------------------------------------------------------------------------------

Each of our virtual machines has associated with it a random string of numbers
called its MAC address. Because of the risk of MAC spoofing, these number are
secured on DynamicsHJC.

If you are logged into the VirtualBox Machines (vbox) account on DynamicsHJC,
you view the file using ::

    cat ~/mac-addresses.txt

or, if you are sitting in front of the monitor, opening the file through Finder.
It is stored in the home directory.

If you are not logged into the vbox account, you can obtain the list through
SSH::

    ssh vbox@dynamicshjc.case.edu "cat ~/mac-addresses.txt"


.. _mac-addresses-registration:

Registering New MAC Addresses
--------------------------------------------------------------------------------

Additional machine names with new MAC addresses can be registered with the
university network by following these steps:

1.  Generate a new random MAC address by selecting the virtual machine in
    VirtualBox, choosing Settings > Network > Advanced, and clicking the blue
    arrows. Write this number down and press OK. If the virtual machine is
    configured to use bridged networking ("Attached to: Bridged Adapter"), it
    will not be able to connect to the CWRU wired network until the remaining
    steps are completed.

2.  Ask Dr. Chiel to visit (using a different machine) `UTech Self-Service
    Tools`_, choose `Student Device Registration`_, and enter his CWRU
    credentials. He should then submit the machine name of the virtual machine
    (chosen during OS installation and retrievable by typing ``hostname`` on the
    command line) and the new MAC address.

    If Dr. Chiel is unavailable, you can start this process yourself and later
    submit a request to help@case.edu to transfer ownership of the registered
    machine to him.

    .. _`UTech Self-Service Tools`: https://its-services.case.edu/tools/

    .. _`Student Device Registration`: https://www.case.edu/its/devreg

    .. todo::

        Verify that `Student Device Registration`_ works for non-students.

3.  Registration may take several hours to complete. Once done, internet access
    will be restored to the virtual machine if it is configured for bridged
    networking. If it is using port forwarding ("Attached to: NAT"), there
    should have been no interruption of internet access.

4.  Add the new hostname and MAC address to the file
    ``/Users/vbox/mac-addresses.txt`` on DynamicsHJC.