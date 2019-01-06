Install Message Box Templates
================================================================================
Message box templates are a prerequisite for license templates, and they will be
used later to customize the wiki.

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Install the `message box templates`_. Message boxes highlight important
    information by placing a colorful text box on the page (examples can be seen
    `here <https://en.wikipedia.org/wiki/Template:Ambox>`__). These appear
    frequently on Wikipedia to indicate, for example, that a page needs
    attention or that it presents a biased viewpoint. They are highly
    customizable and could be used to draw students' attention to key ideas. On
    NeuroWiki, we use message boxes to highlight links to simulations.

    To install the message box templates, first download this XML file
    (:download:`message-box-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/message-box-templates-1.27.xml>`),
    and import it into the wiki using `Special:Import`_ (choose "Import to
    default locations").

    Complete the installation by editing this wiki page and appending the
    following:

    - `MediaWiki:Common.css`_

      .. container:: collapsible

        message box template styles

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/message-box-templates-1.27.css

    Details about how the XML file was created can be found here
    [#message-box-templates-xml]_. The CSS code above was extracted from a
    version of *MediaWiki:Common.css* on Wikipedia contemporary with the
    templates included in the XML file.

4.  Test that the message box templates are working by pasting this text into
    any wiki page and pressing the "Show Preview" button::

        {{ambox
         | type  = notice
         | small = {{{small|left}}}
         | text  = This is a test using a small, left-aligned message box.
        }}

        {{ambox
         | type = content
         | text = This is a test using a large, centered message box. It even has an exclamation point!
        }}

        {{ambox
         | type = speedy
         | text = Danger, Will Robinson!
        }}

    The boxes that appear should be colored blue, orange, and red sequentially,
    with circle-"i", circle-"!", and triangle-"!" icons (perform a hard refresh
    in your browser if you do not see the boxes).

    If this test is successful, you can press "Cancel" instead of "Save page" to
    avoid saving the test code.

    .. todo::

        Add screenshots showing what the message box test result should look
        like.

5.  Shut down the virtual machine::

        sudo shutdown -h now

6.  Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Message box templates installed**".


.. rubric:: Footnotes

.. [#message-box-templates-xml]
    The XML file :download:`message-box-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/message-box-templates-1.27.xml>`
    contains versions of the following pages, originally exported from
    Wikipedia, that are compatible with MediaWiki 1.27 and contemporary
    extensions (e.g., Scribunto on branch ``REL1_27``)::

        Module:Arguments
        Module:Category handler
        Module:Category handler/blacklist
        Module:Category handler/config
        Module:Category handler/data
        Module:Category handler/shared
        Module:Message box
        Module:Message box/configuration
        Module:Namespace detect/config
        Module:Namespace detect/data
        Module:No globals
        Module:Yesno
        Template:Ambox
        Template:Cmbox
        Template:Fmbox
        Template:Imbox
        Template:Mbox
        Template:Ombox
        Template:Tmbox

    Versions compatible with MediaWiki 1.27 were found by first trying the
    versions of these pages currently on Wikipedia, exported using
    `Special:Export`_ on 2016-08-21. At the time, Wikipedia was running an
    alpha-phase version of MediaWiki 1.28.0. Luckily, this just worked without
    errors or rendering glitches. If it had not, I would have used the method
    described in :ref:`update-docs-templates` to find working versions of these
    pages.

    The final result is the file :download:`message-box-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/message-box-templates-1.27.xml>`.


.. _`Special:Import`:               https://dynamicshjc.case.edu:8014/wiki/Special:Import
.. _`Special:Export`:               http://en.wikipedia.org/wiki/Special:Export
.. _`MediaWiki:Common.css`:         https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Common.css
.. _`message box templates`:        https://en.wikipedia.org/wiki/Module:Message_box