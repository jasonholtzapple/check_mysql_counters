<?php
/*
check_mysql_counters.php version 1.2

Licensed under the BSD simplified 2 clause license

Copyright (c) 2012, WebPT, LLC.
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

check_mysql_counters.php - a pnp4nagios template to display performance information captured by the check_mysql_counters nagios plugin inspired by the Percona MySQL cacti templates
Written by Jason Holtzapple - jason@bitflip.net

*/

$orange    = '#FF9933';
$blue      = '#3E9ADE';
$red       = '#FF3300';
$darkred   = '#990000';
$paleblue  = '#80B4C1';
$yellow    = '#FFCC00';

$num = 1;

$ds_name[$num] = 'Database Activity';
$opt[$num] = "--title  \"$hostname - Database Activity\" --vertical-label \"avg statements/sec\" --units-exponent 0 --lower-limit 0";
$def[$num] = rrd::def('sel', $RRDFILE[1], $DS[86], 'AVERAGE');
$def[$num] .= rrd::def('ins', $RRDFILE[1], $DS[60], 'AVERAGE');
$def[$num] .= rrd::def('upd', $RRDFILE[1], $DS[141], 'AVERAGE');
$def[$num] .= rrd::def('rep', $RRDFILE[1], $DS[77], 'AVERAGE');
$def[$num] .= rrd::def('del', $RRDFILE[1], $DS[39], 'AVERAGE');
$def[$num] .= rrd::def('cal', $RRDFILE[1], $DS[21], 'AVERAGE');
$def[$num] .= rrd::line1('sel',"$orange", rrd::cut('Select', 8));
$def[$num] .= rrd::gprint('sel', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('ins',"$blue", rrd::cut('Insert', 8));
$def[$num] .= rrd::gprint('ins', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('upd',"$red", rrd::cut('Update', 8));
$def[$num] .= rrd::gprint('upd', 'LAST', '%5.0lf\l');
$def[$num] .= rrd::line1('cal',"$yellow", rrd::cut('Call', 8));
$def[$num] .= rrd::gprint('cal', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('del',"$darkred", rrd::cut('Delete', 8));
$def[$num] .= rrd::gprint('del', 'LAST', '%5.0lf');
$def[$num] .= rrd::line1('rep',"$paleblue", rrd::cut('Replace', 8));
$def[$num] .= rrd::gprint('rep', 'LAST', '%5.0lf\l');

++$num;

$ds_name[$num] = 'Connections';
$opt[$num] = "--title \"$hostname - Connections\"";
$def[$num] = rrd::def('max_connections', $RRDFILE[1], $DS[265], 'MAX');
$def[$num] .= rrd::def('max_used', $RRDFILE[1], $DS[221], 'MAX');
$def[$num] .= rrd::def('aborted_clients', $RRDFILE[1], $DS[1], 'AVERAGE');
$def[$num] .= rrd::def('aborted_connects', $RRDFILE[1], $DS[2], 'AVERAGE');
$def[$num] .= rrd::def('threads_connected', $RRDFILE[1], $DS[260], 'AVERAGE');
$def[$num] .= rrd::def('new_connections', $RRDFILE[1], $DS[149], 'AVERAGE');
$label = rrd::cut('Max Connections',23);
$def[$num] .= rrd::area('max_connections','#C0C0C0',$label,0);
$def[$num] .= rrd::gprint('max_connections','AVERAGE',"%4.0lf \\n");
$label = rrd::cut('Max Used',23);
$def[$num] .= rrd::area('max_used','#FFD660',$label,0);
$def[$num] .= rrd::gprint('max_used','AVERAGE',"%4.0lf \\n");
$label = rrd::cut('Aborted Clients',23);
$def[$num] .= rrd::line1('aborted_clients','#FF3932',$label,0);
$def[$num] .= rrd::gprint('aborted_clients',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Aborted Connects',23);
$def[$num] .= rrd::line1('aborted_connects','#00FF00',$label,0);
$def[$num] .= rrd::gprint('aborted_connects',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Threads Connected',23);
$def[$num] .= rrd::line1('threads_connected','#FF7D00',$label,0);
$def[$num] .= rrd::gprint('threads_connected',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('New Connections',23);
$def[$num] .= rrd::line1('new_connections','#4444ff',$label,0);
$def[$num] .= rrd::gprint('new_connections',array('LAST','AVERAGE','MAX'),"%4.0lf");

++$num;

$ds_name[$num] = 'Command Counters';
$opt[$num] = "--title \"$hostname - Command Counters\"";
$def[$num] = rrd::def('questions', $RRDFILE[1], $DS[240], 'AVERAGE');
$def[$num] .= rrd::def('select', $RRDFILE[1], $DS[86], 'AVERAGE');
$def[$num] .= rrd::def('delete', $RRDFILE[1], $DS[39], 'AVERAGE');
$def[$num] .= rrd::def('insert', $RRDFILE[1], $DS[60], 'AVERAGE');
$def[$num] .= rrd::def('update', $RRDFILE[1], $DS[141], 'AVERAGE');
$def[$num] .= rrd::def('replace', $RRDFILE[1], $DS[77], 'AVERAGE');
$def[$num] .= rrd::def('load', $RRDFILE[1], $DS[64], 'AVERAGE');
$def[$num] .= rrd::def('delete_multi', $RRDFILE[1], $DS[40], 'AVERAGE');
$def[$num] .= rrd::def('insert_select', $RRDFILE[1], $DS[61], 'AVERAGE');
$def[$num] .= rrd::def('update_multi', $RRDFILE[1], $DS[142], 'AVERAGE');
$def[$num] .= rrd::def('replace_select', $RRDFILE[1], $DS[78], 'AVERAGE');
$def[$num] .= rrd::area('questions','#FFC3C0',rrd::cut('Questions'),23);
$def[$num] .= rrd::gprint('questions',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('select','#FF0000',rrd::cut('Select'),23,1);
$def[$num] .= rrd::gprint('select',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('delete','#FF7D00',rrd::cut('Delete'),23,1);
$def[$num] .= rrd::gprint('delete',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('insert','#FFF200',rrd::cut('Insert'),23,1);
$def[$num] .= rrd::gprint('insert',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('update','#00CF00',rrd::cut('Update'),23,1);
$def[$num] .= rrd::gprint('update',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('replace','#2175D9',rrd::cut('Replace'),23,1);
$def[$num] .= rrd::gprint('replace',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('load','#55009D',rrd::cut('Load'),23,1);
$def[$num] .= rrd::gprint('load',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('delete_multi','#942D0C',rrd::cut('Delete Multi'),23,1);
$def[$num] .= rrd::gprint('delete_multi',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('insert_select','#AAABA1',rrd::cut('Insert Select'),23,1);
$def[$num] .= rrd::gprint('insert_select',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('update_multi','#D8ACE0',rrd::cut('Update Multi'),23,1);
$def[$num] .= rrd::gprint('update_multi',array('LAST','AVERAGE','MAX'),"%4.0lf");
$def[$num] .= rrd::area('replace_select','#00B99B',rrd::cut('Replace Select'),23,1);
$def[$num] .= rrd::gprint('replace_select',array('LAST','AVERAGE','MAX'),"%4.0lf");

++$num;


$ds_name[$num] = 'Files and Tables';
$opt[$num] = "--title \"$hostname - Files and Tables\"";
$def[$num] = rrd::def('table_open_cache', $RRDFILE[1], $DS[267], 'AVERAGE');
$def[$num] .= rrd::def('open_tables', $RRDFILE[1], $DS[226], 'AVERAGE');
$def[$num] .= rrd::def('opened_files', $RRDFILE[1], $DS[227], 'AVERAGE');
$def[$num] .= rrd::def('opened_tables', $RRDFILE[1], $DS[229], 'AVERAGE');
$label = rrd::cut('Table Cache',25);
$def[$num] .= rrd::area('table_open_cache','#96E78A',$label,0);
$def[$num] .= rrd::gprint('table_open_cache',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Open Tables',25);
$def[$num] .= rrd::line1('open_tables','#9FA4EE',$label,0);
$def[$num] .= rrd::gprint('open_tables',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Open Files',25);
$def[$num] .= rrd::line1('opened_files','#FFD660',$label,0);
$def[$num] .= rrd::gprint('opened_files',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Opened Tables',25);
$def[$num] .= rrd::line1('opened_tables','#FF0000',$label,0);
$def[$num] .= rrd::gprint('opened_tables',array('LAST','AVERAGE','MAX'),"%4.0lf");

++$num;

$ds_name[$num] = 'MySQL Handlers';
$opt[$num] = "--title \"$hostname - MySQL Handlers\"";
$def[$num] = rrd::def('handler_write', $RRDFILE[1], $DS[171], 'AVERAGE');
$def[$num] .= rrd::def('handler_update', $RRDFILE[1], $DS[170], 'AVERAGE');
$def[$num] .= rrd::def('handler_delete', $RRDFILE[1], $DS[158], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_first', $RRDFILE[1], $DS[161], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_key', $RRDFILE[1], $DS[162], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_next', $RRDFILE[1], $DS[163], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_prev', $RRDFILE[1], $DS[164], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_rnd', $RRDFILE[1], $DS[165], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_rnd_next', $RRDFILE[1], $DS[166], 'AVERAGE');
$label = rrd::cut('Handler Write',25);
$def[$num] .= rrd::area('handler_write','#605C59',$label,1);
$def[$num] .= rrd::gprint('handler_write',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Update',25);
$def[$num] .= rrd::area('handler_update','#D2AE84',$label,1);
$def[$num] .= rrd::gprint('handler_update',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Delete',25);
$def[$num] .= rrd::area('handler_delete','#C9C5C0',$label,1);
$def[$num] .= rrd::gprint('handler_delete',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read First',25);
$def[$num] .= rrd::area('handler_read_first','#9F3E81',$label,1);
$def[$num] .= rrd::gprint('handler_read_first',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Key',25);
$def[$num] .= rrd::area('handler_read_key','#C6BE91',$label,1);
$def[$num] .= rrd::gprint('handler_read_key',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Next',25);
$def[$num] .= rrd::area('handler_read_next','#CE3F53',$label,1);
$def[$num] .= rrd::gprint('handler_read_next',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Prev',25);
$def[$num] .= rrd::area('handler_read_prev','#FD7F00',$label,1);
$def[$num] .= rrd::gprint('handler_read_prev',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Rnd',25);
$def[$num] .= rrd::area('handler_read_rnd','#6E4E40',$label,1);
$def[$num] .= rrd::gprint('handler_read_rnd',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Handler Read Rnd Next',25);
$def[$num] .= rrd::area('handler_read_rnd_next','#79DAEC',$label,1);
$def[$num] .= rrd::gprint('handler_read_rnd_next',array('LAST','AVERAGE','MAX'),"%6.0lf");

++$num;

$ds_name[$num] = 'MySQL Query Cache';
$opt[$num] = "--title \"$hostname - MySQL Query Cache\"";
$def[$num] = rrd::def('qcache_queries_in_cache', $RRDFILE[1], $DS[237], 'AVERAGE');
$def[$num] .= rrd::def('qcache_hits', $RRDFILE[1], $DS[233], 'AVERAGE');
$def[$num] .= rrd::def('qcache_inserts', $RRDFILE[1], $DS[234], 'AVERAGE');
$def[$num] .= rrd::def('qcache_not_cached', $RRDFILE[1], $DS[236], 'AVERAGE');
$def[$num] .= rrd::def('qcache_lowmem_prunes', $RRDFILE[1], $DS[235], 'AVERAGE');
$label = rrd::cut('Queries In Cache',25);
$def[$num] .= rrd::line1('qcache_queries_in_cache','#4444FF',$label,0);
$def[$num] .= rrd::gprint('qcache_queries_in_cache',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Cache Hits',25);
$def[$num] .= rrd::line1('qcache_hits','#EAAF00',$label,0);
$def[$num] .= rrd::gprint('qcache_hits',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Inserts',25);
$def[$num] .= rrd::line1('qcache_inserts','#157419',$label,0);
$def[$num] .= rrd::gprint('qcache_inserts',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Not Cached',25);
$def[$num] .= rrd::line1('qcache_not_cached','#00A0C1',$label,0);
$def[$num] .= rrd::gprint('qcache_not_cached',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Low-Memory Prunes',25);
$def[$num] .= rrd::line1('qcache_lowmem_prunes','#FF0000',$label,0);
$def[$num] .= rrd::gprint('qcache_lowmem_prunes',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Prepared Statements';
$opt[$num] = "--title \"$hostname - Prepared Statements\"";
$def[$num] = rrd::def('prepared_stmt_count', $RRDFILE[1], $DS[230], 'AVERAGE');
$label = rrd::cut('Prepared Statement Count',25);
$def[$num] .= rrd::line1('prepared_stmt_count','#4444FF',$label,0);
$def[$num] .= rrd::gprint('prepared_stmt_count',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Select Types';
$opt[$num] = "--title \"$hostname - Select Types\"";
$def[$num] = rrd::def('select_full_join', $RRDFILE[1], $DS[241], 'AVERAGE');
$def[$num] .= rrd::def('select_full_range_join', $RRDFILE[1], $DS[242], 'AVERAGE');
$def[$num] .= rrd::def('select_range', $RRDFILE[1], $DS[243], 'AVERAGE');
$def[$num] .= rrd::def('select_range_check', $RRDFILE[1], $DS[244], 'AVERAGE');
$def[$num] .= rrd::def('select_scan', $RRDFILE[1], $DS[245], 'AVERAGE');
$label = rrd::cut('Full Join',25);
$def[$num] .= rrd::area('select_full_join','#FF0000',$label,1);
$def[$num] .= rrd::gprint('select_full_join',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Full Range',25);
$def[$num] .= rrd::area('select_full_range_join','#FF7D00',$label,1);
$def[$num] .= rrd::gprint('select_full_range_join',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Range',25);
$def[$num] .= rrd::area('select_range','#FFF200',$label,1);
$def[$num] .= rrd::gprint('select_range',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Range Check',25);
$def[$num] .= rrd::area('select_range_check','#00CF00',$label,1);
$def[$num] .= rrd::gprint('select_range_check',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Scan',25);
$def[$num] .= rrd::area('select_scan','#7CB3F1',$label,1);
$def[$num] .= rrd::gprint('select_scan',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Sorts';
$opt[$num] = "--title \"$hostname - Sorts\"";
$def[$num] = rrd::def('sort_rows', $RRDFILE[1], $DS[252], 'AVERAGE');
$def[$num] .= rrd::def('sort_range', $RRDFILE[1], $DS[251], 'AVERAGE');
$def[$num] .= rrd::def('sort_merge_passes', $RRDFILE[1], $DS[250], 'AVERAGE');
$def[$num] .= rrd::def('sort_scan', $RRDFILE[1], $DS[253], 'AVERAGE');
$label = rrd::cut('Rows Sorted',25);
$def[$num] .= rrd::area('sort_rows','#FFAB00',$label,0);
$def[$num] .= rrd::gprint('sort_rows',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Range',25);
$def[$num] .= rrd::line1('sort_range','#157419',$label,0);
$def[$num] .= rrd::gprint('sort_range',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Merge Passes',25);
$def[$num] .= rrd::line1('sort_merge_passes','#DA4725',$label,0);
$def[$num] .= rrd::gprint('sort_merge_passes',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Scan',25);
$def[$num] .= rrd::line1('sort_scan','#4444FF',$label,0);
$def[$num] .= rrd::gprint('sort_scan',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Table Locks';
$opt[$num] = "--title \"$hostname - Table Locks\"";
$def[$num] = rrd::def('table_locks_immediate', $RRDFILE[1], $DS[254], 'AVERAGE');
$def[$num] .= rrd::def('table_locks_waited', $RRDFILE[1], $DS[255], 'AVERAGE');
$label = rrd::cut('Table Locks Immediate',25);
$def[$num] .= rrd::line1('table_locks_immediate','#002A8F',$label,0);
$def[$num] .= rrd::gprint('table_locks_immediate',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Table Locks Waited',25);
$def[$num] .= rrd::line1('table_locks_waited','#FF3932',$label,0);
$def[$num] .= rrd::gprint('table_locks_waited',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Temporary Objects';
$opt[$num] = "--title \"$hostname - Temporary Objects\"";
$def[$num] = rrd::def('created_tmp_tables', $RRDFILE[1], $DS[152], 'AVERAGE');
$def[$num] .= rrd::def('created_tmp_disk_tables', $RRDFILE[1], $DS[150], 'AVERAGE');
$def[$num] .= rrd::def('created_tmp_files', $RRDFILE[1], $DS[151], 'AVERAGE');
$label = rrd::cut('Temp Tables',25);
$def[$num] .= rrd::area('created_tmp_tables','#837C04',$label,0);
$def[$num] .= rrd::gprint('created_tmp_tables',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Temp Disk Tables',25);
$def[$num] .= rrd::line1('created_tmp_disk_tables','#F51D30',$label,0);
$def[$num] .= rrd::gprint('created_tmp_disk_tables',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Temp Files',25);
$def[$num] .= rrd::line1('created_tmp_files','#157419',$label,0);
$def[$num] .= rrd::gprint('created_tmp_files',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Transaction Handler';
$opt[$num] = "--title \"$hostname - Transaction Handler\"";
$def[$num] = rrd::def('handler_commit', $RRDFILE[1], $DS[157], 'AVERAGE');
$def[$num] .= rrd::def('handler_rollback', $RRDFILE[1], $DS[167], 'AVERAGE');
$def[$num] .= rrd::def('handler_savepoint', $RRDFILE[1], $DS[168], 'AVERAGE');
$def[$num] .= rrd::def('handler_savepoint_rollback', $RRDFILE[1], $DS[169], 'AVERAGE');
$label = rrd::cut('Handler Commit',26);
$def[$num] .= rrd::line1('handler_commit','#DE0056',$label,0);
$def[$num] .= rrd::gprint('handler_commit',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Handler Rollback',26);
$def[$num] .= rrd::line1('handler_rollback','#784890',$label,0);
$def[$num] .= rrd::gprint('handler_rollback',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Handler Savepoint',26);
$def[$num] .= rrd::line1('handler_savepoint','#D1642E',$label,0);
$def[$num] .= rrd::gprint('handler_savepoint',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Handler Savepoint Rollback',26);
$def[$num] .= rrd::line1('handler_savepoint_rollback','#487860',$label,0);

$def[$num] .= rrd::gprint('handler_savepoint_rollback',array('LAST','AVERAGE','MAX'),"%5.0lf");
?>
