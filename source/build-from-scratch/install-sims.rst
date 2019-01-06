Install Simulations
================================================================================

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Download `JSNeuroSim`_, the JavaScript code for the neural simulations::

        git clone https://github.com/CWRUChielLab/JSNeuroSim.git /var/www/html/JSNeuroSim

    .. _`JSNeuroSim`: https://github.com/CWRUChielLab/JSNeuroSim

4.  Download executables for the `Nernst Potential Simulator`_::

        mkdir -p /var/www/html/nernst
        sudo wget -O /var/www/html/nernst/nernst-v1-0-1-mac-intel.zip https://github.com/CWRUChielLab/nernst/releases/download/v1.0.1/nernst-v1-0-1-mac-intel.zip
        sudo wget -O /var/www/html/nernst/nernst-v1-0-1b-win.zip https://github.com/CWRUChielLab/nernst/releases/download/v1.0.1b/nernst-v1-0-1b-win.zip
        sudo wget -O /var/www/html/nernst/nernst-v1-0-1-linux.tar.gz https://github.com/CWRUChielLab/nernst/releases/download/v1.0.1/nernst-v1-0-1-linux.tar.gz

    .. _`Nernst Potential Simulator`: https://github.com/CWRUChielLab/nernst/releases

5.  Give the web server ownership of and access to the new files::

        sudo chown -R www-data:www-data /var/www/
        sudo chmod -R ug+rw /var/www/

6.  The JavaScript simulations should now be accessible. Verify this by visiting

        https://dynamicshjc.case.edu:8014/JSNeuroSim/simulations/simple_currentclamp_jqplot.html

    The Nernst Potential Simulator should also be accessible. Verify that these
    links work:

    - Mac: https://dynamicshjc.case.edu:8014/nernst/nernst-v1-0-1-mac-intel.zip 
    - Windows: https://dynamicshjc.case.edu:8014/nernst/nernst-v1-0-1b-win.zip 
    - Linux: https://dynamicshjc.case.edu:8014/nernst/nernst-v1-0-1-linux.tar.gz 

7.  Shut down the virtual machine::

        sudo shutdown -h now

8.  Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Simulations installed**".
