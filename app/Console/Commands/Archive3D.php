<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Search;

class Archive3D extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:archive3d';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all the data from Archive3D';
    protected $baseUrl;
    protected $txtCategory;
    protected $txtDownload;
    protected $txtPage;
    protected $txtImage;
    protected $txtDiv;
    protected $data;
    protected $domDoc;
    protected $categories;
    protected $products;
    protected $titles;
    protected $nextPage;
    protected $internalErrors;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->baseUrl = 'https://archive3d.net/';
        $this->txtCategory = 'category';
        $this->txtDownload = 'a=download';
        $this->txtPage = '>Next<';
        $this->txtImage = '<img src="';
        $this->txtDiv = '<div class="b1">';
        $this->data = file_get_contents($this->baseUrl);
        $this->domDoc = new \DomDocument('1.0', 'UTF-8');
        $this->internalErrors = libxml_use_internal_errors(true);
        $this->nextPage = '';
        $this->categories = $this->products = $this->titles = [];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->fetchData($this->data);
       $this->fetchDataByCategories();
    }
    
    public function fetchDataByCategories()
    {
      foreach($this->categories as $category) 
      {
         $nextPage = "";
         $this->data = file_get_contents($category);
         $this->fetchData($this->data);
         while($nextPage != "") {
            $this->data = file_get_contents($nextPage);
            $this->fetchData($data);
         }
      }
    }
    
    public function fetchData($data) 
    {
       @$this->domDoc->loadHTML($data);
       libxml_use_internal_errors($this->internalErrors);
       $elements = $this->domDoc->getElementsByTagName('a'); 
       $divElements = $this->domDoc->getElementsByTagName('div'); 

       $i = 0;
       foreach($divElements as $divChild) {
          $line = $divChild->ownerDocument->saveXML( $divChild );
          $pos = strpos($line, $this->txtDiv, 0);
          if($pos !== false && $pos == 0) {
             $start = strpos($line, "<br /><div>");
             $end = strpos($line, "</div>");
             $len = $end - $start - 11;
             $title = substr($line, $start + 11, $len);
             $this->products[$i]['title'] = $title;
             ++$i;
          }
       }

       $j = 0;
       foreach ($elements as $child) { 
          $line = $child->ownerDocument->saveXML( $child );
          if(strpos($line, $this->txtCategory) > -1) {
             $start = strpos($line, "\"");
             $end = strrpos($line, "\">");
             $partUrl = substr($line, $start + 1, $end - 9);
             $this->categories[] = "$this->baseUrl$partUrl";
          } else if(strpos($line, $this->txtDownload) > -1) {
             $start = strpos($line, "\"");
             $end = strrpos($line, "\" title");
             $partUrl = substr($line, $start + 1, $end - 9);
             $linkUrl = "$this->baseUrl$partUrl";

             $start = strpos($line, $this->txtImage);
             $end = strpos($line, "64");
             $len = $end - $start - 1;
             $partUrl = substr($line, $start + 10, $len);
             $imageUrl = "$partUrl";

             $this->products[$j]['image'] = $imageUrl;
             $this->products[$j]['link'] = $linkUrl;

             $searchObj = Search::where('title', $this->products[$j]['title'])->first();
             if(empty($searchObj)) 
             {
                $searchObj = new Search();
                $searchObj['title'] = $this->products[$j]['title'];
                $searchObj['d_link'] = $this->products[$j]['link'];
                $searchObj['d_image'] = $this->products[$j]['image'];
                $searchObj->save();
             }
             ++$j;
          } else if(strpos($line, $this->txtPage) > -1) {		
             $start = strpos($line, "\"");
             $end = strpos($line, "\">Next");
             $partUrl = substr($line, $start + 1, $end - 9);
             $nextPage = "$this->baseUrl$partUrl";
          }
       }
    }
}
