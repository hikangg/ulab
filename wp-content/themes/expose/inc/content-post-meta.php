<h4 class="dark font3 add-bottom-quarter">
	<span>
		<?php 
			_e('by ','expose');
			the_author();
			echo ' / ';
			the_category(' / ');
			if( comments_open() )
				comments_number( __(' / 0 Comments','expose'), __(' / 1 Comment','expose'), __(' / % Comments','expose') );	
		?>
	</span>
</h4>