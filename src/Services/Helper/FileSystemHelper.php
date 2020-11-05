<?php

namespace App\Services\Helper;

use Symfony\Component\Filesystem\Filesystem;

class FileSystemHelper
{

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function saveAvatar(string $svg)
    {
        $filename = md5(uniqid(rand(), true)). '.svg';
        $filepath = 'avatars/' . $filename;

        $this->filesystem->mkdir('avatars');
        $this->filesystem->touch($filepath);
        $this->filesystem->appendToFile($filepath, $svg);


        return $filename;
    }

}