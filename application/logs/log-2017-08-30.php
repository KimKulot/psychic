<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-08-30 02:55:33 --> Severity: error --> Exception: Call to a member function get_latest_blog() on null /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/controllers/Blog.php 25
ERROR - 2017-08-30 13:06:42 --> Query error: Column 'request_url' cannot be null - Invalid query: INSERT INTO `inbound_messages` (`action`, `billing`, `country`, `number`, `network`, `shortcode`, `message`, `request_url`, `txtnation_msg_id`, `random`) VALUES ('mpush_ir_message', 'MT', 'UK', '447960759867', 'TMOBILE14UK', '68899', 'psychics when will i meet my lover?', NULL, '1070715715', 0)
ERROR - 2017-08-30 13:56:23 --> Query error: Unknown column 'mobile_num' in 'where clause' - Invalid query: SELECT `inbound_messages`.*
FROM `inbound_messages`
WHERE `mobile_num` = '447960759867'
ORDER BY `id` DESC
 LIMIT 1
ERROR - 2017-08-30 13:56:23 --> Severity: error --> Exception: Call to a member function result() on boolean /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Base_model.php 112
ERROR - 2017-08-30 14:07:18 --> Severity: error --> Exception: Call to undefined function debugLog() /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/controllers/Txtnation_api.php 236
ERROR - 2017-08-30 14:14:30 --> Severity: error --> Exception: Call to undefined function debugLog() /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/controllers/Txtnation_api.php 185
ERROR - 2017-08-30 14:16:42 --> Query error: Unknown column 'mobile_num' in 'where clause' - Invalid query: SELECT `inbound_messages`.*
FROM `inbound_messages`
WHERE `mobile_num` = '447960759867'
ORDER BY `id` DESC
 LIMIT 1
ERROR - 2017-08-30 14:16:42 --> Severity: error --> Exception: Call to a member function result() on boolean /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Base_model.php 112
ERROR - 2017-08-30 14:27:49 --> Severity: error --> Exception: Call to a member function db_query() on null /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Inbound_message_model.php 76
ERROR - 2017-08-30 14:32:20 --> Severity: error --> Exception: Call to undefined method Inbound_message_model::db_query() /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Inbound_message_model.php 76
ERROR - 2017-08-30 14:36:48 --> Severity: error --> Exception: Call to undefined method Inbound_message_model::db_query() /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Inbound_message_model.php 78
ERROR - 2017-08-30 14:42:45 --> Severity: error --> Exception: Call to undefined method Inbound_message_model::db_query() /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Inbound_message_model.php 78
ERROR - 2017-08-30 14:49:57 --> Severity: error --> Exception: Too few arguments to function Inbound_message_model::updateStatus(), 1 passed in /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/controllers/Txtnation_api.php on line 241 and exactly 2 expected /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Inbound_message_model.php 98
ERROR - 2017-08-30 14:53:32 --> Severity: error --> Exception: Too few arguments to function Inbound_message_model::updateStatus(), 1 passed in /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/controllers/Txtnation_api.php on line 241 and exactly 2 expected /home/apptextpsychic1002/htdoc/text-a-psychic.com/application/models/Inbound_message_model.php 99
