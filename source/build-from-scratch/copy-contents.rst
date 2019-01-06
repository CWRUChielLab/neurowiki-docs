Copy Old Wiki Contents
================================================================================

1.  Start neurowiki_2016 and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Start the old (2015) virtual machine if it is not already running.

4.  Export the policy and unit pages from last year's wiki. You may have decided
    after last fall's semester ended to make some changes to these pages on
    either the live wiki (neurowiki.case.edu) or the development wiki
    (neurowikidev.case.edu). To determine where the latest changes can be found,
    visit these pages to view the latest edits on each wiki:

    - `Live wiki recent changes <https://neurowiki.case.edu/w/index.php?title=Special:RecentChanges&days=500&from=&limit=500>`__
    - `Dev wiki recent changes <https://neurowikidev.case.edu/w/index.php?title=Special:RecentChanges&days=500&from=&limit=500>`__

    If you made changes in parallel to both wikis that you want to keep, you may
    need to manually propogate some of those edits.

    After determining where you should export pages from, visit *Special:Export*
    on that wiki (`live wiki
    <https://neurowiki.case.edu/wiki/Special:Export>`__ | `dev wiki
    <https://neurowikidev.case.edu/wiki/Special:Export>`__). Select
    these options,

    - Check "Include only the current revision, not the full history"
    - Do NOT check "Include templates"
    - Check "Save as file"

    and paste the names of the following pages into the text field:

    .. container:: collapsible

        NeuroWiki pages to export

        ::

            Course policies
                Attendance
                Lab notebook
                Conceptual checkoffs
                Pre-Unit Quizzes
                Post-Unit Quizzes
                Surveys
                Comments on Course Materials
                Term Paper
                    Term Paper Exemplars
                        Term Paper Proposal ixk51
                        Benchmark I ixk51
                        Benchmark II ixk51
                        Benchmark III ixk51
                        Talk:Benchmark III ixk51
                        Benchmark IV ixk51
                        Talk:Benchmark IV ixk51
                        Final Term Paper ixk51

                        Term Paper Proposal agv13
                        Benchmark I agv13
                        Benchmark II agv13
                        Benchmark III agv13
                        Talk:Benchmark III agv13
                        Benchmark IV agv13
                        Talk:Benchmark IV agv13
                        Final Term Paper agv13

                        Term Paper Proposal axl90
                        Benchmark I axl90
                        Benchmark II axl90
                        Talk:Benchmark II axl90
                        Benchmark III axl90
                        Talk:Benchmark III axl90
                        Benchmark IV axl90
                        Talk:Benchmark IV axl90
                        Final Term Paper axl90
                    Term Paper Proposal
                    Term Paper Benchmarks
                        Instructions for Grant Proposals
                Term Paper Presentation
                Writing and Editing
                Plagiarism
                Don't Cheat
                The rules apply to everyone, including you.
                Critical Thinking
                The Structure of a Scientific Paper
                How to Read a Scientific Paper
                Fundamental questions about nature
                What does it mean to understand a phenomenon scientifically?
                Course Topics
                The Goals and Promise of Neuroscience

            Course syllabus
                Equilibrium Potentials I
                    Problem Set 1, Problem 1
                    Equilibrium Potentials I Answer 1
                Equilibrium Potentials II
                    Equilibrium Potentials II Answer 1
                    Equilibrium Potentials II Answer 2
                    Equilibrium Potentials II Answer 3
                    Equilibrium Potentials II Answer 4
                    Problem Set 2, Problem 1
                    Problem Set 2, Problem 2
                        Equilibrium Potentials II Lab Notebook Table
                    Equilibrium Potentials II Answer 5
                    Equilibrium Potentials II Answer 6
                    Equilibrium Potentials II Answer 7
                    Problem Set 2, Problem 3
                Passive Membrane Properties, the Resting Potential, and Electrical Models of Passive Properties
                    Passive Membranes Answer 1
                    Passive Membranes Answer 2
                    Passive Membranes Answer 3
                    Passive Membranes Answer 4
                    Passive Membranes Answer 5
                    Passive Membranes Answer 6
                    Passive Membranes Answer 7
                Action Potential I: Qualitative Introduction and Current Clamp
                Action Potential II: Voltage Clamp and Analysis of the Potassium Current
                Action Potential III: Sodium Current, Patch Clamp, and Ion Channels
                    Action Potentials III Answer 1
                    Action Potentials III Answer 2
                Action Potential IV: Hodgkin-Huxley Equations and Other Conductances
                    FirstOrderEquationDerivation
                    HodgkinHuxleyModelParameters
                Action Potential V: Design and Analysis of Complex Neurons
                    Action Potentials V Lab Notebook Table
                Cable Properties I: Passive Properties
                    Cable Theory Parameters and Units‏‎
                    DerivationSphericalCell
                    CablePropertiesIQuestion4
                Cable Properties II: Temporal Characteristics and Myelination
                    Cable Theory Parameters
                    CablePropertiesIIQuantities
                Cable Properties III: Design and Analysis of Branching Neurons
                Synaptic Physiology I: Postsynaptic Mechanisms
                Synaptic Physiology II: Presynaptic Mechanisms and Quantal Analysis
                Synaptic Plasticity I: Facilitation and Depression
                Synaptic Plasticity II: Introduction to Long-Term Potentiation
                Synaptic Plasticity III: Design and Analysis of a Plastic Synapse
                Novel Transmitters I: Introduction to Nitric Oxide
                Novel Transmitters II: Design and Analysis of a Nitric Oxide Synapse
                Sensory Neurons: Mechano-Afferent Neurons
                Simple Neuromuscular Models
                    Neuromuscular Lab Notebook Table
                A Simple Reflex Loop
                Central Pattern Generators I: From Behavior to a Circuit
                    Circuit Analysis Lab Notebook Table
                    Cell Identification Table
                    Bursting Identification Table
                Central Pattern Generators II: Analysis of Tritonia Escape Swim Circuit Interneurons
                Central Pattern Generators III: Role of Modulation in a Central Pattern Generator
                Neural Correlates of Consciousness
                Student Presentations

            Simulations
            Help:Editing
            NeuroWiki:About
            NeuroWiki:Copyrights
            Template:Instructor links
            User:Hjc
            User:Jpg18
            Sandbox
            Student list
            To Do List

    Export the pages and save the XML file when given the option.

