Cleaning the Boot Partition
================================================================================

Sometimes you will log into the virtual machine and see a message like this
one::

    => /boot is using 94.5% of 235MB

**This should NOT be ignored.**

``/boot`` is the mount point for the boot partition: a small partition (roughly
250 MB) of the hard drive that stores the boot loader (GRUB) and multiple
versions of the Linux kernel (core of the operating system). When a new version
of the Linux kernel becomes available, it will be downloaded and installed in
the boot partition automatically, but the system needs to be rebooted before it
can switch over to using the newest kernel.

Because a reboot is required to cease using the old kernel, it cannot be removed
automatically. Consequently, over time the boot partition will fill up with
several outdated versions of the Linux kernel until a sysadmin does something
about it. Worse yet, critical security updates and non-critical software updates
will eventually require newer versions of the kernel, and the ``apt-get
upgrade`` command will fail until room is made in the boot partition for the
version of the kernel that they depend on. **If the boot partition is not
maintained, security updates will eventually cease, and manual system updates
will fail until the problem is fixed.**

To free up space in the boot partition, first reboot the virtual machine so that
it will switch to using the latest installed version of the kernel::

    sudo shutdown -r now

Next, remove old versions of the kernel (this command will remove all but the
two most recent versions in case there is something wrong with the latest)::

    sudo apt-get remove $(dpkg --list 'linux-image-[0-9]*-generic' | grep ^ii | awk '{print $2}' | sort | head -n -2 | grep -v $(uname -r))
    sudo apt-get autoremove

You can now check disk usage in the boot partition::

    df -h /boot

It should be much lower than it was before, probably below 50%.
