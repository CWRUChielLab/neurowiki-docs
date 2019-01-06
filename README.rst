NeuroWiki Documentation
================================================================================

.. image:: https://readthedocs.org/projects/neurowiki-docs/badge/?version=latest
    :target: ReadTheDocs_
    :alt: Documentation Status

This repository contains the source code for generating documentation that
explains how to build a wiki_ for the course BIOL 373. The source code is
automatically recompiled each time it is changed, and the compiled documentation
is hosted on ReadTheDocs_.

.. _ReadTheDocs:    https://neurowiki-docs.readthedocs.io/
.. _wiki:           https://neurowiki.case.edu/

The source code can also be compiled on your local computer using the basic
instructions below.

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
