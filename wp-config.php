<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */

//CODIO
define('DB_NAME', 'principal');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

//SERVIDOR XPRESS
// define('DB_NAME', 'uabcmx_principal');
// define('DB_USER', 'uabcmx_root');
// define('DB_PASSWORD', 'ElSalmo23!');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '=7_!NZN>@A79:H @yOJ.?k[vB9|6|]AcE8?O4i(]K`-B+sgT>P`uHHT9v=6k?GgQ');
define('SECURE_AUTH_KEY', 'd=vbM6-+m%F#,{+IFP ]BV8[l%|B<$=q03:-H$T|_?/*]Bcv;!t-Zy#L,Y]^PT+)');
define('LOGGED_IN_KEY', '{-5f=zn;OugJJZB,DGE@yTc}_7<b8.<L&R;<Bq=|PO^_MKQENg,rZeJWPG#?*CSO');
define('NONCE_KEY', 'O9)@<_$q|_]f@c7s Ecy5ZwI*j7zW}O49myym,cv,~60B=xph?SRC}3.DMl)Og~@');
define('AUTH_SALT', 'SB)czHjUz(RX6d}y-=E|a5GLQ>1F?sS$|>vjdX9=7b]z^JFsamNjld[^iP-+_!{N');
define('SECURE_AUTH_SALT', ':Bt);#`BiH/yP$&`V7tcu5dw<jKd[g]SX^Fqsrk17]<74oM)poGIn[tX>J_Bz(.t');
define('LOGGED_IN_SALT', 'pH,Vj*%cV674?:?4N^PX(+lW4m[DUT|2d:6ySp67&JD(h{.pWEseC$|-#i{<fFJ`');
define('NONCE_SALT', ';qf>$etX$VJG~-HCCE^!rTS4ad)[j^&CM4xk>a)tG52v:l!N>U#w|vqeC4+M1xYY');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

