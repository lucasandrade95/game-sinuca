# Inicialização do Game de Sinuca

Responsible code author: Lucas Andrade <lucasmendes95@outlook.com.br>

### Utilizar o Xampp - de preferência
```bash
Git clone do projeto na pasta htdocs do xampp
Ex.: C:\xampp\htdocs\game-sinuca
```

### Criar o banco de dados MySql - game_sinuca
```bash
CREATE SCHEMA `game_sinucas` ;
```

### Criar a Table - Tabela
```bash
CREATE TABLE `game_sinuca`.`tabela` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `desc_premiacao` VARCHAR(200) NOT NULL,
  `pontuacao` INT(11) NOT NULL,
  `desc_regras` VARCHAR(200) NOT NULL,
  `id_times` VARCHAR(200) NULL,
  PRIMARY KEY (`id`));
```


### Criar a Table - Time
```bash
CREATE TABLE `game_sinuca`.`time` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `jogador_1` VARCHAR(200) NOT NULL,
  `jogador_2` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`));
```

### Start the app in development mode
```bash
yarn install
```

### Start the app in development mode
```bash
quasar dev
```
