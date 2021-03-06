<div class="container">

<div class="row">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All <span class="badge" id="all_messages_count"><?=$all_messages?></span> </a></li>
    	<li role="presentation"><a href="#responded" aria-controls="responded" role="tab" data-toggle="tab" >Responded
			<span class="badge" id="responded_messages_count"><?=$resolved_messages?></span>
    		</a>
    	</li>
    </ul>
	
	<!-- Tab panes -->
	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="all">
    		<br/>
    		<!-- start All Messages Datatable -->
			<table id="table-all" class="table bulletin-table" cellspacing="0" width="100%">
				<thead> 
					<tr>
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-envelope font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Message ID</b></i>
							</div>
						</th> 
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-list-alt font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Text Message</b></i>
							</div>
						</th> 
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicons-git-private font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Private</b></i>
							</div>
						</th> 
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-random font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Random</b></i>
							</div>
						</th> 
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-calendar font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Date Sent</b></i>
							</div>
						</th> 
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-dashboard font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Time</b></i>
							</div>
						</th>
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-flag font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Country Code</b></i>
							</div>
						</th> 
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-phone font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Cellphone Number</b></i>
							</div>
						</th> 
						<th>
							<div class="text-center">
								<span class="glyphicon glyphicon-list-alt font-size-50" aria-hidden="true"></span>
								<br/>
								<i><b>Shortcode</b></i>
							</div>
						</th> 
						<th>
							
						</th> 
					</tr>
				</thead> 
				<tbody> 
				</tbody> 
			</table>
			<!-- end All Messages Datatable -->
		</div>
    	<div role="tabpanel" class="tab-pane" id="responded">
			<!-- start Responded Messages Datatable -->
			<br/>
			<table id="table-responded" class="table bulletin-table" cellspacing="0" width="100%">
            <thead>
                <th>
						<div class="text-center">
							<span class="glyphicon glyphicon-envelope font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Message ID</b></i>
						</div>
					</th> 
					<th>
						<div class="text-center">
							<span class="glyphicon glyphicon-list-alt font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Text Message</b></i>
						</div>
					</th> 
					<th>
						<div class="text-center">
							<span class="glyphicon glyphicon-list-alt font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Message Reply</b></i>
						</div>
					</th> 
					<th>
						<div class="text-center">
							<span class="glyphicon glyphicon-calendar font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Date Sent</b></i>
						</div>
					</th> 
					<th>
						<div class="text-center">
							<span class="glyphicon glyphicon-dashboard font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Time</b></i>
						</div>
					</th>
					<th>
						<div class="text-center">
							<span class="glyphicon glyphicon-flag font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Country Code</b></i>
						</div>
					</th> 
					<th>
						<div class="text-center">
							<span class="glyphicon glyphicon-phone font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Cellphone Number</b></i>
						</div>
					</th> 
					
					<th>
						<div class="text-center">
							<span class="glyphicon glyphicon-list-alt font-size-50" aria-hidden="true"></span>
							<br/>
							<i><b>Shortcode</b></i>
						</div>
					</th> 
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th>Message ID</th>
                    <th>Message</th>
                    <th>Message Reply</th>
                    <th>Date Sent</th>
                    <th>Time</th>
                    <th>Country</th>
                    <th>Mobile</th>
                    <th>Short Code</th>
                </tr>
            </tfoot>
        	</table>
			<!-- end Responded Messages Datatable -->
		</div>
	</div>


	<div id="sms-answer" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><b>SMS Answer</b></h4>
				</div>
				<div class="modal-body">
					<div class="alert" role="alert">
						<span id="error"></span>
					</div>
					<input type="hidden" id="msg_id" name="msg_id" value="" />
			        <h4 class="text-center"><strong>ANSWER BOARD</strong></h4>
			        <p><strong>ID Number: <span id="message_id"></span></strong></p>
			        <p><strong>Reader: <?php echo $user['username'] ?></strong></p>
			        <p>From: <span id="number"></span></p>
					<p>Shortcode: <span id="shortcode"></span></p>
					<b>Message:</b>
					<p><span id="message"></span></p>
			        <p>Answer</p>
			        <textarea class="message" id="answer" onkeyup="countChar(this)"></textarea>
    				
			        <div>
			        	<input type="checkbox" name="allow_button" id="allow_button" checked="checked"/> 
			        	<label for="allow_button">Hit 'Enter' to send message</label>
			        	<span class="char-count" id="charNum">0/160</span>
			        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="releaseMessage()">Close</button>
		        <button type="button" class="btn btn-primary send-message" id="btn-send" onclick="sendMessage()">Submit Answer</button>
		      </div>

		    </div>
		  </div>
		</div>
	</div>

	<!-- start old modal window for send reply -->
	<div id="sms-details" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><b>SMS</b></h4>
					</div>
					<div class="modal-body">
						<h4 class="text-center"><strong>SMS DETAILS</strong></h4>
						<p><strong>ID Number: <span id="message_id"></span> </strong></p>
				        <p><strong>Reader: <span id="psychic_fname"></span> <span id="psychic_lname"></span> </strong></p>
				        <p>From: <span id="number"></span></p>
						<p>Shortcode: <span id="shortcode"></span></p>
						<b>Message:</b>
						<p><span id="message"></span></p>
				        <p>Answer</p>
				        {{ message.replied_message }}
					</div>
					<div class="modal-footer">
						<!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<b utton type="button" class="btn btn-primary send-message" ng-click="send_message(message)">Submit Query</button>-->
					</div>
		    	</div>
			</div>
		</div>
	</div>
	<!-- end old modal window for send reply -->
	<audio class="audio message_receive" type="audio/mpeg" src="public_html/assets/knock_brush.mp3"></audio>
	

	<div id="profile-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
		    <div class="modal-content">
		    	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel"><b>Update Profile Info</b></h4>
				</div>
				<div class="modal-body">
		       		<div class="alert" role="alert">
						<span id="error"></span>
					</div>
					<p>
						<span>
							<strong>Username: </strong>
						</span>
						<span>
							<input class="form-control" type="text" name="username" value="<?php echo $user['username']; ?>" readonly/>
							<input type="hidden" name="psychic_id" id="psychic_id" value="<?php echo $user['id']; ?>" readonly/>
						</span>
					</p>
					<p>
						<span>
							<strong>Firstname: </strong>
						</span>
						<span>
							<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $user['lname']; ?>" readonly/>
						</span>
					</p>
					<p>
						<span>
							<strong>Lastname: </strong>
						</span>
						<span>
							<input class="form-control" type="text" name="fname" id="fname" value="<?php echo $user['fname']; ?>" readonly/>
						</span>
					</p>
					<p>
						<span>
							<strong>Home Address: </strong>
						</span>
						<span>
							<textarea class="message form-control" id="home_address" name="home_address"><?php echo $user['home_address']; ?></textarea>
						</span>
					</p>
					<p>
						<span>
							<strong>Email Address: </strong>
						</span>
						<span>
							<input class="form-control" type="text" name="email_address" id="email_address" value="<?php echo $user['email_address']; ?>" />
						</span>
					</p>
					<p>
						<span>
							<strong>Paypal Address: </strong>
						</span>
						<span>
							<input class="form-control" type="text" name="paypal_address" id="paypal_address" value="<?php echo $user['paypal_address']; ?>" />
						</span>
					</p>
					<p>
						<span>
							<strong>Mobile No.: </strong>
						</span>
						<span>
							<input class="form-control" type="text" name="mobile_num" id="mobile_num" value="<?php echo $user['mobile_num']; ?>" />
						</span>
					</p>
					<p>
						<span>
							<strong>Home Phone: </strong>
						</span>
						<span>
							<input class="form-control" type="text" name="home_phone" id="home_phone" value="<?php echo $user['home_phone']; ?>" />
						</span>
					</p>

					
					
						
					
				</div>

				<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-primary update-profile" id="btn-send" onclick="updateProfile()">Update</button>
				</div>
		    </div>
		  </div>
		</div>
	</div>

	<div id="change-password-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel"><b>Change Password</b></h4>
				</div>
				<div class="modal-body">
					<div class="alert" role="alert">
						<span id="error"></span>
					</div>
					<p>
						<span>
							<strong>Old Password: </strong>
						</span>
						<span>
							<input class="form-control" type="password" name="password" id="password" value="" />
			                    	<input type="hidden" name="psychic_id" id="psychic_id" value="<?php echo $user['id']; ?>" readonly/>
						</span>
					</p>
					<p>
						<span>
							<strong>New Password: </strong>
						</span>
						<span>
							<input type="password" class="form-control" name="new_password" id="new_password" value="" />
						</span>
					</p>
					<p>
						<span>
							<strong>Confirm New Password: </strong>
						</span>
						<span>
							<input type="password" class="form-control" name="new_password2" id="new_password2" value="" />
						</span>
					</p>
		       		
				</div>
				<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-primary update-profile" id="btn-send" onclick="changePassword()">Update</button>
				</div>
		    </div>
		  </div>
		</div>
	</div>

	<div id="payout-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel"><b>Payout Details</b></h4>
				</div>
				<div class="modal-body">
					<div class="alert" role="alert">
						<span id="error"></span>
					</div>
					<p>
						<span>
							<strong> </strong>
						</span>
						<span>
							
						</span>
					</p>
		       		
				</div>
				<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		    </div>
		  </div>
		</div>
	</div>


