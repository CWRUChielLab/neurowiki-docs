Updating this Documentation
================================================================================

.. _update-docs-compile:

Compiling the Docs
--------------------------------------------------------------------------------

.. todo::

    Add general instructions for compiling the docs. Note that these can also be
    found in the README.


.. _update-docs-LocalSettings.php:

Updating the MediaWiki Configuration File
--------------------------------------------------------------------------------

.. todo::

    Document method of creating a pre-configured ``LocalSettings.php`` file,
    which is just a modified version of the file created by default by the
    script ``maintenance/install.php``.


.. _update-docs-templates:

Updating Templates Exported from Wikipedia
--------------------------------------------------------------------------------

The XML files used in :doc:`/build-from-scratch/install-citation-tools` and
similar pages were exported from Wikipedia and may be too old to work with
future releases of MediaWiki and/or some extensions (especially Scribunto). If
you intend to update the docs to use a much newer version of MediaWiki, you may
need to generate new versions of the XML files.

It is possible that you can just re-export the necessary *Module* and *Template*
pages from Wikipedia, as is decribed in the footnotes on the relevant doc pages.
However, if Wikipedia is running a version of MediaWiki or an extension that is
newer than the version you plan to upgrade to, and backwards-incompatible
changes have been made to the pages you need to export from Wikipedia, simply
importing the current versions of these pages may fail in unusual ways (e.g.,
odd citation rendering errors).

By digging through the histories of these pages and using a binary search
guess-and-check strategy, is possible to identify older versions of the
pages that are compatible with whichever version of MediaWiki you want to
upgrade to. It may help to review the `MediaWiki version timeline
<https://www.mediawiki.org/wiki/Version_lifecycle#Version_timeline>`__ to get a
good initial guess for a date.

Once you have identified a particular moment in time when Wikipedia was using
versions of the pages that are compatible with your upgraded MediaWiki
installation, you can export a snapshot of all the pages you need from that time
using the command line. Here is an example::

    curl -d "&action=submit&offset=2014-06-01T00:00:00Z&limit=1&dir=desc&pages=
        Module:Arguments
        Module:Category handler
        Module:Category handler/blacklist
        etc. ...
        " http://en.wikipedia.org/w/index.php?title=Special:Export -o "message-box-modules.xml"
