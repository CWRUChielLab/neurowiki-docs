Introduction to Vim
================================================================================

Vim is a text editor for the command line that you will use often when following
these instructions. Vim can be very intimidating for new users, but for the
purposes of these instructions you only need to know a few commands.

To start Vim, type ``vim /path/to/file`` on the command line to edit a new or
existing file. Vim has two modes that you will use regularly: command mode and
insert mode. **Command mode** allows you to execute commands like saving and
quitting. **Insert mode** lets you actually edit text.

When you first start Vim you will be in command mode, so you cannot immediately
begin editing text. You must first switch into insert mode by pressing ``i``.
When you do this, you should notice the last line in the terminal window says
"``-- INSERT --``". When in insert mode, you can type text and it will appear on
screen as you would expect. Press Esc to return to command mode, and the insert
mode indicator at the bottom of the terminal window will disappear.

If you press the wrong keys in command mode, unexpected and confusing things may
happen. If you get stuck in some other mode, press Esc a few times to return to
command mode. If that fails, try typing ``:q`` followed by the Enter key.

Below is a list of useful commands. Notice that commands beginning with a colon
(``:``) or slash (``/``) appear on the bottom line in the terminal window when
typed in command mode.

- **Save and quit**: In command mode, type ``:w`` followed by the Enter key to
  save (write) the file. Type ``:q`` followed by the Enter key to quit Vim. If
  you have made unsaved changes to the file before trying to quit, you will get
  an error, "``No write since last change``". To quit and discard unsaved
  changes, type ``:q!`` followed by the Enter key.

- **Undo and redo**: In command mode, press ``u`` to undo your last action.
  Press Ctrl + ``r`` to redo.
 
- **Search**: In command mode, type ``/``, followed by a word or phrase,
  followed by the Enter key to begin searching for the phrase. Press ``n`` to
  cycle to the next instance of the phrase or ``N`` to cycle to the previous
  instance.

- **Line numbers**: In command mode, type ``:set number`` followed by the Enter
  key to turn on line numbering. Use ``:set nonumber`` to turn it off again.

- **Jump**: In command mode, press ``gg`` to jump to the top of the file. Type a
  line number before this command to jump to that line. Press ``G`` to jump to
  the end of the file.

- **Paste**: You can use your terminal application's normal paste command to
  paste text while in insert mode. However, sometimes when you paste a
  multi-line block of text into Vim from another source (such as from this
  document), the pasted content will be auto-indented or auto-commented in
  undesirable ways. To prevent this behavior, in command mode, type ``:set
  paste`` followed by the Enter key before entering insert mode and pasting.

- **Mouse**: In command mode, type ``:set mouse=a`` followed by the Enter key to
  enable interaction with the text using your mouse. This will allow you to
  click anywhere to place the cursor or to select blocks of text.


.. _vimrc:

Vim Configuration File
--------------------------------------------------------------------------------

The following instructions will customize your Vim configuration so that syntax
highlighting and line numbers are turned on by default. It will also enable
interaction with text using the mouse, so you can place the cursor by clicking
with the mouse. It also enables a "persistent undo" feature that allows Vim to
retain the history of edits for a file after it is closed, so you can undo or
redo edits even after closing and reopening a file.

The persistent undo feature depends on the existence of a directory. Create this
directory now::

    mkdir -p ~/.vim/undodir

Finally, download and install the ``.vimrc`` configuration file::

    wget -O ~/.vimrc https://dynamicshjc.case.edu/~vbox/biol373/_downloads/.vimrc

If you are curious about the contents of ``.vimrc``, you can view it here:

.. container:: collapsible

    .vimrc

    :download:`Direct link <_downloads/misc/.vimrc>`

    .. literalinclude:: _downloads/misc/.vimrc
        :language: vim