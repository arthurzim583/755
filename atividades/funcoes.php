<?php

  $nomeEscola = "senai";

  //função 1 exibir mensagem

  function saudacao() {
   return "Bem vindo ao sistema";

  }

  //função 2 exibir nome

  function cumprimentar($nome) {
  return "olá, " .$nome . "!";


  }
  
  function somar($numero1, $numero2) {
  $resultado = ($numero1 + $numero2);
  return $resultado;



  }

   function calcularMedia($nota1, $nota2){
    $media = ($nota1 + $nota2) / 2;

    return $media;
    


   }

   function verificarstatus($media) {

    //MÉDIA É 7

    if ($media >= 7){
        return "Aprovado";
    
       
      
       }else{
        return "reprovado";
       }

   }





?>


