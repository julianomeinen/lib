<?php
/**
 * Classe para gerar elementos html comuns de formulário
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
	 * Atributo que define se o formulário será utilizado para upload de arquivo
	 * @access public
	 * @var boolean
	 */
	public $upload = false;
	
	/**
	 * Array que guarda os atributos do formulário
	 * @access public
	 * @var obejct
	 */
	public $arrAtributos;
	
	/**
	 * String que guarda todo o conteúdo do formulário
	 * @access public
	 * @var string
	 */
	public $htmlFormulario;
	
	/**
	 * Método construtor do formulário
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
	 * Método que seta os atributos para o formulário
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
	 * Método que abre o formulário (<form>) com todos os atributos setados
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
	 * Método adiciona um elemento ao formulário (por exmeplo, um campo texto, select, input, etc.)
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
	 * Método que fecha o formulário (<form>)
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
	 * Método retorna o tipo tag usada para adicionar o elemento no formulário
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
	 * Método que exibe o formulário com todos os seus elementos
	 * @access public
	 * @since 1.0
	 */
	public function exibirFormulario()
	{
		$this->fecharFormulario();
		return $this->htmlFormulario;
	}
	
}