
# Sobre dacxi-backend

Aplicação com dois endpoints com informações de criptomoedas


# Instalacao

## Pre requisitos:

- [Php 8.0](https://www.php.net/releases/8.0/en.php).
- [Laravel 8.0](https://laravel.com/docs/8.x).
- [Docker](https://www.docker.com)


## Clonando Repositório

```
git clone https://github.com/pitombeira00/dacxi-backend
```

## Get Price Coin By id

```
POST /api/coin/price
```

#HEADERS
```
Accept: application/json
```
#Multipart-Form
```
{
  "coin": "bitcoin",
}
```
## Get Estimated Price Coin By id

```
POST /api/coin/estimated/price
```

#HEADERS
```
Accept: application/json
```
#Multipart-Form
```
{
  "coin": "bitcoin",
  "datetime": "2022-20-12 09:00" 
}
```
## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
