<?php
/*
CLASSE: AwsDeleteObject
Deleta um objeto via Delete para o servidor AWS
*/
class AwsDeleteObject
{
	public static function deletar($conn, $caminho, $delimitador_pastas)
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

			

			$result = $s3Client->deleteObject([
				'Bucket' => $bucket,
				'Key' => $caminho, //pasta do bucket + nome do arquivo
			]);
		
			$retorno = $result['ObjectURL'];
			$status = 1;
		
		} catch (S3Exception $e) {
			$retorno =  $e->getMessage() . "\n";
			$status = 0;

		}

		if($status == 1) {
			$deleta_file = $conn->prepare("
			DELETE FROM s3Files WHERE (s3_file_path) = ('$caminho');
			");
			try {
				$excluir_file = $deleta_file->execute();
			} catch (PDOException $e) {
				$excluir_file = $e->getMessage();
			}
			return $excluir_file;
		}

		return $status . "_?_" . $retorno;

	}


}
?>