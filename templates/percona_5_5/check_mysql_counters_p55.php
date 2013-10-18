<?php
/*
check_mysql_counters.php version 1.5

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
$def[$num] = rrd::def('sel', $RRDFILE[1], $DS[85], 'AVERAGE');
$def[$num] .= rrd::def('ins', $RRDFILE[1], $DS[61], 'AVERAGE');
$def[$num] .= rrd::def('upd', $RRDFILE[1], $DS[147], 'AVERAGE');
$def[$num] .= rrd::def('rep', $RRDFILE[1], $DS[76], 'AVERAGE');
$def[$num] .= rrd::def('del', $RRDFILE[1], $DS[40], 'AVERAGE');
$def[$num] .= rrd::def('cal', $RRDFILE[1], $DS[22], 'AVERAGE');
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
$def[$num] = rrd::def('max_connections', $RRDFILE[1], $DS[342], 'MAX');
$def[$num] .= rrd::def('max_used', $RRDFILE[1], $DS[280], 'MAX');
$def[$num] .= rrd::def('aborted_clients', $RRDFILE[1], $DS[1], 'AVERAGE');
$def[$num] .= rrd::def('aborted_connects', $RRDFILE[1], $DS[2], 'AVERAGE');
$def[$num] .= rrd::def('threads_running', $RRDFILE[1], $DS[337], 'AVERAGE');
$def[$num] .= rrd::def('threads_connected', $RRDFILE[1], $DS[335], 'AVERAGE');
$def[$num] .= rrd::def('new_connections', $RRDFILE[1], $DS[155], 'AVERAGE');
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
$label = rrd::cut('Threads Running',23);
$def[$num] .= rrd::line1('threads_running','#942D0C',$label,0);
$def[$num] .= rrd::gprint('threads_running',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('Threads Connected',23);
$def[$num] .= rrd::line1('threads_connected','#FF7D00',$label,0);
$def[$num] .= rrd::gprint('threads_connected',array('LAST','AVERAGE','MAX'),"%4.0lf");
$label = rrd::cut('New Connections',23);
$def[$num] .= rrd::line1('new_connections','#4444ff',$label,0);
$def[$num] .= rrd::gprint('new_connections',array('LAST','AVERAGE','MAX'),"%4.0lf");

++$num;

$ds_name[$num] = 'Command Counters';
$opt[$num] = "--title \"$hostname - Command Counters\"";
$def[$num] = rrd::def('questions', $RRDFILE[1], $DS[313], 'AVERAGE');
$def[$num] .= rrd::def('select', $RRDFILE[1], $DS[85], 'AVERAGE');
$def[$num] .= rrd::def('delete', $RRDFILE[1], $DS[40], 'AVERAGE');
$def[$num] .= rrd::def('insert', $RRDFILE[1], $DS[61], 'AVERAGE');
$def[$num] .= rrd::def('update', $RRDFILE[1], $DS[147], 'AVERAGE');
$def[$num] .= rrd::def('replace', $RRDFILE[1], $DS[76], 'AVERAGE');
$def[$num] .= rrd::def('load', $RRDFILE[1], $DS[65], 'AVERAGE');
$def[$num] .= rrd::def('delete_multi', $RRDFILE[1], $DS[41], 'AVERAGE');
$def[$num] .= rrd::def('insert_select', $RRDFILE[1], $DS[62], 'AVERAGE');
$def[$num] .= rrd::def('update_multi', $RRDFILE[1], $DS[148], 'AVERAGE');
$def[$num] .= rrd::def('replace_select', $RRDFILE[1], $DS[77], 'AVERAGE');
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
$def[$num] = rrd::def('table_open_cache', $RRDFILE[1], $DS[344], 'AVERAGE');
$def[$num] .= rrd::def('open_tables', $RRDFILE[1], $DS[285], 'AVERAGE');
$def[$num] .= rrd::def('opened_files', $RRDFILE[1], $DS[286], 'AVERAGE');
$def[$num] .= rrd::def('opened_tables', $RRDFILE[1], $DS[288], 'AVERAGE');
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
$def[$num] = rrd::def('handler_write', $RRDFILE[1], $DS[178], 'AVERAGE');
$def[$num] .= rrd::def('handler_update', $RRDFILE[1], $DS[177], 'AVERAGE');
$def[$num] .= rrd::def('handler_delete', $RRDFILE[1], $DS[164], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_first', $RRDFILE[1], $DS[167], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_key', $RRDFILE[1], $DS[168], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_next', $RRDFILE[1], $DS[170], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_prev', $RRDFILE[1], $DS[171], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_rnd', $RRDFILE[1], $DS[172], 'AVERAGE');
$def[$num] .= rrd::def('handler_read_rnd_next', $RRDFILE[1], $DS[173], 'AVERAGE');
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
$def[$num] = rrd::def('qcache_queries_in_cache', $RRDFILE[1], $DS[310], 'AVERAGE');
$def[$num] .= rrd::def('qcache_hits', $RRDFILE[1], $DS[306], 'AVERAGE');
$def[$num] .= rrd::def('qcache_inserts', $RRDFILE[1], $DS[307], 'AVERAGE');
$def[$num] .= rrd::def('qcache_not_cached', $RRDFILE[1], $DS[309], 'AVERAGE');
$def[$num] .= rrd::def('qcache_lowmem_prunes', $RRDFILE[1], $DS[308], 'AVERAGE');
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
$def[$num] = rrd::def('prepared_stmt_count', $RRDFILE[1], $DS[303], 'AVERAGE');
$label = rrd::cut('Prepared Statement Count',25);
$def[$num] .= rrd::line1('prepared_stmt_count','#4444FF',$label,0);
$def[$num] .= rrd::gprint('prepared_stmt_count',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Select Types';
$opt[$num] = "--title \"$hostname - Select Types\"";
$def[$num] = rrd::def('select_full_join', $RRDFILE[1], $DS[314], 'AVERAGE');
$def[$num] .= rrd::def('select_full_range_join', $RRDFILE[1], $DS[315], 'AVERAGE');
$def[$num] .= rrd::def('select_range', $RRDFILE[1], $DS[316], 'AVERAGE');
$def[$num] .= rrd::def('select_range_check', $RRDFILE[1], $DS[317], 'AVERAGE');
$def[$num] .= rrd::def('select_scan', $RRDFILE[1], $DS[318], 'AVERAGE');
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
$def[$num] = rrd::def('sort_rows', $RRDFILE[1], $DS[327], 'AVERAGE');
$def[$num] .= rrd::def('sort_range', $RRDFILE[1], $DS[326], 'AVERAGE');
$def[$num] .= rrd::def('sort_merge_passes', $RRDFILE[1], $DS[325], 'AVERAGE');
$def[$num] .= rrd::def('sort_scan', $RRDFILE[1], $DS[328], 'AVERAGE');
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
$def[$num] = rrd::def('table_locks_immediate', $RRDFILE[1], $DS[329], 'AVERAGE');
$def[$num] .= rrd::def('table_locks_waited', $RRDFILE[1], $DS[330], 'AVERAGE');
$label = rrd::cut('Table Locks Immediate',25);
$def[$num] .= rrd::line1('table_locks_immediate','#002A8F',$label,0);
$def[$num] .= rrd::gprint('table_locks_immediate',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Table Locks Waited',25);
$def[$num] .= rrd::line1('table_locks_waited','#FF3932',$label,0);
$def[$num] .= rrd::gprint('table_locks_waited',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'Temporary Objects';
$opt[$num] = "--title \"$hostname - Temporary Objects\"";
$def[$num] = rrd::def('created_tmp_tables', $RRDFILE[1], $DS[158], 'AVERAGE');
$def[$num] .= rrd::def('created_tmp_disk_tables', $RRDFILE[1], $DS[156], 'AVERAGE');
$def[$num] .= rrd::def('created_tmp_files', $RRDFILE[1], $DS[157], 'AVERAGE');
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
$def[$num] = rrd::def('handler_commit', $RRDFILE[1], $DS[163], 'AVERAGE');
$def[$num] .= rrd::def('handler_rollback', $RRDFILE[1], $DS[174], 'AVERAGE');
$def[$num] .= rrd::def('handler_savepoint', $RRDFILE[1], $DS[175], 'AVERAGE');
$def[$num] .= rrd::def('handler_savepoint_rollback', $RRDFILE[1], $DS[176], 'AVERAGE');
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

++$num;

$ds_name[$num] = 'InnoDB Adaptive Hash Index';
$opt[$num] = "--title \"$hostname - InnoDB Adaptive Hash Index\"";
$def[$num] = rrd::def('innodb_adaptive_hash_cells', $RRDFILE[1], $DS[179], 'AVERAGE');
$def[$num] .= rrd::def('innodb_adaptive_hash_heap_buffers', $RRDFILE[1], $DS[180], 'AVERAGE');
$label = rrd::cut('Hash Index Cells Total',25);
$def[$num] .= rrd::area('innodb_adaptive_hash_cells','#0C4E5D',$label,0);
$def[$num] .= rrd::gprint('innodb_adaptive_hash_cells',array('LAST','AVERAGE','MAX'),"%.1lf%S");
$label = rrd::cut('Hash Index Cells Used',25);
$def[$num] .= rrd::area('innodb_adaptive_hash_heap_buffers','#D9C7A3',$label,0);
$def[$num] .= rrd::gprint('innodb_adaptive_hash_heap_buffers',array('LAST','AVERAGE','MAX'),"%.1lf%S");

++$num;

$ds_name[$num] = 'InnoDB Buffer Pool';
$opt[$num] = "--title \"$hostname - InnoDB Buffer Pool\"";
$def[$num] = rrd::def('innodb_buffer_pool_pages_total', $RRDFILE[1], $DS[193], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_pages_data', $RRDFILE[1], $DS[184], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_pages_free', $RRDFILE[1], $DS[188], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_pages_dirty', $RRDFILE[1], $DS[185], 'AVERAGE');
$label = rrd::cut('Pool Size',25);
$def[$num] .= rrd::area('innodb_buffer_pool_pages_total','#3D1500',$label,0);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_total',array('LAST'),"%.1lf%S");
$label = rrd::cut('Database Pages',25);
$def[$num] .= rrd::area('innodb_buffer_pool_pages_data','#EDAA41',$label,0);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_data',array('LAST','AVERAGE','MAX'),"%.1lf%S");
$label = rrd::cut('Free Pages',25);
$def[$num] .= rrd::area('innodb_buffer_pool_pages_free','#AA3B27',$label,1);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_free',array('LAST','AVERAGE','MAX'),"%.1lf%S");
$label = rrd::cut('Modified Pages',25);
$def[$num] .= rrd::line1('innodb_buffer_pool_pages_dirty','#13343B',$label,0);
$def[$num] .= rrd::gprint('innodb_buffer_pool_pages_dirty',array('LAST','AVERAGE','MAX'),"%.1lf%S");

++$num;

$ds_name[$num] = 'InnoDB Buffer Pool Activity';
$opt[$num] = "--title \"$hostname - InnoDB Buffer Pool Activity\"";
$def[$num] = rrd::def('innodb_pages_created', $RRDFILE[1], $DS[250], 'AVERAGE');
$def[$num] .= rrd::def('innodb_pages_read', $RRDFILE[1], $DS[251], 'AVERAGE');
$def[$num] .= rrd::def('innodb_pages_written', $RRDFILE[1], $DS[252], 'AVERAGE');
$label = rrd::cut('Pages Created',25);
$def[$num] .= rrd::line1('innodb_pages_created','#D6883A',$label);
$def[$num] .= rrd::gprint('innodb_pages_created',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Pages Read',25);
$def[$num] .= rrd::line1('innodb_pages_read','#E6D883',$label);
$def[$num] .= rrd::gprint('innodb_pages_read',array('LAST','AVERAGE','MAX'),"%5.0lf");
$label = rrd::cut('Pages Written',25);
$def[$num] .= rrd::line1('innodb_pages_written','#55AD84',$label);
$def[$num] .= rrd::gprint('innodb_pages_written',array('LAST','AVERAGE','MAX'),"%5.0lf");

++$num;

$ds_name[$num] = 'InnoDB Buffer Pool Efficiency';
$opt[$num] = "--title \"$hostname - InnoDB Buffer Pool Efficiency\"";
$def[$num] = rrd::def('innodb_buffer_pool_read_requests', $RRDFILE[1], $DS[197], 'AVERAGE');
$def[$num] .= rrd::def('innodb_buffer_pool_reads', $RRDFILE[1], $DS[198], 'AVERAGE');
$label = rrd::cut('Pool Read Requests',20);
$def[$num] .= rrd::line1('innodb_buffer_pool_read_requests','#6EA100',$label);
$def[$num] .= rrd::gprint('innodb_buffer_pool_read_requests',array('LAST','AVERAGE','MAX'),"%6.0lf");
$label = rrd::cut('Pool Reads',20);
$def[$num] .= rrd::line1('innodb_buffer_pool_reads','#AA3B27',$label);
$def[$num] .= rrd::gprint('innodb_buffer_pool_reads',array('LAST','AVERAGE','MAX'),"%6.0lf");

++$num;

$ds_name[$num] = 'InnoDB Checkpoint Age';
$opt[$num] = "--title \"$hostname - InnoDB Checkpoint Age\"";
$def[$num] = rrd::def('innodb_lsn_current', $RRDFILE[1], $DS[230], 'MAX');
$def[$num] .= rrd::def('innodb_lsn_last_checkpoint', $RRDFILE[1], $DS[232], 'MAX');
$def[$num] .= rrd::cdef('innodb_checkpoint_age','innodb_lsn_current,innodb_lsn_last_checkpoint,-');
$label = rrd::cut('Uncheckpointed Bytes',25);
$def[$num] .= rrd::line1('innodb_checkpoint_age','#661100',$label,0);
$def[$num] .= rrd::gprint('innodb_checkpoint_age',array('LAST','AVERAGE','MAX'),"%.1lf%S");

++$num;

$ds_name[$num] = 'InnoDB Insert Buffer';
$opt[$num] = "--title \"$hostname - InnoDB Insert Buffer\"";
$def[$num] = rrd::def('innodb_ibuf_merged_inserts', $RRDFILE[1], $DS[223], 'AVERAGE');
$def[$num] .= rrd::def('innodb_ibuf_merges', $RRDFILE[1], $DS[224], 'AVERAGE');
$def[$num] .= rrd::def('innodb_ibuf_merged_delete_marks', $RRDFILE[1], $DS[221], 'AVERAGE');
$def[$num] .= rrd::def('innodb_ibuf_merged_deletes', $RRDFILE[1], $DS[222], 'AVERAGE');
$def[$num] .= rrd::cdef('innodb_merged_records','innodb_ibuf_merged_inserts,innodb_ibuf_merged_delete_marks,innodb_ibuf_merged_deletes,+,+');
$label = rrd::cut('Inserts',25);
$def[$num] .= rrd::line1('innodb_ibuf_merged_inserts','#157419',$label,0);
$def[$num] .= rrd::gprint('innodb_ibuf_merged_inserts',array('LAST','AVERAGE','MAX'),"%.2lf");
$label = rrd::cut('Merged Records',25);
$def[$num] .= rrd::line1('innodb_merged_records','#0000ff',$label,0);
$def[$num] .= rrd::gprint('innodb_merged_records',array('LAST','AVERAGE','MAX'),"%.2lf");
$label = rrd::cut('Merges',25);
$def[$num] .= rrd::line1('innodb_ibuf_merges','#862F2F',$label,0);
$def[$num] .= rrd::gprint('innodb_ibuf_merges',array('LAST','AVERAGE','MAX'),"%.2lf");

++$num;

$ds_name[$num] = 'InnoDB Insert Buffer Usage';
$opt[$num] = "--title \"$hostname - InnoDB Insert Buffer Usage\"";
$def[$num] = rrd::def('innodb_ibuf_segment_size', $RRDFILE[1], $DS[225], 'AVERAGE');
$def[$num] .= rrd::def('innodb_ibuf_size', $RRDFILE[1], $DS[226], 'AVERAGE');
$def[$num] .= rrd::def('innodb_ibuf_free_list', $RRDFILE[1], $DS[220], 'AVERAGE');
$label = rrd::cut('Ibuf Cell Count',25);
$def[$num] .= rrd::area('innodb_ibuf_segment_size','#793A57',$label,0);
$def[$num] .= rrd::gprint('innodb_ibuf_segment_size',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Ibuf Used Cells',25);
$def[$num] .= rrd::area('innodb_ibuf_size','#8C873E',$label,0);
$def[$num] .= rrd::gprint('innodb_ibuf_size',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Ibuf Free Cells',25);
$def[$num] .= rrd::area('innodb_ibuf_free_list','#A38A5F',$label,0);
$def[$num] .= rrd::gprint('innodb_ibuf_free_list',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB I/O';
$opt[$num] = "--title \"$hostname - InnoDB I/O\"";
$def[$num] = rrd::def('innodb_data_reads', $RRDFILE[1], $DS[209], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_writes', $RRDFILE[1], $DS[210], 'AVERAGE');
$def[$num] .= rrd::def('innodb_log_writes', $RRDFILE[1], $DS[229], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_fsyncs', $RRDFILE[1], $DS[204], 'AVERAGE');
$label = rrd::cut('File Reads',25);
$def[$num] .= rrd::area('innodb_data_reads','#ED7600',$label,0);
$def[$num] .= rrd::gprint('innodb_data_reads',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('File Writes',25);
$def[$num] .= rrd::area('innodb_data_writes','#157419',$label,1);
$def[$num] .= rrd::gprint('innodb_data_writes',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Log Writes',25);
$def[$num] .= rrd::area('innodb_log_writes','#DA4725',$label,1);
$def[$num] .= rrd::gprint('innodb_log_writes',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('File Syncs',25);
$def[$num] .= rrd::area('innodb_data_fsyncs','#4444FF',$label,1);
$def[$num] .= rrd::gprint('innodb_data_fsyncs',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB I/O Pending';
$opt[$num] = "--title \"$hostname - InnoDB I/O Pending\"";
$def[$num] = rrd::def('innodb_data_pending_fsyncs', $RRDFILE[1], $DS[205], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_pending_reads', $RRDFILE[1], $DS[206], 'AVERAGE');
$def[$num] .= rrd::def('innodb_data_pending_writes', $RRDFILE[1], $DS[207], 'AVERAGE');
$label = rrd::cut('AIO Sync',25);
$def[$num] .= rrd::area('innodb_data_pending_fsyncs','#FF7D00',$label,0);
$def[$num] .= rrd::gprint('innodb_data_pending_fsyncs',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Normal AIO Reads',25);
$def[$num] .= rrd::area('innodb_data_pending_reads','#B90054',$label,0);
$def[$num] .= rrd::gprint('innodb_data_pending_reads',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Normal AIO Writes',25);
$def[$num] .= rrd::area('innodb_data_pending_writes','#8F9286',$label,0);
$def[$num] .= rrd::gprint('innodb_data_pending_writes',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB Row Lock Time';
$opt[$num] = "--title \"$hostname - InnoDB Row Lock Time\"";
$def[$num] = rrd::def('innodb_row_lock_time', $RRDFILE[1], $DS[257], 'AVERAGE');
$label = rrd::cut('InnoDB Row Lock Time',25);
$def[$num] .= rrd::area('innodb_row_lock_time','#B11D03',$label,0);
$def[$num] .= rrd::gprint('innodb_row_lock_time',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB Row Lock Waits';
$opt[$num] = "--title \"$hostname - InnoDB Row Lock Waits\"";
$def[$num] = rrd::def('innodb_row_lock_waits', $RRDFILE[1], $DS[260], 'AVERAGE');
$label = rrd::cut('InnoDB Row Lock Waits',25);
$def[$num] .= rrd::area('innodb_row_lock_waits','#E84A5F',$label,0);
$def[$num] .= rrd::gprint('innodb_row_lock_waits',array('LAST','AVERAGE','MAX'),"%.1lf");

++$num;

$ds_name[$num] = 'InnoDB Row Operations';
$opt[$num] = "--title \"$hostname - InnoDB Row Operations\"";
$def[$num] = rrd::def('innodb_rows_read', $RRDFILE[1], $DS[263], 'AVERAGE');
$def[$num] .= rrd::def('innodb_rows_deleted', $RRDFILE[1], $DS[261], 'AVERAGE');
$def[$num] .= rrd::def('innodb_rows_updated', $RRDFILE[1], $DS[264], 'AVERAGE');
$def[$num] .= rrd::def('innodb_rows_inserted', $RRDFILE[1], $DS[262], 'AVERAGE');
$label = rrd::cut('Reads',10);
$def[$num] .= rrd::area('innodb_rows_read','#AFECED',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_read',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Deletes',10);
$def[$num] .= rrd::area('innodb_rows_deleted','#DA4725',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_deleted',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Updates',10);
$def[$num] .= rrd::area('innodb_rows_updated','#EA8F00',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_updated',array('LAST','AVERAGE','MAX'),"%.1lf");
$label = rrd::cut('Inserts',10);
$def[$num] .= rrd::area('innodb_rows_inserted','#35962B',$label,0);
$def[$num] .= rrd::gprint('innodb_rows_inserted',array('LAST','AVERAGE','MAX'),"%.1lf");

?>
