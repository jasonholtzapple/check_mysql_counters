check_mysql_counters
====================

check_mysql_counters is a nagios plugin and pnp4nagios template designed to
show you performance trends in your MySQL servers.

To use, copy check_mysql_counters to your nagios libexec directory if you
are using MySQL 5.1, check_mysql_counters_55 if you are using MySQL 5.5,
check_mysql_counters_56 if you are using MySQL 5.6,
check_mysql_counters_p55 if you are using Percona 5.5, or
check_mysql_counterS_p56 if you are using Percona 5.6

Then create a MYSQL_COUNTERS nagios service that executes the plugin:

* Oracle 5.1: check_mysql_counters -H host -P port -u mysqluser -p mysqlpassword
* Oracle 5.5: check_mysql_counters_55 -H host -P port -u mysqluser -p mysqlpassword
* Oracle 5.6: check_mysql_counters_56 -H host -P port -u mysqluser -p mysqlpassword
* Percona 5.5: check_mysql_counters_p55 -H host -P port -u mysqluser -p mysqlpassword
* Percona 5.6: check_mysql_counters_p56 -H host -P port -u mysqluser -p mysqlpassword

Then copy the correct check_mysql_counters.php template from the directory

* oracle_5_1_with_innodb_plugin
* oracle_5_1_without_innodb_plugin
* oracle_5_5
* oracle_5_6
* percona_5_5
* percona_5_6

to your pnp4nagios template directory - the default location is
/usr/local/pnp4nagios/share/templates

The plugin currently does not support being called by NRPE (the data returned is too large), a future version might address this.

Requirements
============

* MySQL 5.1 - supported
* MySQL 5.5 - untested
* MySQL 5.6 - supported
* Percona Server 5.5 - supported
* Percona Server 5.6 - supported

php/mysqli on the server executing the plugin.

MySQL database user - no special privileges required.

It has been tested with pnp4nagios 0.6.

Authors
=======

* Jason Holtzapple - original plugin and templates
* Jesse Morgan - Oracle MySQL 5.6 support and various bug fixes
