Last login: Fri Apr 29 15:42:13 on ttys002
You have new mail.

The default interactive shell is now zsh.
To update your account to use zsh, please run `chsh -s /bin/zsh`.
For more details, please visit https://support.apple.com/kb/HT208050.
MDs-MacBook-Pro:~ shafiq$ ssh root@128.199.18.246
root@128.199.18.246's password: 
Welcome to Ubuntu 20.04.3 LTS (GNU/Linux 5.4.0-96-generic x86_64)

 * Documentation:  https://help.ubuntu.com
 * Management:     https://landscape.canonical.com
 * Support:        https://ubuntu.com/advantage

  System information as of Fri Apr 29 10:56:32 UTC 2022

  System load:  0.12              Users logged in:       0
  Usage of /:   6.3% of 48.29GB   IPv4 address for eth0: 128.199.18.246
  Memory usage: 34%               IPv4 address for eth0: 10.47.0.5
  Swap usage:   0%                IPv4 address for eth1: 10.122.0.2
  Processes:    129

56 updates can be applied immediately.
To see these additional updates run: apt list --upgradable


*** System restart required ***
********************************************************************************

Welcome to DigitalOcean's 1-Click LAMP Droplet.
To keep this Droplet secure, the UFW firewall is enabled.
All ports are BLOCKED except 22 (SSH), 80 (HTTP), and 443 (HTTPS).

In a web browser, you can view:
 * The LAMP 1-Click Quickstart guide: https://do.co/3gY97ha#start
 * Your LAMP website: http://128.199.18.246

On the server:
 * The default web root is located at /var/www/html
 * The MySQL root password is saved in /root/.digitalocean_password
 * Certbot is preinstalled. Run it to configure HTTPS. See
   https://do.co/3gY97ha#enable-https for more detail.

For help and more information, visit https://do.co/3gY97ha

********************************************************************************
To delete this message of the day: rm -rf /etc/update-motd.d/99-one-click
Last login: Fri Apr 29 10:15:22 2022 from 49.205.238.151
root@DakshinWeb1:~# php --version
PHP 8.0.14 (cli) (built: Dec 20 2021 21:22:57) ( NTS )
Copyright (c) The PHP Group
Zend Engine v4.0.14, Copyright (c) Zend Technologies
    with Zend OPcache v8.0.14, Copyright (c), by Zend Technologies
root@DakshinWeb1:~# sudo apt update
Hit:1 http://mirrors.digitalocean.com/ubuntu focal InRelease
Get:2 http://mirrors.digitalocean.com/ubuntu focal-updates InRelease [114 kB]  
Get:3 http://mirrors.digitalocean.com/ubuntu focal-backports InRelease [108 kB]
Hit:4 http://ppa.launchpad.net/ondrej/php/ubuntu focal InRelease               
Get:5 http://security.ubuntu.com/ubuntu focal-security InRelease [114 kB]
Get:6 http://mirrors.digitalocean.com/ubuntu focal-updates/main amd64 Packages [1749 kB]
Hit:7 https://repos-droplet.digitalocean.com/apt/droplet-agent main InRelease  
Get:8 http://mirrors.digitalocean.com/ubuntu focal-updates/universe amd64 Packages [920 kB]
Get:9 http://mirrors.digitalocean.com/ubuntu focal-backports/main amd64 Packages [42.2 kB]
Get:10 http://mirrors.digitalocean.com/ubuntu focal-backports/main Translation-en [10.1 kB]
Get:11 http://mirrors.digitalocean.com/ubuntu focal-backports/universe amd64 Packages [22.7 kB]
Fetched 3080 kB in 1s (2716 kB/s)                                              
Reading package lists... Done
Building dependency tree       
Reading state information... Done
56 packages can be upgraded. Run 'apt list --upgradable' to see them.
root@DakshinWeb1:~# sudo apt install curl
Reading package lists... Done
Building dependency tree       
Reading state information... Done
curl is already the newest version (7.68.0-1ubuntu2.10).
curl set to manually installed.
0 upgraded, 0 newly installed, 0 to remove and 56 not upgraded.
root@DakshinWeb1:~# dpkg -l curl
Desired=Unknown/Install/Remove/Purge/Hold
| Status=Not/Inst/Conf-files/Unpacked/halF-conf/Half-inst/trig-aWait/Trig-pend
|/ Err?=(none)/Reinst-required (Status,Err: uppercase=bad)
||/ Name           Version            Architecture Description
+++-==============-==================-============-============================>
ii  curl           7.68.0-1ubuntu2.10 amd64        command line tool for transf>
root@DakshinWeb1:~# 
root@DakshinWeb1:~# sudo service apache2 restart
root@DakshinWeb1:~# sudo apt install php libapache2-mod-php php-mysql
Reading package lists... Done
Building dependency tree       
Reading state information... Done
The following additional packages will be installed:
  libapache2-mod-php8.1 php8.1 php8.1-cli php8.1-mysql php8.1-opcache
  php8.1-readline
