<?php

namespace CsvSeed;

class CsvSeed
{
    private $file;
    public $path;
    public $map = [];

    public function seed(){

        $columns = [];
        $results = [];

        $count = -2;
        if (($handle = fopen($this->path, "r")) !== FALSE) {

            while (($row = fgetcsv($handle, 99999, ",")) !== FALSE) {
                $count ++;

                if($count == -1){
                    $columns = $this->mapColumns($row);
                    continue;
                }


                $data= [];

                for($i = 0; $i < sizeof($row); $i ++){
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