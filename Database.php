<?php

class DB
{
    protected $connection;
    protected $config;

    public function __construct()
    {
        $this->config = include('config.php');

        try
        {
            $this->connection = new PDO(
                "mysql:host={$this->config['db_host']};dbname={$this->config['db_name']}",
                $this->config['db_username'],
                $this->config['db_password']
            );

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo "Connection error: {$e->getMessage()}";
        }
    }

    public function query($query)
    {
        return $this->connection->query($query);
    }

    public function prepare($query,$param,$value)
    {
		

       $a = $this->connection->prepare($query);
	   $a->bindParam(':'.$param, $value, PDO::PARAM_STR);
	   
       $a->execute();	   
	   $result_array = $a->fetchAll(PDO::FETCH_ASSOC);

	   
	  return $result_array;
    }

}