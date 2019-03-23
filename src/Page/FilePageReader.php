<?php declare(strict_types = 1);

namespace App\Page;

use App\Page\InvalidPageException;

class FilePageReader implements PageReader
{
    private $pageFolder;

    public function __construct(string $pageFolder)
    {
        $this->pageFolder = $pageFolder;
    }

    public function readBySlug(string $slug) : string
    {
        $path = "$this->pageFolder/$slug.md";
        
        if (!file_exists($path)) {
           
            throw new InvalidPageException($slug);
            
        }
        
        return file_get_contents($path);
    }
    
}