<?php
/**
 * Classe para gerar elementos html comuns de formul�rio
 * @author	Juliano Meinen, julianomeinen.souza@gmail.com
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GPL
 * @package Formulario
 * @link    http://github.com/julianomeinen/lib/Formulario
 * @since 19/07/2013
 */

namespace lib;

use lib\Html;
use lib\Atributo;

class Formulario
{
	/**
	 * Atributo que define se o formul�rio ser� utilizado para upload de arquivo
	 * @access public
	 * @var boolean
	 */
	public $upload = false;
	
	/**
	 * Array que guarda os atributos do formul�rio
	 * @access public
	 * @var obejct
	 */
	public $arrAtributos;
	
	/**
	 * String que guarda todo o conte�do do formul�rio
	 * @access public
	 * @var string
	 */
	public $htmlFormulario;
	
	/**
	 * M�todo construtor do formul�rio
	 * <code>
	 * <?php
	 * $Formulario = new Formulario($Atributo);
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object Atributo
	 */
	public function __construct( Atributo $Atributo = null ) {
		if($Atributo)
		{
			$this->setAtributos( $Atributo );
		}
		return $this;
	}
	
	/**
	 * M�todo que seta os atributos para o formul�rio
	 * <code>
	 * <?php
	 * $Formulario = new Formulario();
	 * $Formulario->abrirFormulario($Atributo->name);
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object Atributo
	 */
	public function setAtributos( Atributo $Atributo = null ) {
		$Atributo->tag  	= "form";
		$Atributo->name 	= !$Atributo->name ? "formulario" : $Atributo->name;
		$Atributo->id   	= !$Atributo->id ? $Atributo->name : $Atributo->id;
		$Atributo->method   = !$Atributo->method ? "post" : $Atributo->method;
		$Atributo->enctype  = $this->upload ? "multipart/form-data" : $Atributo->enctype;
		$this->arrAtributos = $Atributo;
		return $this;
	}
	
	/**
	 * M�todo que abre o formul�rio (<form>) com todos os atributos setados
	 * <code>
	 * <?php
	 * $Formulario = new Formulario();
	 * $Formulario->abrirFormulario();
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 */
	public function abrirFormulario() {
		$html = Html::abrirTag($this->arrAtributos);
		$this->htmlFormulario.= $html;
		return $html;
	}
	
	/**
	 * M�todo adiciona um elemento ao formul�rio (por exmeplo, um campo texto, select, input, etc.)
	 * <code>
	 * <?php
	 * $Formulario = new Formulario();
	 * $Formulario->addElemento($Elemento);
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  object Elemento
	 */
	public function addElemento(Elemento $Elemento) {
		if(!$this->htmlFormulario && $this->arrAtributos)
		{
			$this->abrirFormulario();
		}
		$arrAtributos = get_object_vars($Elemento);
		$Atributo = new Atributo();
		$Atributo->tag = $this->pegarTipoTag($Elemento);
		$Atributo->type = $arrAtributos['tipo'];
		unset($arrAtributos['tipo']);
		$Atributo->setAtributos($arrAtributos);
		$html = Html::criarHTML($Atributo);
		$this->{$Elemento->name} = $html;
		$this->htmlFormulario.= $html;
		return $html;
	}
	
	/**
	 * M�todo que fecha o formul�rio (<form>)
	 * <code>
	 * <?php
	 * $Formulario = new Formulario();
	 * $Formulario->fecharFormulario();
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 */
	public function fecharFormulario() {
		$Atributo = new Atributo();
		$Atributo->tag  	= "form";
		$html = Html::fecharTag($Atributo);
		$this->htmlFormulario.= $html;
		return $html;
	}
	
	/**
	 * M�todo retorna o tipo tag usada para adicionar o elemento no formul�rio
	 * @access private
	 * @since 1.0
	 * @param  object Elemento
	 */
	private function pegarTipoTag(Elemento $Elemento) {
		switch($Elemento->tipo){
			case "text":
				$Elemento->tag = "input";
				return $Elemento->tag;
				break;
			default:
				$Elemento->tag = "input";
				return $Elemento->tag;
				break;
			exit;
		}
	}
	
	/**
	 * M�todo que exibe o formul�rio com todos os seus elementos
	 * @access public
	 * @since 1.0
	 */
	public function exibirFormulario()
	{
		$this->fecharFormulario();
		return $this->htmlFormulario;
	}
	
}