<?php

namespace Evarmi\IdAccountValidator;

class Validator
{
    public static function documentValidation($document)
    {
        $documento = strtoupper(str_replace([' ', '-', '.'], '', $document));

        if (preg_match('/^[0-9]{8}[A-Z]$/', $documento)) {
            // Es un DNI
            return self::validarDNI($documento);
        } elseif (preg_match('/^[XYZ][0-9]{7}[A-Z]$/', $documento)) {
            // Es un NIE
            return self::validarNIE($documento);
        } elseif (preg_match('/^[ABCDEFGHJNPQRSUVW][0-9]{7}[0-9A-J]$/', $documento)) {
            // Es un CIF
            return self::validarCIF($documento);
        }

        return [
            'type' => 'unknown',
            'result' => false,
        ];
    }

    private static function validarDNI($dni, ?string $type = null)
    {
        $numeros = substr($dni, 0, 8);
        $letra = substr($dni, -1);
        $letrasValidas = 'TRWAGMYFPDXBNJZSQVHLCKE';

        if ($type === 'NIE') {
            $numbersToLetter = [
                '0' => 'X',
                '1' => 'Y',
                '2' => 'Z',
            ];

            $value = $numbersToLetter[substr($numeros, 0, 1)] . substr($numeros, 1) . substr($dni, -1);
        } else {
            $value = $dni;
        }

        return [
            'type' => $type == 'NIE' ? 'NIE' : 'DNI',
            'value' => $value,
            'result' => $letra === $letrasValidas[$numeros % 23],
        ];
    }

    private static function validarNIE($nie)
    {
        $primeraLetra = substr($nie, 0, 1);
        $numeros = substr($nie, 1, 7);
        $letra = substr($nie, -1);

        switch ($primeraLetra) {
            case 'X':
                $numeros = '0' . $numeros;
                break;
            case 'Y':
                $numeros = '1' . $numeros;
                break;
            case 'Z':
                $numeros = '2' . $numeros;
                break;
            default:
                return false;
        }

        return self::validarDNI($numeros . $letra, 'NIE');
    }

    private static function validarCIF($cif)
    {
        $letra = substr($cif, 0, 1);
        $numeros = substr($cif, 1, 7);
        $control = substr($cif, -1);

        // Cálculo del dígito de control
        $sumaPar = 0;
        $sumaImpar = 0;

        for ($i = 0; $i < 7; $i++) {
            $digito = (int) $numeros[$i];
            if ($i % 2 === 0) {
                // Posiciones impares
                $doble = $digito * 2;
                $sumaImpar += $doble > 9 ? $doble - 9 : $doble;
            } else {
                // Posiciones pares
                $sumaPar += $digito;
            }
        }

        $sumaTotal = $sumaPar + $sumaImpar;
        $digitoControlCalculado = (10 - ($sumaTotal % 10)) % 10;

        if (ctype_alpha($control)) {
            // Control por letra
            $letrasValidas = 'JABCDEFGHI';
            return [
                'type' => 'CIF',
                'value' => $cif,
                'result' => $control === $letrasValidas[$digitoControlCalculado],
            ];
        } else {
            // Control por número
            return [
                'type' => 'CIF',
                'value' => $cif,
                'result' => (int) $control === $digitoControlCalculado,
            ];
        }
    }

    /**
     * IBAN VALIDATE
     */

    public static function ibanValidation($iban)
    {
        $iban = strtoupper(str_replace(' ', '', $iban));

        if (strlen($iban) < 15 || strlen($iban) > 34) {
            return false;
        }

        $ibanReorganizado = substr($iban, 4) . substr($iban, 0, 4);

        $ibanNumerico = '';
        for ($i = 0; $i < strlen($ibanReorganizado); $i++) {
            $char = $ibanReorganizado[$i];
            if (ctype_alpha($char)) {
                // Convertir la letra en número
                $ibanNumerico .= ord($char) - 55;
            } else {
                // Mantener los dígitos
                $ibanNumerico .= $char;
            }
        }

        return [
            'type' => 'IBAN',
            'value' => $iban,
            'result' => bcmod($ibanNumerico, '97') == 1,
        ];
    }
}
