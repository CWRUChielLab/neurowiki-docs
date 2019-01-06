Modifying Student Real Names
================================================================================

.. _modify-real-names-mediawiki:

Changing Real Names on the Wiki
--------------------------------------------------------------------------------

.. todo::

    Install phpMyAdmin for a web interface for changing real names.

To edit user real names manually so they will appear with the Realnames
extension, edit the wiki database directly using the following command::

    mysql -u root -p wikidb

Enter the <MySQL password> when prompted. Edit entries for individuals on the
wiki using

.. code-block:: sql

    UPDATE user SET user_real_name='<realname>' WHERE user_name='<username>';

Note that user names always begin with a capital letter. Type ``exit`` to quit.
After changing a real name, the server must be restarted::

    sudo apache2ctl restart


.. _modify-real-names-django:

Changing Real Names in the Survey System
--------------------------------------------------------------------------------

.. todo::

    Add instructions for changing real names in Django.