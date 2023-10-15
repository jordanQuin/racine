<div class="sidebar">
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
		echo "<p>Rechercher un type de lieu</p>";
	}
	?>





	<form action="<?= base_url(); ?>/map/places" method="post">
		<?= csrf_field() ?>
		<select name="select_place" id="select">
			<option selected disabled hidden style='display: none' value=''>Sélectionner un type de lieu</option>

			<option value="naissance"> Naissance </option>
			<option value="publication"> Publication </option>
			<option value="deces"> Décès </option>
			<option value="esclavage"> Esclavage </option>
			<option value="lieuvie"> Lieu de vie </option>

		</select>

		<br><br>

		<input id="cc" type="submit" value="Rechercher" />
	</form>




	<br><br><br><br><br>


	<!-- Menu déroulant pour le choix des récits -->


	<?php
	if (!empty($pts) && is_array($pts)) {

		$url = site_url() . "recits/" . $pts[0]['id_recit'];
		echo "<a id= 'acc'href=", $url, "><p id='lien'>", $pts[0]['nom_esc'],
		" (", $pts[0]['date_publi'], "), (Voir la fiche récit)</p></a>";
	} else {
		echo "<p id='recit'>Rechercher un récit</p>";
		//var_dump($couche);
	}
	?>




	<form action="<?= base_url(); ?>/map/recits" method="post">
		<?= csrf_field() ?>
		<select name="select_recit" id="select">

			<option>Sélectionner un récit</option>
			<?php
			$nbt = count($points);
			foreach ($points as $p) { ?>
				<option value=<?php echo $p['id_recit'] ?>>

					<?php echo $p['nom_esc'], ' (', $p['date_publi'], ')' ?> </option>

			<?php } ?>

		</select>

		<br><br>


		<input id="cc" type="submit" value="Rechercher" />

	</form>


	<br><br><br><br>
	<section class="legend2">

		<span>
			<p> Pays et villes présents dans le récit </p>
		</span>
		<i class="naissance"></i><span>Lieu de naissance</span><br>
		<i class="publi"></i><span>Lieu de publication des récits</span><br>
		<i class="lieuvie"></i><span>Lieu de vie</span><br>
		<i class="deces"></i><span>Lieu de décès</span><br>
		<i class='esclavage'></i><span>Lieu d'esclavage</span><br>

		<i class='naiss_esc legend2_desc'></i><span>Naissance esclavage</span><br>
		<i class='lieuvie_dec legend2_desc'></i><span>Vie et décès</span><br>
		<i class='esc_vie_dec legend2_desc'></i><span>Esclavage, vie et décès</span><br>
		<i class='naiss_esc_vie_dec legend2_desc'></i><span>Naissance, esclavage, vie et décès</span><br>
		<br>
		<i class='usa'></i><span>Frontières étatsuniennes</span><br>
	</section>
	<br>
	<a href="/connexion"><button>Connexion</button></a>
	<br><br>
	<br>
	<a href="/ajout_point"><button>Ajout d'un point</button></a>
	<br><br>

</div>