# Technical Test for Backend - Dacxi

## Descrição
Teste técnico da Dacxi com o objetivo de armazenar o histórico de preços do Bitcoin ao longo do tempo.

# Rotas

## Rotas Historic Price
```
[GET] /api/crypto/last-price-bitcoin : A rota exibe o preço mais recente do bitcoin (salvo no histórico)

[GET] /api/crypto/price-datetime-bitcoin?date={date}&time={time} : A rota exibe o preço estimado do bitcoin em uma determinada data e hora passadas nos parâmetros da rota nos formatos: date=2022-07-20 e time=14:04:29

[GET] /api/crypto/last-price-coin?coin_id={id} : A rota exibe o preço mais recente de uma moeda (salvo no histórico) passada nos parâmetros da rota

[GET] /api/crypto/price-datetime-coin?coin_id={id}&date={date}&time={time} : A rota exibe o preço estimado de uma moeda em uma determinada data e hora passadas nos parâmetros da rota nos formatos: coin_id=dacxi, date=2022-07-20 e time=14:04:29

[GET] /api/crypto/historic?coin_id={id} : A rota lista o histórico de preços de uma moeda passada nos parâmetros da rota

[DELETE] /api/crypto/{id} : A rota remove o histórico de preços de uma moeda passada nos parâmetros da rota
```

## Rotas Coin
```
[POST] /api/coin : A rota recebe id, id da moeda na API, nome e simbolo no seguinte formato: {"id": "bitcoin", "coin_id": "bitcoin", "name": "Bitcoin", "symbol": "btc"}

[GET] /api/coin : A rota lista todas as moedas cadastradas

[GET] /api/coin/{id} : A rota lista as informações de uma moeda

[PUT] /api/coin/{id} : A rota atualiza as informações coin_id, name e symbol da moeda no seguinte formato: {"id": "bitcoin", "coin_id": "bitcoin", "name": "Bitcoin", "symbol": "btc"}, com o id presente nos parâmetros da rota

[DELETE] /api/coin/{id} : A rota deleta a meda com o id presente nos parâmetros da rota
```


# Deploy da aplicação
A hospedagem da aplicação foi feita no Heroku e pode ser acessada [aqui](https://crypto-historic-price.herokuapp.com). O banco de dados utilizado nele foi o ClearDB MySQL e o Advanced Scheduler para auxiliar o Task Scheduling do Laravel.

# Como executar o projeto em sua máquina

```
# Clone este repositório
$ git clone https://github.com/adkatarine/dacxi-test-backend.git

# Acesse a pasta do projeto no terminal ou cmd ou editor de sua preferência

# Instale as dependências na raiz do projeto
$ composer install

# Configure as variáveis de ambiente do banco de dados no arquivo .env

# Execute este comando para criar todas as migrações
$ php artisan migrate

# Execute este comando para popular a tabela coins com as moedas requisitadas usando o Seeder
$ php artisan db:seed

# Abra um terminal e ative a Task Scheduling (Agendamento de Tarefas) do Laravel
$ php artisan schedule:work

# Abra outro terminal e execute a aplicação para acessar a API
$ php artisan serve

# Escolha um cliente da sua preferência para testar a API e configure as rotas ou importe o arquivo insomnia-routes.json no Insominia.
```

# Decisões de projeto

## Tabelas
Duas tabelas foram criadas no banco de dados:
* tabela coins para armazenar informações sobre as moedas como: id da moeda neste projeto, id da moeda na API de requisição dos preços, nome e símbolo da moeda.
* tabela historic prices que armazena o id da moeda no projeto, o seu preço atual e o datetime.

Essa estrutura de tabelas tende a facilitar a inserção ou exclusão do histórico de alguma moeda e na troca dos dados da moeda na troca de API da requisição dos preços. Atualmente, o banco armazena o histórico de preços de cinco moedas em real (BRL): Bitcoin, DACXI, ETH, ATOM e LUNA.

## API de requisição dos preços
A classe estática responsável pelos dados e requisição da API CoinGecko implementa a interface APICrypto para minimizar grandes mudanças em outras partes do código caso seja necessário trocar de API.

## Task Scheduling do Laravel
O agendamento de tarefas do Laravel foi utilizado para requisitar a API CoinGecko e foi decidido que essa requisição seria a cada 5 minutos. Assim, sempre que o endpoint que estima o preço de uma moeda em uma determinada data e hora for requisitado, ele retornará o preço naquela exata hora ou dentro dos 5 minutos anteriores.

## Cache do Laravel
A Cache do Laravel foi utilizada na requisição dos id's das moedas no banco, no momento de requisição dos preços atuais, considerando que raramente moedas seriam adicionadas ou removidas do histórico, tornando descessário requisitar o banco com tanta frequência.


# Construído com

* [Laravel](https://laravel.com) - Framework na versão 9.x para criar a API
* [MySQL](https://www.mysql.com) - Database
* [Task Scheduling](https://laravel.com/docs/9.x/scheduling#running-the-scheduler-locally) - Agendador de tarefas do Laravel para ser possível salvar o histórico dos preços de tempos em tempos
* [Cache](https://laravel.com/docs/9.x/cache) - Cache do Laravel para não ser necessário consultar o id das moedas no banco a cada requisição dos preços.
* [CoinGecko API](https://www.coingecko.com/en/api/documentation) - API para consulta dos preços das moedas
* [Heroku](https://dashboard.heroku.com) - Plataforma de hospedagem.
* [Insomnia](https://insomnia.rest) - Cliente para testar a API.
