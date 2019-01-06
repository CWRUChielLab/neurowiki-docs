Port Forwarding & Bridged Networking
================================================================================

DynamicsHJC is a computer (an actual computer, not a virtual machine) in the
Chiel lab. VirtualBox and all our virtual machines are running on it.

DynamicsHJC is plugged into the wired network via ethernet. Associated with
every computer's ethernet port is a unique MAC address, which is basically a
number that it uses to identify itself to the network.

When a new computer is first plugged into the wired network on campus, it can't
use the internet until you complete a registration wizard that pops up in the
browser. This registration process is triggered by the fact that the MAC address
is not recognized by Case.  Registration links a computer's name (hostname) to
its MAC address.

In our case, the hostname is "dynamicshjc".  I've set up a web server on that
computer, and that's where these wiki setup instructions are hosted (notice that
``dynamicshjc.case.edu`` is in the address). When you visit these instructions
in a web browser, the university network routes you to our lab computer by doing
a lookup of the hostname in its registration database to determine which
ethernet port to connect you with.

Since our virtual machines are running on DynamicsHJC, they all share a single
ethernet port. How can the network properly route web traffic to the right
machine if more than one lives at the same address? There are two mutually
exclusive ways of solving this problem with VirtualBox: port forwarding and
bridged networking.

**Port forwarding** assigns to a virtual machine a unique port number (analogous
to having multiple apartments at one street address). To connect to a virtual
machine using port forwarding, you'd type something like this into your web
browser: https://dynamicshjc.case.edu:8014. More precisely, individual ports on
the host (host ports) are mapped to individual ports on the virtual machine
(guest ports). In this example, the host port 8014 on DynamicsHJC is mapped to
the guest port 443 (the standard HTTPS port) on the virtual machine. We use this
method throughout these instructions while set up is in progress to avoid
conflicts with the existing wiki site.

With **bridged networking**, the virtual machine is assigned a randomly
generated, faux MAC address, which the computer running VirtualBox presents to
the network as if it's actually a different ethernet port. When this is done,
the network can't tell the difference between a virtual machine using bridged
networking and a real computer using its own unique ethernet port. Using the
network registration process outlined :ref:`here <mac-addresses-registration>`,
you can associate a hostname with the virtual machine's phony MAC address (this
only ever needs to be done once), and thus it can be accessed like a real
machine at an address like ``neurowiki.case.edu``. This is the permanent
solution that we switch to when the virtual machine is all set up.