Suggested packages:
  php-pear
The following NEW packages will be installed:
  libapache2-mod-php libapache2-mod-php8.1 php php-mysql php8.1 php8.1-cli
  php8.1-mysql php8.1-opcache php8.1-readline
0 upgraded, 9 newly installed, 0 to remove and 56 not upgraded.
Need to get 3768 kB of archives.
After this operation, 12.7 MB of additional disk space will be used.
Do you want to continue? [Y/n] Y
Get:1 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 php8.1-opcache amd64 8.1.5-1+ubuntu20.04.1+deb.sury.org+1 [333 kB]
Get:2 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 php8.1-readline amd64 8.1.5-1+ubuntu20.04.1+deb.sury.org+1 [12.8 kB]
Get:3 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 php8.1-cli amd64 8.1.5-1+ubuntu20.04.1+deb.sury.org+1 [1661 kB]
Get:4 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 libapache2-mod-php8.1 amd64 8.1.5-1+ubuntu20.04.1+deb.sury.org+1 [1599 kB]
Get:5 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 libapache2-mod-php all 2:8.1+92+ubuntu20.04.1+deb.sury.org+2 [7464 B]
Get:6 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 php8.1 all 8.1.5-1+ubuntu20.04.1+deb.sury.org+1 [24.0 kB]
Get:7 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 php all 2:8.1+92+ubuntu20.04.1+deb.sury.org+2 [7264 B]
Get:8 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 php8.1-mysql amd64 8.1.5-1+ubuntu20.04.1+deb.sury.org+1 [116 kB]
Get:9 http://ppa.launchpad.net/ondrej/php/ubuntu focal/main amd64 php-mysql all 2:8.1+92+ubuntu20.04.1+deb.sury.org+2 [7288 B]
Fetched 3768 kB in 6s (637 kB/s)
Selecting previously unselected package php8.1-opcache.
(Reading database ... 98812 files and directories currently installed.)
Preparing to unpack .../0-php8.1-opcache_8.1.5-1+ubuntu20.04.1+deb.sury.org+1_amd64.deb ...
Unpacking php8.1-opcache (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Selecting previously unselected package php8.1-readline.
Preparing to unpack .../1-php8.1-readline_8.1.5-1+ubuntu20.04.1+deb.sury.org+1_amd64.deb ...
Unpacking php8.1-readline (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Selecting previously unselected package php8.1-cli.
Preparing to unpack .../2-php8.1-cli_8.1.5-1+ubuntu20.04.1+deb.sury.org+1_amd64.deb ...
Unpacking php8.1-cli (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Selecting previously unselected package libapache2-mod-php8.1.
Preparing to unpack .../3-libapache2-mod-php8.1_8.1.5-1+ubuntu20.04.1+deb.sury.org+1_amd64.deb ...
Unpacking libapache2-mod-php8.1 (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Selecting previously unselected package libapache2-mod-php.
Preparing to unpack .../4-libapache2-mod-php_2%3a8.1+92+ubuntu20.04.1+deb.sury.org+2_all.deb ...
Unpacking libapache2-mod-php (2:8.1+92+ubuntu20.04.1+deb.sury.org+2) ...
Selecting previously unselected package php8.1.
Preparing to unpack .../5-php8.1_8.1.5-1+ubuntu20.04.1+deb.sury.org+1_all.deb ...
Unpacking php8.1 (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Selecting previously unselected package php.
Preparing to unpack .../6-php_2%3a8.1+92+ubuntu20.04.1+deb.sury.org+2_all.deb ...
Unpacking php (2:8.1+92+ubuntu20.04.1+deb.sury.org+2) ...
Selecting previously unselected package php8.1-mysql.
Preparing to unpack .../7-php8.1-mysql_8.1.5-1+ubuntu20.04.1+deb.sury.org+1_amd64.deb ...
Unpacking php8.1-mysql (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Selecting previously unselected package php-mysql.
Preparing to unpack .../8-php-mysql_2%3a8.1+92+ubuntu20.04.1+deb.sury.org+2_all.deb ...
Unpacking php-mysql (2:8.1+92+ubuntu20.04.1+deb.sury.org+2) ...
Setting up php8.1-mysql (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...

Creating config file /etc/php/8.1/mods-available/mysqlnd.ini with new version

Creating config file /etc/php/8.1/mods-available/mysqli.ini with new version

Creating config file /etc/php/8.1/mods-available/pdo_mysql.ini with new version
Setting up php8.1-readline (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...

Creating config file /etc/php/8.1/mods-available/readline.ini with new version
Setting up php8.1-opcache (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...

Creating config file /etc/php/8.1/mods-available/opcache.ini with new version
Setting up php-mysql (2:8.1+92+ubuntu20.04.1+deb.sury.org+2) ...
Setting up php8.1-cli (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
update-alternatives: using /usr/bin/php8.1 to provide /usr/bin/php (php) in auto mode
update-alternatives: using /usr/bin/phar8.1 to provide /usr/bin/phar (phar) in auto mode
update-alternatives: using /usr/bin/phar.phar8.1 to provide /usr/bin/phar.phar (phar.phar) in auto mode

Creating config file /etc/php/8.1/cli/php.ini with new version
Setting up libapache2-mod-php8.1 (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...

Creating config file /etc/php/8.1/apache2/php.ini with new version
libapache2-mod-php8.1: php8.0 module already enabled, not enabling PHP 8.1
Setting up php8.1 (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Setting up libapache2-mod-php (2:8.1+92+ubuntu20.04.1+deb.sury.org+2) ...
Setting up php (2:8.1+92+ubuntu20.04.1+deb.sury.org+2) ...
Processing triggers for man-db (2.9.1-1) ...
Processing triggers for php8.1-cli (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
Processing triggers for libapache2-mod-php8.1 (8.1.5-1+ubuntu20.04.1+deb.sury.org+1) ...
root@DakshinWeb1:~# sudo nano /etc/apache2/mods-enabled/dir.conf
root@DakshinWeb1:~# sudo service apache2 restart
root@DakshinWeb1:~# sudo ufw allow "Apache Full"
Skipping adding existing rule
Skipping adding existing rule (v6)
root@DakshinWeb1:~# sudo apt-get install php-curl
Reading package lists... Done
Building dependency tree       
Reading state information... Done
php-curl is already the newest version (2:8.1+92+ubuntu20.04.1+deb.sury.org+2).
0 upgraded, 0 newly installed, 0 to remove and 56 not upgraded.
root@DakshinWeb1:~# sudo service apache2 restart
root@DakshinWeb1:~# php -version
PHP 8.1.5 (cli) (built: Apr 21 2022 10:14:45) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.5, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.5, Copyright (c), by Zend Technologies
root@DakshinWeb1:~# phpinfo()
> exit
-bash: syntax error near unexpected token `exit'
root@DakshinWeb1:~# cd /etc
root@DakshinWeb1:/etc# ls
NetworkManager                 hosts.deny              php
PackageKit                     init                    pki
X11                            init.d                  pm
adduser.conf                   initramfs-tools         polkit-1
aliases                        inputrc                 pollinate
aliases.db                     insserv.conf.d          popularity-contest.conf
alternatives                   iproute2                postfix
apache2                        iscsi                   ppp
apparmor                       issue                   profile
apparmor.d                     issue.net               profile.d
apport                         kernel                  protocols
apt                            kernel-img.conf         python3
at.deny                        landscape               python3.8
bash.bashrc                    ld.so.cache             rc0.d
bash_completion                ld.so.conf              rc1.d
bash_completion.d              ld.so.conf.d            rc2.d
bindresvport.blacklist         ldap                    rc3.d
binfmt.d                       legal                   rc4.d
byobu                          letsencrypt             rc5.d
ca-certificates                libaudit.conf           rc6.d
ca-certificates.conf           libblockdev             rcS.d
ca-certificates.conf.dpkg-old  locale.alias            resolv.conf
calendar                       locale.gen              resolvconf
cloud                          localtime               rmt
console-setup                  logcheck                rpc
cron.d                         login.defs              rsyslog.conf
cron.daily                     logrotate.conf          rsyslog.d
cron.hourly                    logrotate.d             screenrc
cron.monthly                   lsb-release             security
cron.weekly                    ltrace.conf             selinux
crontab                        lvm                     services
cryptsetup-initramfs           machine-id              shadow
crypttab                       magic                   shadow-
dbus-1                         magic.mime              shells
dconf                          mailcap                 skel
debconf.conf                   mailcap.order           sos
debian_version                 manpath.config          ssh
default                        mdadm                   ssl
deluser.conf                   mecabrc                 subgid
depmod.d                       mime.types              subuid
dhcp                           mke2fs.conf             sudoers
dpkg                           modprobe.d              sudoers.d
e2scrub.conf                   modules                 sysctl.conf
ec2_version                    modules-load.d          sysctl.d
environment                    monit                   systemd
ethertypes                     mtab                    terminfo
fail2ban                       multipath.conf          timezone
fonts                          mysql                   tmpfiles.d
fstab                          nanorc                  ubuntu-advantage
fuse.conf                      netplan                 ucf.conf
fwupd                          network                 udev
gai.conf                       networkd-dispatcher     udisks2
groff                          networks                ufw
group                          newt                    update-manager
group-                         nsswitch.conf           update-motd.d
grub.d                         opt                     update-notifier
gshadow                        os-release              vim
gshadow-                       overlayroot.conf        vmware-tools
gss                            overlayroot.local.conf  vtrgb
hdparm.conf                    pam.conf                wgetrc
host.conf                      pam.d                   xattr.conf
hostname                       passwd                  xdg
hosts                          passwd-                 zsh_command_not_found
hosts.allow                    perl
root@DakshinWeb1:/etc# cd php/
root@DakshinWeb1:/etc/php# ls
5.6  7.0  7.1  7.2  7.3  7.4  8.0  8.1
root@DakshinWeb1:/etc/php# cd 8.1
root@DakshinWeb1:/etc/php/8.1# ls
apache2  cli  mods-available
root@DakshinWeb1:/etc/php/8.1# cd cli/
root@DakshinWeb1:/etc/php/8.1/cli# ls
conf.d  php.ini
root@DakshinWeb1:/etc/php/8.1/cli# nano php.ini 
root@DakshinWeb1:/etc/php/8.1/cli# php -i | grep 'php.ini'
Configuration File (php.ini) Path => /etc/php/8.1/cli
Loaded Configuration File => /etc/php/8.1/cli/php.ini
root@DakshinWeb1:/etc/php/8.1/cli# nano php.ini 

  GNU nano 4.8                        php.ini                                   
[mail function]
; For Win32 only.
; https://php.net/smtp
SMTP = localhost
; https://php.net/smtp-port
smtp_port = 25

; For Win32 only.
; https://php.net/sendmail-from
;sendmail_from = me@example.com

; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
; https://php.net/sendmail-path
;sendmail_path =

; Force the addition of the specified parameters to be passed as extra paramete>
; to the sendmail binary. These parameters will always replace the value of
; the 5th parameter to mail().
;mail.force_extra_parameters =


^G Get Help  ^O Write Out ^W Where Is  ^K Cut Text  ^J Justify   ^C Cur Pos
^X Exit      ^R Read File ^\ Replace   ^U Paste Text^T To Spell  ^_ Go To Line
