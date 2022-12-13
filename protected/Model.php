<?php
namespace App;
use App\Db;

abstract class Model
{
    protected static $table = null;

    public static function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;
        $db = new Db();
        return $db->query($sql, static::class);
    }
    
    /**
     * findById
     *
     * @param  mixed $id
     * @return void
     */
    public static function findById($id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=' . $id;
        $db = new Db();
        $result = $db->query($sql, static::class);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }   
    }
    
    /**
     * @return void
     */
    public function insert()
    {
        $db = new Db();
        
        $data = get_object_vars($this);
        
        $bindings = [];
        $columns = []; 
        $values = [];

        foreach($data as $key => $value){
            if($key == 'id' & static::class != 'App\Models\Article'){
                continue;
            }
            
            $columns[] = $key;
            $bindings[] = ':'. $key;
            $values[':'. $key] = $value;
        }
        
        $sql = 'INSERT INTO ' . static::$table . 
        ' ('. implode(',', $columns) .') 
        VALUES ('.implode(',',$bindings).')';

        $db->execute($sql, $values);
        
        if(static::class != 'App\Models\Article'){
            $this->id = $db->lastInsertId();
        }
    }
    
    /**
     * @param  array $data
     * @return void
     */
    public static function insertAll(array $data)
    {   
        $db = new Db();

        $columnsVars = get_class_vars(static::class);

        $bindings = [];
        $columns = []; 
        $values = [];

        $counter = 1;
        foreach ($columnsVars as $key => $value) {
            if($key == 'id' & static::class != 'App\Models\Article' | $key == 'table'){
                continue;
            }
            $columns[] = $key;
        }

        foreach ($data as $item) {
            
            $testObj = get_object_vars($item);
            $bindingsItem = [];
            $valuesItem = [];
            
            foreach ($testObj as $key => $value) {
                if ($key == 'id' & static::class != 'App\Models\Article') {
                    continue;
                }
                $bindingsItem[] = ':'. $key . $counter;
                $values[':'. $key . $counter] = $value;
                
            }

            $bindings[] = '( ' . implode( ',',$bindingsItem ) . ' )';
            $counter = $counter + 1;
               
        }
        
        $sql = 'INSERT INTO ' . static::$table . 
        ' ('. implode(',' , $columns) .') 
        VALUES '.implode(',' , $bindings);

        $db->execute($sql, $values);
        
    }
}
