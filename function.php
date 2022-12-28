<?php

//	Função para substituir paginação padrão por páginação numérica
	function custom_page_navigation() {
		if( is_singular() )
			return;
	 
		global $wp_query;
	 
		//	para execução se tiver apenas 1 página
		if( $wp_query->max_num_pages <= 1 ){
			return;
		}			
	 
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $wp_query->max_num_pages );
	 
		//	adiciona página atual ao array
		if ( $paged >= 1 )
			$links[] = $paged;
	 
		//	adiciona as páginas próximas a´página atual ao array
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}
	 
		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}
	 
		echo '<div class="custom-page-navigation"><ul>' . "\n";
	 
		//	link do post anterior
		if ( get_previous_posts_link() ){
			printf( '<li class="previous-page">%s</li>' . "\n", get_previous_posts_link('<img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0yMCAuNzU1bC0xNC4zNzQgMTEuMjQ1IDE0LjM3NCAxMS4yMTktLjYxOS43ODEtMTUuMzgxLTEyIDE1LjM5MS0xMiAuNjA5Ljc1NXoiLz48L3N2Zz4=">') );
		}			
	 
		/** link para a primeira página mais ellipses se necessário */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';
	 
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
	 
			if ( ! in_array( 2, $links ) ){
				echo '<li>…</li>';
			}
		}
	 
		//	link para a página atual mais 2 páginas em ambas as direções necessário
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}
	 
		//	link para a última página mais ellipses se necessário
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) ){
				echo '<li>…</li>' . "\n";
			}
	 
			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}
	 
		/** link do post posterior */
		if ( get_next_posts_link() ){
			printf( '<li class="next-page">%s</li>' . "\n", get_next_posts_link('<img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik00IC43NTVsMTQuMzc0IDExLjI0NS0xNC4zNzQgMTEuMjE5LjYxOS43ODEgMTUuMzgxLTEyLTE1LjM5MS0xMi0uNjA5Ljc1NXoiLz48L3N2Zz4=">') );
		}
	 
		echo '</ul></div>' . "\n";
	}

?>