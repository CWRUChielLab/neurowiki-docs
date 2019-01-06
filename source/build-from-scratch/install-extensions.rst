Install MediaWiki Extensions
================================================================================

1.  Start the virtual machine and log in::

        ssh -p 8015 hjc@dynamicshjc.case.edu

2.  Check for and install system updates on the virtual machine::

        sudo apt-get update
        sudo apt-get dist-upgrade
        sudo apt-get autoremove

3.  Install these new packages,

        =========================== ============================================
        Package                     Description
        =========================== ============================================
        *phpCAS*                    PHP implementation of Central Auth Service
        *php-ldap*                  LDAP module for PHP for looking up real
                                    names when wiki accounts are created
        *parsoid*                   Web service converting HTML+RDFa to
                                    MediaWiki wikitext and back (prereq for
                                    VisualEditor)
        *dvipng*                    convert DVI files to PNG graphics (prereq
                                    for Math)
        *ocaml*                     ML language implementation with a
                                    class-based object system (prereq for Math)
        *texlive-latex-recommended* TeX Live: LaTeX recommended packages (prereq
                                    for Math)
        *texlive-latex-extra*       TeX Live: LaTeX additional packages (prereq
                                    for Math)
        *texlive-fonts-recommended* TeX Live: Recommended fonts (prereq for
                                    Math)
        *texlive-lang-greek*        TeX Live: Greek (prereq for Math)
        =========================== ============================================

    using the following::

        sudo apt-get install php-cas php-ldap dvipng ocaml texlive-latex-recommended texlive-latex-extra texlive-fonts-recommended texlive-lang-greek
        sudo apt-key advanced --keyserver pgp.mit.edu --recv-keys 90E9F83F22250DD7
        sudo apt-add-repository "deb https://releases.wikimedia.org/debian jessie-mediawiki main"
        sudo apt-get update
        sudo apt-get install parsoid

    .. todo::

        Change parsoid install command to use a specific version known to work
        with MW 1.27 (version "0.5.3all" ?).

4.  Restart the web server::

        sudo apache2ctl restart

