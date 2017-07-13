<?php
/**
 * This package allows to manage products in catalogue.
 *
 * @package control\catalogue
 * @author Futurer
 */

namespace control\catalogue;

require_once 'lib.php';

abstract class MainController
{
    const SIZE_W = 1350;	//максимальная ширина изображения на шапку сайта (для каждой категории)
    const ICON_SIZE_W=150;	//максимальная ширина изображения-иконки для категории каталога
    const ICON_SIZE_H=150;	//максимальная высота изображения-иконки для категории каталога
    
    protected $dbh;       //объект PDO для работы с БД через PDO_MYSQL
    protected $idc;
    protected $idi;
    protected $idph;
    protected $idr;
    protected $idp;
    protected $tab=1;     //номер вкладки 1 уровня вложенности
    protected $tab1=1;    //номер вкладки 2 уровня вложенности
    protected $id_cat;
    protected $lang;      //язык

    public function __construct($host, $dbname, $user, $pass, $lang, $tab)
    {
        try {
            $this->dbh = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        } catch(PDOException $e) {  
            echo $e->getMessage();  
        }
        $this->lang = $lang;
        $this->tab = $tab;
    }

    abstract public function addedCat(\control\entity\FolderObj $folder_obj);
    abstract public function editedCat();
    abstract public function upPriorCat();
    abstract public function downPriorCat();
    abstract public function markDelCat();
    abstract public function delCat();
}

class CatalogManager extends MainController
{    
    /**
     *
     * @var string Variable to hold error messages or successful operations.
     */
    private $notice = "";
    
    /**
     *
     * @var string A sequence of 16 characters for the temporary identification of the row in the database. 
     */
    private $tmp_code = "";
    
    public function __construct($host, $dbname, $user, $pass, $lang, $tab)
    {
        parent::__construct($host, $dbname, $user, $pass, $lang, $tab);
        
        $this->tmp_code = \lib\LibMethods::getTmpCode();
    }

