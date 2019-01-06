Using a Backup Archive to Recover from Loss of the Virtual Machine
================================================================================

These instructions describe how to recover the wiki if the virtual machine is
lost but backups are retained. The instructions are untested and possibly
incomplete. Additional breathing may be required. The wiki backups should
contain everything needed to run the server except for the Apache configuration
settings, which are contained in this document.

1.  Breathe.

2.  :doc:`Create a replica virtual machine </build-from-scratch/install-os>`.

3.  :doc:`Configure the web server </build-from-scratch/config-web-server>`.

4.  Install the prerequisite packages for :doc:`MediaWiki
    </build-from-scratch/install-mediawiki>`, the :doc:`MediaWiki extensions
    </build-from-scratch/install-extensions>`, and :doc:`Django
    </build-from-scratch/install-django>`.

5.  Install the web server (Apache) configuration files for :doc:`MediaWiki
    </build-from-scratch/install-mediawiki>` and :doc:`Django
    </build-from-scratch/install-django>`.

6.  Restore the machine from an archived backup. The restore script
    ``backup-wiki`` is included in the archive.

7.  :doc:`Activate bridged networking
    </build-from-scratch/activate-bridged-networking>`. The wiki should be
    accessible now.

8.  Go through the instruction set for :doc:`building the wiki from scratch
    </build-from-scratch/index>` carefully and complete any minor steps that
    have been skipped, such as placing scripts in ``/usr/local/sbin`` (e.g., one
    is needed for automatic backups to work).

9.  Verify that automatic backups are working.