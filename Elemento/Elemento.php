<?php
/**
 * Classe para criação de elemento HTML (por exemplo, campos de formulário)
 * @author	Juliano Meinen, julianomeinen.souza@gmail.com
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GPL
 * @package Elemento
 * @link    http://github.com/julianomeinen/lib/Elemento
 * @since 22/07/2013
 */

namespace lib;

use lib\Html;
use lib\Atributo;

class Elemento
{
	
	/**
	 * tipo do elemento html (por exemplo, input, text, select, etc.)
	 * @access public
	 * @var string
	 */
	public $tipo;
	
	/**
	 * Método construtor da classe
	 * <code>
	 * <?php
	 * $Elemento = new Elemento("input",$Atributo);
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  string $tipo - Tipo do elemento html (por exemplo, input, text, select, etc.)
	 * @param  object $Atributo
	 */
	public function __construct($tipo = null, Atributo $Atributo = null) {;
		if($tipo){
			$this->tipo = $tipo;
		}
		if($Atributo){
			$this->setAtributos($Atributo);
		}
		return $this;
	}
	
	/**
	 * Método mágico que atribui os valores
	 * <code>
	 * <?php
	 * $Elemento = new Elemento();
	 * $Elemento->tipo = "input";
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  string $chave
	 * @param  mixed $valor
	 */
	public function __set($chave, $valor) {
		 $this->$chave = $valor;
	}
	
		
	/**
	 * Método mágico que retorna os valores
	 * <code>
	 * <?php
	 * $Elemento = new Elemento();
	 * $Elemento->tipo;
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  string $chave
	 */
	public function __get($chave)
	{
	     return $this->$chave = $valor;
	}
	
	/**
	 * Método que seta os atributos
	 * <code>
	 * <?php
	 * $Elemento = new Elemento();
	 * $Elemento->setAtributos($Atributo);
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object $Atributo
	 */
	public function setAtributos(Atributo $Atributo)
	{
		if($Atributo && is_object($Atributo))
		{
			foreach($Atributo as $chave => $valor)
			{
				$this->$chave = $valor;
			}
		}
	}
	
	/**
	 * Método que seta os atributos
	 * <code>
	 * <?php
	 * $Elemento = new Elemento();
	 * $Elemento->setAtributos($Atributo);
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object $Atributo
	 */
	public function getAtributos()
	{
		return get_object_vars($this);
	}
	
}