5.  On the 2016 virtual machine, visit `Special:Import
    <https://dynamicshjc.case.edu:8014/wiki/Special:Import>`__ and upload the
    XML file obtained from the 2015 wiki (choose "Import to default locations").

6.  Since it is possible that the list above is incomplete, visit
    `Special:WantedPages
    <https://dynamicshjc.case.edu:8014/w/index.php?title=Special:WantedPages&limit=500&offset=0>`__
    to determine which pages are still missing.

    There will be several missing pages related to the class that should be
    ignored. These are the pages begining with the slash ("/") character, such
    as */Equilibrium Potentials I*, or with "Private:Template:", such as
    *Private:Template:Termpaper 's Term Paper Proposal‏‎*. These appear in the
    list because the *Template:Notebook* and *Template:Termpaper* pages use
    relative links or name substitution in links for the lab notebooks and term
    paper benchmanks.

    If necessary, repeat steps 4-5 until no relevant pages are missing.

7.  The following pages need to be updated with new dates, personnel, office
    hours times, etc., or out-dated contents need to be cleared:

    - `Course syllabus
      <https://dynamicshjc.case.edu:8014/wiki/Course_syllabus>`__
    - `Course policies
      <https://dynamicshjc.case.edu:8014/wiki/Course_policies>`__
    - `Term Paper
      <https://dynamicshjc.case.edu:8014/wiki/Term_Paper>`__
    - `Term Paper Benchmarks
      <https://dynamicshjc.case.edu:8014/wiki/Term_Paper_Benchmarks>`__
    - `Student list
      <https://dynamicshjc.case.edu:8014/wiki/Student_list>`__
    - `Student Presentations
      <https://dynamicshjc.case.edu:8014/wiki/Student_Presentations>`__
    - `Student term paper list
      <https://dynamicshjc.case.edu:8014/wiki/Private:Term_papers>`__
    - `Template:Termpaper
      <https://dynamicshjc.case.edu:8014/wiki/Template:Termpaper>`__

8.  If you'd like to add or remove term paper benchmark exemplars, now is a good
    time to do so. If you remove any, be sure to also delete associated files
    and images from the "Files to Import" directory.

    .. todo::

        The "Files to Import" directory is now hosted online. Add instructions
        for modifying it.

9.  On the virtual machine, download and then import into the wiki a collection
    of images and files. This includes the wiki logo, favicon, and figures from
    the units and benchmark exemplars::

        wget -P ~ https://dynamicshjc.case.edu/~vbox/biol373/_downloads/BIOL-373-Files-to-Import.tar.bz2
        tar -xjf ~/BIOL-373-Files-to-Import.tar.bz2 -C ~
        php /var/www/mediawiki/maintenance/importImages.php --user=Hjc ~/BIOL-373-Files-to-Import
        sudo apache2ctl restart
        rm -rf ~/BIOL-373-Files-to-Import*

    If you'd like to view the collection of files, you can download it to your
    personal machine here: :download:`BIOL-373-Files-to-Import.tar.bz2
    </_downloads/misc/BIOL-373-Files-to-Import.tar.bz2>`

