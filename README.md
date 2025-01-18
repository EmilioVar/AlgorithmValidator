# IDAccountValidator

Esta librería permite validar diferentes tipos de documentos como DNI, NIE, CIF y también validar el IBAN, todo ello en base a sus algoritmos.
Es una herramienta útil para asegurarse de que los datos ingresados sean correctos y válidos.

## Características Principales

- Validación de DNI (Documento Nacional de Identidad)
- Validación de NIE (Número de Identificación de Extranjero)
- Validación de CIF (Código de Identificación Fiscal)
- Validación de IBAN (International Bank Account Number)

## Forma de uso

Para su funcionamiento, basta con llamar a la clase Validator utilizando el siguiente namespace en el lugar donde lo vayamos a utilizar:

`use Evarmi\IdAccountValidator\Validator;`

Tenemos ***2 métodos disponibles*** Para las validaciones:

- *documentValidation()*: será el encargado de validar un número de documento, ya sea dni, nie o cif.
***El reconocimiento del tipo de documento lo hace automáticamente***.
- *ibanValidation()*: realizará las validaciones para comprobar si un cif es válido.

El retorno dichos métodos será un array, el cual tiene los las siguientes posibilidades de retorno:

```Array
    [
        "type" (string) => "DNI" | "NIE" | "CIF",
        "value" => (string) => El valor introducido,
        "result" => (bool) => Si la validación ha sido satisfactoria devolvera true
    ]
```

## Ejemplos de Uso

```php
    ### Validación de DNI:

    $validacionDNI = Validator::documentValidation('23826295C');

    var_dump($validacionDNI);
    /**
     * [
     *      "type"=> "DNI" ,
     *      "value" => "23826295C",
     *      "result" => true
     * ]
     **/

    ### Validación de NIE:

    $validacionNIE = Validator::documentValidation('X8222827M');

    var_dump($validacionNIE);
    /**
     * [
     *      "type"=> "NIE" ,
     *      "value" => "X8222827M",
     *      "result" => true
     * ]
     **/

    ### Validación de CIF

    $validacionCIF = Validator::documentValidation('B86561412');

    var_dump($validacionCIF);
    /**
     * [
     *      "type"=> "CIF" ,
     *      "value" => "B86561412",
     *      "result" => true
     * ]
     **/

    ### Validación de IBAN

    $validacionIBAN = Validator::ibanValidation('ES7921000813610123456789');

    var_dump($validacionIBAN);
    /**
     * [
     *      "type"=> "IBAN" ,
     *      "value" => "ES7921000813610123456789",
     *      "result" => true
     * ]
     **/

```
## Test
Para ejecutar los test de comprobación de los metodos puedes ejecutar el siguiente comando de composer:

`composer test`

## Contribuir

¡Gracias por considerar contribuir a esta librería! Nos encantaría contar con tu ayuda para mejorarla. Si tienes ideas, sugerencias o encuentras algún problema, no dudes en abrir un issue o enviar un pull request. 

Para contribuir, sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama para tu funcionalidad o corrección de errores (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y asegúrate de que los tests pasen (`composer test`).
4. Haz commit de tus cambios (`git commit -m 'Añadir nueva funcionalidad'`).
5. Sube tus cambios a tu fork (`git push origin feature/nueva-funcionalidad`).
6. Abre un pull request en el repositorio original.

Esperamos tus contribuciones y estamos emocionados de trabajar juntos para mejorar esta librería. ¡Gracias por tu apoyo!

## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.


