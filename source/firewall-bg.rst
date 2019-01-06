University Firewall
================================================================================

In July 2016, Case instituted a new computer network security policy, called
`Default Protect All <https://www.case.edu/utech/projects-live/default/>`__,
that affects how on-campus computers are accessed from off campus. A firewall
was activated that prevents connections to computers on the university's network
(computers accessed with the case.edu domain name) from computers that aren't
connected to the wired network, CaseGuest, CaseWireless, or VPN.

This affects web servers, remote shell connections (SSH), and remote desktop
sharing (VNC). If you need remote access to a lab computer from somewhere
off-campus, you should always be able to obtain it if you first connect to VPN.
However, to host public websites like the wikis, it is necessary to obtain
firewall exceptions for specific ports on specific host machines. This is done
by contacting the Help Desk (help@case.edu or 216-368-4357). Exceptions only
need to be granted once, and this has already been done for the class wikis and
many other machines in our lab. A complete list of the exceptions obtained for
our lab computers can be found `here
<https://slugwiki.case.edu/wiki/Accessing_Lab_Computers_from_Off_Campus>`__.

In case this system changes or new exceptions are needed in the future, here I
provide background information and procedures for dealing with the university
firewall.


.. _firewall-tech-bg:

Technical Background
--------------------------------------------------------------------------------

When a computer attempts to connect to the university network for the first time
(e.g., after rebooting), it must contact a central server, called the Dynamic
Host Configuration Protocol (DHCP) server, and request a numerical IP address,
which looks something like 129.22.139.42 (it seems that all IP addresses in our
building begin with 129.22.139.*). The IP address is needed so that other
computers know where to find it.

Unless a permanent, "static" IP address is specifically requested, the DHCP
server will temporarily lease a "dynamic" IP address to the machine. This is
useful to the network managers since there are a limited number of available
addresses, and devices (e.g., mobile phones) connect to and disconnect from the
network all the time. If a permanent IP was assigned to a device every time it
connected to the network, the university would quickly run out of addresses.

Leases on IP addresses have expiration dates. A computer that has been leased an
IP address must check in with the central server after a certain period of time
(roughly 10 hours) to maintain its connection to the network. If the computer
was leased a dynamic IP address, the lease on the original IP address will
usually just be renewed; however, it is possible that a different IP address
will be leased (hence "dynamic").

Changes in IP address are usually invisible to end users since they don't need
to access computers using IP addresses directly. Normally, an end user knows the
unchanging "fully qualified domain name" (FQDN) of the computer they want to
connect to, such as neurowiki.case.edu. In this example, "neurowiki" is the
"host name" for a computer on the university network, and "case.edu" is the
"domain name" for the university network. Whenever an end users requests to
access a computer using its FQDN, another server, called a Domain Name System
(DNS) server, translates the FQDN to its corresponding IP address. The database
that the DNS server reads to perform these translations needs to be updated
whenever a dynamically allocated IP address changes.

Case's Default Protect All policy places all computers on the university network
behind a firewall that prohibits access to these computers from all but trusted
nodes, namely other computers on the university network or on VPN. This makes it
much harder for a hacker to gain access to university computers from off-campus.
However, it also means that web and data servers cannot be accessed by the
public or off-campus colleagues. Case allows for exceptions to the policy to be
requested for specific ports on specific computers for this reason.

Apparently, the way the firewall is implemented requires that the computers
granted exceptions have static IP addresses. A static IP address can be
requested for a particular computer through `a form on UTech's website
<https://www.case.edu/utech/service-catalog/static-ip/>`__. After the request is
granted, the computer will be reliably leased the same IP address.

Since the assignment of a static IP address to a computer reduces the finite
pool of available IP addresses for dynamic assignment, reclaiming static IP
addresses when they are no longer needed is a priority for the network managers.
Consequently, requests for static IP addresses must be renewed each year, or
they will be returned to the pool.


.. _firewall-static-ip:

Transitioning to a Static IP Address
--------------------------------------------------------------------------------

Some time after a request for a static IP address is granted (roughly 20
minutes, supposedly), the DNS database is updated so that the FQDN (e.g.,
neurowiki.case.edu) points to the new static IP address. However, until the
hours-long lease on the original, dynamic IP address currently in use by the
computer ends, the computer will not update its address. After that time, it
will check in with the DHCP server and be assigned its new, static IP address.
However, in this interval, the server will be inaccessible because the DNS
server has moved its pointer before the server has moved to its new address.

