<?php
/*
CLASSE: AwsEditObject
Edita um objeto via manual no servidor AWS
*/
class AwsEditObject
{
	public static function editar($conn, $pasta, $objeto, $nome_objeto, $delimitador_pastas, $caminho_excluir)
	{

		if(!class_exists("KeysAmazon")){
			include($delimitador_pastas . "classes/KeysAmazon.php");
		}
		require $delimitador_pastas . 'vendor/autoload.php';

		$classeObterKeys = new KeysAmazon();
		$response_keys = $classeObterKeys->obterKeys($conn);
		$exp_keys = explode("_?_", $response_keys);

		$access_key = $exp_keys[0];
		$secret_key = $exp_keys[1];
		$bucket = $exp_keys[2];

		$credentials = new Aws\Credentials\Credentials($access_key, $secret_key);

		try {
			//Create a S3Client
			$s3Client = new Aws\S3\S3Client([
				'version'     => 'latest',
				'region'      => 'sa-east-1', //escolher a região conforme o cadastro do usuário (sa-east-1 = América São Paulo)
				'credentials' => $credentials
			]);

			if($pasta == "") {
				//quero inserir na raiz do bucket
				$caminho = $nome_objeto;
			}
			else {
				//quero inserir na pasta X
				$caminho = $pasta . "/" . $nome_objeto;
			}

			$result_delete = $s3Client->deleteObject([
				'Bucket' => $bucket,
				'Key' => $caminho_excluir, //pasta do bucket + nome do arquivo
			]);

			$result_insert = $s3Client->putObject([
				'Bucket' => $bucket,
				'Key' => $caminho, //pasta do bucket + nome do arquivo
				'SourceFile' => $objeto, //caminho fonte do arquivo a ser upado
			]);
			
			
			$retorno_delete = $result_delete['ObjectURL'];
			$status_delete = 1;
			$retorno_insert = $result_insert['ObjectURL'];
			$status_insert = 1;
		
		
		} catch (S3Exception $e) {
			$retorno_delete =  $e->getMessage() . "\n";
			$status_delete = 0;
			$retorno_insert = $e->getMessage() . "\n";
			$status_insert = 0;

		}

		if($status_delete == 1 && $status_insert == 1) {
			$edit_file = $conn->prepare("
				UPDATE s3Files SET s3_file_path = '$caminho' WHERE s3_file_path = '$caminho_excluir';
			");
			try {
				$editar_file = $edit_file->execute();
			} catch (PDOException $e) {
				$editar_file = $e->getMessage();
			}
		}

		return $status_delete . "_?_" . $retorno_delete . "_?_" . $status_insert . "_?_" . $retorno_insert . "_?_" . $editar_file;

	}

}
?>