SSL Certificate Management
================================================================================

For an introduction to SSL certificates, see :doc:`ssl-bg`.

A collection of all our SSL certificates is maintained in a secure directory on
DynamicsHJC: ``/Users/vbox/ssl-certificates``. Since Fall 2016, this directory
is shared with the virtual machines as a virtual file system mounted at
``/media/sf_ssl-certificates``. Virtual machines created since that time serve
their SSL certificates directly from this central collection. (Older virtual
machines have local copies of the certificates.) This makes certificate renewal
easier, as updating the certificate in one place will take care of expiring
certificates on all clones of that virtual machine.


.. _ssl-cert-check:

Checking Expiration Dates
--------------------------------------------------------------------------------

SSL certificates have limited lifespans. Certificates provided by the university
usually last 3 years. You can check the expiration date of a certificate on
a live website using your browser (click the lock icon in the address bar). You
can also check the expiration dates for all the certificates in the
aforementioned collection using this script on DynamicsHJC::

    sudo ~vbox/ssl-certificates/check-ssl-cert-expiration


.. _ssl-cert-create:

Creating a New Certificate
--------------------------------------------------------------------------------

.. note::

    These are probably not the instructions you are looking for! In general, you
    should not need to create SSL certificates from scratch. If you received a
    warning in an email about an expiring certificate, you should instead
    consult :ref:`ssl-cert-renew`.

Normally, the only time you would use the following process for creating a
certificate from scratch would be if you need a certificate for a machine with a
new name (e.g., because you want to start hosting a wiki at
``awesomewiki.case.edu``). You might also be asked by the university's
certificate administrators to create a new certificate, rather than renew an
existing one, if there is a problem with the old one (e.g., if the old
certificate was created with the deprecated SHA1 encryption algorithm).

Below is a list of steps showing how one would create a certificate from
scratch. Throughout these instructions, you should replace ``<host>`` with the
name of the machine for which you are creating the certificate. The ``<CSR
password>`` is something you need to make up in step 3, and which will be needed
in step 6. You can discard it after that as it will not be needed again.

1.  Log into the VirtualBox Machines (vbox) account on DynamicsHJC::

        ssh vbox@dynamicshjc.case.edu

2.  Create a new directory for the new certificate::

        mkdir -p ~/ssl-certificates/<host>/new

3.  Generate a private key and certificate signing request (CSR) pair for the
    new certificate::

        openssl req -sha512 -new -newkey rsa:2048 -nodes -keyout ~/ssl-certificates/<host>/new/<host>_case_edu.key -out ~/ssl-certificates/<host>/new/<host>_case_edu.csr

    Enter the following details when prompted:

    - Country Name: US
    - State or Province Name: Ohio
    - Locality Name: Cleveland
    - Organization Name: Case Western Reserve University
    - Organizational Unit Name: Biology
    - Common Name: <host>.case.edu
    - Email Address: hjc@case.edu
    - A challenge password: <CSR password>
    - An optional company name: .

4.  Protect the new files::

        find ~/ssl-certificates/*/ -type f -exec chmod u=rw,go= {} \;

5.  Dump the contents of the CSR to the screen and copy all of it to the
    clipboard::

        cat ~/ssl-certificates/<host>/new/<host>_case_edu.csr

6.  Visit the following web site,

        https://cert-manager.com/customer/InCommon/ssl?action=enroll

    and supply the following on the front page:

    - Access Code: <access code> (see email dated 12/27/2015 from certificate-admin@case.edu with subject line "Fwd: WARNING: Expiration Notice: InCommon SSL certificate for dynamicshjc.case.edu")
    - E-mail: hjc@case.edu

    Fill in the remaining fields:

    - Don't edit address details
    - Certificate Type: InCommon SSL (SHA-2)
    - Certificate Term: 3 years
    - Server Software: Apache/ModSSL
    - CSR: <paste contents of CSR>
    - Common Name: <host>.case.edu
    - Pass-phrase: <CSR password>
    - External Requester: hjc@case.edu

    Press Enroll.

7.  After an evaluation period, an email with a subject line beginning
    "Enrollment Successful" will arrive for Dr. Chiel containing links for
    downloading files in various formats. He can forward the email to you.

    Using Safari in the VirtualBox Machines (vbox) account on DynamicsHJC, log
    into your email and download the following using the links provided in the
    email:

    - X509 Certificate only, Base64 encoded
    - X509 Intermediates/root only, Base64 encoded

    The first file, which will end in ``_cert.cer``, is the new certificate
    belonging to your site. The second file, which will end in ``_interm.cer``,
    contains a chain of certificate authorities that the server will use to
    corroborate its claim that its certificate isn't fake.

8.  Move these two files into ``~ssl-certificates/<host>/new`` on DynamicsHJC
    with the matching private key and CSR files. If you downloaded the files
    while sitting in front of DynamicsHJC or using screen sharing, this can be
    done simply by dragging-and-dropping. If instead you downloaded the files
    onto your local machine, you can use ``scp`` to copy the files::

        scp *.cer vbox@dynamicshjc.case.edu:ssl-certificates/<host>/new

9.  Once again, secure the files::

        find ~/ssl-certificates/*/ -type f -exec chmod u=rw,go= {} \;

