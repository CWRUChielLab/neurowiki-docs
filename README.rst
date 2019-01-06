NeuroWiki Documentation
================================================================================

Dependencies
--------------------------------------------------------------------------------

Ubuntu
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
::

    sudo apt-get install make python-pip
    sudo pip install -U Sphinx sphinx_rtd_theme

Cygwin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

First install `make`, `python`, and `python-setuptools` using the Cygwin
installer. ::

    easy_install-2.7 -U Sphinx sphinx_rtd_theme

Building
--------------------------------------------------------------------------------
::

    cd neurowiki-docs
    make html
