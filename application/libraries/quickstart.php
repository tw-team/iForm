<?php

require_once 'System.php';
require_once 'WindowsAzure/WindowsAzure.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Blob\Models\CreateContainerOptions;
use WindowsAzure\Blob\Models\PublicAccessType;

class WindowsAzureCloudProcessing {
    // Create blob REST proxy.

    private $blobRestProxy;
	private $theData;
    const connectionString = "DefaultEndpointsProtocol=http;AccountName=iforms;AccountKey=BAVgIfXFy09uQWL3DHqy6gPGqwiGaqfer1YQ6qLyXlx1+xPix1qV1OCTUa4L/aj7Idd6zDm2DiX9KY9xovC2zw==";

     public function __construct() {
        $this->blobRestProxy = ServicesBuilder::getInstance()->createBlobService(self::connectionString);
    }

    public function containerCreator($containerName) {
        $createContainerOptions = new CreateContainerOptions(); 
        $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
        try {
        // Create container.
			$this->blobRestProxy->createContainer($containerName, $createContainerOptions);
        }
        catch(ServiceException $e){

        }

    }
    public function uploadFile($containerName, $filePath, $blobName) {
        $content = file_get_contents($filePath);
        try {
            $this->blobRestProxy->createBlockBlob($containerName, $blobName, $content);
        }
        catch(ServiceException $e){
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
    }
	
    public function downloadBlobs($containerName) {
        try {
            // List blobs.
            $blob_list = $this->blobRestProxy->listBlobs($containerName);
            $blobs = $blob_list->getBlobs();
            $res  = array();
            foreach($blobs as $blob)
            {
                $content = file_get_contents($blob->getUrl());
                array_push($res,$content);
            }
            return $res;
            
        }
        catch(ServiceException $e){
            return;
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
    }
	public function deleteBlobs($containerName)
    {
		try {

			$blob_list = $this->blobRestProxy->listBlobs($containerName);
			$blobs = $blob_list->getBlobs();
			foreach($blobs as $blob)
			{
				$this->blobRestProxy->deleteBlob($containerName, $blob->getName());
			}
            $this->blobRestProxy->deleteContainer($containerName);
		}
		catch(ServiceException $e){
        }
	}
}

//$obj1 = new WindowsAzureCloudProcessing();
//$obj1->containerCreator("batman1234");
//$obj1->uploadFile("batman1234", "assets/xmlFiles/fisier.xml", "somethingunique");
//$obj1->downloadBlobs("batman1234");
//unset($obj1);
//$obj1->downloadBlobs();



?>