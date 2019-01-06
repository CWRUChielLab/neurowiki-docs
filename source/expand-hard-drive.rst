Expanding the Virtual Hard Drive
================================================================================

If a lot of material is uploaded to the wiki (e.g., problem set screenshots),
backups may begin to fail due to insufficient hard drive space. The virtual hard
drive can be grown to a larger size if necessary.

1.  Shut down the virtual machine.

2.  Export a VirtualBox appliance as a backup.

3.  Delete all snapshots. These silently interfere with the virtual machine's
    ability to recognize the increased storage.

4.  In VirtualBox, under Settings > Storage, note the file location of the
    VDI storage file. Locate it now in Finder and make a backup of it.

5.  Remove the storage attachment.

6.  In Terminal, run ::

        VBoxManage modifyhd <location> --resize <size>

    where ``<location>`` is the path to the original VDI file, and ``<size>`` is
    an integer number of megabytes that the resized storage should have.

    For example, to expand to 40 GB use something like this::

        VBoxManage modifyhd /Users/vbox/VirtualBox\ VMs/BIOL\ 373/2016/neurowiki_2016/neurowiki_2016.vdi --resize 40960

7.  In VirtualBox, under Settings > Storage, re-attach the VDI file under
    "Controller: SATA".

8.  On DynamicsHJC, `download the GParted Live Bootable Image (ISO)
    <http://gparted.org/download.php>`__.

9.  In VirtualBox, under Settings > Storage, add the ISO, and make sure the boot
    order under Settings > System has "Optical" checked and prioritized above
    "Hard Disk".

10. Start the virtual machine to boot into GParted, and press Enter a few times
    to get through the initial prompts.

11. In the GParted interface, you should see some unallocated space that
    corresponds to the extra space added using ``VBoxManage``.

12. If the main partition and/or its child partitions are locked, "Deactivate"
    them.

13. Expand the main partition and its child partitions to include the
    unallocated space.

14. Restart the virtual machine. It should boot normally.

15. Check the disk space using ::

        df -h /

    The "Size" probably won't reflect the new space added.  If it doesn't, run
    ::

        sudo lvextend -l +100%FREE <device>
        sudo resize2fs <device>

    where ``<device>`` is the path given in the first column of the result of
    ``df -h /``.
    
    Verify that this worked by checking the disk space again.