10. .. todo::

        Update this step with instructions for adding files to the online
        "BIOL-373-Files-to-Import.tar.bz2" archive, and move the
        ``fetch_wiki_files.sh`` script to an external file in the docs source.

    Visit `Special:WantedFiles
    <https://dynamicshjc.case.edu:8014/w/index.php?title=Special:WantedFiles&limit=500&offset=0>`__
    to determine which files are still missing. Files on this list that are
    struckthrough are provided through `Wikimedia Commons
    <https://commons.wikimedia.org/wiki/Commons:Welcome>`__ and can be ignored.

    If there are only a few files missing, download them individually from the
    old wiki, add them to the "Files to Import" directory, and upload them
    manually.

    If there are many files missing (which is likely to happen if you added a
    new exemplar), you can use the following script to download them from the
    old wiki in a batch.

    On your personal machine, create the file ::

        vim fetch_wiki_files.sh

    and fill it with the following:

    .. container:: collapsible

        fetch_wiki_files.sh

        .. code-block:: bash

            #!/bin/bash

            # This script should be run with a single argument: the path to a file
            # containing the names of the files to be downloaded from the wiki,
            # each on its own line and written in the form "File:NAME.EXTENSION".
            INPUT="$1"
            if [ ! -e "$INPUT" ]; then
                echo "File \"$INPUT\" not found!"
                exit 1
            fi

            # MediaWiki provides an API for querying the server. We will use it
            # to determine the URLs for directly downloading each file.
            WIKIAPI=https://neurowiki.case.edu/w/api.php

            # The result of our MediaWiki API query will be provided in JSON and
            # will contain some unnecessary meta data. We will use this Python
            # script to parse the query result. It specifically extracts only the
            # URLs for directly downloading each file.
            SCRIPT="
            import sys, json

            data = json.loads(sys.stdin.read())['query']['pages']

            for page in data.values():
                if 'invalid' not in page and 'missing' not in page:
                    print page['imageinfo'][0]['url']
            "

            # Create the directory where downloaded files will be saved
            DIR=downloaded_wiki_files
            mkdir -p $DIR

            # While iterating through the input line-by-line...
            while read FILENAME; do
                if [ "$FILENAME" ]; then
                    echo -n "Downloading \"$FILENAME\" ... "

                    # ... query the server for a direct URL to the file ...
                    JSON=`curl -s -d "action=query&format=json&prop=imageinfo&iiprop=url&titles=$FILENAME" $WIKIAPI`

                    # ... parse the query result to obtain the naked URL ...
                    URL=`echo $JSON | python -c "$SCRIPT"`

                    if [ "$URL" ];
                    then
                        # ... download the file
                        cd $DIR
                        curl -s -O $URL
                        cd ..
                        echo "success!"
                    else
                        echo "not found!"
                    fi
                fi
            done < "$INPUT"

    Make the script executable::

        chmod u+x fetch_wiki_files.sh

    Copy the bulleted list of missing files found at `Special:WantedFiles
    <https://dynamicshjc.case.edu:8014/w/index.php?title=Special:WantedFiles&limit=500&offset=0>`__
    and paste them into this file::

        vim wanted_files_list.txt

    You can use this Vim command to clean up the list::

        :%s/^\s*File:\(.*\)\%u200f\%u200e (\d* link[s]*)$/File:\1/g

    Finally, execute the script to download all the files in the list::

        ./fetch_wiki_files.sh wanted_files_list.txt

    The downloaded files will be saved in the ``downloaded_wiki_files``
    directory. Copy these to the "Files to Import" directory and upload them to
    the new wiki manually or using the ``importImages.php`` script used in step
    9.

11. Protect every image and media file currently on the wiki from vandalism.
    Access the database::

        mysql -u root -p wikidb

    Enter the <MySQL password> when prompted. Execute these SQL commands (the
    magic number 6 refers to the `File namespace
    <https://www.mediawiki.org/wiki/Manual:Namespace_constants>`__):

    .. code-block:: sql

        INSERT IGNORE INTO page_restrictions (pr_page,pr_type,pr_level,pr_cascade,pr_expiry)
            SELECT p.page_id,'edit','sysop',0,'infinity' FROM page AS p WHERE p.page_namespace=6;
        INSERT IGNORE INTO page_restrictions (pr_page,pr_type,pr_level,pr_cascade,pr_expiry)
            SELECT p.page_id,'move','sysop',0,'infinity' FROM page AS p WHERE p.page_namespace=6;
        INSERT IGNORE INTO page_restrictions (pr_page,pr_type,pr_level,pr_cascade,pr_expiry)
            SELECT p.page_id,'upload','sysop',0,'infinity' FROM page AS p WHERE p.page_namespace=6;

    Type ``exit`` to quit.

    You do not need to protect any wiki pages because the Lockdown extension for
    MediaWiki does this for you!

12. Shut down the virtual machine::

        sudo shutdown -h now

13. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**2015 wiki contents migrated**".
