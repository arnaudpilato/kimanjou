<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $profile;
    private $location;
    private $slugger;

    public function __construct($targetDirectory, $profile, $location, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->profile = $profile;
        $this->location = $location;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file, $directory): string
    {
        if ($directory === 'profile') {
            $this->targetDirectory = $this->profile;
        }

        if ($directory === 'location') {
            $this->targetDirectory = $this->location;
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}