Install License Templates
================================================================================
Copyright licenses can be assigned to files when they are uploaded to the wiki.
Note that :doc:`install-mbox` is a prerequisite for the license templates.

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Install the `license templates`_. License templates are selected for each
    file at time of upload.

    To install the license templates, first download this XML file
    (:download:`license-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/license-templates-1.27.xml>`), and
    import it into the wiki using `Special:Import`_ (choose "Import to default
    locations").

    Complete the installation by editing these wiki pages and filling them with
    the following:

    - `MediaWiki:Wm-license-cc-zero-text`_ ::

        This file is made available under the [[wikipedia:Creative Commons|Creative Commons]] [//creativecommons.org/publicdomain/zero/1.0/deed.en CC0 1.0 Universal Public Domain Dedication].

    - `MediaWiki:Wm-license-cc-zero-explanation`_ ::

        The person who associated a work with this deed has dedicated the work to the [[wikipedia:public domain|public domain]] by waiving all of his or her rights to the work worldwide under copyright law, including all related and neighboring rights, to the extent allowed by law. You can copy, modify, distribute and perform the work, even for commercial purposes, all without asking permission.

    Details about how the XML file was created can be found here
    [#license-templates-xml]_. The two *MediaWiki* pages listed above had to be
    manually filled because they would not export from Wikipedia properly.

4.  Test that the license templates are working by visiting `Special:Upload`_,
    selecting each license from the drop-down menu one at a time, and inspecting
    the message boxes that appear. If the licenses look alright, there are no
    script errors, and there are no red links, then the license templates are
    working properly.

5.  Shut down the virtual machine::

        sudo shutdown -h now

6.  Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**License templates installed**".


.. rubric:: Footnotes

.. [#license-templates-xml]
    The XML file :download:`license-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/license-templates-1.27.xml>` contains
    versions of the following pages, originally exported from Wikipedia, that
    are compatible with MediaWiki 1.27 and contemporary extensions (e.g.,
    Scribunto on branch ``REL1_27``)::

        MediaWiki:Licenses
        Module:Math
        Template:Category handler
        Template:Cc-by-4.0
        Template:Cc-by-sa-4.0
        Template:Cc-by-sa-4.0,3.0,2.5,2.0,1.0
        Template:Cc-zero
        Template:Center
        Template:File other
        Template:Free media
        Template:GFDL
        Template:Image other
        Template:ImageNoteControl
        Template:Lang
        Template:License migration
        Template:License migration announcement
        Template:Max
        Template:PD-art
        Template:PD-old
        Template:PD-old-100
        Template:PD-US
        Template:PD-USGov
        Template:R from move
        Template:Self
        Template:Template other

    Versions compatible with MediaWiki 1.27 were found by first trying the
    versions of these pages currently on Wikipedia, exported using
    `Special:Export`_ on 2016-08-21. At the time, Wikipedia was running an
    alpha-phase version of MediaWiki 1.28.0. Luckily, this just worked without
    errors or rendering glitches. If it had not, I would have used the method
    described in :ref:`update-docs-templates` to find working versions of these
    pages.

    I then made some modifications. On Wikipedia, the list of licenses is
    quite long and includes many that will not be useful to our students. To
    remove these, in the XML file I deleted several lines from
    *MediaWiki:Licenses*.

    Finally, to eliminate the red links that would otherwise appear in some
    licenses, I manually edited the XML contents of many templates.
    Specifically, wherever there would be a red link, I added the interwiki
    prefix ``wikipedia:``. For example, ``[[Creative Commons]]`` appears several
    times across a few templates. I replaced each instance with
    ``[[wikipedia:Creative Commons|Creative Commons]]``.

    The final result is the file :download:`license-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/license-templates-1.27.xml>`.


.. _`Special:Import`:                           https://dynamicshjc.case.edu:8014/wiki/Special:Import
.. _`Special:Export`:                           http://en.wikipedia.org/wiki/Special:Export
.. _`Special:Upload`:                           https://dynamicshjc.case.edu:8014/wiki/Special:Upload
.. _`MediaWiki:Wm-license-cc-zero-text`:        https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Wm-license-cc-zero-text
.. _`MediaWiki:Wm-license-cc-zero-explanation`: https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Wm-license-cc-zero-explanation
.. _`license templates`:                        https://www.mediawiki.org/wiki/Project:File_copyright_tags