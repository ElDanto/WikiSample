<?php
namespace App;
use App\Config;
class Db
{
    protected $dbh;

    public function __construct()
    {
        $config = \App\Config::instance();
        $dbs = 'mysql:host=' . $config->data['db']['host'] . '; dbname=' . $config->data['db']['dbname']; 
        $this->dbh = new \PDO($dbs, $config->data['db']['dbuser'], $config->data['db']['dbpass']);
        
    }
    
    /**
     * @param  string $sql
     * @param  string $class
     * @param  array $data
     * @return array $object
     */
    public function query(string $sql, string $class, array $data = []){
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);

        $data = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        
        return $data;
    }
    
    /**
     * @param  string $query
     * @param  array $params
     * @return bool
     */
    public function execute($query, $params=[])
    {
        $sth = $this->dbh->prepare($query);
        return $sth->execute($params);
    }
    
    public function lastInsertId()
    {
        $data = $this->dbh->lastInsertId();
        return $data; 
    }

}