</div>

<script type="text/javascript" src="public_html/assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="public_html/assets/DataTables/media/js/jquery.dataTables.min.js"></script>

<link href="/public_html/assets/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="public_html/js/script.js"></script>

<script type="text/javascript">
 
var aTable;
var rTable;
 
$(document).ready(function() {

	var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', '<?php echo base_url() ."public_html/sounds/doorbell.mp3";?>');
    
    //datatables
    rTable = $('#table-responded').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        //"serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": '<?php echo base_url() . "/inbound_messages/resolved_messages/$user_id"?>',
            "type": "GET"
        },
 
        //Set column definition initialisation properties.
        
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
		 columns: [
                {data: "id",},
                {data: "message"},
                {data: "message_reply"},
                {data: "date_sent"},
                {data: "time_sent"},
                {data: "country"},
                {data: "mobile"},
                {data: "shortcode"},
            ]
 
    }
	
);


	setInterval( function () {
	    //rTable.ajax.reload(null, false);
	    rTable.ajax.reload( 
	    	function () {
			// Get the new length 
			newLength = rTable.data().length;
			//console.log('New: '+newLength);
			document.getElementById('responded_messages_count').innerHTML = newLength;

		}, false );
	}, 5000 );
    //var refresh = setInterval('$("#table-responded").dataTable().fnDraw()', 5000);


    aTable = $('#table-all').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        //"serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": '<?php echo base_url() . "/inbound_messages/all_messages/$user_id"?>',
            "type": "GET"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        {
        	render: function ( message_id, type, row ) {
        		//alert(row);
        		var status_val;
        		
        		$.each(row, function(key,value){
                    
                    if (key == "status" ) {
                    	status_val = value;
                    }
                    if (key == "random" ) {
                    	random = value;
                    }
                });
                //alert(status_val);
                if (status_val == "0") {
        			return '<a href="#" id="btn-respond" data-target="#sms-answer" data-toggle="modal" class="btn btn-sm btn-primary pull-right m-t-n-xs" onclick="acceptMessage('+message_id+', '+random+')">Accept</a>';
        		} else {
        			return '<a href="#" id="btn-respond" data-target="#sms-answer" data-toggle="modal" class="btn btn-sm btn-danger pull-right m-t-n-xs disabled" >Accept</a>';
        		}
        	},
        	"targets": -1,
        	//"visible": false
        }
        
        ],
		 columns: [
                {data: "id",},
                {data: "message"},
                {data: "preferred_psychic_id"},
                {data: "respondents"},
                {data: "date_sent"},
                {data: "time_sent"},
                {data: "country"},
                {data: "mobile"},
                {data: "shortcode"},
                {
                    data: "action_id"
                },
                
                
            ]
    });

    setInterval( function () {
    	oldLength = aTable.data().length;
    	//console.log('Old: '+oldLength);
    	
	    aTable.ajax.reload( 
	    	function () {
			// Get the new length 
			newLength = aTable.data().length;
			//console.log('New: '+newLength);
			document.getElementById('all_messages_count').innerHTML = newLength;

			// If any changes have been made, reload page
			if(oldLength < newLength)
			{
				//console.log('CHANGED');
				audioElement.play();

				// change row color - 20170725
				var new_rows = newLength - oldLength;
				for (var i = 0; i < new_rows; i++) {
					aTable.$('tr:eq(' + i + ')').css('background-color', '#B2DFEE');
				}
			}
		}, false );
		
	}, 5000 );

    $('#sms-answer').on('hidden.bs.modal', function () {
  		releaseMessage();
	})

	$('#sms-answer').on('keypress', function (e) {
		if (e.which == 13 && $('#allow_button').is(':checked')) {
			sendMessage();
			e.preventDefault();
		}
	})

});


