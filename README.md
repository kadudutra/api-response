# ApiResponse

[![License](https://img.shields.io/badge/license-MIT-green)](https://github.com/GustavoSantosBr/)
[![Minimum PHP Version](https://img.shields.io/badge/php-%5E7.3.6-blue)](https://php.net/)

 ApiResponse permite que você lide com respostas de requisições
 de maneira simples e personalizada.

## Instalação

Execute o comando:
```bash
composer require gustavosantos/api-response
```
## Implementação

- Em sua middleware ou handler, basta retornar o ***ApiResponse***.
  
  Exemplo de implementação em uma handler:
     
  ```php
  <?php
  
  declare(strict_types=1);
  
  namespace Person\Handler;
  
  use Http\StatusHttp;
  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface;
  use Psr\Http\Server\RequestHandlerInterface;
  use Response\ApiResponse;
  use Exception;
  use Person\PersonException;
  
  class PersonHandler implements RequestHandlerInterface
  {
      /**
       * @param ServerRequestInterface $request
       * @return ResponseInterface
       */
      public function handle(ServerRequestInterface $request): ResponseInterface
      {
          try {
              return new ApiResponse("Sucesso!", StatusHttp::OK);
          } catch (PersonException $e) {
              return new ApiResponse($e->getCustomError(), $e->getCode());
          } catch (Exception $e) {
              return new ApiResponse($e->getMessage(), $e->getCode());
          }
      }
  }
  ```
  
- Para o retorno de exceções, você pode implementar [base-exception](https://github.com/GustavoSantosBr/base-exception.git)
  o que lhe permite usar o método ***getCustomError***, o qual prove uma
  implementação mais personalizada.
- Exceções do tipo ***Exception***, use o método ***getMessage***

## Retornos

- Retorno de sucesso:
```json
{
    "statuscode": 200,
    "data": "Sucesso!"
}
```

- Retorno de exceção:
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

- Se os objetos dos retorno forem ***null***, eles não serão serializados
por padrão. Para alterar, basta informar no construtor do ***ApiResponse***.
