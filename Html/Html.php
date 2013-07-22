<?php
/**
 * Classe para gerar html
 * @author	Juliano Meinen, julianomeinen.souza@gmail.com
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GPL
 * @package Html
 * @link    http://github.com/julianomeinen/lib/Html
 * @since 19/07/2013
 */

namespace lib;

use lib\Atributo;

class Html
{
	
	/**
	 * Array que define quais atributos de tags html devem ser retirados na hora de imprimir o conteúdo
	 * @access static
	 * @var array
	 */
	static $arrAtributosNaoPermitidos = array("tag","upload");
	
	/**
	 * Array que define quais atributos de tags html devem obrigatoriamente conter valor para serem exibidos
	 * @access static
	 * @var array
	 */
	static $arrAtributosComValoresObrigatorios = array("enctype");
	
	/**
	 * Método para abrir tags que não são fechadas na mesma linha (Ex: <form>). Obs.: Para gerar tags que são fechadas na mesma linha (Ex: <br/>) use o método tag desta classe
	 * <code>
	 * <?php
	 * $Html::abrirTag($Atributo)
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object Atributo
	 */
	public static function abrirTag( Atributo $Atributo ) {
		$html = "<".$Atributo->tag." ";
		foreach ($Atributo as $key => $value) {
			if(!in_array($key,self::$arrAtributosNaoPermitidos))
			{
				if(in_array($key,self::$arrAtributosComValoresObrigatorios) && $value){
					$html.= $key."=\"".$value."\" ";
				}elseif(!in_array($key,self::$arrAtributosComValoresObrigatorios)){
					$html.= $key."=\"".$value."\" ";
				}
			}
		}
		$html.= ">";
		return $html; 
	}
	
	/**
	 * Método para fechar tags (Ex: </form>) 
	 * <code>
	 * <?php
	 * $Html::fecharTag($Atributo)
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object Atributo
	 */
	public static function fecharTag( Atributo $Atributo ) {
		$html = "</".$Atributo->tag.">";
		return $html;
	}
	
	/**
	 * Método para criar o exibir o HTML
	 * <code>
	 * <?php
	 * $Html::criarHTML($Atributo)
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object Atributo
	 */
	public static function criarHTML( Atributo $Atributo ) {
		$html = "<".($Atributo->tag ? $Atributo->tag : "")."";
		foreach ($Atributo as $key => $value) {
			if(!in_array($key,self::$arrAtributosNaoPermitidos))
			{
				if(in_array($key,self::$arrAtributosComValoresObrigatorios) && $value){
					$html.= " ".$key."=\"".$value."\"";
				}elseif(!in_array($key,self::$arrAtributosComValoresObrigatorios)){
					$html.= " ".$key."=\"".$value."\"";
				}
			}
		}
		$html.= " />";
		return $html;
	}
		
}