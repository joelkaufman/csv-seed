<?php

namespace joelkaufman;

class CsvSeed
{
    private $file;
    public $path;
    public $map = [];

    public function seed(){

        $columns = [];
        $results = [];

        $count = -2;
        if (($handle = fopen($this->path, "r")) !== false) {

            while (($row = fgetcsv($handle, 99999, ",")) !== false) {
                $count ++;

                if($count == -1){
                    $columns = $this->mapColumns($row);
                    continue;
                }


                $data= [];

                for($i = 0; $i < sizeof($row); $i ++){
                    if($columns[$i] == false){
                        continue;
                    }
                    $data[$columns[$i]] = $row[$i];
                }

                $results[$count] = $data;
            }

            fclose($handle);
        }

        return $results;
    }

    private function mapColumns(Array $data){

        $results = Array();

        for($i = 0; $i < sizeof($data); $i ++){

            if( array_key_exists($data[$i], $this->map) )
            {
                $results[$i] = $this->map[$data[$i]];
                continue;
            }

            $results[$i] = $data[$i];
        }

        return $results;
    }

}