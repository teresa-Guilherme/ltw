<div id="fundo">
	<script src="scripts/restaurant.js" type="text/javascript"></script>
	<!-- start Main Wrapper -->
	<div class="main-wrapper">
		<div class='restaurant-wrapper'>
			<div class='restaurant-content'>
				<?php
				if(isset($_GET['id'])){
					echo "<section id=rest$_GET[id] class=restaurant>";
					echo "</section>";
				}
				?>
			</div>
		</div>
		<div class='rating-container'>
					<div class="rating">
						<span><input type="radio" name="rating" id="star5" value="5"><label for="star5"><img src="images/restaurant/emptyStar.png" width="30" alt="Very Good" /></label></span>
						<span><input type="radio" name="rating" id="star4" value="4"><label for="star4"><img src="images/restaurant/emptyStar.png" width="30" alt="Good" /></label></span>
						<span><input type="radio" name="rating" id="star3" value="3"><label for="star3"><img src="images/restaurant/emptyStar.png" width="30" alt="Meh" /></label></span>
						<span><input type="radio" name="rating" id="star2" value="2"><label for="star2"><img src="images/restaurant/emptyStar.png" width="30" alt="Bad" /></label></span>
						<span><input type="radio" name="rating" id="star1" value="1"><label for="star1"><img src="images/restaurant/emptyStar.png" width="30" alt="Very Bad" /></label></span>
					</div>
				</div>
	</div>
</div>