10. You can now move the new files into the location where the virtual machines
    will expect to find them (and retire the old certificate if one exists)::

        mkdir -p ~/ssl-certificates/<host>/old
        rm -f ~/ssl-certificates/<host>/old/*
        mv ~/ssl-certificates/<host>/*.{cer,key,csr} ~/ssl-certificates/<host>/old
        mv ~/ssl-certificates/<host>/new/*.{cer,key,csr} ~/ssl-certificates/<host>

    Double check that you did this right, and then remove the ``new``
    directory::

        rm -rf ~/ssl-certificates/<host>/new

11. If any of the currently running virtual machines were using the retired
    certificate (if it even existed), you will need to log into them and restart
    their web servers before they will begin using the new certificate. Use the
    following to restart the web server::

        sudo apache2ctl restart

    If the new certificate was for DynamicsHJC, you should also restart its web
    server. The command is a little different on the Mac::

        sudo apachectl restart

    Check that the web server is now using the new certificate by visiting the
    site in a browser and clicking the lock icon that appears next to the
    address bar. You should be able to view the certificate details. Verify that
    the expiration date is far in the future.


.. _ssl-cert-renew:

Renewing an Expiring Certificate
--------------------------------------------------------------------------------

When an SSL certificate is going to expire soon, you will receive an
expiration notice in an email. Follow these steps to renew it. Throughout these
instructions, you should replace ``<host>`` with the name of the machine for
which you are renewing the certificate.

1.  Forward the email notice to Tareq Alrashid at certificate-admin@case.edu and
    ask that the certificate be renewed for another 3 years.

2.  After an evaluation period, an email with a subject line beginning
    "Enrollment Successful" will arrive for Dr. Chiel containing links for
    downloading files in various formats. He can forward the email to you.

    Using Safari in the VirtualBox Machines (vbox) account on DynamicsHJC, log
    into your email and download the following using the links provided in the
    email:

    - X509 Certificate only, Base64 encoded
    - X509 Intermediates/root only, Base64 encoded

    The first file, which will end in ``_cert.cer``, is the renewed certificate
    belonging to your site. The second file, which will end in ``_interm.cer``,
    contains a chain of certificate authorities that the server will use to
    corroborate its claim that its certificate isn't fake.

3.  Retire the old certificate and certificate chain files::

        mkdir -p ~/ssl-certificates/<host>/old
        rm -f ~/ssl-certificates/<host>/old/*
        mv ~/ssl-certificates/<host>/*.cer ~/ssl-certificates/<host>/old

4.  Move the two files downloaded in step 2 into ``~ssl-certificates/<host>`` on
    DynamicsHJC. The matching private key and CSR files should already be in
    there, with extensions ``.key`` and ``.csr`` respectively (if the latter is
    missing, that's OK). If you downloaded the files while sitting in front of
    DynamicsHJC or using screen sharing, this can be done simply by
    dragging-and-dropping. If instead you downloaded the files onto your local
    machine, you can use ``scp`` to copy the files::

        scp *.cer vbox@dynamicshjc.case.edu:ssl-certificates/<host>

5.  Protect the new files::

        find ~/ssl-certificates/*/ -type f -exec chmod u=rw,go= {} \;

6.  If any of the currently running virtual machines were using the retired
    certificate, you will need to log into them and restart their web servers
    before they will begin using the new certificate. Use the following to
    restart the web server on the virtual machines::

        sudo apache2ctl restart

    If the renewed certificate was for DynamicsHJC, you should also restart its
    web server. The command is a little different on the Mac::

        sudo apachectl restart

    Check that the web server is now using the new certificate by visiting the
    site in a browser and clicking the lock icon that appears next to the
    address bar. You should be able to view the certificate details. Verify that
    the expiration date is far in the future.