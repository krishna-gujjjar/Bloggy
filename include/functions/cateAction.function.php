<?php function category($cid = null)
{ ?>
	<select class="custom-select" name="postCate" id="postCate">
		<option disabled selected> Category </option>
		<?php $showCate = run("SELECT * FROM cate WHERE cstatus = '1'"); ?>
		<?php if (countData($showCate)) : ?>
			<?php foreach ($showCate as $val) : ?>
				<?php if (empty($cid)) { ?>
					<option value="<?php echo $val['cid']; ?>">
						<?php echo strtoupper($val['cname']); ?>
					</option>
						<?php 
				} elseif (!empty($cid)) { ?>
					<option value="<?php echo $val['cid']; ?>" <?php compareValue($cid, $val['cid'], 'selected') ?>>
						<?php echo strtoupper($val['cname']); ?>
					</option>
						<?php 
				} ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</select>
	<?php 
} ?>

<?php 
function compareValue($firstVal, $secondVal, $tureCondition, $falseCondition = null)
{
	if ($firstVal == $secondVal) {
		return print($tureCondition);
	} elseif (!empty($falseCondition) && $firstVal != $secondVal) {
		return print($falseCondition);
	}
}
?>