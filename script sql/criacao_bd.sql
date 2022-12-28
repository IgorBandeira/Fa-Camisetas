-- script bd
drop database loja;
-- criar base de dados
CREATE DATABASE loja;
-- selecionar bd
use loja;


-- CRIAÇÃO DE TABELAS --
CREATE TABLE `loja`.`tb_cliente`(
	`pk_id_cliente` INT(6) NOT NULL AUTO_INCREMENT ,
	`nome_cliente` VARCHAR(100) NOT NULL ,
	`email` VARCHAR(100) NOT NULL ,
	`senha` VARCHAR(200) NOT NULL , 
    `cpf` VARCHAR(22) UNIQUE NOT NULL ,
	`telefone` VARCHAR(30) NOT NULL ,
	PRIMARY KEY (`pk_id_cliente`));
    
-- Criar tabela Produto
CREATE TABLE `loja`.`tb_roupa`(
	`pk_id_produto` INT(6) NOT NULL AUTO_INCREMENT ,
	`nome_roupa` VARCHAR(200) NOT NULL ,
    `caracteristicas` VARCHAR(1000) NOT NULL ,
    `foto_roupa` varchar(200)	NOT NULL,
	`modo_conservacao` VARCHAR(1000) , 
    `tamanhos` CHAR(50) NOT NULL ,
	`vl_produto` VARCHAR(50) NOT NULL ,
    `genero` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`pk_id_produto`));
    
 -- Tabela cesta
 CREATE TABLE `loja`.`tb_cesta` (
	`pk_id_cesta` INT(6) NOT NULL AUTO_INCREMENT ,
    `dt_compra` DATETIME NOT NULL ,
    `vl_compra` FLOAT(5,2) NOT NULL ,
    `fk_id_cliente` INT(6) NOT NULL,
    FOREIGN KEY(`fk_id_cliente`) REFERENCES `tb_cliente`(`pk_id_cliente`) on delete cascade,
    PRIMARY KEY (`pk_id_cesta`));

-- Para criar os itens da Cesta
CREATE TABLE `loja`.`tb_itens_cesta` (
    `qt_produto` INT(6) NOT NULL ,
    `vl_produto` FLOAT(5,2) NOT NULL ,
    `pk_nm_ordem` INT(6) NOT NULL AUTO_INCREMENT ,
    `fk_id_cesta` INT(6) NOT NULL,
    `fk_id_produto` INT(6) NOT NULL,
    FOREIGN KEY(`fk_id_cesta`) REFERENCES `tb_cesta`(`pk_id_cesta`),
	FOREIGN KEY(`fk_id_produto`) REFERENCES `tb_roupa`(`pk_id_produto`),
    PRIMARY KEY (`pk_nm_ordem`));


-- popular tabela roupas
insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Como Treinar o Seu Dragão"',
    'Como Treinar o Seu Dragão  é ambientado em um mundo mítico de Vikings e dragões. 
	A história gira em torno de um garoto de 15 anos chamado Soluço, que vive na ilha de Berk, 
	onde os combates entre vikings e dragões é um modo de vida.',
    '../imagens_site/imagens/v1.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '69,90',
    'Feminino');

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Pokemón"',
    'Pokémon são criaturas que vivem em todos os lugares, livres na natureza ou com os humanos. 
	Eles seriam como os animais do nosso mundo, e assim como eles, existem diferentes espécies 
	espalhadas por todo o mundo.',
    '../imagens_site/imagens/v2.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '89,90',
    'Feminino');

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Rei Leão"',
    'Este desenho animado da Disney mostra as aventuras de um leão jovem de nome Simba, o herdeiro de seu pai, 
	Mufasa.O tio malvado de Simba, Oscar, planeja roubar o trono de Mufasa atraindo pai e filho para uma emboscada. 
	Simba consegue escapar e somente Mufasa morre. Com a ajuda de seus amigos, Timon e Pumba, ele reaparece como 
	adulto para recuperar sua terra, que foi roubada por seu tio Oscar.',
    '../imagens_site/imagens/v3.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '59,90',
    'Feminino');

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Demon Slayer"',
    'Em Demon Slayer, Tanjiro, um bondoso jovem que ganha a vida vendendo carvão descobre que sua família foi massacrada por um demônio. 
	E, para piorar, Nezuko, sua irmã mais nova e única sobrevivente, também acabou transformada em um demônio. 
	Arrasado com essa sombria realidade, Tanjiro decide se tornar um matador de demônios para fazer sua irmã voltar a ser humana e para destruir o demônio que matou seus entes queridos.',
    '../imagens_site/imagens/v4.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '59,90',
    'Feminino');
    
insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Lilo & Stitch"',
    'Lilo é uma garota que adora cuidar de animais menos favorecidos. Lilo tem o costume de coletar lixo reciclável nas praias para, com o dinheiro recebido,
	comprar comida para peixes. Até que, em um belo dia, ela encontra um cachorro e decide adotá-lo. Entretanto, este cachorro na verdade é Stitch, um ser alienígena
	que é um dos criminosos mais perigosos da galáxia. Agora, Stitch esconde quatro de suas seis pernas e decide se fazer passar por um cachorro comum, ficando amigo de Lilo.',
    '../imagens_site/imagens/v5.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '69,90',
    'Feminino');

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Star Wars"',
    'Star Wars é uma disputa política entre um império tirano e ditatorial e um grupo libertário. O enredo é permeado pela tragédia pessoal de Anakin Skywalker,
	um jedi (do bem) que sucumbe ao Lado Sombrio da Força (do mal) se transformando no vilão Darth Vader, que é um dos líderes do Império Galático.',
    '../imagens_site/imagens/v6.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '59,90',
    'Feminino');;

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "A Viagem de Chihiro"',
    'Chihiro e seus pais estão se mudando para uma cidade diferente. A caminho da nova casa, o pai decide pegar um atalho. 
	Eles se deparam com uma mesa repleta de comida, embora ninguém esteja por perto. Chihiro sente o perigo, mas seus pais 
	começam a comer. Quando anoitece, eles se transformam em porcos. Agora, apenas Chihiro pode salvá-los.',
    '../imagens_site/imagens/v7.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '69,90',
    'Feminino');

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Mulan - Mushu"',
    'Mulan, uma jovem chinesa que não se encaixa na sociedade, teme que seu pai, um homem doente, 
	seja convocado para lutar na guerra. A garota então se disfarça de homem e assume o posto de 
	seu pai no exército chinês. Acompanhada por seu dragão Mushu, Mulan parte para a linha 
	de batalha.',
    '../imagens_site/imagens/v8.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '99,90',
    'Feminino');

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Feminina "Brooklyn 99"',
    'Jake Peralta é um detetive brilhante e ao mesmo tempo imaturo, que nunca precisou se preocupar em respeitar as regras. 
	Tudo muda quando um capitão exigente assume o comando de seu esquadrão e Jake deve aprender a trabalhar em equipe.',
    '../imagens_site/imagens/v9.png',
    '- Lavagem à mão;
	- Não alvejar;
	- Não centrifugar;
	- Secagem na horizontal;
	- Não passar; 
	- Não limpar a seco; 
	- Lavagem a úmido profissional processo suave;
	Obs: Pode haver variação de tonalidade devido a incidência de luz.',
	'P, M, G, GG',
    '79,90',
    'Feminino');

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Masculina "Deadpool"',
	'Deadpool é um personagem fictício do universo Marvel, que atua geralmente como anti-herói e ocasionalmente como vilão. 
	Deadpool, cujo nome verdadeiro é Wade Winston Wilson, é um mercenário canadense marcado por ser falastrão, violento e
	principalmente por ser comediante e a partir ficou conhecido como o "mercenário tagarela". Tem também o fator de cura
	que o faz sobreviver aos piores ferimentos.',
    '../imagens_site/imagens/v10.png',
  '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '89,90',
	'Masculino');  

insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Masculina "Homem-Aranha"',
	'O Espetacular Homem-Aranha, também conhecido como Cabeça de Teia e Amigão da Vizinhança é um herói original da Marvel Comics,
	e um dos maiores super-heróis de todos os tempos, numa afirmação que até mesmo os mais fervorosos fãs da DC podem concordar!',
    '../imagens_site/imagens/v11.png',
    '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '59,90',
	'Masculino'); 
    
    insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Masculina "Jujutsu Kaisen"',
	'O jovem Yuta Okkotsu ganha o controle de um espírito extremamente poderoso, então um grupo de feiticeiros o matriculam na Tokyo Prefectural
	Jujutsu High School, para ajudá-lo a controlar esse poder e também para ficar de olho nele.',
    '../imagens_site/imagens/v12.png',
    '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '59,90',
	'Masculino');  

    insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Maculina "Pokemón"',
    'Pokémon são criaturas que vivem em todos os lugares, livres na natureza ou com os humanos. 
	Eles seriam como os animais do nosso mundo, e assim como eles, existem diferentes espécies 
	espalhadas por todo o mundo.',
    '../imagens_site/imagens/v13.png',
    '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '59,90',
	'Masculino'); 

	insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Maculina "Boku no Hero"',
	'Em um mundo onde quase toda a população possui algum poder sobre-humano, Izuku Midoriya é um dos poucos casos de pessoas comuns.
	Mas esse não é o maior de seus problemas. Exatamente por ser desprovido de qualquer poder, Izuku sofre constantemente nas mãos de
	seus colegas de classe.',
    '../imagens_site/imagens/v14.png',
    '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '79,90',
	'Masculino');  

	insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Masculina "Mulan - Mushu"',
    'Mulan, uma jovem chinesa que não se encaixa na sociedade, teme que seu pai, um homem doente, 
	seja convocado para lutar na guerra. A garota então se disfarça de homem e assume o posto de 
	seu pai no exército chinês. Acompanhada por seu dragão Mushu, Mulan parte para a linha 
	de batalha.',
    '../imagens_site/imagens/v15.png',
   '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '99,90',
	 'Masculino'); 

	insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Masculina "FullMetal Alchemist"',
	'Depois de perderem sua mãe, Alphonse e Edward Elric tentam trazê-la de volta usando uma técnica de alquimia proíbida. 
	Contudo, o princípio básico da alquimia é a "troca equivalente", e tentar ressucitar alguém custa muito alto.
	Ed perde sua perna, e Al perde seu corpo, e então embarcam numa aventura de tentar recuperar seus corpos.',
    '../imagens_site/imagens/v16.png',
    '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '59,90',
	'Masculino'); 

	insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Masculina "A Viagem de Chihiro"',
    'Chihiro e seus pais estão se mudando para uma cidade diferente. A caminho da nova casa, o pai decide pegar um atalho. 
	Eles se deparam com uma mesa repleta de comida, embora ninguém esteja por perto. Chihiro sente o perigo, mas seus pais 
	começam a comer. Quando anoitece, eles se transformam em porcos. Agora, apenas Chihiro pode salvá-los.',
    '../imagens_site/imagens/v17.png',
    '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '69,90',
	'Masculino'); 

	insert into tb_roupa(nome_roupa, caracteristicas, foto_roupa, modo_conservacao, tamanhos, vl_produto, genero) 
	values ('Camiseta Masculina "Lilo & Stitch"',
    'Lilo é uma garota que adora cuidar de animais menos favorecidos. Lilo tem o costume de coletar lixo reciclável nas praias para, com o dinheiro recebido,
	comprar comida para peixes. Até que, em um belo dia, ela encontra um cachorro e decide adotá-lo. Entretanto, este cachorro na verdade é Stitch, um ser alienígena
	que é um dos criminosos mais perigosos da galáxia. Agora, Stitch esconde quatro de suas seis pernas e decide se fazer passar por um cachorro comum, ficando amigo de Lilo.',
    '../imagens_site/imagens/v18.png',
    '- Lavagem à mão;
	Não alvejar,
	Não centrifugar,
	Secagem na horizontal,
	Não passar,
	Não limpar a seco,
	Lavagem a úmido profissional processo suave;',
	'P, M, G, GG',
    '89,90',
	'Masculino'); 
    
select * from tb_roupa;
select * from tb_cliente;
select * from tb_cliente;


