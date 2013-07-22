lib
===

Bibliotecas de Compoentes PHP (versão 5.4 ou maior)

include "lib/Formulario/Formulario.php";
include "lib/Atributo/Atributo.php";
include "lib/Html/Html.php";
include "lib/Elemento/Elemento.php";

use lib\Formulario;
use lib\Atributo;
use lib\Elemento;

/* ------ Início do Formulário de Exemplo 1 ------ */
/* Há 2 formas de usar o Objeto da classe de Formulário
 * 1ª Imprimir o formulário por etapas
*/

$form = new Formulario(); //Instância do formulário
$form->upload = true; //Informa para o formulário que haverá upload de arquivo e portanto, devemos criar a tag enctype=multipart/form-data

$atributoForm = new Atributo(); //Instância de atributos para o formulário
$atributoForm->name = "formulario_1"; //A classe utiliza métodos mágicos, portanto seus atributos podem ser setados dessa forma
$atributoForm->setAtributos(["id" => "formulario_1_id", "class" => "css_formulario_padrao"]); // Há também um método para passar os atributos por Array no modelo chave => valor (Observe a escrita do array, a partir do 5.3 aceita-se [] e array())
$atributoForm->setAtributo("method","post")
->setAtributo("action",""); // Umn atributo individual também pode ser passado pelo método 'setAtributo'

$form->setAtributos($atributoForm); //Agora devemos o objeto de atributos para o Formulário

echo $form->abrirFormulario(); //Imrpime a tag de abertura do formulário

$CampoTexto = new Elemento("text"); //Instância para criar um novo elemento de campo texto no formulário
$atributoCampoTexto = new Atributo(array("name" => "texto", "id" => "id_texto", "size" => "20")); //Atributos do campo texto, exatamente como do formulário, porém com outros valores
$CampoTexto->setAtributos($atributoCampoTexto); //Setamos os atributos para o campo texto

$form->addElemento($CampoTexto); //Incluímos o campo texto no formulário, desta forma é criado um atributo com o nome do elemento para o objeto do formulário ($form->texto)

echo $form->texto; //Agora que incluímos o campo texto no formulário, podemos exibí-lo

echo $form->fecharFormulario(); //Fechamos o formulário

/* ------ Fim do Formulário de Exemplo 1 ------ */


/* ------ Início do Formulário de Exemplo 2 ------ */
/*
 * A 2ª maneira de Imrpimir o formulário é com apenas um método (exibirFormulario)
*/
$form2 = new Formulario(
  	new Atributo(
				array(
						"name" => "formulario_2",
						"id" => "formulario_2_id"
				)
		)
); //Instância do formulário já com a instância de seus atributos (Obs. Verifique os atributos padrões na classe lib/Formulario.php)
$form2->addElemento(
		new Elemento(
				"text",
				new Atributo(
						array(
								"name" => "campo_texto",
								"id" => "campo_texto_id"
						)
				)
		)
); //Adiciona o elemento criado no formulário
echo $form2->exibirFormulario(); //Exibe todo o formulário
/* ------ Fim do Formulário de Exemplo 2 ------ */
