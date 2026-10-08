<?php
/**
 * Image helpers: output attachments at the registered image sizes (see
 * inc/setup.php).
 *
 * WordPress generates srcset automatically from all sizes sharing the
 * original's aspect ratio.
 */

/**
 * A single image at a fixed size (port of the `image` macro).
 *
 * @param int    $id               Attachment ID.
 * @param string $size             Registered image size, e.g. 'avatar'.
 * @param string $default_alt_text Fallback alt text if the attachment has none.
 * @param string $class            Optional class attribute.
 */
function ks_image( int $id, string $size = 'large', string $default_alt_text = '', string $class = '' ): string {
	return ks_image_set( $id, $size, '', $default_alt_text, $class, false );
}

/**
 * A responsive image with srcset (port of the `imageSet` macro).
 *
 * Use `sizes` to tell the browser how much space the image takes up at
 * different media queries, e.g. "(min-width: 40rem) 50vw, 100vw".
 *
 * @param int    $id               Attachment ID.
 * @param string $size             Registered image size used for src, width and height.
 * @param string $sizes            Optional `sizes` attribute.
 * @param string $default_alt_text Fallback alt text if the attachment has none.
 * @param string $class            Optional class attribute.
 * @param bool   $srcset           Whether to output srcset. Default true.
 */
function ks_image_set( int $id, string $size = 'large', string $sizes = '', string $default_alt_text = '', string $class = '', bool $srcset = true ): string {
	if ( ! $id ) {
		return '';
	}

	$alt   = trim( (string) get_post_meta( $id, '_wp_attachment_image_alt', true ) );
	$attrs = [
		'alt'     => '' !== $alt ? $alt : $default_alt_text,
		'loading' => 'lazy',
	];

	if ( $class ) {
		$attrs['class'] = $class;
	}

	if ( ! $srcset ) {
		$attrs['srcset'] = false;
		$attrs['sizes']  = false;
	} elseif ( $sizes ) {
		$attrs['sizes'] = $sizes;
	}

	return wp_get_attachment_image( $id, $size, false, $attrs );
}

/**
 * Normalise an image value (ACF image array, WP_Post or ID) to an attachment ID.
 *
 * @param mixed $image
 */
function ks_image_id( $image ): int {
	if ( is_array( $image ) ) {
		return (int) ( $image['ID'] ?? $image['id'] ?? 0 );
	}
	if ( $image instanceof WP_Post ) {
		return $image->ID;
	}
	return (int) $image;
}
