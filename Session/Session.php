<?php
/**
 * Classe para registro de sessões de dados na aplicação
 * @author	Juliano Meinen, julianomeinen.souza@gmail.com
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GPL
 * @package Session
 * @link    http://github.com/julianomeinen/lib/Session
 * @since 19/07/2013
 */

namespace lib;

class Session
{
	
	/**
	 * Método mágico que atribui os valores
	 * <code>
	 * <?php
	 * $session = new Session();
	 * $session->nome = "Juliano Meinen";
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  string $chave
	 * @param  mixed $valor
	 */
	public function __set($chave, $valor) {
		 $_SESSION[$chave] = $valor;
	}
	
		
	/**
	 * Método mágico que retorna os valores
	 * <code>
	 * <?php
	 * $session = new Session();
	 * $session->nome;
	 * ?>
	 * </code>
	 * @access public
	 * @since 1.0
	 * @param  string $chave
	 */
	public function __get($chave)
	{
	    if(array_key_exists($chave, (is_array($_SESSION) ? $_SESSION : array()))) {
	        return $_SESSION[$chave];
	    }else{
	    	return null;
	    }
	}

}