5.  Download these extensions,

        =============================== ========================================
        Extension                       Description
        =============================== ========================================
        `CASAuthentication`_            integration with university Single
                                        Sign-On
        `EmbedVideo`_                   embed online videos in wiki pages
        `ImportUsers`_ [#import-users]_ create user accounts from CSV files
        `Lockdown`_                     restrict access to specific namespaces
        `Math`_                         math typesetting
        `MobileFrontend`_               better wiki interface for smartphones
        `NewArticleTemplate`_           auto-fill new pages with template text
        `Realnames`_                    replace user names with real names
        `ScholasticGrading`_            assign and report grades
        `Scribunto`_                    embed scripts in Module namespace
                                        (prereq for citation and license
                                        templates)
        `UserMerge`_                    merge contributions and delete users
        `VisualEditor`_                 WYSIWYG editor for wiki atricles
        =============================== ========================================

        .. _`CASAuthentication`:        https://github.com/CWRUChielLab/CASAuth
        .. _`EmbedVideo`:               https://www.mediawiki.org/wiki/Extension:EmbedVideo
        .. _`ImportUsers`:              https://www.mediawiki.org/wiki/Extension:ImportUsers
        .. _`Lockdown`:                 https://www.mediawiki.org/wiki/Extension:Lockdown
        .. _`Math`:                     https://www.mediawiki.org/wiki/Extension:Math
        .. _`MobileFrontend`:           https://www.mediawiki.org/wiki/Extension:MobileFrontend    
        .. _`NewArticleTemplate`:       https://www.mediawiki.org/wiki/Extension:NewArticleTemplate
        .. _`Realnames`:                https://www.mediawiki.org/wiki/Extension:Realnames
        .. _`ScholasticGrading`:        https://github.com/CWRUChielLab/ScholasticGrading
        .. _`Scribunto`:                https://www.mediawiki.org/wiki/Extension:Scribunto
        .. _`UserMerge`:                https://www.mediawiki.org/wiki/Extension:UserMerge
        .. _`VisualEditor`:             https://www.mediawiki.org/wiki/Extension:VisualEditor

    using the following::

        cd /var/www/mediawiki/extensions/

        # CASAuthentication
        git clone https://github.com/CWRUChielLab/CASAuth.git

        # EmbedVideo
        git clone https://github.com/HydraWiki/mediawiki-embedvideo.git EmbedVideo
        git -C EmbedVideo checkout -q v2.3.3  # latest release as of Aug 2016

        # ImportUsers
        git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ImportUsers.git
        git -C ImportUsers checkout -q REL1_27

        # Lockdown
        git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Lockdown.git
        git -C Lockdown checkout -q REL1_27

        # Math
        git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Math.git
        git -C Math checkout -q REL1_27
        make -C Math  # build texvc

        # MobileFrontend
        git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/MobileFrontend.git
        git -C MobileFrontend checkout -q REL1_27

        # NewArticleTemplate
        git clone https://github.com/mathiasertl/NewArticleTemplates.git NewArticleTemplate
        git -C NewArticleTemplate checkout -q cff90b32  # latest commit as of Aug 2016

        # Realnames
        wget -O Realnames.tar.gz http://ofbeaton.com/releases/Realnames/Realnames_0.3.1_2011-12-25.tar.gz
        tar -xf Realnames.tar.gz && rm Realnames.tar.gz

        # ScholasticGrading
        git clone https://github.com/CWRUChielLab/ScholasticGrading.git

        # Scribunto
        git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Scribunto.git
        git -C Scribunto checkout -q REL1_27

        # UserMerge
        git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/UserMerge.git
        git -C UserMerge checkout -q REL1_27

        # VisualEditor
        git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git
        git -C VisualEditor checkout -q REL1_27
        git -C VisualEditor submodule update --init

    .. todo::

        Consider adding Mathoid installation instructions. In its current form,
        this instruction set utilizes the Math extension's PNG mode. By changing
        ``$wgDefaultUserOptions['math']`` to ``'mathml'`` in
        ``LocalSettings.php``, an alternate MathML mode can be used. This
        requires a Mathoid server for runtime equation rendering. The
        ``$wgMathFullRestbaseURL`` setting specifies a server in Germany that is
        free to use but is occasionally unresponsive, causing the wiki to either
        load slowly or fail to render equations. By building a local Mathoid
        server, responsiveness and reliability could be guarenteed. However,
        after much effort, Jeff has not been able to get a Mathoid installation
        working yet. Since MathML offers few advantages over PNG mode, getting
        this working is a low priority.

6.  Download and install the CAS (Single Sign-On) configuration file::

        wget -O /var/www/mediawiki/extensions/CASAuth/CASAuthSettings.php https://neurowiki-docs.readthedocs.io/en/latest/_downloads/CASAuthSettings.php

    Randomize the secret key inside the configuration file::

        sed -i '/^\$CASAuth\["PwdSecret"\]/s|=".*";|="'$(openssl rand -hex 32)'";|' /var/www/mediawiki/extensions/CASAuth/CASAuthSettings.php

    Protect the secret key::

        sudo chmod ug=rw,o= /var/www/mediawiki/extensions/CASAuth/CASAuthSettings.php*

    If you are curious about the contents of ``CASAuthSettings.php``, you can
    view it here:

    .. container:: collapsible

        CASAuthSettings.php

        :download:`Direct link </_downloads/mediawiki-1.27-compatible/CASAuthSettings.php>`

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/CASAuthSettings.php
            :language: php

7.  Modify the Parsoid configuration for the VisualEditor extension. The Parsoid
    server running on the virtual machine needs to communicate with the web
    server on the same machine. To simplify this, Parsoid is configured to
    connect simply to ``http://localhost...``. For this to work, the protocol
    must be changed to HTTPS, and Parsoid must be permitted to ignore mismatched
    SSL certificates, since it will expect a certificate for "localhost", rather
    than one for DynamicsHJC, NeuroWiki, or NeuroWikiDev. Make the changes by
    running these commands::

        sudo sed -i '/setMwApi/s|http://|https://|' /etc/mediawiki/parsoid/settings.js
        sudo sed -i '/strictSSL/s|\(\w*\)//\(.*\)|\1\2|' /etc/mediawiki/parsoid/settings.js
        sudo service parsoid restart

8.  .. todo::

        Update the patch for MobileFrontend. For now, skip this step during
        installation.

    Customizing the mobile site navigation menu by downloading a patch file and
    applying it::

        wget -O /var/www/mediawiki/extensions/MobileFrontend/MobileFrontend_customize-icons.patch https://neurowiki-docs.readthedocs.io/en/latest/_downloads/MobileFrontend_customize-icons.patch
        patch -d /var/www/mediawiki/extensions/MobileFrontend < /var/www/mediawiki/extensions/MobileFrontend/MobileFrontend_customize-icons.patch

    If you are curious about the contents of the patch file, you can view it
    here:

    .. container:: collapsible

        MobileFrontend_customize-icons.patch

        :download:`Direct link </_downloads/mediawiki-1.27-compatible/MobileFrontend_customize-icons.patch>`

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/MobileFrontend_customize-icons.patch
            :language: diff

9.  .. todo::

        Explain the function of NewArticleTemplate better here and in terms of
        the subpages actually used by students.

    Modify the NewArticleTemplate extension so that subpage templates will be
    used even if the parent page does not exist.

    For example, without this modification, a new page *User:Foo/Bar* will use
    the User namespace subpage template
    *MediaWiki:NewArticleTemplate/User/Subpage* if the parent page *User:Foo*
    already exists, but it will use the User namespace template
    *MediaWiki:NewArticleTemplate/User* if *User:Foo* does not already exist.

    This modification will force the subpage template to always be used for
    subpages, regardless of whether the parent page exists or not.

    Download a patch file and apply it::

        wget -O /var/www/mediawiki/extensions/NewArticleTemplate/NewArticleTemplate_always-use-subpage-template.patch https://neurowiki-docs.readthedocs.io/en/latest/_downloads/NewArticleTemplate_always-use-subpage-template.patch
        patch -d /var/www/mediawiki/extensions/NewArticleTemplate < /var/www/mediawiki/extensions/NewArticleTemplate/NewArticleTemplate_always-use-subpage-template.patch

    If you are curious about the contents of the patch file, you can view it
    here:

    .. container:: collapsible

        NewArticleTemplate_always-use-subpage-template.patch

        :download:`Direct link </_downloads/mediawiki-1.27-compatible/NewArticleTemplate_always-use-subpage-template.patch>`

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/NewArticleTemplate_always-use-subpage-template.patch
            :language: diff

    .. todo::

        Add hooks to NewArticleTemplate so that it works with VisualEditor.

    .. todo::

        Fork NewArticleTemplate on GitHub and incorporate the "always use
        subpage template" patch and the hooks for VisualEditor.

10. Fix a bug in the Realnames extension (version 0.3.1) [#realnames-bug]_. The
    Realnames extension includes a bug that causes subpages in the User
    namespace to lack titles. Download a patch file and apply it::

        wget -O /var/www/mediawiki/extensions/Realnames/Realnames_ignore-subpage-titles.patch https://neurowiki-docs.readthedocs.io/en/latest/_downloads/Realnames_ignore-subpage-titles.patch
        patch -d /var/www/mediawiki/extensions/Realnames < /var/www/mediawiki/extensions/Realnames/Realnames_ignore-subpage-titles.patch

    If you are curious about the contents of the patch file, you can view it
    here:

    .. container:: collapsible

        Realnames_ignore-subpage-titles.patch

        :download:`Direct link </_downloads/mediawiki-1.27-compatible/Realnames_ignore-subpage-titles.patch>`

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/Realnames_ignore-subpage-titles.patch
            :language: diff

    .. todo::

        Fork Realnames on GitHub and incorporate the "ignore subpage titles"
        patch.

11. Fix a bug in the MediaWiki core that causes Lockdown to conflict with
    certain API calls [#lockdown-bug]_. In particular, this patch is needed to
    prevent the "Marking as patrolled failed" error and a silent failure when
    using the ``action=userrights`` API module. Download a patch file and apply
    it::

        wget -O /var/www/mediawiki/includes/user/Lockdown_api-compatibility.patch https://neurowiki-docs.readthedocs.io/en/latest/_downloads/Lockdown_api-compatibility.patch
        patch -d /var/www/mediawiki/includes/user < /var/www/mediawiki/includes/user/Lockdown_api-compatibility.patch

    If you are curious about the contents of the patch file, you can view it
    here:

    .. container:: collapsible

        Lockdown_api-compatibility.patch

        :download:`Direct link </_downloads/mediawiki-1.27-compatible/Lockdown_api-compatibility.patch>`

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/Lockdown_api-compatibility.patch
            :language: diff

12. Give the web server ownership of and access to the new files::

        sudo chown -R www-data:www-data /var/www/
        sudo chmod -R ug+rw /var/www/

13. Download and install the extension configuration settings::

        wget -P ~ https://neurowiki-docs.readthedocs.io/en/latest/_downloads/LocalSettings_extensions.php
        cat ~/LocalSettings_extensions.php >> /var/www/mediawiki/LocalSettings.php
        rm ~/LocalSettings_extensions.php

    If you are curious about the contents of the configuration file, you can
    view it here:

    .. container:: collapsible

        LocalSettings_extensions.php

        :download:`Direct link </_downloads/mediawiki-1.27-compatible/LocalSettings_extensions.php>`

        .. literalinclude:: /_downloads/mediawiki-1.27-compatible/LocalSettings_extensions.php
            :language: php

    .. todo::

        Post my solution for the VisualEditor + Lockdown extension conflict to
        the `discussion board
        <https://www.mediawiki.org/wiki/Topic:Rpj13q6rjc1bo377>`__, and then
        provide a "This solution is documented here" footnote in these
        instructions.

14. Create database tables for the Math and ScholasticGrading extensions::

        php /var/www/mediawiki/maintenance/update.php

15. Create aliases for URLs to the surveys and simulations using "interwiki"
    links. Interwiki links allow MediaWiki sites to easily create links to one
    another. For example, using ``[[wikipedia:Neuron]]`` on our wiki will create
    a link directly to the Wikipedia article on neurons. Here we use this
    capability to create aliases, such as ``[[survey:1]]``, that make linking to
    the surveys and simulations easier.

    Run the following (you will be prompted for the MySQL password twice)::

        echo "INSERT INTO interwiki (iw_prefix,iw_url,iw_api,iw_wikiid,iw_local,iw_trans) VALUES ('survey','/django/survey/\$1/','','',0,0)" | mysql -u root -p wikidb
        echo "INSERT INTO interwiki (iw_prefix,iw_url,iw_api,iw_wikiid,iw_local,iw_trans) VALUES ('sim','/JSNeuroSim/simulations/\$1.html','','',0,0)" | mysql -u root -p wikidb

16. Create a script for toggling the locked state of the wiki by downloading and
    installing a file::

        sudo wget -O /usr/local/sbin/lock-wiki https://neurowiki-docs.readthedocs.io/en/latest/_downloads/lock-wiki
        sudo chmod +x /usr/local/sbin/lock-wiki

    If you are curious about the contents of the script, you can view it here:

    .. container:: collapsible

        lock-wiki

        :download:`Direct link </_downloads/misc/lock-wiki>`

        .. literalinclude:: /_downloads/misc/lock-wiki
            :language: bash

17. At this point, individuals with CWRU accounts can log into the wiki, which
    will create a wiki account for them. Invite the TAs to do this now. After
    their accounts are created, you should visit (while logged in)

    https://dynamicshjc.case.edu:8014/wiki/Special:UserRights

    For each TA, enter their wiki user name (which should match their CWRU user
    name), and add them to the following groups:

    - *administrator*
        - Administrators have special powers on the wiki, such as moving,
          deleting, or protecting pages.
    - *bureaucrat*
        - Bureaucrats have the ability to change group membership (using the
          *Special:UserRights* page) for any user, including administrators and
          other bureaucrats (making this the most powerful group).
    - *grader*
        - Graders can view and edit all grades on the *Special:Grades* page.

    Add yourself to the *grader* group as well (you should already be a member
    of the other groups).

18. Check that all extensions are installed and working properly. Visit
    `Special:Version
    <https://dynamicshjc.case.edu:8014/wiki/Special:Version>`__ and compare the
    list of installed extensions to the list of extensions at the beginning of
    this section of the instructions.

    You can test each of the essential extensions by doing the following:

        =============================== ========================================
        Extension                       Test
        =============================== ========================================
        `CASAuthentication`_            log in using CWRU's Single Sign-On
        `EmbedVideo`_                   try adding ``{{#ev:youtube|8zRtXBrmvyc||center|Survival Guide}}`` to a page
        `ImportUsers`_                  visit `Special:ImportUsers <https://dynamicshjc.case.edu:8014/wiki/Special:ImportUsers>`__
        `Lockdown`_                     remove yourself from the *administrator* group using `Special:UserRights <https://dynamicshjc.case.edu:8014/wiki/Special:UserRights>`__ and try editing a policy page (restore privileges when done!)
        `Math`_                         try adding ``<math>x=\sqrt{2}</math>`` to a page
        `MobileFrontend`_               click the "Mobile view" link at the bottom of any page (click "Desktop" to return to normal)
        `NewArticleTemplate`_           will test later...
        `Realnames`_                    log in and look for your full name in the top right of the page
        `ScholasticGrading`_            visit `Special:Grades <https://dynamicshjc.case.edu:8014/wiki/Special:Grades>`__
        `UserMerge`_                    visit `Special:UserMerge <https://dynamicshjc.case.edu:8014/wiki/Special:UserMerge>`__
        `VisualEditor`_                 enable VE under Preferences > Editing, and then try editing a page by clicking "Edit" (not "Edit source")
        =============================== ========================================

    .. todo::

        Embedded videos don't render in VisualEditor. Fix?

    .. todo::

        When attempting to upload files through VisualEditor, it thinks I'm not
        logged in. Fix!

19. Shut down the virtual machine::

        sudo shutdown -h now

20. Using VirtualBox, take a snapshot of the current state of the virtual
    machine. Name it "**MediaWiki extensions installed**".


.. rubric:: Footnotes

.. [#import-users]
    This extension creates a Special page, *Special:ImportUsers*. After using
    it, run ::

        php /var/www/mediawiki/maintenance/initSiteStats.php

    to update the user count displayed on the wiki statistics page,
    *Special:Statistics* ("Active users" will change to "-1" after the script is
    run, but this will correct itself the next time an edit is made on the
    wiki).

.. [#realnames-bug]
    This solution is documented `here
    <http://www.mediawiki.org/wiki/Thread:Extension_talk:Realnames/Unknown_Modifier_Error_on_Subpages>`__.

.. [#lockdown-bug]
    This issue is described `here
    <https://phabricator.wikimedia.org/T148582>`__, and `this patch
    <https://gerrit.wikimedia.org/r/#/c/325566/>`__ (used in these instructions)
    was proposed for fixing it. Later, `another patch
    <https://gerrit.wikimedia.org/r/#/c/303358/>`__ was proposed, but I have not
    tested it since the first one works for our purposes. One or both of these
    patches was expected to be included in 1.27.2+, but as of July 2017 the bug
    `is reported <https://www.mediawiki.org/wiki/Topic:Tcspqvnlstfztqw2>`__ to
    still be present.
