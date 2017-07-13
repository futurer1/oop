<?php

namespace control\entity;

/**
 * Class contains data about the finished operation to the database.
 */
class ReportTransact
{
    private $act;
    private $tab;
    private $idc;
    private $notice;   
    
    public function __construct($act, $tab, $idc, $notice="")
    {
        $this->act = $act;
        $this->tab = $tab;
        $this->idc = $idc;
        $this->notice = $notice;
    }
    
    public function getValue($name)
    {
        return $this->{$name};
    }
}

/**
 * This class provide to create and hold Folder objects of items catalogue.
 */
class FolderObj
{
    /**
     * @var string $namecat The name of the category of goods.
     * @var string $annotcat Short description of the category of goods.
     * @var int $viewmodefolder The display mode of the products in category of Catalogue.
     * @var int $index_c IndexID from table index_folders
     */
    public $namecat;
    public $annotcat;
    public $viewmodefolder;
    public $index_c;


    public function __construct(string $namecat="", string $annotcat="", int $viewmodefolder=null, int $index_c=null)
    {
        $this->namecat = $namecat;
        $this->annotcat = $annotcat;
        $this->viewmodefolder = $viewmodefolder;
        $this->index_c = $index_c;
    }
}