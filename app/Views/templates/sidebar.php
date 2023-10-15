<div class="sidebar" id="sidebar">

	<?= session()->getFlashdata('error') ?>

	<!-- Menu déroulant pour le choix des lieux -->
	<?php
	if (!empty($place) && is_array($place)) {

		if ($place[1]['type'] == "naissance") {
			echo "<p>Lieux de naissance</p>";
		}
		if ($place[1]['type'] == "publication") {
			echo "<p>Lieux de publication</p>";
		}
		if ($place[1]['type'] == "deces") {
			echo "<p>Lieux de décès</p>";
		}
		if ($place[1]['type'] == "esclavage") {
			echo "<p>Lieux d'esclavage</p>";
		}
		if ($place[1]['type'] == "lieuvie") {
			echo "<p>Lieux de vie après l'esclavage</p>";
		}
	} else {
		echo "<p>". lang('sidebar.location.search_location_type') ."</p>";
	}
	?>

	<form action="<?= base_url(); ?>/map/places" method="post">
		<?= csrf_field() ?>
		<select name="select_place" id="select">
			<option selected disabled hidden style='display: none' value=''><?= lang('sidebar.location.select_location_type')?></option>

			<option value="naissance"> <?= lang('sidebar.location.birth')?> </option>
			<option value="publication"> <?= lang('sidebar.location.publication')?>  </option>
			<option value="deces"> <?= lang('sidebar.location.death')?>  </option>
			<option value="esclavage"> <?= lang('sidebar.location.slavery')?>  </option>
			<option value="lieuvie"> <?= lang('sidebar.location.location_life')?> </option>

		</select>

		<br><br>

		<input id="cc" type="submit" value="<?= lang('sidebar.search_button')?>" />
	</form>




	<br><br><br><br><br>


	<!-- Menu déroulant pour le choix des récits -->
	<!-- reprendre ce code -->

	<?php
	if (!empty($pts) && is_array($pts)) {

		$url = site_url() . "recits/" . $pts[0]['id_recit'];
		echo "<a id= 'acc'href=", $url, "><p id='lien'>", $pts[0]['nom_esc'],
		" (", $pts[0]['date_publi'], "), (Voir la fiche récit)</p></a>";
	} else {
		echo "<p id='recit'>" . lang('sidebar.narrative.search_narrative') ."</p>";
		//var_dump($couche);
	}
	?>




	<form action="<?= base_url(); ?>/map/recits" method="post">
		<?= csrf_field() ?>
		<select name="select_recit" id="select">

			<option><?= lang('sidebar.narrative.search_narrative') ?></option>
			<?php
			$nbt = count($points);
			foreach ($points as $p) { ?>
				<option value=<?php echo $p['id_recit'] ?>>

					<?php echo $p['nom_esc'], ' (', $p['date_publi'], ')' ?> </option>

			<?php } ?>

		</select>

		<br><br>


		<input id="cc" type="submit" value="<?= lang('sidebar.search_button')?>" />

	</form>


	<br><br><br><br>
	<section class="legend2">

		<span>
			<p> <?= lang('sidebar.legend.title')?> </p>
		</span>
		<i class="naissance"></i><span><?= lang('sidebar.legend.location_birth')?></span><br>
		<i class="publi"></i><span><?= lang('sidebar.legend.location_publication_narratives')?></span><br>
		<i class="lieuvie"></i><span><?= lang('sidebar.legend.location_life')?></span><br>
		<i class="deces"></i><span><?= lang('sidebar.legend.location_death')?></span><br>
		<i class='esclavage'></i><span><?= lang('sidebar.legend.location_slavery')?></span><br>

		<i class='naiss_esc legend2_desc'></i><span><?= lang('sidebar.legend.birth_slavery')?></span><br>
		<i class='lieuvie_dec legend2_desc'></i><span><?= lang('sidebar.legend.life_death')?></span><br>
		<i class='esc_vie_dec legend2_desc'></i><span><?= lang('sidebar.legend.slavery_life_death')?></span><br>
		<i class='naiss_esc_vie_dec legend2_desc'></i><span><?= lang('sidebar.legend.birth_slavery_life_death')?></span><br>
		<br>
		<i class='usa'></i><span><?= lang('sidebar.legend.us_borders')?></span><br>
	</section>
	<script>
		function confirmLogout() {
			return confirm('<?= lang('sidebar.logout_confirmation') ?>');
		}
	</script>

	<?php $session = \Config\Services::session(); ?>


	<br>
	<a href="<?= $session->get('is_admin') ? '/deconnexion' : '/connexion' ?>">
		<button id="cc" onclick="return <?= $session->get('is_admin') ? 'confirmLogout()' : '' ?>"><?= $session->get('is_admin') ? lang('sidebar.logout_button') : lang('sidebar.login_button') ?></button>
	</a>

	<br><br>
		<?php if($session->get('is_admin')):?>
				<a href="/creercompte"><button id="cc"><?= lang('sidebar.create_account_button')?></button> </a> 
				<br>
				<a href="/ajout_point"><button id="cc"><?= lang('sidebar.add_point_button')?></button></a>
				<br>
				<a href="/ajout_recit"><button id="cc"><?= lang('sidebar.add_narrative_button')?></button></a>
				<br>
				<a href="/ajout_esclave"><button id="cc"><?= lang('sidebar.add_slave_button')?></button></a>
				<br>
				<a href="/choix_esclave"><button id="cc"><?= lang('sidebar.modify_slave_button')?></button></a>
				<br>
				<a href="/suppr_esclave"><button id="cc"><?= lang('sidebar.delete_slave_button')?></button></a>
			<?php endif ?>

</div>