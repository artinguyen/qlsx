<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class ArticlesController extends AppController
{
    
    public $session;
    public function initialize(): void
    {
        parent::initialize();
        
        $this->session = $this->request->getSession();
        //var_dump($this->session->read('user_id'));die();
    }

    public function index()
    {
        // $this->loadComponent('Paginator');
        // $articles = $this->Paginator->paginate($this->Articles->find());
        // $this->set(compact('articles'));
        //die(ini_get('memory_limit'));
        echo "Memory usage report:"."\n";
$total = memory_get_usage(True);
$used = memory_get_usage(False);
echo "   Total memory: ".$total."\n";
echo "   Used memory: ".$used."\n";

echo "Memory test on string object (10Ki) allocatin:"."\n";
$before = memory_get_usage();
$o = str_repeat("Hello PHP!", 1024); # 10,240 byte-string
$after = memory_get_usage();
unset($o);
$final = memory_get_usage();
echo "   Memory used before allocation: ".$before."\n";
echo "   Memory used before allocation: ".$after."\n";
echo "   Memory used used by the string: ".($after-$before)."\n";
echo "   Memory freed up by the string: ".($after-$final)."\n";

echo "Increase memory upper limit:"."\n";
$before = ini_get('memory_limit');
ini_set('memory_limit', '256M');
$after = ini_get('memory_limit');
echo "   Memory limit before: ".$before."\n";
echo "   Memory limit after: ".$after."\n";
die();
        $this->autoRender = false;
        
        $this->session->write('user_id', '1');
        $big_array = array();
for ($i = 0; $i < 1000000; $i++)
{
   $big_array[] = $i;
}
echo 'After building the array.<br>';
$this->print_mem();
unset($big_array);
echo 'After unsetting the array.<br>';
$this->print_mem();
    }

    public function test()
    {
        //$session = $this->request->getSession();
        var_dump($this->session->read('user_id'));die();
    }

    function print_mem()
{
   /* Currently used memory */
   $mem_usage = memory_get_usage();
   
   /* Peak memory usage */
   $mem_peak = memory_get_peak_usage();
   echo 'The script is now using: <strong>' . round($mem_usage) . 'KB</strong> of memory.<br>';
   echo 'Peak usage: <strong>' . round($mem_peak) . 'KB</strong> of memory.<br><br>';
}
}