function acceptMessage(id, random){
	$('#answer').val('');
	$('#answer').prop('disabled', false);
	$('#btn-send').removeClass('disabled');
	$("#error").html('');
    $.ajax({
	    type: 'post',
	    url: '<?php echo base_url() . "/inbound_messages/accept_message"?>',
	    data: {message_id: id, psychic_id: <?php echo $user_id ?>},
	    dataType: 'json',
	    success: function(data){
	    	$.each(data, function(key,value){
	    		if (key == "data" && value != null) {
	    			$("#msg_id").val(value.id);
	    			$("#message_id").html(value.id);
	    			//$("#number").html(value.number);
				var number = value.number;
				var last_number = number.substring(0, number.length - 8);
				var masked = '********' + last_number;
	    			$("#number").html(masked);
	    			$("#shortcode").html(value.shortcode);
	    			$("#message").html(value.message);
	    		} else if (key == "errors" && value!="") {
	    			$("#error").html('<strong>'+value+'</strong');
	    			$("#answer").prop('disabled', true);
	    			$('#btn-send').addClass('disabled');
	    		}
			});

	    }
	});

    return false; // not always essential, but I usually return false.
}

function releaseMessage() {
	$('#charNum').text('0/160');
	var id = $("#msg_id").val();
	$('#answer').val('');
	
	$.ajax({
	    type: 'post',
	    url: '<?php echo base_url() . "/inbound_messages/decline_message"?>',
	    data: {message_id: id, psychic_id: <?php echo $user_id ?>},
	    dataType: 'json',
	    success: function(data){
	    	$.each(data, function(key,value){
	    		if (key == "data" && value != null) {
	    			$("#message_id").html(value.id);
	    			$("#number").html(value.number);
	    			$("#shortcode").html(value.shortcode);
	    			$("#message").html(value.message);
	    		} else if (key == "errors" && value!="") {
	    			$("#error").html('<strong>'+value+'</strong');
	    		}
			});

	    }
	});

	return false;
}

