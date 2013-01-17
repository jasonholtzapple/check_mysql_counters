check_mysql_counters
====================

check_mysql_counters is a nagios plugin and pnp4nagios template designed to
show you performance trends in your MySQL servers.

To use, copy check_mysql_counters to your nagios libexec directory if you
are using MySQL 5.1, check_mysql_counters_55 if you are using MySQL 5.5,
or check_mysql_counters_p55 if you are using Percona 5.5.

Then create a MYSQL_COUNTERS nagios service that executes the plugin:

* Oracle 5.1: check_mysql_counters -H host -P port -u mysqluser -p mysqlpassword
* Oracle 5.5: check_mysql_counters_55 -H host -P port -u mysqluser -p mysqlpassword
* Percona 5.5: check_mysql_counters_p55 -H host -P port -u mysqluser -p mysqlpassword

As far as I know, the database user does not need any special privileges
to gather statistics.

Then copy the correct check_mysql_counters.php template from the directory

* oracle_5_1_with_innodb_plugin
* oracle_5_1_without_innodb_plugin
* oracle_5_5
* percona_5_5

to your pnp4nagios template directory - the default location is
/usr/local/pnp4nagios/share/templates

If you are using nrpe for your check, you will need to use a pnp4nagios
custom template. See the documentation here for an example:

http://docs.pnp4nagios.org/pnp-0.6/tpl_custom

Requirements
============

* MySQL 5.1 - supported
* MySQL 5.5 - untested
* Percona Server 5.5 - supported

php/mysqli on your Nagios server for the plugin

It has been tested with pnp4nagios 0.6
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
~                                                                               
                                                              30,11         All

