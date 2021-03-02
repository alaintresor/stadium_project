<?php
function pr($arr)
{
	echo '<pre>';
	print_r($arr);
}

function prx($arr)
{
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con, $str)
{
	if ($str != '') {
		$str = trim($str);
		return mysqli_real_escape_string($con, $str);
	}
}
function isAdmin()
{
	if (!isset($_SESSION['ADMIN_LOGIN'])) {
?>
		<script>
			window.location.href = 'login.php';
		</script>
	<?php
	}
	if ($_SESSION['ADMIN_ROLE'] == 1) {
	?>
		<script>
			window.location.href = 'logout.php';
		</script>
	<?php
	}
}

function isManger()
{
	if (!isset($_SESSION['ADMIN_LOGIN'])) {
	?>
		<script>
			window.location.href = 'login.php';
		</script>
	<?php
	}
	if ($_SESSION['ADMIN_ROLE'] == 0) {
	?>
		<script>
			window.location.href = 'logout.php';
		</script>
<?php
	}
}
function isStadiumAgent()
{
	if (!isset($_SESSION['ADMIN_LOGIN'])) {
	?>
		<script>
			window.location.href = 'login.php';
		</script>
	<?php
	}
	if ($_SESSION['ADMIN_ROLE'] == 2) {
	?>
		<script>
			window.location.href = 'logout.php';
		</script>
<?php
	}
}
?>