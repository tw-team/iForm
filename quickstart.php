<?php

require_once 'System.php';
require_once 'application/libraries/WindowsAzure/WindowsAzure.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Blob\Models\CreateContainerOptions;
use WindowsAzure\Blob\Models\PublicAccessType;

class WindowsAzureCloudProcessing {
    // Create blob REST proxy.

    private $blobRestProxy;
	private $theData;
    const connectionString = "DefaultEndpointsProtocol=http;AccountName=iforms;AccountKey=eNFXEIQYvYc0Pyg9Q1rRBu3GluBl+sMTw78XOb++QNlKJiVrIEC+K8rzonITR4PB6nWizhtd6wEigerP/icaaA==";

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
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
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
            $file = 'assets/xmlFiles/bigFile.xml';
            foreach($blobs as $blob)
            {
               $this->theData .= file_get_contents($blob->getUrl());  
            }
            file_put_contents($file, $this->theData);
        }
        catch(ServiceException $e){
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
    }
}

$obj1 = new WindowsAzureCloudProcessing();
//$obj1->containerCreator("batman1234");
//$obj1->uploadFile("batman1234", "assets/xmlFiles/fisier.xml", "somethingunique");
$obj1->downloadBlobs("51c1ae28eccca");
unset($obj1);
//$obj1->downloadBlobs();



?>