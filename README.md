# ApiResponse

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
    "params": null,
    "data": "Sucesso!",
    "error": null
}
```

Retorno com erro:
```json
{
    "statuscode": 400,
    "params": null,
    "data": null,
    "error": [
        {
            "messageerror": "Ocorreu um erro ao desserializar o usuário!",
            "internalmessageerror": "Could not decode JSON, syntax error - malformed JSON.",
            "internalcodeerror": 1
        }
    ]
}
```