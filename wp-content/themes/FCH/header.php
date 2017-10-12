<?php
/*
 * Encabezado del tema
 *
 * Muestra todas las inclusiones del documento hasta llegar al contenedor principal
 *
 * @package WordPress
 * @subpackage Catarsis
 * @since Catarsis 1.0
 */
?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo get_bloginfo('name'); ?> </title>
<!-- 	<meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="theme-color" content="#d1be16">
	<link rel="icon" sizes="196x196" href="<?php bloginfo('template_url'); ?>/imagenes/favicon.png">
	<link href="<?php bloginfo('template_url'); ?>/css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
	<span id="tooltip">Soy el tooltip</span>
<?php
	include('estructura/menu-principal.php');
	include('estructura/contenedor-principal.php');
?>
