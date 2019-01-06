Customize the Wiki
================================================================================

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Change the name of the front page of the wiki. Move the existing `Main Page
    <https://dynamicshjc.case.edu:8014/wiki/Main_Page?redirect=no>`__
    to *Course syllabus* (capital "C", lowercase "s") and check "Leave a
    redirect behind" (the Move button is located near the top-right of the page,
    next to "View history").

    Next, delete the moved page (now called *Course syllabus*) so that last
    year's version of the page will import properly.
    
    Finally, edit the following page to make clicking on the wiki logo direct
    the user to the right place. Replace its contents with the following:

    - `MediaWiki:Mainpage
      <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Mainpage>`__
      ::

        Course syllabus

4.  Modify the navigation sidebar. Edit the following page, and replace its
    contents with the following:

    - `MediaWiki:Sidebar
      <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Sidebar>`__
      ::

        * navigation
        ** Course syllabus|Course syllabus
        ** Course policies|Course policies
        ** Special:Grades|Course grades
        ** Simulations|Simulations
        ** {{fullurl:Special:UserLogin|returnto=Special:MyPage}}|Lab notebook
        ** Private:Term papers|Term papers
        ** recentchanges-url|recentchanges
        ** randompage-url|randompage
        ** Help:Editing|help
        * SEARCH
        * TOOLBOX
        * LANGUAGES

5.  Add a reminder for students to the file upload form to include CWRU IDs in
    filenames. Edit the following page, and append the following:

    - `MediaWiki:Uploadtext
      <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Uploadtext>`__
      ::

        <font color="red">'''''Please prefix all your filenames with your CWRU ID!'''''</font>

6.  Add a reminder for students to the WikiEditor dialog box to include CWRU IDs
    and file extensions in filenames. Edit the following page, and replace its
    contents with the following:

    - `MediaWiki:Wikieditor-toolbar-file-target
      <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Wikieditor-toolbar-file-target>`__
      ::
    
        Filename: (PLEASE INCLUDE YOUR CWRU ID AND THE FILE EXTENSION!)

    .. todo::

        Add a similar message about prefixing uploaded file names with a
        student's user name to VisualEditor.

7.  Add custom styling. Edit the following page, and append the following:

    - `MediaWiki:Common.css
      <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:Common.css>`__

      .. code-block:: css

        /**********************************************
        *           CUSTOM NEUROWIKI STYLES           *
        **********************************************/

        table.course-info {
            float: right;
            border: 1px solid #aaa;
            width:300px;
            text-align: center;
            border-collapse: collapse;
        }
        table.course-info caption {
            background: #2c659c;
            color: #fff;
            font-weight: bold;
        }
        table.course-info th {
            background: #dcdcdc;
        }
        div.course-example {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 1em;
            margin-top: 8px;
        }

        /* Make room for the extra tall NeuroWiki logo */
        div#mw-panel {
            top: 270px;
        }
        #p-logo {
            top: -260px;
            height: 270px;
        }
        #p-logo a {
            height: 270px;
        }

