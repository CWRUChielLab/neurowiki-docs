Install Citation Tools
================================================================================

.. todo::

    Get Wikipedia's advanced citation tools for VisualEditor, especially
    automatic citation completion from URLs, DOIs, and PMIDs.

.. todo::

    Add screenshots showing the various citation tools in action.


1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Install the `citation templates`_. Citation templates are plain text
    templates that allow wiki users to create standardized reference citations
    by filling in parameters.

    For example, citation templates will transform wiki text such as this, ::

        {{cite journal|last1=Cullins|first1=Miranda J.|last2=Gill|first2=Jeffrey P.|last3=McManus|first3=Jeffrey M.|last4=Lu|first4=Hui|last5=Shaw|first5=Kendrick M.|last6=Chiel|first6=Hillel J.|title=Sensory Feedback Reduces Individuality by Increasing Variability within Subjects|journal=Current Biology|date=October 2015|volume=25|issue=20|pages=2672–2676|doi=10.1016/j.cub.2015.08.044}}

    into properly formatted wiki text, complete with italics and bold markup and
    hyperlinks::

        Cullins, Miranda J.; Gill, Jeffrey P.; McManus, Jeffrey M.; Lu, Hui; Shaw, Kendrick M.; Chiel, Hillel J. (October 2015). "Sensory Feedback Reduces Individuality by Increasing Variability within Subjects". ''Current Biology'' '''25''' (20): 2672–2676. [[doi]]:[https://dx.doi.org/10.1016%2Fj.cub.2015.08.044 10.1016/j.cub.2015.08.044].

    To install the citation templates, first download this XML file
    (:download:`citation-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/citation-templates-1.27.xml>`), and
    import it into the wiki using `Special:Import`_ (choose "Import to default
    locations").

    Complete the installation by editing this wiki page and appending the
    following:

    - `MediaWiki:Common.css`_

      .. container:: collapsible

        citation template styles

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/citation-templates-1.27.css
            :language: css

    Details about how the XML file was created can be found here
    [#citation-templates-xml]_. The CSS code above was extracted from a version
    of *MediaWiki:Common.css* on Wikipedia contemporary with the templates
    included in the XML file.

4.  Install `refToolbar`_. refToolbar is a MediaWiki "gadget": a
    JavaScript-powered add-on for MediaWiki managed by the Gadgets extension. It
    adds a "Cite" button to the edit toolbar that makes filling citation
    templates easier by providing a pop-up wizard with text fields for each
    citation template parameter.

    To install refToolbar, first download this XML file
    (:download:`refToolbar-1.27.xml
    </_downloads/mediawiki-1.27-compatible/refToolbar-1.27.xml>`), and import it
    into the wiki using `Special:Import`_ (choose "Import to default
    locations").

    Complete the installation by editing this wiki page and appending the
    following:

    - `MediaWiki:Gadgets-definition`_ ::

        * refToolbar[ResourceLoader|default|dependencies=user.options,mediawiki.legacy.wikibits]|refToolbar.js
        * refToolbarBase[ResourceLoader|hidden|rights=hidden]|refToolbarBase.js

    Details about how the XML file was created can be found here
    [#reftoolbar-xml]_.

5.  Install `reference tooltips`_. Like refToolbar, reference tooltips are
    implemented using a MediaWiki gadget. When enabled, placing the mouse cursor
    over any citation will either provide the reference in a tooltip (if the
    bibliography is not currently visible on-screen) or highlight the reference
    in the bibliography (if the bibliography is visible).

    To install reference tooltips, first download this XML file
    (:download:`reference-tooltips-1.27.xml
    </_downloads/mediawiki-1.27-compatible/reference-tooltips-1.27.xml>`), and
    import it into the wiki using `Special:Import`_ (choose "Import to default
    locations").

    Complete the installation by editing this wiki page and appending the
    following:

    - `MediaWiki:Gadgets-definition`_ ::

        * ReferenceTooltips[ResourceLoader|default]|ReferenceTooltips.js|ReferenceTooltips.css

    Details about how the XML file was created can be found here
    [#reference-tooltips-xml]_.

6.  Test that the citation tools are working by pasting this text into any wiki
    page and pressing the "Show Preview" button::

        <ref name=note />
        <ref name=book />
        <ref name=journal />
        <ref name=news />
        <ref name=web />

        <div style="height:200px"></div>

        {{reflist|refs=
        <ref name=note>This is a simple note, not a full citation.</ref>
        <ref name=book>{{cite book|last1=Doe|first1=John|last2=Doe|first2=Jane|title=Book Title|date=1 January 1999|publisher=Publisher|location=New York|isbn=978-1-23-456789-7|pages=1-99|edition=1st|url=http://www.example.com|accessdate=1 January 2015}}</ref>
        <ref name=journal>{{cite journal|last1=Doe|first1=John|last2=Doe|first2=Jane|title=Journal article title|journal=Journal|date=1 January 1999|volume=1|issue=1|pages=1-99|doi=10.1234/56789|pmid=123456|url=http://www.example.com|accessdate=1 January 2015}}</ref>
        <ref name=news>{{cite news|last1=Doe|first1=John|last2=Doe|first2=Jane|title=News article title|url=http://www.example.com|accessdate=1 January 2015|work=Newspaper|agency=Agency|issue=1|publisher=Publisher|date=1 January 1999}}</ref>
        <ref name=web>{{cite web|last1=Doe|first1=John|last2=Doe|first2=Jane|title=Web article title|url=http://www.example.com|website=Website|publisher=Publisher|accessdate=1 January 2015}}</ref>
        }}

    Perform these tests:

    - Inspect the reference list. If the citations look alright, there are no
      script errors, and there are no red links, then the citation templates are
      properly installed.
    - Try inserting a new citation template into the page using refToolbar's
      "Cite" menu, found on the toolbar to the right of "Help" (perform a hard
      refresh in your browser if you do not see it). You should also be able to
      insert additional citations to existing named references by clicking
      "Named references".
    - Test the reference tooltips by hovering your cursor over one of the
      citations (bracketed numbers). If the reference list is simultaneously
      visible, you should see a box appear in the reference list around the
      corresponding reference. If the list is not visible, you should see a
      tooltip containing the reference. You can adjust the height of the
      ``<div>`` or resize your browser window to test both cases.

    If these tests are successful, you can press "Cancel" instead of "Save
    page" to avoid saving the test code.

    .. todo::

        Add tests for VisualEditor's citation tools.

7.  Shut down the virtual machine::

        sudo shutdown -h now

8.  Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Citation tools installed**".


.. rubric:: Footnotes

.. [#citation-templates-xml]
    The XML file :download:`citation-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/citation-templates-1.27.xml>`
    contains versions of the following pages, originally exported from
    Wikipedia, that are compatible with MediaWiki 1.27 and contemporary
    extensions (e.g., Scribunto on branch ``REL1_27``)::

        Module:Citation/CS1
        Module:Citation/CS1/COinS
        Module:Citation/CS1/Configuration
        Module:Citation/CS1/Date validation
        Module:Citation/CS1/Identifiers
        Module:Citation/CS1/Suggestions
        Module:Citation/CS1/Utilities
        Module:Citation/CS1/Whitelist
        Template:Cite AV media
        Template:Cite AV media notes
        Template:Cite book
        Template:Cite conference
        Template:Cite DVD notes
        Template:Cite encyclopedia
        Template:Cite episode
        Template:Cite interview
        Template:Cite journal
        Template:Cite mailing list
        Template:Cite map
        Template:Cite news
        Template:Cite newsgroup
        Template:Cite podcast
        Template:Cite press release
        Template:Cite report
        Template:Cite serial
        Template:Cite sign
        Template:Cite speech
        Template:Cite techreport
        Template:Cite thesis
        Template:Cite web
        Template:Reflist

    Versions compatible with MediaWiki 1.27 were found by first trying the
    versions of these pages currently on Wikipedia, exported using
    `Special:Export`_ on 2016-08-20. At the time, Wikipedia was running an
    alpha-phase version of MediaWiki 1.28.0. Luckily, this just worked without
    errors or rendering glitches. If it had not, I would have used the method
    described in :ref:`update-docs-templates` to find working versions of these
    pages.

    Finally, to eliminate the red links that would otherwise appear in some
    citations, I manually edited the XML contents of
    *Module:Citation/CS1/Configuration*. Specifically, in the variable
    ``id_handlers``, I added the interwiki prefix ``wikipedia:`` to each
    ``link`` field; I added the same prefix to the value of
    ``['help page link']``.

    The final result is the file :download:`citation-templates-1.27.xml
    </_downloads/mediawiki-1.27-compatible/citation-templates-1.27.xml>`.

.. [#reftoolbar-xml]
    The XML file :download:`refToolbar-1.27.xml
    </_downloads/mediawiki-1.27-compatible/refToolbar-1.27.xml>` contains
    versions of the following pages, originally exported from Wikipedia, that
    are compatible with MediaWiki 1.27 and contemporary extensions (e.g.,
    Scribunto on branch ``REL1_27``)::

        MediaWiki:Gadget-refToolbar
        MediaWiki:Gadget-refToolbar.js
        MediaWiki:Gadget-refToolbarBase.js
        MediaWiki:RefToolbar.js
        MediaWiki:RefToolbarConfig.js
        MediaWiki:RefToolbarLegacy.js
        MediaWiki:RefToolbarMessages-en.js
        MediaWiki:RefToolbarNoDialogs.js

    Versions compatible with MediaWiki 1.27 were found by first trying the
    versions of these pages currently on Wikipedia, exported using
    `Special:Export`_ on 2016-08-20. At the time, Wikipedia was running an
    alpha-phase version of MediaWiki 1.28.0. Luckily, this just worked without
    errors or rendering glitches. If it had not, I would have used the method
    described in :ref:`update-docs-templates` to find working versions of these
    pages.

    The final result is the file :download:`refToolbar-1.27.xml
    </_downloads/mediawiki-1.27-compatible/refToolbar-1.27.xml>`.

.. [#reference-tooltips-xml]
    The XML file :download:`reference-tooltips-1.27.xml
    </_downloads/mediawiki-1.27-compatible/reference-tooltips-1.27.xml>`
    contains versions of the following pages, originally exported from
    Wikipedia, that are compatible with MediaWiki 1.27::

        MediaWiki:Gadget-ReferenceTooltips
        MediaWiki:Gadget-ReferenceTooltips.css
        MediaWiki:Gadget-ReferenceTooltips.js

    Versions compatible with MediaWiki 1.27 were found by first trying the
    versions of these pages currently on Wikipedia, exported using
    `Special:Export`_ on 2017-03-29. At the time, Wikipedia was running
    MediaWiki 1.29.0. Luckily, this just worked without errors or rendering
    glitches. If it had not, I would have used the method described in
    :ref:`update-docs-templates` to find working versions of these pages.

    I then made one small modification. On Wikipedia, the reference tooltips are
    confined to the Main, Project, and Help namespaces. We need the tooltips to
    work anywhere on our wiki, and most critically in the User and Private
    namespaces. To accomplish this, in the XML file I replaced line 7 of
    *MediaWiki:Gadget-ReferenceTooltips.js* with ::

        if (true) {

    The final result is the file :download:`reference-tooltips-1.27.xml
    </_downloads/mediawiki-1.27-compatible/reference-tooltips-1.27.xml>`.


.. _`Special:Import`:               https://dynamicshjc.case.edu:8014/wiki/Special:Import
.. _`Special:Export`:               http://en.wikipedia.org/wiki/Special:Export
.. _`MediaWiki:Common.css`:         https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Common.css
.. _`MediaWiki:Gadgets-definition`: https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Gadgets-definition
.. _`citation templates`:           https://en.wikipedia.org/wiki/Wikipedia:Citation_templates
.. _`refToolbar`:                   http://en.wikipedia.org/wiki/Wikipedia:RefToolbar
.. _`reference tooltips`:           https://www.mediawiki.org/wiki/Reference_Tooltips