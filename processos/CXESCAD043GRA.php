<?php
require_once("../Connections/connpdo.php");
date_default_timezone_set('America/Sao_Paulo');
session_start();
$user = $_SESSION['id_usuario'];

$potencia = $_POST['potencia'];
$finame = intval($_POST['finame']);

$hj = date("Y-m-d H:i:s");

if ((!isset($_FILES['arquivo_kits']))) {
	echo "preencha_excel";
	return false;
} else {

	if (isset($_FILES['arquivo_kits'])) {

		$ext = pathinfo($_FILES['arquivo_kits']['name'], PATHINFO_EXTENSION);

		if ($ext != "csv") {
			echo "erro_csv";
			return false;
		} else {
			$pasta = "../importacoes_kits/";

			$hoje = md5(date("Y-m-d H:i:s"));

			$nome_arquivo =   $hoje  . "_#_" . $_FILES['arquivo_kits']['name'];

			if (move_uploaded_file($_FILES['arquivo_kits']['tmp_name'], $pasta . $nome_arquivo)) {

				$caminho = $pasta . $nome_arquivo;
				$caminho_bd = "importacoes_kits/" . $nome_arquivo;

				$arquivo = fopen($caminho, 'r');

				$cont = 1;
				$nro_importacoes = 0;

				while (!feof($arquivo)) {
					// Pega os dados da linha
					$linha = fgets($arquivo, 1024);

					// Divide as Informações das celulas para poder salvar
					$dados = explode(';', $linha);
					$verifica = $dados[0];


					if (($cont == 1) or ($cont == 3)) {
						$cont++;
					} elseif ($cont == 2) {
						$potencia_csv = $dados[0];

						if ($potencia_csv != $potencia) {
							echo "potencias_diferentes";
							return false;
						} else {
							$cont++;
						}
					} else {
						if (($verifica != "") and (is_numeric($verifica))) {

							$min_modulos = $dados[0];
							$max_modulos = $dados[1];
							$range_modulos = $dados[2];
							$cod_inversor1 = $dados[3];
							$qtd_inversor1 = $dados[4];

							if ($dados[5] == "") {
								$cod_inversor2 = 0;
								$qtd_inversor2 = 0;
							} else {
								$cod_inversor2 = $dados[5];
								$qtd_inversor2 = $dados[6];
							}

							if ($dados[7] == "") {
								$cod_inversor3 = 0;
								$qtd_inversor3 = 0;
							} else {
								$cod_inversor3 = $dados[7];
								$qtd_inversor3 = $dados[8];
							}



							$potencia_inversores = str_replace(",", ".", $dados[9]);

							if ($dados[10] != "") {
								$potencia_trafo = str_replace(",", ".", $dados[10]);
							} else {
								$potencia_trafo = 0;
							}

							if ($dados[11] != "") {
								$valor_comercial = str_replace(".", "", $dados[11]);
								$valor_comercial = str_replace(",", ".", $valor_comercial);
							} else {
								$valor_comercial = 0;
							}

							$corrente_inversores = str_replace(",", ".", $dados[12]);

							if ($dados[13] == "") {
								$corrente_inversoresfc09 = 0;
							} else {
								$corrente_inversoresfc09 = str_replace(",", ".", $dados[13]);
							}

							if ($dados[13] == "") {
								$corrente_inversoresfc09 = 0;
							} else {
								$corrente_inversoresfc09 = str_replace(",", ".", $dados[13]);
							}

							$monitoramento = $dados[14];


							if ($dados[15] == "") {
								$dps_ca = 0;
							} else {
								$dps_ca = $dados[15];
							}

							if ($dados[16] == "") {
								$disjuntor = 0;
							} else {
								$disjuntor = $dados[16];
							}


							$busca_kit = $conn->prepare("SELECT * FROM kits_sistema WHERE potencia_modulo_kit = '$potencia' AND qtd_min_modulos_kit >= '$min_modulos' AND qtd_max_modulos_kit <= '$max_modulos' AND tipo_kit = 0 AND finame_kit = $finame AND status_kit = 1");
							try {
								$busca_kit->execute();
							} catch (PDOException $e) {
								$e->getMessage();
							}


							if ($busca_kit->rowCount() > 0) {


								while ($row_kit = $busca_kit->fetch(PDO::FETCH_ASSOC)) {
									$id_kit = $row_kit['id_kit'];

									$update = $conn->prepare("
										UPDATE kits_sistema SET
										status_kit = 0
										WHERE id_kit = '$id_kit'
										");
									try {
										$update->execute();
									} catch (PDOException $e) {
										$e->getMessage();
									}
								}

								$insere = $conn->prepare("
									INSERT INTO kits_sistema(
									tipo_kit,
									finame_kit,
									potencia_modulo_kit,
									qtd_min_modulos_kit,
									qtd_max_modulos_kit,
									range_modulos_kit,
									cod_inversor1_kit,
									cod_inversor2_kit,
									cod_inversor3_kit,
									qtd_inversor1_kit,
									qtd_inversor2_kit,
									qtd_inversor3_kit,
									potencia_inversor_kit,
									potencia_trafo_kit,
									valor_comercial_kit,
									corrente_inversores1_kit,
									corrente_inversores2_kit,
									monitoramento_kit,
									dps_ca_kit,
									disjuntor_comercial_kit,
									status_kit
									)
									VALUES(
									0,
									'$finame',
									'$potencia',
									'$min_modulos',
									'$max_modulos',
									'$range_modulos',
									'$cod_inversor1',
									'$cod_inversor2',
									'$cod_inversor3',
									'$qtd_inversor1',
									'$qtd_inversor2',
									'$qtd_inversor3',
									'$potencia_inversores',
									'$potencia_trafo',
									'$valor_comercial',
									'$corrente_inversores',
									'$corrente_inversoresfc09',
									'$monitoramento',
									'$dps_ca',
									'$disjuntor',
									1								
									)
									");
								try {
									$insere->execute();
								} catch (PDOException $e) {
									$e->getMessage();
								}
							} else {
								$insere = $conn->prepare("
									INSERT INTO kits_sistema(
									tipo_kit,
									finame_kit,
									potencia_modulo_kit,
									qtd_min_modulos_kit,
									qtd_max_modulos_kit,
									range_modulos_kit,
									cod_inversor1_kit,
									cod_inversor2_kit,
									cod_inversor3_kit,
									qtd_inversor1_kit,
									qtd_inversor2_kit,
									qtd_inversor3_kit,
									potencia_inversor_kit,
									potencia_trafo_kit,
									valor_comercial_kit,
									corrente_inversores1_kit,
									corrente_inversores2_kit,
									monitoramento_kit,
									dps_ca_kit,
									disjuntor_comercial_kit,
									status_kit
									)
									VALUES(
									0,
									'$finame',
									'$potencia',
									'$min_modulos',
									'$max_modulos',
									'$range_modulos',
									'$cod_inversor1',
									'$cod_inversor2',
									'$cod_inversor3',
									'$qtd_inversor1',
									'$qtd_inversor2',
									'$qtd_inversor3',
									'$potencia_inversores',
									'$potencia_trafo',
									'$valor_comercial',
									'$corrente_inversores',
									'$corrente_inversoresfc09',
									'$monitoramento',
									'$dps_ca',
									'$disjuntor',
									1								
									)
									");
								try {
									$insere->execute();
								} catch (PDOException $e) {
									$e->getMessage();
								}
							}
							$nro_importacoes++;
							$cont++;
						}
					}
				}

				$tipo_log = "Atualização de Kits";

				$texto_log = nl2br("
					Importado = " . $nro_importacoes . "Registros" .
					"<br>Potência = " . $potencia);

				$rotina_log = "CXESCAD043";

				$insere_log = $conn->prepare("
					INSERT INTO logs_gerais(rotina_log, cod_usuario, cod_registro, tipo_log, descricao_log, data_log)
					VALUES('$rotina_log','$user',0,'$tipo_log','$texto_log','$hj')
					");
				try {
					$insere_log->execute();
				} catch (PDOException $e) {
					$e->getMessage();
				}


				echo "importado_" . $nro_importacoes;
				$conn = null;
				return false;
			} else {
				echo "erro_upload";
				return false;
			}
		}
	} else {
		echo "erro";
		return false;
	}
}