

# EXTENSIONS

# CASAuthentication
require_once("$IP/extensions/CASAuth/CASAuth.php");

# EmbedVideo
wfLoadExtension( 'EmbedVideo' );

# ImportUsers
require_once("$IP/extensions/ImportUsers/ImportUsers.php");

# Interwiki -- automatically enabled above
$wgGroupPermissions['sysop']['interwiki'] = true;

######################################################################
# Lockdown

# Non-admin users (students) can be prevented from editing the wiki
# after the final deadline for the term paper. Toggle between states
# by running
#   sudo lock-wiki
# which will change the value of this variable.
$wikiLocked = false;

# These lines are included just to get these groups to appear among
# the list of available user groups.
$wgGroupPermissions['term-paper-author']['read'] = true;
$wgGroupPermissions['term-paper-deadline-extension']['read'] = true;

# Define custom namespaces for term papers and prevent their inclusion
# in other pages as templates
define('NS_PRIVATE', 100);
define('NS_PRIVATE_TALK', 101);
$wgExtraNamespaces[NS_PRIVATE] = 'Private';
$wgExtraNamespaces[NS_PRIVATE_TALK] = 'Private_talk';
$wgNonincludableNamespaces[] = NS_PRIVATE;
$wgNonincludableNamespaces[] = NS_PRIVATE_TALK;

# The VisualEditor extension and its companion Parsoid server will
# fail if a combination of MediaWiki's core permission system
# ($wgGroupPermissions) and the Lockdown extension are used to
# restrict access to the wiki. Here we remove all restrictions by
# making the entire wiki readable and writable by anyone (including
# users not logged in), but we will create restrictions below using
# Lockdown.
$wgGroupPermissions['*']['read'] = true;
$wgGroupPermissions['*']['edit'] = true;

# Load the Lockdown extension unless the request to access the wiki
# comes from localhost (IP address 127.0.0.1, i.e., the virtual
# machine itself). This will load Lockdown for all users accessing the
# wiki through the web but not for the Parsoid server running on the
# virtual machine, which is used by the VisualEditor extension. If
# Lockdown is loaded when Parsoid tries to access the wiki (even if no
# configuration variables are set), VisualEditor will fail.
if ( !(array_key_exists('REMOTE_ADDR',$_SERVER) && $_SERVER['REMOTE_ADDR'] == '127.0.0.1') ) {

    # Load the extension
    require_once("$IP/extensions/Lockdown/Lockdown.php");

    # Restrict reading of term paper pages to term paper authors and
    # admins (instructors)
    $wgNamespacePermissionLockdown[NS_PRIVATE]['read']      = array('sysop', 'term-paper-author', 'term-paper-deadline-extension');
    $wgNamespacePermissionLockdown[NS_PRIVATE_TALK]['read'] = array('sysop', 'term-paper-author', 'term-paper-deadline-extension');

    # Restrict editing of all pages to admins (instructors), with a
    # few exceptions if the wiki is unlocked or if a student has a
    # term paper extension ('user' includes all logged in users)
    $wgNamespacePermissionLockdown['*']['edit'] = array('sysop');
    if ( !$wikiLocked ) {
        $wgNamespacePermissionLockdown[NS_TALK]['edit']         = array('user');
        $wgNamespacePermissionLockdown[NS_USER]['edit']         = array('user');
        $wgNamespacePermissionLockdown[NS_USER_TALK]['edit']    = array('user');
        $wgNamespacePermissionLockdown[NS_FILE]['edit']         = array('user');
        $wgNamespacePermissionLockdown[NS_PRIVATE]['edit']      = array('sysop', 'term-paper-author');
        $wgNamespacePermissionLockdown[NS_PRIVATE_TALK]['edit'] = array('sysop', 'term-paper-author');
    } else {
        $wgNamespacePermissionLockdown[NS_PRIVATE]['edit']      = array('sysop', 'term-paper-deadline-extension');
    }

    # Restrict moving of all pages to sysop, with a few exceptions if
    # the wiki is unlocked ('user' includes all logged in users)
    $wgNamespacePermissionLockdown['*']['move'] = array('sysop');
    if ( !$wikiLocked ) {
        $wgNamespacePermissionLockdown[NS_USER]['move']    = array('user');
        $wgNamespacePermissionLockdown[NS_FILE]['move']    = array('user');
        $wgNamespacePermissionLockdown[NS_PRIVATE]['move'] = array('sysop', 'term-paper-author');
    } else {
        $wgNamespacePermissionLockdown[NS_PRIVATE]['move'] = array('sysop', 'term-paper-deadline-extension');
    }
}

# END Lockdown
##########################################################################

# Math
wfLoadExtension( 'Math' );
$wgMathFullRestbaseURL = 'https://api.formulasearchengine.com/';
$wgMathValidModes = array('mathml', 'png', 'source');
$wgDefaultUserOptions['math'] = 'png';
$wgHiddenPrefs[] = 'math';

# MobileFrontend
wfLoadExtension( 'MobileFrontend' );
$wgMFAutodetectMobileView = true;

# NewArticleTemplate
require_once ("$IP/extensions/NewArticleTemplate/NewArticleTemplate.php");
$wgNewArticleTemplatesEnable = true;
$wgNewArticleTemplatesOnSubpages = true;
$wgNewArticleTemplatesNamespaces = array(
    NS_USER      => 1,
    NS_USER_TALK => 1
);
$wgNewArticleTemplates_PerNamespace = array(
    NS_USER      => "MediaWiki:NewArticleTemplate/User",
    NS_USER_TALK => "MediaWiki:NewArticleTemplate/User Talk"
);

# Realnames
require_once("$IP/extensions/Realnames/Realnames.php");

# ScholasticGrading
require_once("$IP/extensions/ScholasticGrading/ScholasticGrading.php");
$wgGroupPermissions['grader']['editgrades'] = true;

# Scribunto
require_once("$IP/extensions/Scribunto/Scribunto.php");
$wgScribuntoDefaultEngine = 'luastandalone';

# UserMerge
wfLoadExtension( 'UserMerge' );
$wgGroupPermissions['*']['usermerge'] = false;
$wgGroupPermissions['sysop']['usermerge'] = true;
$wgUserMergeProtectedGroups = array('sysop');

# VisualEditor
wfLoadExtension( 'VisualEditor' );
$wgDefaultUserOptions['visualeditor-enable'] = 0;
$wgDefaultUserOptions['visualeditor-hidebetawelcome'] = 1;
$wgVirtualRestConfig['modules']['parsoid'] = array(
    'url' => 'http://localhost:8142',   # use http, not https
    'prefix' => 'localhost',
    'domain' => 'localhost',
    'forwardCookies' => true,
);
$wgVisualEditorAvailableNamespaces = array(
    NS_MAIN         => true,
    NS_TALK         => true,
    NS_USER         => true,
    NS_USER_TALK    => true,
    NS_PRIVATE      => true,
    NS_PRIVATE_TALK => true,
    NS_HELP         => true,
    NS_PROJECT      => true,
);

# WikiEditor -- automatically enabled above
$wgDefaultUserOptions['usebetatoolbar'] = true;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = true;
$wgDefaultUserOptions['wikieditor-preview'] = true;
