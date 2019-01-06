JSNeuroSim Development
================================================================================
These optional instructions will set up a development environment for the
JSNeuroSim code base that uses the sophisticated test kit originally created by
Kendrick.

1.  Start the development virtual machine and log in::

        ssh hjc@neurowikidev.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Install these new packages,

        ========================    ============================================
        Package                     Description
        ========================    ============================================
        *default-jre*               Standard Java or Java compatible Runtime
        *rubygems*                  package management framework for Ruby
                                    libraries/applications
        ========================    ============================================

    using the following::

        sudo apt-get install default-jre rubygems

4.  Install `JsTestDriver <http://code.google.com/p/js-test-driver/>`__, a
    JavaScript unit tests runner written in Java::

        mkdir -p ~/bin/JsTestDriver
        curl -o ~/bin/JsTestDriver/JsTestDriver-1.3.4.b.jar https://js-test-driver.googlecode.com/files/JsTestDriver-1.3.4.b.jar

5.  Install `jstdutil
    <http://cjohansen.no/en/javascript/jstdutil_a_ruby_wrapper_over_jstestdriver>`__,
    a Ruby wrapper over JsTestDriver that allows tests to be run automatically
    when source files are changed::

        sudo gem install jstdutil

6.  Set an environment variable so that jstdutil knows where JsTestDriver is
    installed. Edit the file ::
    
        vim ~/.bashrc

    and add the following at the end of the file:

    .. code-block:: bash
    
        export JSTESTDRIVER_HOME=~/bin/JsTestDriver
    
    Run the script to set the environment variable::
    
        source ~/.bashrc

7.  To start the test driver and begin listening for test results, run the
    following::

        jstestdriver --port 4224 &
        cd /var/www/html/JSNeuroSim/
        jsautotest

8.  Open a web browser, navigate to

        http://neurowikidev.case.edu:4224/

    and select "Capture This Browser in strict mode" to allow the test driver to
    use your browser for testing.