    /**
     * 
     * @param \control\catalogue\FolderObj $folder_obj Object with information about folder which must be add in data base.
     * @return \control\catalogue\ReportTransact Object with information about completed transaction.
     */
    public function addedCat(\control\entity\FolderObj $folder_obj)
    {
        $dbh = $this->dbh;
        $STH = $dbh->prepare("INSERT INTO seo_metatags (TmpCode) VALUES ('".$this->tmp_code."')");
        $STH->execute();

        $STH = $dbh->prepare("SELECT MetatagsID FROM seo_metatags WHERE TmpCode=? LIMIT 1");
        $STH->bindValue(1, $this->tmp_code, \PDO::PARAM_STR);
        $STH->setFetchMode(\PDO::FETCH_ASSOC);
        $STH->execute();
        $sdb=$STH->fetch();

        $STH = $dbh->prepare("UPDATE seo_metatags SET TmpCode=NULL WHERE MetatagsID=:metatagsid LIMIT 1");
        $STH->bindParam(':metatagsid', $sdb['MetatagsID']);
        $STH->execute();

        $STH = $dbh->prepare("INSERT INTO folders ("
                . "MetatagsID, "
                . "NameFolder{$this->lang}, "
                . "AnnotFolder{$this->lang}, "
                . "ViewModeFolder, "
                . "TmpCode"
             . ") VALUES ( "
                . ":metatagsid, :namecat, :annotcat, :viewmodefolder, :tmpcode"
             . ")");
        $mas_marks = array('metatagsid' => $sdb['MetatagsID']);
        $folder_obj->namecat ? $mas_marks['namecat'] = str_replace("'","\\'",($folder_obj->namecat)) : $mas_marks['namecat'] = 'без названия';
        $folder_obj->annotcat ? $mas_marks['annotcat'] = str_replace("'","\\'",($folder_obj->annotcat)) : $mas_marks['namecat'] = 'NULL';
        if($folder_obj->viewmodefolder && 
            ( $folder_obj->viewmodefolder == 1 || $folder_obj->viewmodefolder == 2 || $folder_obj->viewmodefolder == 3)
        ){
            $mas_marks['viewmodefolder'] = $folder_obj->viewmodefolder;
        } else { $mas_marks['viewmodefolder'] = 'NULL'; }
        $mas_marks['tmpcode'] = $this->tmp_code;
        $STH->execute($mas_marks);
        
        $STH = $dbh->prepare("SELECT FolderID FROM folders WHERE TmpCode=:tmp_code LIMIT 1");
        $STH->bindParam(':tmp_code', $this->tmp_code);
        $STH->setFetchMode(\PDO::FETCH_ASSOC);
        $STH->execute();
        $sdb=$STH->fetch();

        if($sdb['FolderID']){
            $id_cat=$sdb['FolderID'];
            
            $STH = $dbh->prepare("UPDATE folders SET TmpCode=NULL WHERE FolderID=:id_cat LIMIT 1");
            $STH->bindParam(':id_cat', $id_cat);
            $STH->execute();
            
            
            
            $STH = $dbh->prepare("SELECT FolderID FROM index_folders WHERE IndexID=:index_c LIMIT 1");
            $STH->bindParam(':index_c', $folder_obj->index_c);
            $STH->setFetchMode(\PDO::FETCH_ASSOC);
            $STH->execute();
            $sdb=$STH->fetch();
            
            $sdb['FolderID'] ? $folder_id=$sdb['FolderID'] : $folder_id=0;
            
            //узнаем приоритет следующего индекса на этом уровне категорий
            $STH = $dbh->prepare("SELECT `index_folders`.`Prior` "
                               . "FROM `index_folders` "
                               . "WHERE `index_folders`.`ParentFolderID`=:folder_id "
                               . "ORDER BY `index_folders`.`Prior` "
                               . "DESC LIMIT 1");
            if($folder_id){
                $STH->bindValue(':folder_id', $folder_id);
            } else {
                $STH->bindValue(':folder_id', NULL);
            }
            $STH->setFetchMode(\PDO::FETCH_ASSOC);
            $STH->execute();
            $sdb=$STH->fetch();
            $sdb['Prior'] ? $next_prior=$sdb['Prior']*1+1 : $next_prior=1;
            
            $STH = $dbh->prepare("INSERT INTO index_folders (ParentFolderID, FolderID, Prior, TmpCode) VALUES (:folderid, :id_cat, :next_prior, :tmp_code)");
            
            if($folder_id){
                $STH->bindParam(':folderid', $folder_id);
            } else {
                $STH->bindValue(':folderid', NULL);
            }
            $STH->bindParam(':id_cat', $this->id_cat);
            $STH->bindParam(':next_prior', $next_prior);
            $STH->bindParam(':tmp_code', $this->tmp_code);
            $STH->execute();

            $STH = $dbh->prepare("SELECT IndexID FROM index_folders WHERE TmpCode=:tmp_code LIMIT 1");
            $STH->bindParam(':tmp_code', $this->tmp_code);
            $STH->setFetchMode(\PDO::FETCH_ASSOC);
            $STH->execute();
            $sdb=$STH->fetch();
            if($sdb['IndexID']){
                $STH = $dbh->prepare("UPDATE index_folders SET TmpCode=NULL WHERE IndexID=:indexid LIMIT 1");
                $STH->bindParam(':indexid', $sdb['IndexID']);
                $STH->execute();
                return new \control\entity\ReportTransact("edit_cat", 2, $sdb['IndexID'], "Новая категория была успешно добавлена. Теперь можно приступить к управлению информацией в других вкладках.");
            }
        }
        return new \control\entity\ReportTransact("add_cat", $this->tab, $this->idc, "Произошла ошибка при добавлении категории, пожалуйста повторите попытку снова.");
    }
    
    /**
     * @todo Some code for edit category describe in Catalogue.
     */
    public function editedCat()
    {
    }
    
    /**
     * @todo Increase prioritet of category in Catalogue.
     */
    public function upPriorCat()
    {
    }
    
    /**
     * @todo Decrease prioritet of category in Catalogue.
     */
    public function downPriorCat()
    {
    }
    
    /**
     * @todo Marking category enabled/disabled in Catalogue.
     */
    public function markDelCat()
    {    
    }
    
    /**
     * @todo Delete category from Catalogue.
     */
    public function delCat()
    {
    }
}