function countChar(val) {
        var len = val.value.length;
        if (len >= 160) {
          val.value = val.value.substring(0, 160);
        } else {
          $('#charNum').text(len + '/160');
        }
      };

function sendMessage() {
	var msg = jQuery("textarea#answer").val();
	var id = $("#msg_id").val();
	
	$.ajax({
	    type: 'post',
	    url: '<?php echo base_url() . "/txtnation/send_message"?>',
	    data: {ref_message_id: id, sender_id: <?php echo $user_id ?>, message: msg},
	    dataType: 'json',
	    success: function(data){
	    	$.each(data, function(key,value){
	    		if (key == "data" && value != null) {
	    			/*
	    			$("#message_id").html(value.id);
	    			*/
	    		} else if (key == "success" && value == true) {
	    			alert("Message Sent!")
	    			$('#sms-answer').modal('toggle'); //or  $('#IDModal').modal('hide');
    				return false;
	    		} else if (key == "errors") {
	    			$("#error").html('<strong>'+value+'</strong>');
	    		}
			});

	    }
	});
	

	return false;
}

function showProfile(id){
    $.ajax({
	    type: 'get',
	    url: '<?php echo base_url() . "/psychics/psychic"?>',
	    data: {id: id},
	    dataType: 'json',
	    success: function(data){
	    	$.each(data, function(key,value){
	    		if (key == "data" && value != null) {
	    			$("#fname").val(value.fname);
	    			$("#lname").val(value.lname);
	    			$("#home_address").val(value.home_address);
	    			$("#email_address").val(value.email_address);
	    			$("#paypal_address").val(value.paypal_address);
	    			$("#mobile_num").val(value.mobile_num);
	    			$("#home_phone").val(value.home_phone);
	    		} else if (key == "errors" && value!="") {
	    			$("#error").html('<strong>'+value+'</strong');
	    		}
			});

	    }
	});

    return false; // not always essential, but I usually return false.
}