Instead of waiting for the old lease to expire, you can force a computer to
request a new one at any time. If you've requested a static IP address recently
and notice that you can no longer access your computer, you should first verify
that the situation described above is the problem.

First, check at which address the DNS server says your computer should be
located. In the Terminal (command line) on any Mac or Ubuntu machine, enter::

    host <name>

where ``<name>`` is the FQDN of the inaccessible computer (e.g.,
neurowiki.case.edu). The result will look something like this::

    neurowiki.case.edu is an alias for neurowiki.BIOL.CWRU.edu.
    neurowiki.BIOL.CWRU.edu has address 129.22.139.42

If the static IP request has taken effect, this is it.

Second, check the current IP address lease on the inaccessible machine. At the
Terminal for that machine, enter (on either Mac or Ubuntu)::

    ifconfig -a

The result will look like this::

    eth0      Link encap:Ethernet  HWaddr 08:00:27:44:bb:5a
              inet addr:129.22.139.71  Bcast:129.22.139.127  Mask:255.255.255.128
              inet6 addr: fe80::a00:27ff:fe44:bb5a/64 Scope:Link
              UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
              RX packets:21998180 errors:0 dropped:0 overruns:0 frame:0
              TX packets:61298281 errors:0 dropped:0 overruns:0 carrier:0
              collisions:0 txqueuelen:1000
              RX bytes:2125183715 (2.1 GB)  TX bytes:161301856038 (161.3 GB)

    lo        Link encap:Local Loopback
              inet addr:127.0.0.1  Mask:255.0.0.0
              inet6 addr: ::1/128 Scope:Host
              UP LOOPBACK RUNNING  MTU:65536  Metric:1
              RX packets:5751 errors:0 dropped:0 overruns:0 frame:0
              TX packets:5751 errors:0 dropped:0 overruns:0 carrier:0
              collisions:0 txqueuelen:0
              RX bytes:857989 (857.9 KB)  TX bytes:857989 (857.9 KB)

Here, 129.22.139.71 is the current, dynamically allocated IP address leased to
the computer. It is in use by the active network interface labeled "eth0"
(Ethernet socket 0). For the next step, you must correctly identify the active
network interface. On other machines, this may be labeled differently, or there
may be more than one interface, only one of which is active. For example, on
DynamicsPJT, the result of the command is this::

    lo0: flags=8049<UP,LOOPBACK,RUNNING,MULTICAST> mtu 16384
            inet6 ::1 prefixlen 128
            inet6 fe80::1%lo0 prefixlen 64 scopeid 0x1
            inet 127.0.0.1 netmask 0xff000000
    gif0: flags=8010<POINTOPOINT,MULTICAST> mtu 1280
    stf0: flags=0<> mtu 1280
    en0: flags=8863<UP,BROADCAST,SMART,RUNNING,SIMPLEX,MULTICAST> mtu 1500
            ether 00:25:00:ed:8e:c2
            media: autoselect (<unknown type>)
            status: inactive
    en1: flags=8863<UP,BROADCAST,SMART,RUNNING,SIMPLEX,MULTICAST> mtu 1500
            ether 00:23:df:e0:2f:e8
            inet6 fe80::223:dfff:fee0:2fe8%en1 prefixlen 64 scopeid 0x5
            inet 129.22.139.43 netmask 0xffffff80 broadcast 129.22.139.127
            media: autoselect (1000baseT <full-duplex,flow-control>)
            status: active
    fw0: flags=8863<UP,BROADCAST,SMART,RUNNING,SIMPLEX,MULTICAST> mtu 4078
            lladdr 00:23:df:ff:fe:dc:f5:ac
            media: autoselect <full-duplex>
            status: inactive

This machine has two Ethernet sockets, labeled "en0" and "en1". The interface
"en1" is identifiable as the active interface because it has an IP address
(129.22.139.43); in this case, it also says "status: active". The reason this
interface is active is because whoever originally set up that computer happened
to plug the Ethernet cable into one socket and not the other.

Finally, if you've verified that there is a mismatch between the IP address in
the DNS database and the currently leased IP address, you can resolve the
situation by having the inaccessible computer request a new lease. This should
update it to the new static IP address. To do this, you can restart the computer
or use another command, which depends on the operating system:

- Mac::

    sudo ipconfig set <interface> DHCP

- Ubuntu::

    sudo dhclient -v -r <interface> && sudo dhclient -v <interface>

where ``<interface>`` is the name of the active network interface identified
earlier.

After doing this, you should be able to rerun ``ifconfig -a`` and see that the
IP address has updated. If the new IP address matches the one in the DNS
database, the computer should be accessible again.