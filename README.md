check_mysql_counters
====================

check_mysql_counters is a nagios plugin and pnp4nagios template designed to
show you performance trends in your MySQL servers.

To use, copy the appropriate check to your nagios libexec directory:
MySQL 5.1 -> check_mysql_counters
MySQL 5.5 -> check_mysql_counters_55
MySQL 5.6 -> -> check_mysql_counters_56
Percona MySQL 5.5 -> check_mysql_counters_p55
Percona MySQL 5.6 -> check_mysql_counters_p56
Percona MySQL 5.7 -> check_mysql_counters_p57

Then create a MYSQL_COUNTERS nagios service that executes the plugin:

* CentOS6 MySQL 5.1 (mysql-server package): check_mysql_counters -H host -P port -u mysqluser -p mysqlpassword
* Oracle 5.1: check_mysql_counters -H host -P port -u mysqluser -p mysqlpassword
* Oracle 5.5: check_mysql_counters_55 -H host -P port -u mysqluser -p mysqlpassword
* Oracle 5.6: check_mysql_counters_56 -H host -P port -u mysqluser -p mysqlpassword
* Percona 5.5: check_mysql_counters_p55 -H host -P port -u mysqluser -p mysqlpassword
* Percona 5.6: check_mysql_counters_p56 -H host -P port -u mysqluser -p mysqlpassword
* Percona 5.7: check_mysql_counters_p57 -H host -P port -u mysqluser -p mysqlpassword

Then copy the correct check_mysql_counters.php template from the directory

* centos_5_1_mysql_5_1
* oracle_5_1_with_innodb_plugin
* oracle_5_1_without_innodb_plugin
* oracle_5_5
* oracle_5_6
* percona_5_5
* percona_5_6
* percona_5_7

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
* Percona Server 5.7 - supported

php/mysqli on the server executing the plugin.

MySQL database user - permissions to read the performance_schema table are required for version 5.7 or later.

It has been tested with pnp4nagios 0.6.

Authors
=======

* Jason Holtzapple - original plugin and templates
* Jesse Morgan - Oracle MySQL 5.6 support and various bug fixes
* Kevin Pankonen - CentOS6 MySQL 5.1 (mysql-server) support
