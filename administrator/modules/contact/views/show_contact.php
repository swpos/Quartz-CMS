<?php
	$al_id=decoding($al_fetch_contact->id);
	$al_date=decoding($al_fetch_contact->date);
	$al_time=decoding($al_fetch_contact->time);
	$al_first_name=decoding($al_fetch_contact->first_name);
	$al_last_name=decoding($al_fetch_contact->last_name);
	$al_email=decoding($al_fetch_contact->email);
	$al_phone=decoding($al_fetch_contact->phone);
	$al_postal_code=decoding($al_fetch_contact->postal_code);
	$al_city=decoding($al_fetch_contact->city);
	$al_states=decoding($al_fetch_contact->states);
	$al_country=decoding($al_fetch_contact->country);
	$al_daybirth=decoding($al_fetch_contact->daybirth);
	$al_monthbirth=decoding($al_fetch_contact->monthbirth);
	$al_yearbirth=decoding($al_fetch_contact->yearbirth);
	$al_gender=decoding($al_fetch_contact->gender);
	$al_content=decoding($al_fetch_contact->content);
	$al_shortcut=decoding($al_fetch_contact->shortcut);
	$al_shortcut=str_replace(':',', ',$al_shortcut);
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>SHOW ENTRY</h1>
<table class="table-striped">
    <tr><td width="20%">Shortcut</td><td><?php echo $al_shortcut; ?></td></tr>
    <tr><td width="20%">Date</td><td><?php echo $al_date; ?></td></tr>
    <tr><td width="20%">Time</td><td><?php echo $al_time; ?></td></tr>
    <tr><td width="20%">First name</td><td><?php echo $al_first_name; ?></td></tr>
    <tr><td width="20%">Last name</td><td><?php echo $al_last_name; ?></td></tr>
    <tr><td width="20%">Email</td><td><?php echo $al_email; ?></td></tr>
    <tr><td width="20%">Phone</td><td><?php echo $al_phone; ?></td></tr>
    <tr><td width="20%">Postal code</td><td><?php echo $al_postal_code; ?></td></tr>
    <tr><td width="20%">City</td><td><?php echo $al_city; ?></td></tr>
    <tr><td width="20%">State</td><td><?php echo $al_states; ?></td></tr>
    <tr><td width="20%">Country</td><td><?php echo $al_country; ?></td></tr>
    <tr><td width="20%">Day of birth</td><td><?php echo $al_daybirth; ?></td></tr>
    <tr><td width="20%">Month of birth</td><td><?php echo $al_monthbirth; ?></td></tr>
    <tr><td width="20%">Year of birth</td><td><?php echo $al_yearbirth; ?></td></tr>
    <tr><td width="20%">Gender</td><td><?php echo $al_gender; ?></td></tr>
    <tr><td width="20%">Description (message)</td><td><?php echo $al_content; ?></td></tr>
    <tr><td width="20%">Id</td><td><?php echo $al_id; ?></td></tr>
</table>