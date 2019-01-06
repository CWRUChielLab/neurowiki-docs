Screen Sharing Using SSVNC
================================================================================

The program `SSVNC <http://sourceforge.net/projects/ssvnc/>`__ allows you to
control DynamicsHJC remotely. The advantage of using this program over Mac OS
X's native screen sharing program is that it does not require someone sitting in
front of the monitor to press the "Share my screen" button. It does, however,
require that the account has been logged into once already since the last
reboot, so that the VNC server is running.

If you are using a Mac and SSVNC is already installed and configured on your
machine, you will find the executable located at
``/Applications/ssvnc/MacOSX/ssvnc``. After launching the program, you simply
need to load the correct profile, press "Connect", and enter the vbox password.

If SSVNC is not already installed, download the tar ball for SSVNC here:

    http://sourceforge.net/projects/ssvnc/

On a Mac, unpack the archive into the ``Applications`` directory. In theory, a
Mac user should be able to simply double-click on
``/Applications/ssvnc/MacOSX/ssvnc`` to start the program.

However, as of July 2015, the SSVNC tar ball for Mac
(``ssvnc_no_windows-1.0.29.tar.gz``) lacks binaries for the "Darwin x86_64"
platform. (You can run ``uname -sm`` on the command line to see what platform
you are running.) If you try to run the executable, it will detect your platform
automatically, and it will fail when it does not find a directory named
``/Applications/ssvnc/bin/Darwin.x86_64`` containing needed binaries.

Fortunately, the binaries provided for "Darwin i386" work on "Darwin x86_64", so
we can work around this error. In ``/Applications/ssvnc/bin``, duplicate the
``Darwin.i386`` directory and rename the copy to ``Darwin.x86_64``.

You should now be able to run ``/Applications/ssvnc/MacOSX/ssvnc``. If it
complains about the developer not being trusted, try Control-clicking on the
executable and selecting "Open".

In the field "VNC Host:Display", enter ``vbox@dynamicshjc.case.edu:8``, and
select "Use SSH". Click the "Options" button, then the "Advanced" button, and
finally the "Unix ssvncviewer" button. In the field "Scaling", enter ``0.75``.
Click the "Done" button. Click the "Save" button to save this profile so that
you will not need to re-enter this information in the future. Finally, press
"Connect" and enter the vbox password.

Note that the display port "8" must match the parameter associated with the VNC
server running on DynamicsHJC for the vbox account. This will not change unless
the VNC server is reconfigured.