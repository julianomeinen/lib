<?php
/**
 * Classe para registro de sess�es de dados na aplica��o
 * @author	Juliano Meinen, julianomeinen.souza@gmail.com
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GPL
 * @package Atributo
 * @link    http://github.com/julianomeinen/lib/Atributo
 * @since 19/07/2013
 */

namespace lib;

class Atributo
{
	
	/**
	 * M�todo construtor
	 * @access public
	 * @since 1.0
	 */
	public function __construct($arrAtributos = null) {
		if($arrAtributos && is_array($arrAtributos))
		{
			foreach($arrAtributos as $chave => $valor)
			{
				$this->$chave = $valor;
			}
		}
		return $this;
	}
	
	/**
	 * M�todo m�gico que atribui os valores
	 * <code>
	 * <?php
	 * $Atributo = new Atributo();
	 * $Atributo->nome = "Juliano Meinen";
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
	 * M�todo m�gico que retorna os valores
	 * <code>
	 * <?php
	 * $Atributo = new Atributo();
	 * $Atributo->nome;
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
	 * M�todo para passar os valores dos atributos por meio de array
	 * <code>
	 * <?php
	 * $Atributo = new Atributo();
	 * $Atributo->setAtributos(array("name" => "formulario", "id" => "id_formulario", "enctype" => "multipart/form-data"));
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  array $arrAtributos
	 */
	public function setAtributos(array $arrAtributos)
	{
		foreach($arrAtributos as $chave => $valor)
		{
			$this->$chave = $valor;
		}
		return $this;
	}
	
	/**
	 * M�todo para passar o valor de um atributo
	 * <code>
	 * <?php
	 * $Atributo = new Atributo();
	 * $Atributo->setAtributo("name","formulario")->setAtributo("id","id_formulario")->setAtributo("enctype","multipart/form-data");
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  string $chave
	 * @param  string $valor
	 */
	public function setAtributo($chave,$valor)
	{
		$this->$chave = $valor;
		return $this;
	}

}