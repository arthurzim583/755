<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfolio</title>
    <link rel="stylesheet" href="css/portfolio.css">


</head>

<body>
    <!--Menu-->
    <header>
        <div class="logo">
            <h2>Arthur <span>Batista</span></h2>
        </div>
        <nav>
            <a href="#inicio">inicio</a>
            <a href="#sobre">sobre</a>
            <a href="#projetos">projetos</a>
            <a href="#contato">contato</a>
        </nav>
    </header>

    <!--CONTEÚDO PRINCIPAL-->

    <main>
        <!--Seção de início-->
        <section id="inicio" class="inicio">
            <div class="inicio-conteudo">
                <p class="apresentacao">Olá, eu sou </p>
                <h1> Arthur </h1>
                <h2> Desenvolvedor de software </h2>
                <p class="descricao">
                    gosto de jogar e programar

                </p>

                <div class="botoes">
                    <a href="#projetos" class="botao">ver projetos
                        <a href="#contato" class="botao botao-secundario">entrar em contato</a>
                    </a>
                </div>
            </div>
        </section>

        <!--Sobre-->
        <section id="sobre" class="sobre">
            <div class="titulo-secao">
                <p>conheça um pouco</p>
                <h2>sobre mim</h2>
            </div>

            <div class="sobre-conteudo">

                <div class="sobre-texto">
                    <p>
                        atualmente estou no terceiro ano do ensino medio
                    </p>

                    <p>
                        faço curso de desenvolvimento de sistemas
                    </p>

                </div>
                <div class="habilidades">
                    <div class="habilidade"></div>
                    <h3>HTML</h3>
                    <p>Estilização e criação de interface.</p>
                </div>

                <!--div class="habilidade">

<h3>CSS</h3>
<p>PHP</p>
<p>desenvolvimento de aplicações na web.</p>



</div-->

            </div>





        </section>
        <section id="projetos" class="projetos-secao">
            <div class="titulo-secao">
                <p>Alguns trabalhos</p>
                <h2>Meus projetos</h2>
            </div>

            <div class="projetos">
                <div class="card">
                    <div class="numero-projeto">
                        01
                    </div>
                    <h3>Digitar seu nome e idade</h3>

                    <p>
                        Descrição do sistema:

                    </p>

                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <!--span>PHP</span-->
                    </div>
                    <a href="idade-get.php">Ver projeto</a>
                </div>

                <!--projeto2 -->
                <div class="card">
                    <div class="numero-projeto">
                        02
                    </div>
                    <h3>Sistema de cadastro</h3>

                    <p>
                        Descrição do sistema:
                    </p>

                     <p>Sistema para cadastrar idade e nome e afirmar se a pessoa é de menor ou de maior</p>
                    

                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <!--span>PHP</span-->
                    </div>
                    <a href="idade-get.php">Ver projeto</a>
                </div>
            </div>

              <!--projeto3-->
            <div class="card">
                    <div class="numero-projeto">
                        03
                    </div>
                    <h3>Sistema de cadastro de notas </h3>

                    <p>
                        Descrição do sistema:
                
                    </p>

                    <p>sistema para cadastrar nome do aluno e 3 notas em cada matéria</p>

                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <!--span>PHP</span-->
                    </div>
                    <a href="dados-json.php">Ver projeto</a>
                </div>



                <!--projeto4-->
                <div class="card">
                    <div class="numero-projeto">
                        04
                    </div>
                    <h3>Sistema de cadastro de produtos</h3>

                    <p>
                        Descrição do sistema de cadastro

                    </p>

                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <!--span>PHP</span-->
                    </div>
                    <a href="cadastro_de_produtos-json.php">Ver projeto</a>
                </div>

                <!--projeto5-->
                <div class="card">
                    <div class="numero-projeto">
                        03
                    </div>
                    <h3>Sistema de cadastro de notas </h3>

                    <p>
                        Descrição do sistema:
                
                    </p>

                    <p>sistema para cadastrar nome do aluno e 3 notas em cada matéria</p>

                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <!--span>PHP</span-->
                    </div>
                    <a href="atividades/funcoes.php">Ver projeto</a>
                </div>
        

        </section>

        <!--Seção Contato-->
        <section id="contato" class="contato">
            <div class="contato-links">
                <a href="mailto: joaoarthurbrumpontes@gmail.com">E-mail</a>
                <a href="https://github.com/arthurzim583/755">github</a>
            </div>
        </section>
    </main>







    <footer>
        <p>
            Desenvolvido por mim <a href="https://github.com/arthurzim583/755">Arthur Batista</a>

        </p>
        <p>
            HTML + CSS

        </p>

    </footer>

</body>

</html>