8.  Create the lab notebook template. Edit the following page, and fill it with
    the following:

    - `Template:Notebook
      <https://dynamicshjc.case.edu:8014/wiki/Template:Notebook>`__

      .. container:: collapsible

        Template:Notebook

        ::

            '''{{#if: {{{1|}}} | [[User:{{{1}}}]]'s | My}} Lab Notebook'''

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Equilibrium Potentials I | Equilibrium Potentials I]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Equilibrium Potentials II | Equilibrium Potentials II]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Passive Membrane Properties, the Resting Potential, and Electrical Models of Passive Properties | Passive Membrane Properties, the Resting Potential, and Electrical Models of Passive Properties]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Action Potential I: Qualitative Introduction and Current Clamp | Action Potential I: Qualitative Introduction and Current Clamp]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Action Potential II: Voltage Clamp and Analysis of the Potassium Current | Action Potential II: Voltage Clamp and Analysis of the Potassium Current]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Action Potential III: Sodium Current, Patch Clamp, and Ion Channels | Action Potential III: Sodium Current, Patch Clamp, and Ion Channels]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Action Potential IV: Hodgkin-Huxley Equations and Other Conductances | Action Potential IV: Hodgkin-Huxley Equations and Other Conductances]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Action Potential V: Design and Analysis of Complex Neurons | Action Potential V: Design and Analysis of Complex Neurons]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Cable Properties I: Passive Properties | Cable Properties I: Passive Properties]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Cable Properties II: Temporal Characteristics and Myelination | Cable Properties II: Temporal Characteristics and Myelination]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Cable Properties III: Design and Analysis of Branching Neurons | Cable Properties III: Design and Analysis of Branching Neurons]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Synaptic Physiology I: Postsynaptic Mechanisms | Synaptic Physiology I: Postsynaptic Mechanisms]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Synaptic Physiology II: Presynaptic Mechanisms and Quantal Analysis | Synaptic Physiology II: Presynaptic Mechanisms and Quantal Analysis]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Synaptic Plasticity I: Facilitation and Depression | Synaptic Plasticity I: Facilitation and Depression]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Synaptic Plasticity II: Introduction to Long-Term Potentiation | Synaptic Plasticity II: Introduction to Long-Term Potentiation]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Synaptic Plasticity III: Design and Analysis of a Plastic Synapse | Synaptic Plasticity III: Design and Analysis of a Plastic Synapse]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Novel Transmitters I: Introduction to Nitric Oxide | Novel Transmitters I: Introduction to Nitric Oxide]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Novel Transmitters II: Design and Analysis of a Nitric Oxide Synapse | Novel Transmitters II: Design and Analysis of a Nitric Oxide Synapse]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Sensory Neurons: Mechano-Afferent Neurons | Sensory Neurons: Mechano-Afferent Neurons]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Simple Neuromuscular Models | Simple Neuromuscular Models]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/A Simple Reflex Loop | A Simple Reflex Loop]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Central Pattern Generators I: From Behavior to a Circuit | Central Pattern Generators I: From Behavior to a Circuit]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Central Pattern Generators II: Analysis of Tritonia Escape Swim Circuit Interneurons | Central Pattern Generators II: Analysis of Tritonia Escape Swim Circuit Interneurons]]

            * [[{{#if: {{{1|}}} | User:{{{1}}}}}/Central Pattern Generators III: Role of Modulation in a Central Pattern Generator | Central Pattern Generators III: Role of Modulation in a Central Pattern Generator]]
            <noinclude>
            <hr>
            '''Arguments'''
            # ''Username'' (optional): Links are created as subpages to this user's page. Defaults to using the current page as parent to linked subpages if omitted. Also replaces "My Lab Notebook" with "<nowiki>[[User:<username>]]</nowiki>'s Lab Notebook".
            </noinclude>

9.  Create the term paper benchmark template. Edit the following page, and fill
    it with the following:

    - `Template:Termpaper
      <https://dynamicshjc.case.edu:8014/wiki/Template:Termpaper>`__
      ::

        '''{{#if: {{{1|}}} | [[User:{{{1}}}]]'s | My}} Term Paper Benchmarks'''

        * [[Private: {{#if: {{{1|}}} | User:{{{1}}} | {{FULLPAGENAME}}}} 's Term Paper Proposal | Term Paper Proposal]]. Due October 20, 2016 at 5 PM.

        * [[Private: {{#if: {{{1|}}} | User:{{{1}}} | {{FULLPAGENAME}}}} 's Benchmark I | Benchmark I]]. Due October 27, 2016 at 5 PM.

        * [[Private: {{#if: {{{1|}}} | User:{{{1}}} | {{FULLPAGENAME}}}} 's Benchmark II | Benchmark II]]. Due November 5, 2016 at 5 PM.

        * [[Private: {{#if: {{{1|}}} | User:{{{1}}} | {{FULLPAGENAME}}}} 's Benchmark III | Benchmark III]]. Due November 17, 2016 at 5 PM.

        * [[Private: {{#if: {{{1|}}} | User:{{{1}}} | {{FULLPAGENAME}}}} 's Benchmark IV | Benchmark IV]]. Due November 29, 2016 at 5 PM.

        * [[Private: {{#if: {{{1|}}} | User:{{{1}}} | {{FULLPAGENAME}}}} 's Final Term Paper | Final Term Paper]]. Due December 8, 2016 at 5 PM.
        <noinclude>
        <hr>
        '''Arguments'''
        # ''Username'' (optional): Links are created for the specified term paper author in the Private namespace. Defaults to using the current page title for identifying the term paper author if omitted. Also replaces "My Term Paper Benchmarks" with "<nowiki>[[User:<username>]]</nowiki>'s Term Paper Benchmarks".
        </noinclude>

10. Create a template for student user pages. Edit the following page, and fill
    it with the following:

    - `MediaWiki:NewArticleTemplate/User
      <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:NewArticleTemplate/User>`__
      ::

        {{notebook}}

        {{termpaper}}

        <!--
            ATTENTION: DO NOT MAKE ANY CHANGES TO THIS PAGE!
            PRESS THE SAVE BUTTON BELOW, AND YOUR PERSONAL LAB
            NOTEBOOK WILL BE CREATED. YOU SHOULD USE THE LINKS
            THAT APPEAR THERE FOR SAVING YOUR WORK.
        -->

    .. todo::

        Consider what should be done about the User namespace template if I
        can't get VisualEditor to work with NewArticleTemplate.

11. Create a blank template for student lab notebooks. Create the page
    `MediaWiki:NewArticleTemplate/User/Subpage
    <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:NewArticleTemplate/User/Subpage>`__
    and leave it blank (you will first need to place some initial content on the
    page and save for it to be created, and then delete that content and save
    again).

12. Create templates for instructor and student comments. Edit the following
    page, and fill it with the following:

    - `MediaWiki:NewArticleTemplate/User Talk
      <https://dynamicshjc.case.edu:8014/wiki/MediaWiki:NewArticleTemplate/User_Talk>`__
      ::

        == Student Comments ==

        == Instructor Comments ==

13. Create the simulation link templates. Edit the following pages, and fill
    them with the following:

    - `Template:Simulation
      <https://dynamicshjc.case.edu:8014/wiki/Template:Simulation>`__
      ::

        {{ambox
         | name  = Simulation
         | class = simbox
         | subst = <includeonly>{{subst:</includeonly><includeonly>substcheck}}</includeonly>
         | style = border-left: 10px solid #2c659c
         | small = {{{small|left}}}
         | type  = notice
         | text  = '''Simulation'''<br>[[{{{link}}} | {{{text}}}]]
         | image      = [[File:Simulation-icon.png|55px|link={{{link}}}|alt=]]
         | smallimage = [[File:Simulation-icon.png|40px|link={{{link}}}|alt=]]
        }}

    - `Template:Nernstsim
      <https://dynamicshjc.case.edu:8014/wiki/Template:Nernstsim>`__
      ::

        {{ambox
         | name  = Nernstsim
         | class = simbox
         | subst = <includeonly>{{subst:</includeonly><includeonly>substcheck}}</includeonly>
         | style = border-left: 10px solid #2c659c
         | small = {{{small|left}}}
         | type  = notice
         | text  = '''Simulation'''<br>Nernst potential simulation<br><span class="plainlinks">[{{SERVER}}/nernst/nernst-v1-0-1b-win.zip Win]</span> <nowiki>|</nowiki> <span class="plainlinks">[{{SERVER}}/nernst/nernst-v1-0-1-mac-intel.zip Mac]</span> <nowiki>|</nowiki> <span class="plainlinks">[{{SERVER}}/nernst/nernst-v1-0-1-linux.tar.gz Linux]</span> <nowiki>|</nowiki> <span class="plainlinks">[https://github.com/CWRUChielLab/Nernst Src]</span>
         | image      = [[File:Simulation-icon.png|55px|link=|alt=]]
         | smallimage = [[File:Simulation-icon.png|40px|link=|alt=]]
        }}

    The simulation icon (Simulation-icon.png) will be uploaded later.

14. Hide the "Category: Articles using small message boxes" message that appears
    at the bottom of some pages. Edit the following page and fill it with the
    following:

    - `Category:Articles using small message boxes <https://dynamicshjc.case.edu:8014/wiki/Category:Articles_using_small_message_boxes>`__
      ::

        __HIDDENCAT__

15. Shut down the virtual machine::

        sudo shutdown -h now

16. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**Wiki customization complete**".
