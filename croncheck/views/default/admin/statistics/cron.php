<?php

$hooks = elgg_get_config('hooks');
$cronhooks = $hooks["cron"];
$intervals = array(
	"minute" => 60,
	"fiveminute" => 300,
	"fifteenmin" => 900,
	"halfhour" => 1800,
	"hourly" => 3600,
	"daily" => 86400,
	"weekly" => 604800,
	"monthly" => 2419200, // 4 * week
	"yearly" => 32054400 // 53 * week
);

?>

<div>
<h3><?php echo elgg_echo("croncheck:info"); ?></h3>
	<table class="elgg-table-alt">
		<tr>
			<th><?php echo elgg_echo("croncheck:interval"); ?></th>
			<th><?php echo elgg_echo("croncheck:timestamp"); ?></th>
			<th><?php echo elgg_echo("croncheck:friendly_time"); ?></th>
		</tr>
		<?php
			foreach($intervals as $interval => $seconds) {
				$interval_ts = elgg_get_plugin_setting("latest_" . $interval . "_ts", "croncheck");
		?>

		<tr>
			<td>
				'<?php echo $interval; ?>'
			</td>
			<td>
				<?php
					if($interval_ts) {
						echo $interval_ts;
					}
				?>
			</td>
			<td>
				<?php
					if($interval_ts) {
						echo elgg_view_friendly_time($interval_ts) . " @ " . date("r", $interval_ts);
					} else {
						echo elgg_echo("croncheck:no_run");
					}
				?>
			</td>
		</tr>
		<?php
			}
		?>
	</table>

<br>

<h3><?php echo elgg_echo("croncheck:registered")?></h3>
	<table class="elgg-table-alt">
		<tr>
			<th><?php echo elgg_echo("croncheck:interval"); ?></th>
			<th><?php echo elgg_echo("croncheck:events"); ?></th>
		</tr>
		<?php
			foreach($intervals as $interval => $seconds) {
		?>
			<tr>
				<td>'<?php echo $interval; ?>'</td>
				<td>&nbsp</td>
			</tr>
			<?php
				if(array_key_exists($interval, $cronhooks) && count($cronhooks[$interval]) > 1) {
					foreach($cronhooks[$interval] as $cron) {
						if($cron != "croncheck_monitor") {
			?>
							<tr>
								<td>&nbsp</td>
								<td><?php echo $cron;?></td>
							</tr>
			<?php
						}
					}
				} else {
			?>
						<tr>
							<td>&nbsp</td>
							<td><?php echo elgg_echo("croncheck:none_registered");?></td>
						</tr>
			<?php
				}
			?>
		<?php
			}
		?>
	</table>
</div>