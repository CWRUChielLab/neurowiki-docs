Updating Django
================================================================================

The `django-announce mailing list
<https://docs.djangoproject.com/en/1.8/internals/mailing-lists/#django-announce>`__
provides announcements for security updates and new releases. General
instructions for upgrading can be found `here
<https://docs.djangoproject.com/en/1.8/howto/upgrade-version/>`__.

To see which version of Django is *currently* installed, run ::

    pip show Django

To see which versions of Django are *available*, run ::

    pip install Django==null

Upgrading the Django installation should be as simple as running ::

    sudo pip install Django==1.8.X
    sudo apache2ctl restart

where ``1.8.X`` should be replaced with a valid version number.

Once this is completed, you should try visiting our Django site, including the
admin side of the site, to look for anything obviously broken. You can run some
simple tests, such as opening and closing surveys, or changing a user's
privileges.

If bugs are discovered after upgrading, it is possible that you will need to
make changes to *our* code---the CourseDjango application. Do not forget to
commit and push any fixes to the Git repository (see :doc:`git-intro` for help
with this)!
