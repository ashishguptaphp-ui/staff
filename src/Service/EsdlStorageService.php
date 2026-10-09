<?php
namespace App\Service;
use Cake\Core\Configure;
use Aws\S3\S3Client;

class EsdlStorageService
{
    private S3Client $s3;
    private string $bucket;

    public function __construct()
    {
        //$config = config('ESDL');
        $config = Configure::read('ESDL');

        if (empty($config)) {
            throw new \RuntimeException('ESDL configuration not found');
        }

        $this->bucket = $config['bucket'];

        $this->s3 = new S3Client([
            'version'  => 'latest',
            'region'   => $config['region'],
            'endpoint' => $config['endpoint'],
            'use_path_style_endpoint' => true, // 🔴 required
            'credentials' => [
                'key'    => $config['key'],
                'secret' => $config['secret'],
            ],
        ]);
    }

    public function upload($file, string $path): string
    {
        $key = $path . '/' . time() . '_' . $file->getClientFilename();

        $this->s3->putObject([
            'Bucket'     => $this->bucket,
            'Key'        => $key,
            'SourceFile' => $file->getStream()->getMetadata('uri'),
            'ACL'        => 'private',
        ]);

        return $key;
    }

    public function signedUrl(string $key, string $ttl = '+15 minutes'): string
    {
        $cmd = $this->s3->getCommand('GetObject', [
            'Bucket' => $this->bucket,
            'Key'    => $key,
        ]);

        return (string)$this->s3
            ->createPresignedRequest($cmd, $ttl)
            ->getUri();
    }

    public function getContents(string $key): string
    {
        $result = $this->s3->getObject([
            'Bucket' => $this->bucket,
            'Key' => $key,
        ]);

        return $result['Body']->getContents();
    }

    public function delete(string $key): void
    {
        $this->s3->deleteObject([
            'Bucket' => $this->bucket,
            'Key' => $key,
        ]);
    }
}
