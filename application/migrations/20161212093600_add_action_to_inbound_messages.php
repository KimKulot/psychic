<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Action_To_Inbound_Messages extends CI_Migration {

    public function up()
    {   
        $fields = [
            'action' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'after' => 'txtnation_msg_id'
            ]
        ];
        $this->dbforge->add_column('inbound_messages', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('inbound_messages', 'action');
    }
}