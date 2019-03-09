<?php

class ValidaCNPJ
{
	/** 
	 * Configura o valor (Construtor)
	 * 
	 * Remove caracteres inválidos do CNPJ
	 * 
	 * @param string $valor
	 */
	function __construct ( $valor = null ) {
		// Deixa apenas números no valor
		$this->valor = preg_replace( '/[^0-9]/', '', $valor );
		
		// Garante que o valor é uma string
		$this->valor = (string)$this->valor;
	}

	/**
	 * Verifica se é CNPJ
	 * 
	 * 
	 * @access protected
	 * @return string CNPJ ou false
	 */
	protected function verifica_cnpj () {
		// Verifica CNPJ
		if ( strlen( $this->valor ) === 14 ) {
			return 'CNPJ';
		} 
		// Não retorna nada
		else {
			return false;
		}
	}
    
	/**
	 * Verifica se todos os números são iguais
	 * 	 * 
	 * @access protected
	 * @return bool true para todos iguais, false para números que podem ser válidos
	 */
    protected function verifica_igualdade() {
        // Todos os caracteres em um array
        $caracteres = str_split($this->valor );
        
        // Considera que todos os números são iguais
        $todos_iguais = true;
        
        // Primeiro caractere
        $last_val = $caracteres[0];
        
        // Verifica todos os caracteres para detectar diferença
        foreach( $caracteres as $val ) {
            
            // Se o último valor for diferente do anterior, já temos
            // um número diferente no CNPJ
            if ( $last_val != $val ) {
               $todos_iguais = false; 
            }
            
            // Grava o último número checado
            $last_val = $val;
        }
        
        // Retorna true para todos os números iguais
        // ou falso para todos os números diferentes
        return $todos_iguais;
    }

	/**
	 * Multiplica dígitos vezes posições
	 *
	 * @access protected
	 * @param  string    $digitos      Os digitos desejados
	 * @param  int       $posicoes     A posição que vai iniciar a regressão
	 * @param  int       $soma_digitos A soma das multiplicações entre posições e dígitos
	 * @return int                     Os dígitos enviados concatenados com o último dígito
	 */
	protected function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
		for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
			// Preenche a soma com o dígito vezes a posição
			$soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );

			// Subtrai 1 da posição
			$posicoes--;

			// Parte específica para CNPJ
			// Ex.: 5-4-3-2-9-8-7-6-5-4-3-2
			if ( $posicoes < 2 ) {
				// Retorno a posição para 9
				$posicoes = 9;
			}
		}

		// Captura o resto da divisão entre $soma_digitos dividido por 11
		// Ex.: 196 % 11 = 9
		$soma_digitos = $soma_digitos % 11;

		// Verifica se $soma_digitos é menor que 2
		if ( $soma_digitos < 2 ) {
			// $soma_digitos agora será zero
			$soma_digitos = 0;
		} else {
			// Se for maior que 2, o resultado é 11 menos $soma_digitos
			// Ex.: 11 - 9 = 2
			// Nosso dígito procurado é 2
			$soma_digitos = 11 - $soma_digitos;
		}

		// Concatena mais um dígito aos primeiro nove dígitos
		// Ex.: 025462884 + 2 = 0254628842
		$cpf = $digitos . $soma_digitos;

		// Retorna
		return $cpf;
	}


	/**
	 * Valida CNPJ
	 *
	 * @author
	 * @access protected
	 * @param  string     $cnpj
	 * @return bool             true para CNPJ correto
	 */
	protected function valida_cnpj () {
		// O valor original
		$cnpj_original = $this->valor;

		// Captura os primeiros 12 números do CNPJ
		$primeiros_numeros_cnpj = substr( $this->valor, 0, 12 );

		// Faz o primeiro cálculo
		$primeiro_calculo = $this->calc_digitos_posicoes( $primeiros_numeros_cnpj, 5 );

		// O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
		$segundo_calculo = $this->calc_digitos_posicoes( $primeiro_calculo, 6 );

		// Concatena o segundo dígito ao CNPJ
		$cnpj = $segundo_calculo;
        
        // Verifica se todos os números são iguais
        if ( $this->verifica_igualdade() ) {
            return false;
        }

		// Verifica se o CNPJ gerado é idêntico ao enviado
		if ( $cnpj === $cnpj_original ) {
			return true;
		}
	}

	/**
	 * Valida
	 * @access public
	 * @return bool      True para válido, false para inválido
	 */
	public function valida () {
		// Valida CNPJ
		if ( $this->verifica_cnpj() === 'CNPJ' ) {
			// Retorna true para CNPJ válido
			return $this->valida_cnpj();
		} 
		else {
			return false;
		}
	}

	/**
	 * @access public
	 * @return string CNPJ formatado
	 */
	public function formata() {
		$formatado = false;
		if ( $this->verifica_cnpj() === 'CNPJ' ) {
			// Verifica se o CNPJ é válido
			if ( $this->valida_cnpj() ) {
				// Formata o CNPJ ##.###.###/####-##
				$formatado  = substr( $this->valor,  0,  2 ) . '.';
				$formatado .= substr( $this->valor,  2,  3 ) . '.';
				$formatado .= substr( $this->valor,  5,  3 ) . '/';
				$formatado .= substr( $this->valor,  8,  4 ) . '-';
				$formatado .= substr( $this->valor, 12, 14 ) . '';
			}
		} 
		return $formatado;
	}
}