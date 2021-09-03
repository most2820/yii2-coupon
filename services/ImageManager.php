<?php

declare(strict_types=1);

namespace app\services;

use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ImageManager
{
    private string $path;
    private string $url;
    private string $placeholder;

    public function __construct(string $path, string $url, string $placeholder)
    {
        $this->path = $path;
        $this->url = $url;
        $this->placeholder = $placeholder;
        if (!is_dir($this->path)) {
            FileHelper::createDirectory($this->path, 0755, true);
        }
    }

    private function getRandomFileName(string $path, string $extension = ''): string
    {
        do {
            $name = uniqid("") . '.' . $extension;
        } while (file_exists($path . $name));
        return $name;
    }

    public function upload(UploadedFile $file): string
    {
        $name = $this->getRandomFileName($this->path, $file->extension);
        $file->saveAs($this->path . $name);
        return $name;
    }

    public function generateUrl(?string $name): string
    {
        return $name ? $this->url . '/' . $name : $this->placeholder;
    }

    public function getFile(string $name): string
    {
        return $this->path . '/' . $name;
    }

    public function remove(string $name): bool
    {
        if (file_exists($this->path . $name)) {
            return unlink($this->path . $name);
        }
        return false;
    }
}