function updateProfile() {
	
	var psychic_id = $("#psychic_id").val();
	var username = $("#username").val();
	var fname = $("#fname").val();
	var lname = $("#lname").val();
	var email_address = $("#email_address").val();
	var paypal_address = $("#paypal_address").val();
	var mobile_num = $("#mobile_num").val();
	var home_phone = $("#home_phone").val();
	var home_address = jQuery("textarea#home_address").val();

	$.ajax({
	    type: 'post',
	    url: '<?php echo base_url() . "/psychics/update_profile"?>',
	    data: {
	    	psychic_id: psychic_id, 
	    	username: username, 
	    	fname: fname, 
	    	lname: lname, 
	    	email_address: email_address, 
	    	paypal_address: paypal_address, 
	    	mobile_num: mobile_num, 
	    	home_phone: home_phone, 
	    	home_address: home_address
	    },
	    dataType: 'json',
	    success: function(data){
	    	$.each(data, function(key,value){
	    		if (key == "data" && value != null) {
	    			
	    		} else if (key == "success" && value == true) {
	    			alert("Profile Succesfully Updated")
	    			$('#profile-modal').modal('toggle'); //or  $('#IDModal').modal('hide');
    				return false;
	    		} else if (key == "errors") {
	    			$("#error").html('<strong>'+value+'</strong>');
	    		}
			});

	    }
	});

	return false;
}

function changePassword() {

	var id = $("#psychic_id").val();
	var password = $("#password").val();
	var new_password = $("#new_password").val();
	var new_password2 = $("#new_password2").val();
	// check if new password matched
	if (password == "") {
		alert("Please enter password");
		return false;
	}
	if (new_password != new_password2) {
		alert("Password doesn't match");
		return false;
	}

    $.ajax({
	    type: 'post',
	    url: '<?php echo base_url() . "/psychics/change_password"?>',
	    data: {
	    	psychic_id: id,
	    	password: password,
	    	new_password: new_password
	    },
	    dataType: 'json',
	    success: function(data){
	    	$.each(data, function(key,value){
	    		if (key == "data" && value != null) {

	    		} else if (key == "success" && value == true) {
	    			alert("Password Succesfully Updated")
	    			$('#change-password-modal').modal('toggle'); //or  $('#IDModal').modal('hide');
    				return false;
	    			
	    		} else if (key == "errors" && value!="") {
	    			$("#error").html('<strong>'+value+'</strong');
	    		}
			});

	    }
	});

    return false; // not always essential, but I usually return false.
}


</script>

</body>
</html>
