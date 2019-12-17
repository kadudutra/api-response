# ApiResponse

[![License](https://img.shields.io/badge/license-MIT-green)](https://github.com/GustavoSantosBr/)
[![Minimum PHP Version](https://img.shields.io/badge/php-%5E7.3.6-blue)](https://php.net/)

 ApiResponse permite que você lide com respostas de requisições
 de maneira simples e personalizada.

Para utilizar:
```bash
composer require gustavosantos/base-exception
```

Retorno com sucesso:
```json
{
    "statuscode": 200,
    "data": "Sucesso!"
}
```

Retorno com erro:
```json
{
    "statuscode": 400,  
    "error": [
        {
            "messageerror": "Ocorreu um erro ao desserializar o usuário!",
            "internalmessageerror": "Could not decode JSON, syntax error - malformed JSON.",
            "internalcodeerror": 1
        }
    ]
}
```