Introduction to Git
================================================================================

.. todo::

    Write an intro to Git.

X.  Create a Git profile for yourself::

        git config --global user.name "<your full real name>"
        git config --global user.email <your email>
        git config --global core.editor vim
        git config --global push.default simple

X.  Generate an SSH key on the virtual machine if you do not have one already.
    This will generate an identity for your account on this virtual machine that
    can later be granted privileges to the Git repository on GitHub. If you have
    an SSH key already, this command will recognize that and do nothing.
    Otherwise, press Enter three times when asked about the file location and
    passphrase::

        [ -e ~/.ssh/id_rsa ] || ssh-keygen