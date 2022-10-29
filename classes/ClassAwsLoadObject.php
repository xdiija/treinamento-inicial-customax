<?php
/*
CLASSE: AwsLoadObject
Carrega objeto do servidor AWS
*/
class AwsLoadObject
{
	public static function carregar($conn, $delimitador_pastas)
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

			$busca = $conn->prepare("SELECT * FROM s3Files ORDER BY id_file DESC");

			try {
				$busca->execute();
			} catch (PDOException $e) {
				$e->getMessage();
			}

			$data = '';

			while($row = $busca->fetch(PDO::FETCH_ASSOC)) {

				$caminho = $row['s3_file_path'];

				$cmd = $s3Client->getCommand('GetObject', [
					'Bucket' => $bucket,
					'Key' => $caminho
				]);
				
				$request = $s3Client->createPresignedRequest($cmd, '+20 minutes');
				
				// Get the actual presigned-url
				$presignedUrl = (string)$request->getUri();

				$data .= '<div class="col-lg-4">
							<div class="card-group">
								<div class="card mb-3 parent-container">
									<a id="'.$caminho.'" class="image-link" href="'.$presignedUrl.'">
										<img id="'.$caminho.'" src="'.$presignedUrl.'" class="card-img-top" width="150" height="150">
									</a>
								</div>
							</div>
						</div>';
			}
				
			return($data);
			
		} catch (S3Exception $e) {
			$retorno =  $e->getMessage() . "\n";
			$status = 0;
			
		}
	}

}
?>